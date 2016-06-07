<?php
namespace Config;
ini_set("display_errors",1);
use Config\Cep;
class Data extends Cep implements MethodInferface
{		
	private $pdo;
	private $table;
	private $datas = array();
			
	public function conn(\PDO $pdo,$table)
	{
		$this->pdo = $pdo;
		$this->table = (string)$table;
		return $this;
	}
	public function autoValue($cep)
	{
		$cep = (string) $cep;
		$resul = $this->setCep($cep)->runCep();
		$this->datas = array(
		'uf' 		=> (string) utf8_decode($resul["uf"]),
		'cidade' 	=> (string) utf8_decode($resul["localidade"]),
		'bairro' 	=> (string) utf8_decode($resul["bairro"]));
		return $this;
	}
	public function getData()
	{
		return $this->datas;
	}
	public function setValue($uf,$cidade,$bairro)
	{
		$this->datas = array(
		'uf' 		=> (string) utf8_encode($uf),
		'cidade' 	=> (string) utf8_encode($cidade),
		'bairro' 	=> (string) utf8_encode($bairro));
		return $this;
	}
	public function setDateLocal($date,$local)
	{
		$this->datas['date'] = (string) utf8_decode($date);
		$this->datas['local'] = (string) utf8_decode($local);
		return $this;
	}
	public function runValue()
	{
		$result = $this->pdo->prepare("INSERT INTO ".$this->table." (uf,cidade,bairro,local,data) VALUES (:uf,:cidade,:bairro,:local,:data)");
		$result->bindValue(":uf",$this->datas["uf"],\PDO::PARAM_STR);
		$result->bindValue(":cidade",$this->datas["cidade"],\PDO::PARAM_STR);
		$result->bindValue(":bairro",$this->datas["bairro"],\PDO::PARAM_STR);
		$result->bindValue(":local",$this->datas["local"],\PDO::PARAM_STR);
		$result->bindValue(":data",$this->datas["date"],\PDO::PARAM_STR);
		return $result->execute();
	}
	public function updateValue($id)
	{
		$result = $this->pdo->prepare("UPDATE ".$this->table." SET uf=:uf,cidade=:cidade,bairro=:bairro,local=:local,data=:data WHERE id=:id");
		$result->bindValue(":uf",$this->datas["uf"],\PDO::PARAM_STR);
		$result->bindValue(":cidade",$this->datas["cidade"],\PDO::PARAM_STR);
		$result->bindValue(":bairro",$this->datas["bairro"],\PDO::PARAM_STR);
		$result->bindValue(":local",$this->datas["local"],\PDO::PARAM_STR);
		$result->bindValue(":data",$this->datas["date"],\PDO::PARAM_STR);
		$result->bindValue(":id",(int) $id,\PDO::PARAM_INT);
		return $result->execute();
	}
}