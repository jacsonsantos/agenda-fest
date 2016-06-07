<?php
namespace Config;

class Contato implements MethodInferface
{		
	private $pdo;
	private $table;
	private $contact = array();
	
	public function conn(\PDO $pdo,$table)
	{
		$this->pdo = $pdo;
		$this->table = (string)$table;
		return $this;
	}		
	public function setValue($fixo,$celular,$email)
	{
		$this->contact = array(
		'fixo' 		=> (string) $fixo,
		'celular' 	=> (string) $celular,
		'email' 	=> (string) $email);
		return $this;
	}

	public function run()
	{
		$result = $this->pdo->prepare("INSERT INTO ".$this->table." (fixo,celular,email) VALUES (:fixo,:celular,:email)");
		$result->bindValue(":fixo",$this->contact['fixo'],\PDO::PARAM_STR);
		$result->bindValue(":celular",$this->contact['celular'],\PDO::PARAM_STR);
		$result->bindValue(":email",$this->contact['email'],\PDO::PARAM_STR);
		return $result->execute();
	}
	public function updateValue($id)
	{
		$result = $this->pdo->prepare("UPDATE ".$this->table." SET fixo=:fixo,celular=:celular,email=:email WHERE id=:id");
		$result->bindValue(":fixo",$this->contact['fixo'],\PDO::PARAM_STR);
		$result->bindValue(":celular",$this->contact['celular'],\PDO::PARAM_STR);
		$result->bindValue(":email",$this->contact['email'],\PDO::PARAM_STR);
		$result->bindValue(":id",(int) $id,\PDO::PARAM_INT);
		return $result->execute();
	}		
}