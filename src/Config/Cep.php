<?php
namespace Config;
abstract class Cep
{
	private $cep;

	public function setCep($cep)
	{
		$char = array(".", "-");
		$cep = str_replace($char,"", $cep);
		$this->cep = (string) $cep;
		return $this;
	}
	public function runCep()
	{
		$data = curl_init("viacep.com.br/ws/".$this->cep."/json/");
		curl_setopt($data,CURLOPT_RETURNTRANSFER,true);
		return json_decode(curl_exec($data),true);
	}
}