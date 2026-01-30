<?php
require('../../klaseak/com/leartik/alni/mezuak/mezua.php'); 
require('../../klaseak/com/leartik/alni/mezuak/mezua_db.php');

use com\leartik\alni\mezuak\Mezua; 
use com\leartik\alni\mezuak\MezuaDB;

if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin == true) {
    
    // 1. SI SE PULSA EL BOTÓN "EZABATU" (POST)
    if (isset($_POST['ezabatu'])) {
        
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        
        if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0) {
            
            // Llamamos a deleteMezua
            if (MezuaDB::deleteMezua($id) > 0) {
                $alerta = "Mezua ezabatu da.";
                include('mezua_ezabatu_da.php');
            } else {
                $alerta = "Mezua ez da ezabatu.";
                include('mezua_ez_da_ezabatu.php');
            }
            
        } else {
            // Error de ID
            $alerta = "* Ezabatzeko mezuaren ID-a ez da zuzena edo falta da *";
            // Variables vacías para evitar errores en la vista
            $izena = "";
            $email = "";
            $gorputza = "";
            $erantzuna = "";
            include('mezu_ezabatu.php');
        }
        
    // 2. SI SE RECIBE UN ID PARA CONFIRMAR BORRADO (GET)
    } elseif (isset($_GET['id'])) { 
        
        $id = $_GET['id']; 
        
        if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0) {
            $mezua = MezuaDB::selectMezua($id);
            
            if ($mezua) {
                // Recuperamos datos para mostrarlos antes de borrar
                $izena = $mezua->getIzena();
                $email = $mezua->getEmail();
                $gorputza = $mezua->getGorputza();
                $erantzuna = $mezua->getErantzuna();
                
                $alerta = "¿Ziur zaude mezu hau ezabatu nahi duzula?";
                include('mezu_ezabatu.php');
            } else {
                $mezua = "Mezuaren id ez da aurkitu (ID: {$id}).";
                // Puedes usar un archivo genérico o mostrarlo aquí
                include('../id_baliogabea.php'); 
            }
        } else {
             $mezua = "ID baliogabea.";
             include('../id_baliogabea.php');
        }
    
    } else {
        $mezua = "Ez da mezu ID bat jaso ezabatzeko.";
        include('../id_baliogabea.php');
    }

} else {
    header("location: ../index.php");
}
?>