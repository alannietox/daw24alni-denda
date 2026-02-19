<?php
session_start();

$parametroak = [
    'erabiltzailearen_mezua' => ''
];

$erroreak = [
    'erabiltzailearen_mezua' => '',
];

$botaren_mezua = '';
$hasierako_mezua = '';

if (!isset($_SESSION['txataren_mezuak']))
    $_SESSION['txataren_mezuak'] = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST'):

    $parametroak['erabiltzailearen_mezua'] = trim($_POST['erabiltzailearen_mezua']);

    if (mb_strlen($parametroak['erabiltzailearen_mezua']) == 0):
        $erroreak['erabiltzailearen_mezua']  = 'Mezua falta da';
    endif;

    if (implode($erroreak) != ''):
        $hasierako_mezua = 'Mesedez, zuzendu ondorengo akatsa:';
    else:
        $hasierako_mezua = 'Zure mezua baliozkoa da';
        $_SESSION['txataren_mezuak'][] = ["role" => "user", "content" => $parametroak['erabiltzailearen_mezua']];

        // -----------------------------------------------------------
        // 1. OBTENER FILTROS (Prompt mejorado para limpiar Euskera)
        // -----------------------------------------------------------
        $data = [
            "model" => "gpt-5.2", // O el modelo que uses
            "store" => false,
            "input" => array_merge([
                [
                    "role" => "system",
                    "content" => [
                        [
                            "type" => "input_text",
                            "text" => "Erabiltzailearen esalditik produktuak bilatzeko iragazkiak atera JSON formatuan.
                                       Eremuak: marka, modeloa, gama, kategoria, nobedadea (1/0), deskontua (1/0), salneurri_minimoa, salneurri_maximoa.
                                       
                                       OSO GARRANTZITSUA:
                                       1. Hitzak normalizatu: Kendu deklinabideak. (Adibidez: 'Nvidiako' -> 'Nvidia', 'Asuseko' -> 'Asus').
                                       2. Kategoriak bakarrik hauek izan daitezke: 'cpu', 'gpu', 'ram'.
                                       3. Ez badago baliorik, jarri null.
                                       4. Bakarrik JSONa itzuli, azalpenik gabe."
                        ]
                    ]
                ]
            ], $_SESSION['txataren_mezuak'])
        ];

        // Función para llamar API
        function llamarAPI($data) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/responses'); // Verifica tu URL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . getenv('OPENAI_API_KEY'),
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response, true);
        }

        $response_data = llamarAPI($data);
        
        // Limpieza y Debug
        $text = $response_data['output'][0]['content'][0]['text'] ?? '{}';
        $text = str_replace(['```json', '```'], '', $text);
        $filtroak = json_decode($text, true);
        
        if (!is_array($filtroak)) $filtroak = [];

        // -----------------------------------------------------------
        // 2. CONSULTA SQL (Robustez para encontrar marcas en modelos)
        // -----------------------------------------------------------
        try {
            $db_error = null;
            $db_path = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'produktuak.db');
            if ($db_path === false) {
                $db_path = __DIR__ . DIRECTORY_SEPARATOR . 'produktuak.db';
            }
            $db = new PDO('sqlite:' . $db_path);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Unimos produktuak con kategoriak
            $sql = 'SELECT p.*, k.izena as kategoria_izena 
                    FROM produktuak p 
                    LEFT JOIN kategoriak k ON p.id_kategoria = k.id_kategoria 
                    WHERE 1=1';
            
            $sql_paramteroak = [];

            // Lógica Cruzada: Si busca Marca "Nvidia", miramos en Marca O Modelo
            if (!empty($filtroak['marka'])) {
                $sql .= ' AND (p.marka LIKE :marka OR p.modeloa LIKE :marka)';
                $sql_paramteroak[':marka'] = '%' . $filtroak['marka'] . '%';
            }
            // Si busca Modelo, también miramos en ambos por si acaso
            if (!empty($filtroak['modeloa'])) {
                $sql .= ' AND (p.modeloa LIKE :modeloa OR p.marka LIKE :modeloa)';
                $sql_paramteroak[':modeloa'] = '%' . $filtroak['modeloa'] . '%';
            }
            
            if (!empty($filtroak['gama'])) {
                $sql .= ' AND p.gama LIKE :gama';
                $sql_paramteroak[':gama'] = '%' . $filtroak['gama'] . '%';
            }
            
            // Filtramos por el NOMBRE de la categoría (gpu, cpu, ram)
            if (!empty($filtroak['kategoria'])) {
                $sql .= ' AND k.izena LIKE :kategoria';
                $sql_paramteroak[':kategoria'] = '%' . $filtroak['kategoria'] . '%';
            }

            if (!empty($filtroak['salneurri_minimoa'])) {
                $sql .= ' AND p.prezioa >= :min';
                $sql_paramteroak[':min'] = $filtroak['salneurri_minimoa'];
            }
            if (!empty($filtroak['salneurri_maximoa'])) {
                $sql .= ' AND p.prezioa <= :max';
                $sql_paramteroak[':max'] = $filtroak['salneurri_maximoa'];
            }
            if (!empty($filtroak['nobedadea']) && $filtroak['nobedadea'] == 1) {
                $sql .= ' AND p.nobedadea = 1';
            }

            $kontsulta = $db->prepare($sql);
            $kontsulta->execute($sql_paramteroak);
            $produktuak = $kontsulta->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $db_error = $e->getMessage();
            $produktuak = [];
        }

        if (!empty($db_error)) {
            $katalogoa = "Errorea BDn: " . $db_error . "\n";
        }

        // -----------------------------------------------------------
        // 3. GENERAR CATÁLOGO
        // -----------------------------------------------------------
        $katalogoa = '';
        if (empty($produktuak)) {
            $katalogoa = "Ez da produkturik aurkitu iragazki hauekin: " . json_encode($filtroak); 
            // ^ He añadido esto para que veas en el chat qué está fallando (borrar luego)
        } else {
            foreach ($produktuak as $p) {
                $katalogoa .= "• [{$p['kategoria_izena']}] {$p['marka']} {$p['modeloa']} ({$p['gama']}) - {$p['prezioa']}€\n";
            }
        }

        // -----------------------------------------------------------
        // 4. RESPUESTA FINAL
        // -----------------------------------------------------------
        $data = [
            "model" => "gpt-5.2",
            "input" => array_merge([
                [
                    "role" => "system",
                    "content" => [
                        [
                            "type" => "input_text",
                            "text" => "PcZone dendako laguntzailea zara.
                                       Erabili BAKARRIK beheko zerrenda erantzuteko.
                                       Zerrenda hutsik badago, esan ez dugula produkturik.
                                       
                                       === PRODUKTU ZERRENDA ===
                                       $katalogoa
                                       === ZERRENDA AMAIERA ==="
                        ]
                    ]
                ],
            ], $_SESSION['txataren_mezuak'])
        ];

        $response_data = llamarAPI($data);
        
        if(isset($response_data['output'][0]['content'][0]['text'])) {
            $botaren_mezua = $response_data['output'][0]['content'][0]['text'];
        } else {
            $botaren_mezua = "Errorea sisteman. Saiatu berriro.";
        }

        $_SESSION['txataren_mezuak'][] = ["role" => "assistant", "content" => $botaren_mezua];
        echo $botaren_mezua;
        exit;
    endif;
else: 
    include 'chatbot.php';
endif 
?>