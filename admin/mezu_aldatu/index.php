<?php

// Ajusta las rutas según tu estructura real
require('../../klaseak/com/leartik/alni/mezuak/mezua.php');
require('../../klaseak/com/leartik/alni/mezuak/mezua_db.php');

use com\leartik\alni\mezuak\Mezua;
use com\leartik\alni\mezuak\MezuaDB;

// Comprobar Admin
if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin == true) {

    // 1. SI SE PULSA EL BOTÓN GORDE (POST)
    if (isset($_POST['gorde'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : null;

        $izena = $_POST['izena'];
        $abizena = $_POST['abizena'];
        $email = $_POST['email'];
        $gorputza = $_POST['gorputza'];
        $erantzuna = isset($_POST['erantzuna']) ? 1 : 0; // Checkbox

        // Validación
        if (strlen($izena) > 0 && strlen($abizena) > 0 && strlen($email) > 0 && strlen($gorputza) > 0 && is_numeric($id) && $id > 0) {

            $mezua = new Mezua();
            $mezua->setId($id);
            $mezua->setIzena($izena);
            $mezua->setAbizena($abizena);
            $mezua->setEmail($email);
            $mezua->setGorputza($gorputza);
            $mezua->setErantzuna($erantzuna);
            // La fecha (sortze_data) no la solemos cambiar al editar, la dejamos igual o no la tocamos en el update.

            if (MezuaDB::updateMezua($mezua) > 0) {
                $alerta = "Mezua ondo eguneratu da.";
                
                // Cargamos la vista de éxito
                include('mezua_gorde_da.php');
            } else {
                $alerta = "Mezua ez da gorde (edo ez duzu ezer aldatu).";
                include('mezua_ez_da_gorde.php');
            }
        } else {
            $alerta = "* Eremu guztiak bete behar dira *";
            include('mezu_aldatu.php');
        }

    // 2. SI SE RECIBE UN ID PARA EDITAR (GET)
    } elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {

        $id = $_GET['id'];
        $mezua = MezuaDB::selectMezua($id);

        if ($mezua) {
            $id = $mezua->getId();
            $izena = $mezua->getIzena();
            $abizena = $mezua->getAbizena();
            $email = $mezua->getEmail();
            $gorputza = $mezua->getGorputza();
            $erantzuna = $mezua->getErantzuna();
            $alerta = "";

            include('mezu_aldatu.php');
        } else {
            $mezua = "Mezuaren id ez da aurkitu (ID: {$id}).";
            // Puedes redirigir a una página de error genérica o mostrar el error aquí
            include('../id_baliogabea.php'); // Si tienes este archivo
        }

    // 3. SI NO HAY NI POST NI ID
    } else {
        $mezua = "Ez da mezu ID bat jaso aldatzeko.";
        include('../id_baliogabea.php');
    }

} else {
    // Usuario no autenticado
    header("location: ../index.php");
}
?>