<?php
require('../../klaseak/com/leartik/alni/eskariak/eskaria.php');
require('../../klaseak/com/leartik/alni/eskariak/eskaria_db.php');
require('../../klaseak/com/leartik/alni/bezeroak/bezeroa.php');
require('../../klaseak/com/leartik/alni/detaileak/detailea.php');

use com\leartik\alni\eskariak\EskariaDB;

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
            
            // Llamamos a deleteEskaria
            if (EskariaDB::deleteEskaria($id) > 0) {
                $alerta = "Eskaria ezabatu da.";
                include('eskaria_ezabatu_da.php');
            } else {
                $alerta = "Eskaria ez da ezabatu.";
                include('eskaria_ez_da_ezabatu.php');
            }
            
        } else {
            // Error de ID
            $alerta = "* Ezabatzeko eskariaren ID-a ez da zuzena edo falta da *";
            // Variables vacías para evitar errores en la vista
            $izena = "";
            $abizena = "";
            $helbidea = "";
            $herria = "";
            $postakodea = "";
            $probintzia = "";
            $email = "";
            $egoera = "";
            include('eskari_ezabatu.php');
        }
        
    // 2. SI SE RECIBE UN ID PARA CONFIRMAR BORRADO (GET)
    } elseif (isset($_GET['id'])) { 
        
        $id = $_GET['id']; 
        
        if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0) {
            $eskaria = EskariaDB::selectEskaria($id);
            
            if ($eskaria) {
                // Recuperamos datos para mostrarlos antes de borrar
                $izena = $eskaria->getBezeroa()->getIzena();
                $abizena = $eskaria->getBezeroa()->getAbizena();
                $email = $eskaria->getBezeroa()->getEmaila();
                $helbidea = $eskaria->getBezeroa()->getHelbidea();
                $herria = $eskaria->getBezeroa()->getHerria();
                $postakodea = $eskaria->getBezeroa()->getPostakodea();
                $probintzia = $eskaria->getBezeroa()->getProbintzia();
                $egoera = $eskaria->getEgoera();
                
                $alerta = "¿Ziur zaude eskaria hau ezabatu nahi duzula?";
                include('eskari_ezabatu.php');
            } else {
                $mezua = "Eskariaren id ez da aurkitu (ID: {$id}).";
                // Puedes usar un archivo genérico o mostrarlo aquí
                include('../id_baliogabea.php'); 
            }
        } else {
             $mezua = "ID baliogabea.";
             include('../id_baliogabea.php');
        }
    
    } else {
        $mezua = "Ez da eskari ID bat jaso ezabatzeko.";
        include('../id_baliogabea.php');
    }

} else {
    header("location: ../index.php");
}
?>