<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/agendarPHP.css">
    <title>Document</title>

</head>

<body>
    
    <div class="container">

        <header>

            <div class="title">
                <h1>DP - VIAGENS</h1>
            </div>

            <div class="pages">
                <table>
                    <td> <a href="./index.php"> Início </a> </td>
                    <td> <a href="./pages/cancelamento.html"> Cancelamento </a> </td>
                    <td> <a href="./pages/sobre.html"> Sobre </a> </td>
                </table>
            </div>

        </header>

        <div class="agendamento">

            <section>


            </section>

            
            <?php
                
                include_once("conexao.php");

                $Name = $_POST['name'] ?? $_SESSION['NAME'] ?? null;
                $Cpf = $_POST['cpf'] ?? $_SESSION['CPF'] ?? null;
                $Tel = $_POST['tel'] ?? $_SESSION['TEL'] ?? null;
                $Email = $_POST['email'] ?? $_SESSION['EMAIL'] ?? null;
                $Id = $_SESSION['Id'] ?? $_SESSION['Id_Login'] ?? null;
                $Viagem = $_POST['viagem'];

                if($Name == ($_SESSION['name'] ?? null) && 
                    $Cpf == ($_SESSION['cpf'] ?? null) &&
                    $Tel == ($_SESSION['tel'] ?? null) &&
                    $Email == ($_SESSION['email'] ?? null) &&
                    $Id == ($_SESSION['Id'] ?? null)) {


                    $passagem = mysqli_query($conexao,
                    "INSERT INTO passagem(Id_cliente, Id_viagem)
                    VALUES ('$Id', '$Viagem')");

                    echo 'Agendamento feito com sucesso!';

                } else if($Name == ($_SESSION['NAME'] ?? null) && 
                $Cpf == ($_SESSION['CPF'] ?? null) &&
                $Tel == ($_SESSION['TEL'] ?? null) &&
                $Email == ($_SESSION['EMAIL'] ?? null) && 
                $Id == ($_SESSION['Id_Login'] ?? null)){

                    $passagem = mysqli_query($conexao,
                    "INSERT INTO passagem(Id_cliente, Id_viagem)
                    VALUES ('$Id', '$Viagem')");

                    echo 'Agendamento feito com sucesso!';


                } else {
                    
                    $passagem = mysqli_query($conexao,
                    "INSERT INTO passagem(Id_cliente, Id_viagem)
                    VALUES ('$Id', '$Viagem')");

                    $query = "UPDATE cliente 
                    SET Nome_Cliente = '$Name', 
                    Telefone = '$Tel', 
                    Email = '$Email', 
                    CPF = '$Cpf' 
                    WHERE id_cliente = '$Id'";

                    $update = mysqli_query($conexao, $query);

                    if($update){

                        $_SESSION['name']  = $Name;
                        $_SESSION['cpf']   = $Cpf;
                        $_SESSION['tel']   = $Tel;
                        $_SESSION['email'] = $Email;

                        echo "Dados atualizados e agendamento feito com sucesso!";

                    };

                };


            ?>


        </div>

    </div>

    

</body>

</html>

