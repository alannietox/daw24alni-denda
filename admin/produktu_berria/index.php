<?php
require('../../klaseak/com/leartik/alni/produktuak/produktua.php'); 
require('../../klaseak/com/leartik/alni/produktuak/produktua_db.php');
require('../../klaseak/com/leartik/alni/kategoriak/kategoria.php');
require('../../klaseak/com/leartik/alni/kategoriak/kategoria_db.php');

use com\leartik\alni\produktuak\Produktua; 
use com\leartik\alni\produktuak\ProduktuaDB;
use com\leartik\alni\kategoriak\Kategoria;
use com\leartik\alni\kategoriak\KategoriaDB;

$kategoriak = KategoriaDB::selectKategoriak();

if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin == true) {

    if (isset($_POST['gorde'])) {

        $marka = $_POST['marka'];
        $modeloa = $_POST['modeloa'];
        $gama = $_POST['gama'];
        $prezioa = $_POST['prezioa'];
        $id_kategoriak = $_POST['id_kategoriak'];
        $nobedadea = isset($_POST['nobedadea']) ? 1 : 0;
        $deskontua = $_POST['deskontua'];

        if (strlen($marka) > 0 && strlen($modeloa) > 0 && strlen($gama) > 0 && is_numeric($prezioa) && is_numeric($id_kategoriak) && is_numeric($deskontua)) {

            $produktua = new Produktua();
            $produktua->setMarka($marka);
            $produktua->setModeloa($modeloa);
            $produktua->setGama($gama);
            $produktua->setPrezioa($prezioa);
            $produktua->setIdKategoriak($id_kategoriak);
            $produktua->setNobedadea($nobedadea);
            $produktua->setDeskontua($deskontua);


            if (ProduktuaDB::insertProduktua($produktua) > 0) {
                $mezua = "Produktua gorde da.";
                if (!empty($id_kategoriak)) {
                    $kategoria = KategoriaDB::selectKategoria($id_kategoriak);
                    if ($kategoria) {
                        $kategoriaIzena = $kategoria->getIzena();
                    }
                }
                include('produktua_gorde_da.php');
            } else {
                $mezua = "Produktua ez da gorde.";
                include('produktua_ez_da_gorde.php');
            }

        } else {

            $mezua = "* Eremu guztiak bete behar dira *";
            include('produktu_berria.php');
        }

    } else {

        $marka = "";
        $modeloa = "";
        $gama = "";
        $prezioa = "";
        $id_kategoriak = "";
        $nobedadea = "";
        $deskontua = "";
        $mezua = "";
        include('produktu_berria.php');
    }

} else {
    header("location: ../index.php");
}

?>