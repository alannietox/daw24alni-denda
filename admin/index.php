<?php

require_once __DIR__ . '/../klaseak/com/leartik/alni/produktuak/produktua.php';
require_once __DIR__ . '/../klaseak/com/leartik/alni/produktuak/produktua_db.php';
require_once __DIR__ . '/../klaseak/com/leartik/alni/kategoriak/kategoria.php';
require_once __DIR__ . '/../klaseak/com/leartik/alni/kategoriak/kategoria_db.php';
require_once __DIR__ . '/../klaseak/com/leartik/alni/mezuak/mezua.php';
require_once __DIR__ . '/../klaseak/com/leartik/alni/mezuak/mezua_db.php';

use com\leartik\alni\kategoriak\Kategoria;
use com\leartik\alni\kategoriak\KategoriaDB;
use com\leartik\alni\produktuak\Produktua;
use com\leartik\alni\produktuak\ProduktuaDB;
use com\leartik\alni\mezuak\Mezua;
use com\leartik\alni\mezuak\MezuaDB;


// administrazio gunean sartzeko baldintzak egiaztatu
$admin = false;

if (isset($_POST['sartu'])) {

    if ($_POST['erabiltzailea'] == "admin" && $_POST['pasahitza'] == "admin") {
        
        $admin = true;
        setcookie("erabiltzailea", "admin", time() + 86400);

    }

} else if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {

    $admin = true;

}

// administrazioa baimenduta bada albisteen zerrenda erakutsi, bestela hasierako formularioa
if ($admin == true) {

    $kategoriak= KategoriaDB::selectKategoriak();
    include('kategoriak_erakutsi.php');

    $produktuak = ProduktuaDB::selectProduktuak();
    include('produktuak_erakutsi.php');

    $mezuak = MezuaDB::selectMezuak();
    include('mezuak_erakutsi.php');

    
} else {

    if (isset($_POST['sartu'])) {
        $mezua = "Datuak ez dira zuzenak";
    } else {
        $mezua = "";
    }

    include('login.php');

}

?>