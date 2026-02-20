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
        $erantzuna = isset($_POST['erantzuna']) ? 1 : 0; // Checkbox

        // Validación: Solo necesitamos confirmar que el ID es válido
        if (is_numeric($id) && $id > 0) {

            // 1. Recuperamos el mensaje original de la base de datos
            $mezua = MezuaDB::selectMezua($id);

            // Si el mensaje existe en la base de datos...
            if ($mezua) {
                // 2. Modificamos ÚNICAMENTE la respuesta
                $mezua->setErantzuna($erantzuna);

                // 3. Enviamos a actualizar
                if (MezuaDB::updateMezua($mezua) > 0) {
                    $alerta = "Mezua ondo eguneratu da.";
                    
                    // Preparamos las variables para que la vista de éxito no dé errores
                    $izena = $mezua->getIzena();
                    $abizena = $mezua->getAbizena();
                    $email = $mezua->getEmail();
                    $gorputza = $mezua->getGorputza();

                    // Cargamos la vista de éxito
                    include('mezua_gorde_da.php');
                } else {
                    $alerta = "Mezua ez da gorde (edo ez duzu ezer aldatu).";
                    
                    // Preparamos las variables por si la vista de error también las usa
                    $izena = $mezua->getIzena();
                    $abizena = $mezua->getAbizena();
                    $email = $mezua->getEmail();
                    $gorputza = $mezua->getGorputza();

                    include('mezua_ez_da_gorde.php');
                }
            } else {
                // Si alguien manda un ID que no existe en la BD
                $alerta = "* Errorea: Mezua ez da aurkitu *";
                include('mezu_aldatu.php');
            }

        } else {
            $alerta = "* ID baliogabea *";
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