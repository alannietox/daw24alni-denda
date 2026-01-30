<?php
// Ajusta las rutas (../../) según tu estructura de carpetas real
require('../../klaseak/com/leartik/alni/mezuak/mezua.php'); 
require('../../klaseak/com/leartik/alni/mezuak/mezua_db.php');

use com\leartik\alni\mezuak\Mezua; 
use com\leartik\alni\mezuak\MezuaDB;

// Comprobar si es admin (igual que en tu ejemplo)
if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin == true) {

    if (isset($_POST['gorde'])) {

        // Recoger datos del formulario
        $izena = $_POST['izena'];
        $email = $_POST['email'];
        $gorputza = $_POST['gorputza']; // Renombrado para no confundir con el objeto
        $erantzuna = isset($_POST['erantzuna']) ? 1 : 0; // Checkbox logic

        // Validación básica
        if (strlen($izena) > 0 && strlen($email) > 0 && strlen($gorputza) > 0) {

            $mezua = new Mezua();
            $mezua->setIzena($izena);
            $mezua->setEmail($email);
            $mezua->setGorputza($gorputza);
            $mezua->setErantzuna($erantzuna);
            // La fecha (SortzeData) suele ser automática en BD o null al insertar, 
            // MezuaDB::insertMezua no la pide en tu código provisto.

            if (MezuaDB::insertMezua($mezua) > 0) {
                $alerta = "Mezua ondo gorde da.";
                include('mezua_gorde_da.php');
            } else {
                $alerta = "Mezua ez da gorde.";
                // Podrías crear un mezua_ez_da_gorde.php similar al de productos
                // Por ahora reusamos el formulario con el error
                include('mezua_ez_da_gorde.php');
            }

        } else {
            $alerta = "* Eremu guztiak bete behar dira *";
            include('mezua_berria.php');
        }

    } else {
        // Inicializar variables vacías para el formulario
        $izena = "";
        $email = "";
        $gorputza = "";
        $erantzuna = 0;
        $alerta = "";
        include('mezu_berria.php');
    }

} else {
    header("location: ../index.php");
}
?>