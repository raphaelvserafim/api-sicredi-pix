<?php


namespace Cachesistemas\ApiPixSicredi;


class PixSicredi
{
	const urlH = 'https://api-pix-h.sicredi.com.br/oauth/token';
	const urlP = 'https://api-pix.sicredi.com.br/oauth/token';

	protected $url;

	public function __construct($dados)
	{

		if ($dados["producao"] == 1) {
			$this->url = self::urlP;
		} else {
			$this->url = self::urlH;
		}
	}


	
}
