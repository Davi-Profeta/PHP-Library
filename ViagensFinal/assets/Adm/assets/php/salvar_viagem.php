<?php
include_once('auth.php');
include_once('conexao.php');

$Nome = $_POST['nome'];
$Origem = $_POST['origem'];
$Destino = $_POST['destino'];
$Dia = $_POST['dia'];
$Horario = $_POST['horario'];
$Motorista = $_POST['id_motorista'];

$insere = mysqli_query(
    $conexao,
    "INSERT INTO viagem (Nome_Viagem, Origem, Destino, Dia, `Horário`, Id_Motorista)
     VALUES ('$Nome', '$Origem', '$Destino', '$Dia', '$Horario', '$Motorista')"
);

if ($insere) {
    header("Location: criar_viagem.php?ok=1");
    exit;
}

echo "Erro ao cadastrar a viagem: " . mysqli_error($conexao);
?>
<br>
<a href="criar_viagem.php"><button>Voltar</button></a>
