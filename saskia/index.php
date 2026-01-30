<?php
// saskia/index.php

namespace com\leartik\alni\saskia;

require_once('../klaseak/com/leartik/alni/produktuak/produktua.php');
require_once('../klaseak/com/leartik/alni/produktuak/produktua_db.php');
require_once('../klaseak/com/leartik/alni/saskiak/saskia.php');
require_once('../klaseak/com/leartik/alni/detaileak/detailea.php');

use com\leartik\alni\produktuak\ProduktuaDB;
use com\leartik\alni\saskiak\Saskia;
use com\leartik\alni\detaileak\Detailea;

session_start();

// Saskia inizializatu
if (!isset($_SESSION['saskia'])) {
    $_SESSION['saskia'] = new Saskia();
}

$saskia = $_SESSION['saskia'];
$bista = 'saskia_erakutsi.php'; // Bista lehenetsia

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];

    switch ($action) {
        case 'add':
            if (isset($_POST['id_produktua'])) {
                $id = (int)$_POST['id_produktua'];
                $kopurua = isset($_POST['kopurua']) ? (int)$_POST['kopurua'] : 1;
                $produktua = ProduktuaDB::selectProduktua($id);

                if ($produktua) {
                    // LOGICA NUEVA EN EL INDEX:
                    
                    $aurkitua = false;
                    $detaileak = $saskia->getDetaileak(); // Obtenemos lo que hay en el carro
                    
                    // Recorremos el carro actual
                    foreach ($detaileak as $detailea) {
                        if ($detailea->getProduktua()->getId() == $id) {
                            // Si el ID coincide, actualizamos la cantidad
                            $kopuruBerria = $detailea->getKopurua() + $kopurua;
                            $detailea->setKopurua($kopuruBerria);
                            $aurkitua = true;
                            break; 
                        }
                    }

                    // Si NO lo hemos encontrado en el bucle, creamos uno nuevo
                    if (!$aurkitua) {
                        $detaileaBerria = new Detailea($produktua, $kopurua);
                        $saskia->detaileaGehitu($detaileaBerria);
                    }
                    
                    // Guardamos los cambios en sesión
                    $_SESSION['saskia'] = $saskia;
                }
            }
            // La redirección para evitar duplicados al recargar (F5)
            header('Location: index.php');
            exit();
            break;

        case 'empty':
            $_SESSION['saskia'] = new Saskia();
            $saskia = $_SESSION['saskia'];
            
            // --- CAMBIO AQUÍ: Redirección ---
            header('Location: index.php');
            exit();
            break;

        case 'checkout':
            // 1. PAUSOA: Formularioa erakutsi
            $bista = 'bezero_datuak.php';
            break;

        case 'confirm':
            // 2. PAUSOA: Formularioa jaso eta laburpena erakutsi
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $bezeroa = [
                    'izena'    => $_POST['izena'] ?? '',
                    'abizena'  => $_POST['abizena'] ?? '',
                    'email'    => $_POST['email'] ?? '',
                    'helbidea' => $_POST['helbidea'] ?? ''
                ];
                
                // Nota: Si recargas aquí, todavía te pedirá reenviar el formulario.
                // Para arreglar esto también, deberías guardar $bezeroa en $_SESSION
                // y redirigir a una acción nueva (ej: case 'success').
                
                $bista = 'eskaria_bistaratu.php';
            } else {
                $bista = 'saskia_erakutsi.php';
            }
            break;
        case 'remove':
            if (isset($_GET['id'])) {
                $idEzabatu = (int)$_GET['id'];
                
                // Creamos un carro NUEVO y VACÍO
                $saskiaBerria = new Saskia();
                $detaileakZaharrak = $saskia->getDetaileak();

                // Recorremos el viejo y pasamos al nuevo SOLO lo que no borramos
                foreach ($detaileakZaharrak as $detailea) {
                    if ($detailea->getProduktua()->getId() != $idEzabatu) {
                        $saskiaBerria->detaileaGehitu($detailea);
                    }
                }
                
                // Sustituimos el carro viejo por el nuevo
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
                
                // Si pone 0 o menos, lo mandamos a borrar
                if ($kopurua <= 0) {
                    header("Location: index.php?action=remove&id=$id");
                    exit();
                }

                // Buscamos el producto y le cambiamos el número
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