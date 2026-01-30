<?php
require('../../klaseak/com/leartik/alni/produktuak/produktua.php'); 
require('../../klaseak/com/leartik/alni/produktuak/produktua_db.php');
require('../../klaseak/com/leartik/alni/kategoriak/kategoria.php');
require('../../klaseak/com/leartik/alni/kategoriak/kategoria_db.php');

use com\leartik\alni\produktuak\Produktua; 
use com\leartik\alni\produktuak\ProduktuaDB;
use com\leartik\alni\kategoriak\Kategoria;
use com\leartik\alni\kategoriak\KategoriaDB;

if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin == true) {
    
    if (isset($_POST['ezabatu'])) {
        
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        
        if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0) {
            
            if (ProduktuaDB::deleteProduktua($id) > 0) {
                $mezua = "Produktua ezabatu da.";
                include('produktua_ezabatu_da.php');
            } else {
                $mezua = "Produktua ez da ezabatu.";
                include('produktua_ez_da_ezabatu.php');
            }
            
        } else {
            $mezua = "* Ezabatzeko produktuaren ID-a ez da zuzena edo falta da *";
            $marka = "";
            $modeloa = "";
            $gama = "";
            $prezioa = "";
            $id_kategoriak = "";
            $nobedadea = "";
            $deskontua = "";
            include('produktu_ezabatu.php');
        }
        
    } elseif (isset($_GET['id'])) { 
        
        $id = $_GET['id']; 
        
        if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0) {
            $produktua = ProduktuaDB::selectProduktua($id);
            
            if ($produktua) {
                $marka = $produktua->getMarka();
                $modeloa = $produktua->getModeloa();
                $gama = $produktua->getGama();
                $prezioa = $produktua->getPrezioa();
                $id_kategoriak = $produktua->getIdKategoriak();
                $nobedadea = $produktua->getNobedadea();
                $deskontua = $produktua->getDeskontua();
                if (!empty($id_kategoriak)) {
                    $kategoria = KategoriaDB::selectKategoria($id_kategoriak);
                    if ($kategoria) {
                        $kategoriaIzena = $kategoria->getIzena();
                    }
                }
                $mezua = "¿Ziur zaude produktu hau ezabatu nahi duzula?";
                include('produktu_ezabatu.php');
            } else {
            $mezua = "Produktuaren id ez da aurkitu (ID: {$id}).";
            include('../id_baliogabea.php'); 
        }
    
    } else {
        $mezua = "Ez da produktu ID bat jaso aldatzeko.";
        include('../id_baliogabea.php');
    }
        
    }

} else {
    header("location: ../index.php");
}

?>