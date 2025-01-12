# API PIX do Sicredi em PHP: Como criar cobranças e receber eventos webhook 

## CONTATO 
<p>
<a href="https://wa.me/14375223417" target="_blank"> 
 <img src="https://img.shields.io/badge/WhatsApp-25D366?style=for-the-badge&logo=whatsapp&logoColor=white" title="+55 66 99685-2025"/> 
</a>

 <a href="https://t.me/raphaelserafim" target="_blank">
  <img src="https://img.shields.io/badge/Telegram-2CA5E0?style=for-the-badge&logo=telegram&logoColor=white" target="_blank">
 </a>  

<a href="https://instagram.com/raphaelvserafim" target="_blank">
 <img src="https://img.shields.io/badge/-Instagram-%23E4405F?style=for-the-badge&logo=instagram&logoColor=white" target="_blank">
</a>
 
<a href="https://www.linkedin.com/in/raphaelvserafim" target="_blank">
 <img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white" target="_blank">
</a>  
</p>

# Versão para Node JS

<a href="https://github.com/raphaelvserafim/gerar-pix-sicredi" target="_blank">
Gerar Pix Sicredi Node JS | TypeScript | JavaScript
</a>  
 


## Example of use:

### access Token
```php
use Cachesistemas\ApiPixSicredi\PixSicredi;

include_once 'vendor/autoload.php';

$initPix  = [
    "producao" => 0,
    "client_id" => "",
    "client_secret" => "",
    "crt_file" => "/certificado.pem",
    "key_file" => "/APLICACAO.key",
    "pass" => ""
];

$pix         = new PixSicredi($initPix);

$accessToken = $pix->accessToken();
 
```


### Update URL WebHook
```php
 $pix->updateWebhook('sua-url', 'sua-chave-pix');
```


### Cobrança
```php


$cobranca  = [
    "calendario" => [
        "dataDeVencimento" => "2040-04-01",
        "validadeAposVencimento" => 1
    ],
   
    "valor" => [
        "original" => 10.00,
        "modalidadeAlteracao" => 1
    ],
    "chave" => "23711695000115",
    "solicitacaoPagador" => "Serviço realizado.",
    "infoAdicionais" => [
        [
            "nome" => "cliente_id",
            "valor" => "1234"
        ],
        [
            "nome" => "fatura_id",
            "valor" =>  123334
        ]
    ]
];

 $pix->token = $accessToken;
 $pix->criarCobranca($cobranca );
 
```
