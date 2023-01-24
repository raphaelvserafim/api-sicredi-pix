<?php

use Cachesistemas\ApiPixSicredi\PixSicredi;
 

include_once 'vendor/autoload.php';



$initPix  = [
    "producao" => 0, // 0 | 1 
    "client_id" => "",
    "client_secret" => "",
    "crt_file" => "/certificado.pem",
    "key_file" => "/APLICACAO.key",
    "pass" => ""
];

$pix         = new PixSicredi($initPix);

$accessToken = $pix->accessToken();

print_r($accessToken);



 