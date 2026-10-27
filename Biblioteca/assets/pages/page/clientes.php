<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/cliente.css">
    <title>Document</title>

</head>

<body>

    <header>

        <h1>Cadastrar Clientes</h1>

    </header>

    <main>

        <div class="container">

            <form action="clientes.php" method="post">

                <div class="field">
                    <label for="">Nome</label>
                    <input class="ipt" required type="text" name="name" id="">
                </div>

                <div class="field">
                    <label for="">CPF</label>
                    <input class="ipt" required maxlength="11" type="num" name="cpf" id="">
                </div>

                <div class="field">
                    <label for="">Email</label>
                    <input class="ipt" required type="text" name="email" id="">
                </div>

                <div class="field">
                    <label for="">Telefone</label>
                    <input maxlength="11" class="ipt" required type="tel" name="tel" id="">
                </div>

                <div class="confirm">
                    <button id="btn"> Confirmar </button>
                </div>


            </form>

        </div>

    </main>

    <dialog class="alert">

        <h3> Cadastro feito com sucesso! </h3>
        <form method="dialog">
            <button>Voltar</button>
        </form>

    </dialog>
    
</body>
    <script src="../../js/clientes.js"></script>

<?php 

    require_once "../../php/conexao.php";

    $sucesso = false;

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $Name = $_POST['name'];
        $CPF = $_POST['cpf'];
        $Email = $_POST['email'];
        $Telefone = $_POST['tel'];

        $insert = ("INSERT INTO cliente(Nome_cliente, CPF, Email, Telefone)
        VALUES (?,?,?,?)");

        $stmt = $pdo->prepare($insert);
        $stmt -> execute([$Name,$CPF,$Email,$Telefone]);

        $sucesso = true;
        
        if($sucesso === true){
            echo '<script> modalShow(); </script>';
        };

    };

?>
