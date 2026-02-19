<?php
require('../klaseak/com/leartik/alni/produktuak/produktua.php');

$listaModelos = [];
try {
    $dbSearch = new PDO('sqlite:../produktuak.db');
    // CAMBIO 1: Seleccionamos id Y modeloa
    $stmtSearch = $dbSearch->query("SELECT id, modeloa FROM produktuak");
    
    while ($row = $stmtSearch->fetch(PDO::FETCH_ASSOC)) {
        // CAMBIO 2: Guardamos un array con ambos datos
        $listaModelos[] = [
            'id' => $row['id'],
            'nombre' => $row['modeloa']
        ];
    }
} catch (PDOException $e) {
    // Error silencioso
}
/*
$nobedadeak = ProduktuaDB::selectProduktuakNobedadea();
$dbError = null;
if ($nobedadeak === null) {
    $nobedadeak = [];
}

$deskontuak = ProduktuaDB::selectProduktuakDeskontua();
if ($deskontuak === null) {
    $deskontuak = [];
}
*/
$json_nobedadeak = file_get_contents(filename: "http://localhost/0erronka/api/produktuak/?mota=nobedadeak");
$nobedadeak = [];
if ($json_nobedadeak != null) {
    $nobedadeak = json_decode(json: $json_nobedadeak, associative: true);
    // lehenengo 3ak bakarrik hartu
    $nobedadeak = array_slice(array: $nobedadeak, offset: 0, length: 3);
}

// Eskaintzak eskuratu API-tik
$json_deskontuak = file_get_contents(filename: "http://localhost/0erronka/api/produktuak/?mota=deskontuak");
$deskontuak = [];
if ($json_deskontuak != null) {
    $deskontuak = json_decode(json: $json_deskontuak, associative: true);
    // lehenengo 3ak bakarrik hartu
    $deskontuak = array_slice(array: $deskontuak, offset: 0, length: 3);
}


include('hasiera.php');
?>