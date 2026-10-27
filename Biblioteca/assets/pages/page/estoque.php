<?php
    require_once "../../php/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/estoque.css">
    <title>Estoque</title>
 
</head>
 
<body>
 
    <header>
 
        <h1>Estoque</h1>
 
    </header>
 
    <main>
 
        <section class="painel">
 
            <h2>Livros</h2>
 
            <div class="tabela-wrap">
                <table class="tableL">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="num">Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
 
                        <?php 

                            $livros = ("SELECT *
                            FROM livro ");

                            $stmt = $pdo->prepare($livros);
                            $stmt->execute();

                            foreach($stmt as $i){
                                echo"
                                    <tr class='livros'>
                                        <td class='td' > {$i['Nome_livro']} </td>
                                        <td class='td' > {$i['Quantidade']} </td>
                                    </tr>
                                ";
                            };
                        
                        ?>
 
                    </tbody>
                </table>
            </div>
 
        </section>
 
        <section class="painel">
 
            <h2>Empréstimos</h2>
 
            <div class="tabela-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Livro</th>
                            <th>Data devolução</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 

                            $emprestimos = ("SELECT data_emprestimo,data_expirar, Nome_cliente, Nome_livro
                            FROM emprestimo
                            INNER JOIN cliente ON cliente.Id_cliente = emprestimo.Id_cliente
                            INNER JOIN livro ON livro.Id_livro = emprestimo.Id_livro;");

                            $stmt = $pdo->prepare($emprestimos);
                            $stmt->execute();

                            foreach($stmt as $i){
                                echo"
                                    <tr>
                                        <td class='td' > {$i['Nome_cliente']} </td>
                                        <td class='td' > {$i['Nome_livro']} </td>
                                        <td class='td' > {$i['data_expirar']} </td>
                                    </tr>
                                ";
                            };
                        
                        ?>
 
                    </tbody>
                </table>
            </div>
 
        </section>
 
    </main>

    <dialog class="modalLivro">

        <div class="header">
            <h3>dasdasidjo</h3>
            <p>Cuidado com a atualização dos livros!</p>
        </div>

        <div class="main">

            <form action="estoque.php" method="post">

                <div class="uptade">

                    <div class="field">
                        <label for="">Nome Livro</label>
                        <input class="ipt" required type="text" name="nameLivro" id="">
                    </div>

                    <div class="field">
                        <label for="">Páginas</label>
                        <input maxlength="12" class="ipt" required type="number" name="pag" id="">
                    </div>

                </div>

                
                <div class="uptade">

                    <div class="field">
                        <label for="">Autor</label>
                        <input class="ipt" required type="text" name="autor" id="">
                    </div>

                    <div class="field">
                        <label for="">Editora</label>
                        <input class="ipt" required type="text" name="editora" id="">
                    </div>

                </div>

                <div class="uptade">

                    <div class="field">
                        <label for="">Quantidade de Livros</label>
                        <input maxlength="12" class="ipt" required type="number" name="quantidade" id="">
                    </div>

                    <div class="field">
                        <label for="">Gênero</label>
                            <select class="ipt" name="genero" id="">
                                <option value=""> Selecione um gênero </option>

                                <?php
                                $buscarGenero = ("SELECT * FROM genero");
                                $stmt = $pdo->prepare($buscarGenero);
                                $stmt->execute();

                                foreach ($stmt as $i) {
                                    echo "<option value='{$i['Id_genero']}'> {$i['Nome_genero']} </option>";
                                }
                                ?>
                            </select>
                    </div>

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
 
</body>
    <script src="../../js/estoque.js" defer></script>
</html>

<?php

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $nameLivro = $_POST['nameLivro'];
        $autor = $_POST['autor'];
        $editora = $_POST['editora'];
        $pag = $_POST['pag'];
        $quantidade = $_POST['quantidade'];
        $genero = $_POST['genero'];

        $upLivro = ("UPDATE livro
        SET livro.Nome_livro = ? ,livro.Paginas = ? ,livro.Autor = ? ,livro.Editora = ? ,livro.Quantidade = ? ,livro.Id_genero =  ?
        WHERE livro.Id_livro = ? ; ");

        $stmt = $pdo->prepare($upLivro);
        $stmt->execute([$nameLivro, $pag,  $autor, $editora , $quantidade, $genero]);

        echo " <script> sucessoLivro(); </script> ";
    };

?>