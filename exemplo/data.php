<?php
chdir(dirname(__DIR__));
	ini_set("display_errors",1);
	require_once "vendor/autoload.php";
	use Config\Data;
	$dados = array();
if(isset($_GET["cep"]) && isset($_GET["local"]) && isset($_GET["date"])){
	$cep 	= $_GET["cep"];
	$local 	= $_GET["local"];
	$date 	= $_GET["date"];

	$datas 	= new Data();

	$dados = $datas->autoValue($cep) //insert CEP
				->setDateLocal($date,$local)//insert Date and Local
				->getData(); //return datas
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Exemplo</title>
	<style type="text/css">
		form,p{width: 400px;margin:auto auto;}
		input{margin-bottom: 20px;width: 100%;font-size: 2em;}
		label{font-size: 2em;}
	</style>
</head>
<body>
	<form action="" method="get">
		<label for="Cep">CEP:</label>
		<input type="text" name="cep" required placeholder="Cep..." max="8">
		<label for="Local">LOCAL:</label>
		<input type="text" name="local" required placeholder="Local...">
		<label for="Date">DATE:</label>
		<input type="date" name="date" required>
		<input type="submit" value="Submit">
	</form>
	<p><pre><?php var_dump($dados); ?></pre></p>
</body>
</html>