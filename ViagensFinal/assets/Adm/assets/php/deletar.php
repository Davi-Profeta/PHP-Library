<?php
include_once('auth.php');
include_once('conexao.php');

$id = (int) $_GET['id'];

mysqli_query($conexao, "DELETE FROM passagem WHERE Id_Viagem = $id");
mysqli_query($conexao, "DELETE FROM viagem WHERE Id_Viagem = $id");

header("Location: cancelar.php");
exit;
?>
