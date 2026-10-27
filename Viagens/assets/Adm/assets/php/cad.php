<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php

    include_once('conexao.php');

    $Nome = $_POST['nome'];
    $CPF = $_POST['cpf'];
    $Telefone = $_POST['telefone'];
    $Endereco = $_POST['endereco'];


    $insere = mysqli_query(
        $conexao,
        "INSERT INTO cliente (nome, CPF, telefone, endereco)
    VALUES ('$Nome' , '$CPF' , '$Telefone', '$Endereco')"
    );

    echo "Cadastro realizado com sucesso!";
    ?>

    <a href="../../index.html"> <button>Voltar</button></a>

</body>

</html>