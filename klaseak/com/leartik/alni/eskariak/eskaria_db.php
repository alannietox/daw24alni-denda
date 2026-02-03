<?php
namespace com\leartik\alni\eskariak;

use PDO;
use PDOException;
use com\leartik\alni\eskariak\Eskaria;
use com\leartik\alni\detaileak\Detailea;
// IMPORTANTE: Importamos la clase Bezeroa
use com\leartik\alni\bezeroak\Bezeroa; 

class EskariaDB
{
    private static function getDbPath()
    {
        return "sqlite:C:\\xampp\\htdocs\\0erronka\\produktuak.db";
    }

    private static function getConnection()
    {
        try {
            $db = new PDO(self::getDbPath());
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo "<p>Konexio errorea: " . $e->getMessage() . "</p>";
            return null;
        }
    }

    /**
     * Helper para convertir una fila de la BD en un objeto Eskaria completo
     * que contiene dentro un objeto Bezeroa.
     */
    private static function mapRowToEskaria($row)
    {
        // 1. Crear el objeto Bezeroa y llenarlo con SETTERS
        $bezeroa = new Bezeroa();
        // El ID del cliente no lo tenemos guardado en eskariak, así que usamos 0 o null
        $bezeroa->setId(0); 
        $bezeroa->setIzena($row['izena']);
        $bezeroa->setAbizena($row['abizena']);
        $bezeroa->setHelbidea($row['helbidea']);
        $bezeroa->setHerria($row['herria']);
        $bezeroa->setPostakodea($row['postakodea']);
        $bezeroa->setProbintzia($row['probintzia']);
        $bezeroa->setEmaila($row['emaila']);

        // 2. Crear el objeto Eskaria
        $eskaria = new Eskaria();
        $eskaria->setId($row['id']);
        $eskaria->setData($row['data']);
        
        // 3. Meter el objeto Bezeroa DENTRO de Eskaria
        $eskaria->setBezeroa($bezeroa);

        return $eskaria;
    }

    public static function selectEskariak()
    {
        $eskariak = [];
        try {
            $db = self::getConnection();
            if (!$db) return [];

            // Seleccionamos los campos planos de la tabla
            $sql = "SELECT * FROM eskariak ORDER BY data DESC";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Usamos el helper para crear los objetos
                $eskaria = self::mapRowToEskaria($row);
                
                // Cargar detalles
                $eskaria->setDetaileak(self::selectDetaileak($db, $eskaria->getId()));
                
                $eskariak[] = $eskaria;
            }
            return $eskariak;
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function selectEskaria($id)
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare("SELECT * FROM eskariak WHERE id = ?");
            $stmt->execute([$id]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $eskaria = self::mapRowToEskaria($row);
                $eskaria->setDetaileak(self::selectDetaileak($db, $id));
                return $eskaria;
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    private static function selectDetaileak($db, $idEskaria) 
    {
        $detaileak = [];
        try {
            $stmt = $db->prepare("SELECT * FROM detaileak WHERE id_eskaria = ?");
            $stmt->execute([$idEskaria]);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Aquí podrías necesitar ProduktuaDB para cargar el objeto producto completo
                // De momento pasamos el ID
                $detailea = new Detailea($row['id_produktua'], $row['kopurua'], $row['prezioa']);
                $detaileak[] = $detailea;
            }
        } catch (PDOException $e) {}
        return $detaileak;
    }

    public static function insertEskaria($eskaria)
    {
        $db = self::getConnection();
        if (!$db) return 0;

        try {
            $db->beginTransaction();

            // 1. Extraemos el objeto Bezeroa de dentro del Eskaria
            // (Si usas getters: $eskaria->getBezeroa(), si es público: $eskaria->bezeroa)
            $bezeroa = method_exists($eskaria, 'getBezeroa') ? $eskaria->getBezeroa() : $eskaria->bezeroa;

            // 2. Insertamos usando los GETTERS de Bezeroa
            $sql = "INSERT INTO eskariak (izena, abizena, helbidea, herria, postakodea, probintzia, emaila, data) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $db->prepare($sql);
            
            // Si Eskaria tiene getter para fecha: $eskaria->getData(), si no $eskaria->data
            $fecha = method_exists($eskaria, 'getData') ? $eskaria->getData() : $eskaria->data;
            if (!$fecha) $fecha = date('Y-m-d H:i:s');

            $stmt->execute([
                $bezeroa->getIzena(),      // Usamos Getter de Bezeroa
                $bezeroa->getAbizena(),    // Usamos Getter de Bezeroa
                $bezeroa->getHelbidea(),   // Usamos Getter de Bezeroa
                $bezeroa->getHerria(),     // Usamos Getter de Bezeroa
                $bezeroa->getPostakodea(), // Usamos Getter de Bezeroa
                $bezeroa->getProbintzia(), // Usamos Getter de Bezeroa
                $bezeroa->getEmaila(),     // Usamos Getter de Bezeroa
                $fecha
            ]);

            $lastId = $db->lastInsertId();

            // 3. Insertar Detalles
            // (Si usas getters: $eskaria->getDetaileak(), si es público: $eskaria->detaileak)
            $detaileak = method_exists($eskaria, 'getDetaileak') ? $eskaria->getDetaileak() : $eskaria->detaileak;

            if (!empty($detaileak)) {
                $sqlDet = "INSERT INTO detaileak (id_eskaria, id_produktua, kopurua, prezioa) VALUES (?, ?, ?, ?)";
                $stmtDet = $db->prepare($sqlDet);

                foreach ($detaileak as $detailea) {
                    // Asumiendo que Detailea tiene getters o props públicas
                    $prodId = is_object($detailea->getProduktua()) ? $detailea->getProduktua()->getId() : $detailea->getProduktua();
                    
                    $stmtDet->execute([
                        $lastId,
                        $prodId,
                        $detailea->getKopurua(),
                        $detailea->getPrezioa()
                    ]);
                }
            }

            $db->commit();
            return 1; 

        } catch (PDOException $e) {
            $db->rollBack();
            // Para depurar:
            echo "Error Insert: " . $e->getMessage();
            return 0;
        }
    }
    
    // El update y delete seguirían la misma lógica si los necesitas
}
?>