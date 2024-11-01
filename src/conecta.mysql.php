<?php

$host       = "br944.hostgator.com.br";
$username   = "talit870_pucrs_tcc";
$password   = "sTHv3YUw24f-";
$db         = "talit870_pucrs_tcc";

try {

    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);

    $pdo->exec("set names utf8");
}
catch(PDOException $e)
{
    echo "Conexão falhou: ".$e->getMessage();
}
?>