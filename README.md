# API PIX do Sicredi em PHP: Como criar cobranças e receber eventos webhook 


## CONTATO 
 
<p>
<a href="https://wa.me/5566996852025" target="_blank"> 
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
