<?php


use Cachesistemas\ApiPixSicredi\PixSicredi;

include_once 'vendor/autoload.php';


$pix  = new PixSicredi(["producao" => 0]);


$accessToken = $pix->accessToken(["clientID" => "", "clientSecret" => ""]);


print_r($accessToken);
