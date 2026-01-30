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
        $id = isset($_POST['id']) ? $_POST['id'] : null;

        $id = $_POST['id'];
        $marka = $_POST['marka'];
        $modeloa = $_POST['modeloa'];
        $gama = $_POST['gama'];
        $prezioa = $_POST['prezioa'];
        $id_kategoriak = $_POST['id_kategoriak'];
        $nobedadea = isset($_POST['nobedadea']) ? 1 : 0;
        $deskontua = $_POST['deskontua'];

        if (strlen($marka) > 0 && strlen($modeloa) > 0 && strlen($gama) > 0 && is_numeric($prezioa) > 0 && is_numeric($id_kategoriak) > 0 && is_numeric($nobedadea) && is_numeric($deskontua) && is_numeric($id) && $id > 0) {

            $produktua = new Produktua();
            $produktua->setId($id);
            $produktua->setMarka($marka);
            $produktua->setModeloa($modeloa);
            $produktua->setGama($gama);
            $produktua->setPrezioa($prezioa);
            $produktua->setIdKategoriak($id_kategoriak);
            $produktua->setNobedadea($nobedadea);
            $produktua->setDeskontua($deskontua);

            if (ProduktuaDB::updateProduktua($produktua) > 0) {
                $mezua = "Produktua gorde da.";
                if (!empty($id_kategoriak)) {
                    $kategoria = KategoriaDB::selectKategoria($id_kategoriak);
                    if ($kategoria) $kategoriaIzena = $kategoria->getIzena();
                }
                
                include('../produktu_aldatu/produktua_gorde_da.php');
            } else {

                $mezua = "Produktua ez da gorde.";

                include('../produktu_aldatu/produktua_ez_da_gorde.php');
            }
        } else {
            $mezua = "* Eremu guztiak bete behar dira *";
            include('produktu_aldatu.php');
        }
    } elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {

        $id = $_GET['id'];
        $produktua = ProduktuaDB::selectProduktua($id);

        if ($produktua) {
            $id = $produktua->getId();
            $marka = $produktua->getMarka();
            $modeloa = $produktua->getModeloa();
            $gama = $produktua->getGama();
            $prezioa = $produktua->getPrezioa();
            $id_kategoriak = $produktua->getIdKategoriak();
            $nobedadea = $produktua->getNobedadea();
            $deskontua = $produktua->getDeskontua();
            $mezua = "";

            include('produktu_aldatu.php');
        } else {
            $mezua = "Produktuaren id ez da aurkitu (ID: {$id}).";
            include('../id_baliogabea.php');
        }
    } else {
        $mezua = "Ez da produktu ID bat jaso aldatzeko.";
        include('../id_baliogabea.php');
    }
} else {
    // Usuario no autenticado: Redireccionar
    header("location: ../index.php");
}
