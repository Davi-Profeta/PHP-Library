<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/agendar.css">
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
                    <td> <a href="../index.php"> Início </a> </td>
                    <td> <a href=""> Cancelamento </a> </td>
                    <td> <a href="sobre.html"> Sobre </a> </td>
                </table>
            </div>

        </header>

        <div class="agendamento">

            <section>


            </section>

            <form action="../agendado.php" method="post">

                <div class="space">

                    <div class="inputs">
                        <h3>Confirmação de dados do login</h3>
                    </div>

                    <div class="inputs">
                        <p>Valor: 123,70</p>
                    </div>

                </div>

                <div class="space">

                     <div class="inputs">
                        <label for="">Nome</label>
                        <input type="text" name="name" id="" value="<?= $_SESSION['name'] ?? $_SESSION['NAME'] ?>">
                    </div>

                    <div class="inputs">
                        <label for="">CPF</label>
                        <input type="tel" name="cpf" id="" maxlength="11" value="<?= $_SESSION['cpf'] ?? $_SESSION['CPF'] ?>"> 
                    </div>

                </div>

                <div class="space">

                    <div class="inputs">
                        <label for="">Telefone</label>
                        <input type="tel" name="tel" id="" maxlength="10" value="<?= $_SESSION['tel'] ?? $_SESSION['TEL'] ?>"> 
                    </div>

                    <div class="inputs">
                        <label for="">Email</label>
                        <input type="text" name="email" id="" value="<?= $_SESSION['email'] ?? $_SESSION['EMAIL'] ?>">
                    </div>

                </div>

                <div class="spaceBTN">
                    <input type="hidden" name="viagem" value="<?= $Viagem = $_GET['id_viagem'] ?>">
                    <a href=""> <button> Confirmar dados </button> </a>
                </div>
                
            </form>

        </div>

    </div>

    

</body>

</html>