<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dp_viagens"; // mesmo banco que o site dos usuários

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
    die("Falha na Conexão com o BD: " . $conexao->connect_error);
}

?>
