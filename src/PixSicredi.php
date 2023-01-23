<?php


namespace Cachesistemas\ApiPixSicredi;


class PixSicredi
{
	const urlH = 'https://api-pix-h.sicredi.com.br';
	const urlP = 'https://api-pix.sicredi.com.br';

	protected $url;

	protected $token;

	public function __construct($dados)
	{

		if ($dados["producao"] == 1) {
			$this->url = self::urlP;
		} else {
			$this->url = self::urlH;
		}
	}



	public function accessToken($dados)
	{
		$authorization = base64_encode($dados["clientID"] . ":" . $dados["clientSecret"]);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url . "/oauth/token");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&scope=cob.write+cob.read+cobv.write+cobv.read+webhook.read+webhook.write");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/x-www-form-urlencoded',
			'Authorization: Basic ' . $authorization
		));
		$return = ["status" => true];
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			$return["status"] = false;
			$return["mensagem"] = curl_error($ch);
		} else {
			$return["data"] = $result;
		}
		curl_close($ch);
		return $return;
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
