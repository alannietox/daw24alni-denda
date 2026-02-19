<?php

$api_url = "http://localhost/web_garapena_zerbitzari_ingurunean/zerbitzari_06_01/albisteak";

$albisteak = [];

$json_albisteak = @file_get_contents($api_url);


if ($json_albisteak !== false && $json_albisteak != null) {
    
    $albisteak = json_decode($json_albisteak , true);
    
    
    if (!is_array($albisteak)) {
        $albisteak = [];
    }
}

// Cargamos la vista
include('albisteak_erakutsi.php');
?>