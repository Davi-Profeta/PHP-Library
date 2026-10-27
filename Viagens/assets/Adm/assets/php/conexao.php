
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "viagens";


$conexao = new mysqli($servername, $username, $password, $dbname);



if ($conexao->connect_error) {
    die("Falha na Conexão com o BD: " . $conexao->connect_error);
}

?> 