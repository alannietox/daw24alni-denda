<?php

require('../../klaseak/com/leartik/alni/eskariak/eskaria.php');
require('../../klaseak/com/leartik/alni/eskariak/eskaria_db.php');
require('../../klaseak/com/leartik/alni/bezeroak/bezeroa.php');
require('../../klaseak/com/leartik/alni/detaileak/detailea.php');

use com\leartik\alni\eskariak\EskariaDB;

// =========================
// COMPROBAR ADMIN
// =========================
if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

// =========================
// INICIALIZAR VARIABLES (OBLIGATORIO)
// =========================
$id = isset($_POST['id']) ? $_POST['id'] : null;
$izena = '';
$abizena = '';
$helbidea = '';
$herria = '';
$postakodea = '';
$probintzia = '';
$email = '';
$egoera = 0;
$alerta = '';

// =========================
// POST → GUARDAR CAMBIO
// =========================
if (isset($_POST['gorde'])) {

    $id = $_POST['id'] ?? null;
    $egoera = isset($_POST['egoera']) ? 1 : 0;

    if (is_numeric($id) && $id > 0) {

        if (EskariaDB::updateEskaria($id, $egoera) > 0) {
            $eskaria = EskariaDB::selectEskaria($id);

            if ($eskaria) {
                $id = $eskaria->getId();
                $izena = $eskaria->getBezeroa()->getIzena();
                $abizena = $eskaria->getBezeroa()->getAbizena();
                $helbidea = $eskaria->getBezeroa()->getHelbidea();
                $herria = $eskaria->getBezeroa()->getHerria();
                $postakodea = $eskaria->getBezeroa()->getPostakodea();
                $probintzia = $eskaria->getBezeroa()->getProbintzia();
                $email = $eskaria->getBezeroa()->getEmaila();
                $egoera = $eskaria->getEgoera();
            }
            include('eskaria_gorde_da.php');
        } else {
            $alerta = "Eskaria ez da gorde (ez da aldaketarik egon).";
            include('eskari_aldatu.php');
        }

    } else {
        $alerta = "* ID baliogabea *";
        include('eskari_aldatu.php');
    }

// =========================
// GET → KARGATU ESKARIA
// =========================
} elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = $_GET['id'];
    $eskaria = EskariaDB::selectEskaria($id);

    if ($eskaria) {
        $id = $eskaria->getId();
        $izena = $eskaria->getBezeroa()->getIzena();
        $abizena = $eskaria->getBezeroa()->getAbizena();
        $helbidea = $eskaria->getBezeroa()->getHelbidea();
        $herria = $eskaria->getBezeroa()->getHerria();
        $postakodea = $eskaria->getBezeroa()->getPostakodea();
        $probintzia = $eskaria->getBezeroa()->getProbintzia();
        $email = $eskaria->getBezeroa()->getEmaila();
        $egoera = $eskaria->getEgoera();

        include('eskari_aldatu.php');
    } else {
        $mezua = "Eskariaren id ez da aurkitu (ID: {$id}).";
        include('../id_baliogabea.php');
    }

// =========================
// NI POST NI GET
// =========================
} else {
    $mezua = "Ez da eskari ID bat jaso aldatzeko.";
    include('../id_baliogabea.php');
}
