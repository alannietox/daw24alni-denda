<?php
// Ajusta las rutas (../../) según tu estructura de carpetas real
require('../klaseak/com/leartik/alni/mezuak/mezua.php'); 
require('../klaseak/com/leartik/alni/mezuak/mezua_db.php');

use com\leartik\alni\mezuak\Mezua; 
use com\leartik\alni\mezuak\MezuaDB;

// Comprobar si es admin (igual que en tu ejemplo)
if (isset($_POST['biali'])) {

    // Recoger datos del formulario
    $izena = $_POST['izena'];
    $abizena = $_POST['abizena'];
    $email = $_POST['email'];
    $gorputza = $_POST['gorputza']; // Renombrado para no confundir con el objeto

    // Validación básica
    if (strlen($izena) > 0 && strlen($abizena) > 0 && strlen($email) > 0 && strlen($gorputza) > 0) {

        $mezua = new Mezua();
        $mezua->setIzena($izena);
        $mezua->setAbizena($abizena);
        $mezua->setEmail($email);
        $mezua->setGorputza($gorputza);
        $mezua->setErantzuna(0);
        // La fecha (SortzeData) suele ser automática en BD o null al insertar, 
        // MezuaDB::insertMezua no la pide en tu código provisto.

        if (MezuaDB::insertMezua($mezua) > 0) {
            $alerta = "Mezua ondo biali da. Eskerrik asko gurekin harremanetan jartzeagatik.";
            include('kontaktua_biali.php');
        } else {
            $alerta = "Mezua ez da biali. Mesedez, saiatu berriro.";
            // Podrías crear un mezua_ez_da_gorde.php similar al de productos
            // Por ahora reusamos el formulario con el error
            include('kontaktua_biali.php');
        }

    }
} else {
    $izena = "";
    $abizena = "";
    $email = "";
    $gorputza = "";
    $erantzuna = 0;
    $alerta = "";
    include('kontaktua.php');
}
?>