<?php


require('../../klaseak/com/leartik/alni/kategoriak/kategoria.php');
require('../../klaseak/com/leartik/alni/kategoriak/kategoria_db.php');


use com\leartik\alni\kategoriak\KategoriaDB;


if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin == true) {
    
    
    if (isset($_POST['ezabatu'])) {
        
        
        $id_kategoria = isset($_POST['id_kategoria']) ? $_POST['id_kategoria'] : 0; 
        
      
        if (filter_var($id_kategoria, FILTER_VALIDATE_INT) && $id_kategoria > 0) {
            
      
            if (KategoriaDB::deleteKategoria($id_kategoria) > 0) {
              
                $id = $id_kategoria;
                $mezua = "Kategoria ezabatu da.";
                include('kategoria_ezabatu_da.php');
            } else {
                
                $id = $id_kategoria; 
                $mezua = "Kategoria ez da ezabatu.";
                include('kategoria_ez_da_ezabatu.php');
            }
            
        } else {
            $mezua = "* Ezabatzeko kategoriaren ID-a ez da zuzena edo falta da *";
            $id = $id_kategoria;
            $izena = "";   
            $laburpena = ""; 
            include('kategori_ezabatu.php');
        }
        
    } elseif (isset($_GET['id_kategoria'])) { 
        
        $id_kategoria = $_GET['id_kategoria'];
        
        if (filter_var($id_kategoria, FILTER_VALIDATE_INT) && $id_kategoria > 0) {
            $kategoria = KategoriaDB::selectKategoria($id_kategoria);
            
            if ($kategoria) {
                $id = $kategoria->getId();
                $izena = $kategoria->getIzena();
                $laburpena = $kategoria->getLaburpena();
                $mezua = "¿Ziur zaude kategoria hau ezabatu nahi duzula?";
                include('kategori_ezabatu.php');
            } else {
                $id = $id_kategoria;
                $izena = ""; 
                $laburpena = ""; 
                $mezua = "* Ez da aurkitu ID hori duen kategoriarik. Mesedez, itzuli eta aukeratu beste bat *";
                include('kategori_ezabatu.php');
            }
        } else {
            $mezua = "kategoriaren id ez da aurkitu (ID: {$id_kategoria}).";
            include('../id_baliogabea.php'); 
        }
    
    } else {
        $mezua = "Ez da kategoria ID bat jaso aldatzeko.";
        include('../id_baliogabea.php');
    }

} else {
    header("location: ../index.php");
}
?>