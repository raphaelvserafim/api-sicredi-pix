<?php


namespace Cachesistemas\ApiPixSicredi;


class PixSicredi
{
	const urlH = 'https://api-pix-h.sicredi.com.br';
	const urlP = 'https://api-pix.sicredi.com.br';

	public  $url;
	public  $client_id;
	public  $client_secret;
	public  $authorization;
	public  $token;
	public  $crt_file;
	public  $key_file;
	public  $pass;



	public function __construct($dados)
	{

		if ((int) $dados["producao"] == 1) {
			$this->url = self::urlP;
		} else {
			$this->url = self::urlH;
		}

		$this->client_id 		= $dados["client_id"];
		$this->client_secret 	= $dados["client_secret"];

		$this->crt_file = $dados["crt_file"];
		$this->key_file = $dados["key_file"];
		$this->pass     = $dados["pass"];

		$this->authorization = base64_encode($this->client_id . ":" . $this->client_secret);
	}



	public function accessToken()
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->url . '/oauth/token?grant_type=client_credentials&scope=cob.write+cob.read+webhook.read+webhook.write');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, '');
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Basic ' . $this->authorization . ' '
		]);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0');
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSLCERT, $this->crt_file);
		curl_setopt($curl, CURLOPT_SSLKEY, $this->key_file);
		curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $this->pass);
		$response = curl_exec($curl);
		$status   = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		if ($status  == 200) {
			$data    = json_decode($response, true);
			return ["status" => true, "access_token" => $data["access_token"]];
		} else {
			return ["status" => false, "message" => 	$response];
		}
	}



	public function updateWebhook($url)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->url . "/api/v2/webhook/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_POSTFIELDS => json_encode(["webhookUrl" => $url]),
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"Authorization: Bearer {$this->token}"
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
}
