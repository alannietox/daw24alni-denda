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

        $izena = $_POST['izena'];
        $laburpena = $_POST['laburpena'];

        if (strlen($izena) > 0 && strlen($laburpena) > 0) {

            $kategoria = new Kategoria();
            $kategoria->setIzena($izena);
            $kategoria->setLaburpena($laburpena);

            if (KategoriaDB::insertKategoria($kategoria) > 0) {
                $mezua = "Kategoria gorde da.";
                include('kategoria_gorde_da.php');
            } else {
                $mezua = "Kategoria ez da gorde.";
                include('kategoria_ez_da_gorde.php');
            }

        } else {

            $mezua = "* Eremu guztiak bete behar dira *";
            include('kategori_berria.php');
        }

    } else {
        $izena = "";
        $laburpena = "";
        $mezua = "";

        include('kategori_berria.php');
    }

} else {
    header("location: ../index.php");
}

?>