<?php
namespace com\leartik\alni\saskia;

// 1. IMPORTACIONES
require_once('../klaseak/com/leartik/alni/produktuak/produktua.php');
require_once('../klaseak/com/leartik/alni/produktuak/produktua_db.php');
require_once('../klaseak/com/leartik/alni/saskiak/saskia.php');
require_once('../klaseak/com/leartik/alni/detaileak/detailea.php');
require_once('../klaseak/com/leartik/alni/eskariak/eskaria.php');
require_once('../klaseak/com/leartik/alni/eskariak/eskaria_db.php');
// NUEVO: Importar Bezeroa
require_once('../klaseak/com/leartik/alni/bezeroak/bezeroa.php');

use com\leartik\alni\produktuak\ProduktuaDB;
use com\leartik\alni\saskiak\Saskia;
use com\leartik\alni\detaileak\Detailea;
use com\leartik\alni\eskariak\Eskaria;
use com\leartik\alni\eskariak\EskariaDB;
// NUEVO: Use Bezeroa
use com\leartik\alni\bezeroak\Bezeroa;

session_start();

if (!isset($_SESSION['saskia'])) {
    $_SESSION['saskia'] = new Saskia();
}

$saskia = $_SESSION['saskia'];
$bista = 'saskia_erakutsi.php';

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];

    switch ($action) {
        case 'add':
            if (isset($_POST['id_produktua'])) {
                $id = (int)$_POST['id_produktua'];
                $kopurua = isset($_POST['kopurua']) ? (int)$_POST['kopurua'] : 1;
                $produktua = ProduktuaDB::selectProduktua($id);

                if ($produktua) {
                    $aurkitua = false;
                    $detaileak = $saskia->getDetaileak(); 
                    
                    foreach ($detaileak as $detailea) {
                        if ($detailea->getProduktua()->getId() == $id) {
                            $kopuruBerria = $detailea->getKopurua() + $kopurua;
                            $detailea->setKopurua($kopuruBerria);
                            $aurkitua = true;
                            break; 
                        }
                    }

                    if (!$aurkitua) {
                        $detaileaBerria = new Detailea($produktua, $kopurua);
                        $saskia->detaileaGehitu($detaileaBerria);
                    }
                    $_SESSION['saskia'] = $saskia;
                }
            }
            header('Location: index.php');
            exit();
            break;

        case 'empty':
            $_SESSION['saskia'] = new Saskia();
            header('Location: index.php');
            exit();
            break;

        case 'checkout':
            $bista = 'bezero_datuak.php';
            break;

        case 'confirm':
            // --- LOGICA ACTUALIZADA CON BEZEROA ---
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                // 1. Crear y rellenar el objeto BEZEROA
                $bezeroa = new Bezeroa();
                // Usamos setters porque son privados
                $bezeroa->setIzena($_POST['izena'] ?? '');
                $bezeroa->setAbizena($_POST['abizena'] ?? '');
                $bezeroa->setEmaila($_POST['email'] ?? '');
                $bezeroa->setHelbidea($_POST['helbidea'] ?? '');
                $bezeroa->setHerria($_POST['herria'] ?? '');
                $bezeroa->setPostakodea($_POST['postakodea'] ?? 0);
                $bezeroa->setProbintzia($_POST['probintzia'] ?? '');

                // 2. Crear el objeto ESKARIA y meterle el BEZEROA dentro
                $eskaria = new Eskaria();
                $eskaria->setBezeroa($bezeroa); // <--- Asignamos el objeto cliente

                // 3. Asignar los productos del carrito
                $eskaria->setDetaileak($saskia->getDetaileak());

                // 4. Guardar en Base de Datos
                $emaitza = EskariaDB::insertEskaria($eskaria);

                if ($emaitza) {
                    $_SESSION['saskia'] = new Saskia(); // Vaciar carro
                    $saskia = $_SESSION['saskia'];
                    
                    // Pasamos $eskaria a la vista para mostrar resumen
                    $bista = 'eskaria_bistaratu.php'; 
                } else {
                    echo "<script>alert('Errorea eskaria gordetzean');</script>";
                    $bista = 'bezero_datuak.php';
                }

            } else {
                $bista = 'saskia_erakutsi.php';
            }
            break;

        case 'remove':
            if (isset($_GET['id'])) {
                $idEzabatu = (int)$_GET['id'];
                $saskiaBerria = new Saskia();
                $detaileakZaharrak = $saskia->getDetaileak();

                foreach ($detaileakZaharrak as $detailea) {
                    if ($detailea->getProduktua()->getId() != $idEzabatu) {
                        $saskiaBerria->detaileaGehitu($detailea);
                    }
                }
                $saskia = $saskiaBerria;
                $_SESSION['saskia'] = $saskia;
            }
            header('Location: index.php');
            exit();
            break;

        case 'update':
            if (isset($_POST['id_produktua']) && isset($_POST['kopurua'])) {
                $id = (int)$_POST['id_produktua'];
                $kopurua = (int)$_POST['kopurua'];
                
                if ($kopurua <= 0) {
                    header("Location: index.php?action=remove&id=$id");
                    exit();
                }

                $detaileak = $saskia->getDetaileak();
                foreach ($detaileak as $detailea) {
                    if ($detailea->getProduktua()->getId() == $id) {
                        $detailea->setKopurua($kopurua);
                        break;
                    }
                }
                $_SESSION['saskia'] = $saskia;
            }
            header('Location: index.php');
            exit();
            break;

        default:
            $bista = 'saskia_erakutsi.php';
            break;
    }
}

include($bista);
?>