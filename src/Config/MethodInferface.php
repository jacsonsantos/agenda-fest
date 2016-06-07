<?php
namespace Config;
interface MethodInferface
{
	public function conn(\PDO $pdo,$table);
}