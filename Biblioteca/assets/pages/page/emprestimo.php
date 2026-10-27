<?php
    require_once "../../php/conexao.php";
?>

<!DOCTYPE html>
<html lang="pr-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/emprestimo.css">
    <title>Document</title>

</head>

<body>

    <header>

        <h1>Emprestimos</h1>

    </header>

    <main>

        <div class="container">

            <form action="emprestimo.php" method="post">

                <div class="field">
                    <label for="">Cliente</label>
                    <select name="cliente" id="">
                        <option disabled selected value="">Selecione um cliente</option>

                        <?php 

                            $cliente = ("SELECT *
                            FROM cliente");

                            $stmt = $pdo->prepare($cliente);
                            $stmt->execute();

                            foreach($stmt as $i){
                                echo" <option value='{$i['Id_cliente']}'> {$i['Nome_cliente']} </option> ";
                            };
                        
                        ?>

                    </select>
                </div>

                <div class="field">
                    <label for="">Livro</label>
                    <select name="livro" id="">
                        <option disabled selected value="">Selecione um Livro</option>

                        <?php 

                            $cliente = ("SELECT *
                            FROM livro");

                            $stmt = $pdo->prepare($cliente);
                            $stmt->execute();

                            foreach($stmt as $i){
                                echo" <option value='{$i['Id_livro']}'> {$i['Nome_livro']} </option> ";
                            };
                        
                        ?>

                    </select>
                </div>

                <div class="field">
                    <label for="">Data Emprestimo</label>
                    <input class="ipt" required type="date" name="emprestimo" id="" min="<?= date('Y-m-d') ?>">
                </div>

                <div class="field">
                    <label for="">Data Devolução</label>
                    <input maxlength="12" class="ipt" required type="date" name="devolucao" id="" min="<?= date('Y-m-d') ?>">
                </div>

                <div class="confirm">
                    <button id="btn"> Confirmar </button>
                </div>


            </form>
    

        </div>

    </main>

    
</body>

    <script>
        function mensagem(){
            window.alert("Emprestimo feito com sucesso!");
        };
    </script>

</html>

<?php 

    date_default_timezone_set('America/Sao_Paulo');

    if($_SERVER ['REQUEST_METHOD'] === "POST"){

        $customer = $_POST['cliente'];
        $book = $_POST['livro'];
        $loan = $_POST['emprestimo'];
        $return = $_POST['devolucao'];

        $emprestimo = ("INSERT INTO emprestimo(Id_cliente, Id_livro, data_emprestimo, data_expirar)
        VALUES (?,?,?,?)");

        $stmt = $pdo->prepare($emprestimo);

        if($stmt->execute([$customer, $book, $loan, $return])){

            $quantidade = ("UPDATE livro
            SET Quantidade = Quantidade - 1
            WHERE Id_livro = ? ");

            $stmb = $pdo->prepare($quantidade);
            $stmb->execute([$book]);

        };

        echo"<script> mensagem() </script>";

    };


?>