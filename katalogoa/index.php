<?php
// 1. REQUIRES: Ajusta estas rutas si tus archivos están en carpetas diferentes
// Basado en tu index.php anterior, las clases están en ../klaseak/
require_once('../klaseak/com/leartik/alni/produktuak/produktua.php');
require_once('../klaseak/com/leartik/alni/produktuak/produktua_db.php');
require_once('../klaseak/com/leartik/alni/kategoriak/kategoria.php');
require_once('../klaseak/com/leartik/alni/kategoriak/kategoria_db.php');

// 2. USES: Importar los namespaces
use com\leartik\alni\produktuak\ProduktuaDB;
use com\leartik\alni\kategoriak\KategoriaDB;

$dbError = null;
// --- LÓGICA PRINCIPAL ---
if (isset($_GET['id_produktua'])) {
    // CASO C: El usuario ha pulsado un producto -> Mostrar DETALLES DEL PRODUCTO

$id_produktua = isset($_GET['id_produktua']) ? (int)$_GET['id_produktua'] : 0;
$produktua = null;

if ($id_produktua > 0) {
    $produktua = ProduktuaDB::selectProduktua($id_produktua);
}

$titulo_pagina = $produktua ? $produktua->getModeloa() : 'Produktua Ez Da Aurkitu';
$deskontua = $produktua ? (int)$produktua->getDeskontua() : 0;
$prezioa = $produktua ? $produktua->getPrezioa() : 0.0;
$prezio_final = $prezioa * (1 - ($deskontua / 100));

include('produktua_erakutsi.php');

}
elseif (isset($_GET['id_kategoria'])) {
    // CASO A: El usuario ha pulsado una categoría -> Mostrar PRODUCTOS
    $kategoriaId = $_GET['id_kategoria'];

    // Obtenemos los productos usando la función NUEVA que añadimos en el paso 1
    $produktuak = ProduktuaDB::selectProduktuakByKategoria($kategoriaId);
    
    // Opcional: Obtener info de la categoría para poner el título bonito
    $kategoriaActual = KategoriaDB::selectKategoria($kategoriaId);
    if ($produktuak === null) {
        $dbError = "Errorea produktuak kargatzean.";
    }

    // Cargamos la vista de productos
    include('kategoria_erakutsi.php');

} else {
    // CASO B: No hay ID -> El usuario acaba de entrar -> Mostrar CATEGORÍAS
    
    // Usamos tu clase KategoriaDB real
    $kategoriak = KategoriaDB::selectKategoriak();

    if ($kategoriak === null) {
        $dbError = "Errorea kategoriak kargatzean.";
    }

    // Cargamos la vista de categorías
    include('kategoriak_erakutsi.php');
}
?>
