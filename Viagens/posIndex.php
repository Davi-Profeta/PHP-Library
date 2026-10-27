<?php
    session_start();
    include_once("assets/conexao.php");

    //Se alguém abrir esse arquivo direto (sem enviar o formulário), volta pro cadastro
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        exit;
    };

    $Name = $_POST['name'];
    $cpf = $_POST['cpf'];
    $Tel = $_POST['tel'];
    $Email = $_POST['email'];

    $_SESSION['name'] = $Name;
    $_SESSION['cpf'] = $cpf;
    $_SESSION['tel'] = $Tel;
    $_SESSION['email'] = $Email;

    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cadastrar.css">
    <title>Document</title>

</head>

<body>

    <header>

        <div class="title">
            <h1>DP - VIAGENS</h1>
        </div>

    </header>

    <main>

        <div class="container">

            <?php

                $pesquisaCPF = mysqli_query($conexao,
                    "SELECT CPF
                    FROM cliente
                    WHERE CPF = '$cpf' "
                );

                if(mysqli_num_rows($pesquisaCPF) > 0){

                    echo "

                        <p>CPF já utilizado!</p>
                        <p>Você será redirecionado para arrumar os dados em instantes...</p>

                    ";

                    header("Refresh: 4; url=index.html");

                } else {

                    $FormCliente = mysqli_query(
                    $conexao,
                    "INSERT INTO cliente(Nome_Cliente,Telefone,Email,CPF)
                    VALUES ('$Name', '$Tel', '$Email', '$cpf') "
                    );

                    // Obtém o ID que acabou de ser gerado
                    $id_gerado = mysqli_insert_id($conexao);
                    $_SESSION['Id'] = $id_gerado;

                    echo "

                        <p>Cadastro feito com sucesso!</p>
                        <p>Você será redirecionado para as viagens em instantes...</p>

                    ";

                    header("Refresh: 3; url=assets/index.php"); // espera 3 segundos e vai para assets/index.php


                };


            ?>

        </div>

    </main>

</body>

</html>