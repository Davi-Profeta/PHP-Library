<?php
    require_once "../../php/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/at_cliente.css">
    <title>Document</title>

</head>

<body>

    <header>

        <h1>Atualizar Clientes</h1>

    </header>

    <main>

        <div class="container">

            <div class="tabela-wrapper">

                <table class="table"> 

                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Telefone</th>
                    </tr>

                    <?php 

                        require_once "../../php/conexao.php";

                        
                        $show = ("SELECT *
                        FROM cliente");

                        $stmt = $pdo->prepare($show);
                        $stmt->execute();

                        foreach($stmt as $i){
                            echo"

                                <tr class='cliente' data-id='{$i['Id_cliente']}'>
                                    <td class='td' > {$i['Nome_cliente']} </td>
                                    <td class='td' > {$i['CPF']} </td>
                                    <td class='td' > {$i['Email']} </td>
                                    <td class='td' > {$i['Telefone']} </td>
                                </tr>

                            ";
                        ;}

                    
                    ?>

                </table>

            </div>

            <dialog class="modal">
                
                <div class="header">
                    <h3>Atualização de cliente</h3>
                    <p> Cuidado com qualquer tipo de alteração! </p>
                </div>

                <div class="main">

                    <form class="father" action="at_clientes.php" method="post">

                        <div class="update">

                            <div class="field">
                                <label for="">Nome</label>
                                <input class="ipt" required type="text" name="name" id="">
                            </div>

                            <div class="field">
                                <label for="">CPF</label>
                                <input class="ipt" required maxlength="11" type="num" name="cpf" id="">
                            </div>

                        </div>
                        
                        <div class="update">

                            <div class="field">
                                <label for="">Email</label>
                                <input class="ipt" required type="text" name="email" id="">
                            </div>

                            <div class="field">
                                <label for="">Telefone</label>
                                <input maxlength="11" class="ipt" required type="tel" name="tel" id="">
                            </div>

                            <input type="hidden" name="id" id="cliente-id">

                        </div>

                        <div class="uptade">

                            <div class="confirm">
                                <button type="submit" id="btn"> Confirmar </button>
                            </div>
                        
                            <div class="confirm">
                                <button type="button" id="voltar"> Voltar </button>
                            </div>

                        </div>
                       
                    </form>

                </div>

            </dialog>

        </div>

    </main>
    
</body>

    <script>

        const click = document.querySelector(".table");
        const modal = document.querySelector(".modal");
        const ipt = document.querySelectorAll(".ipt");
        const idInput = document.querySelector("#cliente-id");

        click.addEventListener("click", e => {
            const linha = e.target.closest(".cliente");

            if(linha){
                const td = linha.querySelectorAll(".td");

                const nome = td[0].textContent.trim();
                const cpf = td[1].textContent.trim();
                const email = td[2].textContent.trim();
                const tel = td[3].textContent.trim();
                
                ipt[0].value = nome;
                ipt[1].value = cpf;
                ipt[2].value = email;
                ipt[3].value = tel;

                idInput.value = linha.dataset.id;

                modal.showModal();

            };

        });

        document.querySelector("#voltar").addEventListener("click", e => {
            modal.close();
        });

        function sucesso(){
            window.alert("Sucesso ao atualizar o cliente!");
            modal.close();
        };

    </script>

</html>

<?php

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $Name = $_POST['name'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $Id = $_POST['id'];

        $update = ("UPDATE cliente
        SET cliente.Nome_cliente = ?, cliente.CPF = ?, cliente.Email = ?, cliente.Telefone = ?
        WHERE Id_cliente = ? ;");

        $stmt = $pdo->prepare($update);
        $stmt->execute([$Name, $cpf, $email, $tel, $Id]);

        header("Location: at_clientes.php?ok=1");
        echo"<script> sucesso(); </script>";
        exit;

    };
    

?>