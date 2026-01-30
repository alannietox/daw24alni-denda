<?php

require('../../klaseak/com/leartik/alni/kategoriak/kategoria.php'); 
require('../../klaseak/com/leartik/alni/kategoriak/kategoria_db.php'); 

use com\leartik\alni\kategoriak\Kategoria; 
use com\leartik\alni\kategoriak\KategoriaDB; 

if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") { 
    $admin = true; 
} else { 
    $admin = false; 
}

if ($admin == true) { 

    if (isset($_POST['gorde'])) { 
        

        $id_kategoria = isset($_POST['id_kategoria']) ? $_POST['id_kategoria'] : null; // <--- ALDATUTA: 'id_kategoria'
        $izena = $_POST['izena']; 
        $laburpena = $_POST['laburpena']; 
        
        
        if (strlen($izena) > 0 && strlen($laburpena) > 0 && is_numeric($id_kategoria) && $id_kategoria > 0) { 

            
            $kategoria = new Kategoria(); 
            $kategoria->setId($id_kategoria); 
            $kategoria->setIzena($izena); 
            $kategoria->setLaburpena($laburpena); 

          
            if (KategoriaDB::updateKategoria($kategoria) > 0) { 
             
                $mezua = "Kategoria aldatu da.";
                
                $id = $id_kategoria;
                include('../kategori_berria/kategoria_gorde_da.php'); 
            } else {
                
                $mezua = "Kategoria ez da gorde.";
               
                $id = $id_kategoria;
                include('../kategori_berria/kategoria_ez_da_gorde.php'); 
            }

        } else {
            
            $mezua = "* Eremu guztiak bete behar dira *";

            $id = $id_kategoria;
            include('kategori_aldatu.php'); 
        }

    } 
    
    elseif (isset($_GET['id_kategoria']) && is_numeric($_GET['id_kategoria'])) { 
        
        $id_kategoria = $_GET['id_kategoria'];
        $kategoria = KategoriaDB::selectKategoria($id_kategoria); 

        if ($kategoria) {
            
            $id = $kategoria->getId(); 
            $izena = $kategoria->getIzena(); 
            $laburpena = $kategoria->getLaburpena(); 
            $mezua = "";
            
           
            include('kategori_aldatu.php');

        } else {
            $mezua = "Kategoriaren id ez da aurkitu (ID: {$id_kategoria}).";
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