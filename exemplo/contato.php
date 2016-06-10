<?php
chdir(dirname(__DIR__));
	ini_set("display_errors",1);
	require_once "vendor/autoload.php";
	use Config\Contato;
	$dados = array();
if(isset($_GET["fixo"]) && isset($_GET["celular"]) && isset($_GET["email"])){
	$fixo 		= (string)$_GET["fixo"];
	$celular 	= (string) $_GET["celular"];
	$email 		= (string) $_GET["email"];

	$pdo = new PDO("mysql:dbname=<NameDB>;host=<NameHost>","<user>","<password>");
	$contact 	= new Contato();

	$dados = $contact->conn($pdo,"<table>")->setValue($fixo,$celular,$email)->runValue();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Class Contact - Test</title>
	<style type="text/css">
		form,p{width: 400px;margin:auto auto;}
		input{margin-bottom: 20px;width: 100%;font-size: 2em;}
		label{font-size: 2em;}
	</style>
</head>
<body>
	<form action="">
		<label for="">Fixo:</label>
		<input type="tel" name="fixo" required>
		<label for="">Celular:</label>
		<input type="tel" name="celular" required>
		<label for="">Email:</label>
		<input type="email" name="email" required>
		<input type="submit" value="Send">
	</form>
	<p><pre><?php var_dump($dados); ?></pre></p>
</body>
</html>