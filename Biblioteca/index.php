<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Planeta Leitura</title>

</head>

<body>

    <header>

        <h1> Planeta Leitura </h1>

    </header>

    <main>

        <form class="container" action="index.php" method="post">

            <div class="abaForm">
                <label for="">Usuário</label>
                <input type="text" name="user" class="ipt">
            </div>

            <div class="abaForm">
                <label for="">Senha</label>
                <input type="password" name="password" class="ipt">
            </div>

            <div class="abaBTN">
                <button id="btn">Confirmar</button>
            </div>

        </form>

    </main>
    
</body>

</html>

<?php

    // Impede o navegador de armazenar esta página em cache
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
    header("Pragma: no-cache"); // HTTP 1.0
    header("Expires: 0"); // Proxies
   
    require_once "assets/php/conexao.php";

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $User = $_POST['user'] ?? '';
        $Password = $_POST['password'] ?? '';
        $Nivel = "";

        $buscar = ("SELECT *
        FROM acessos 
        WHERE Nome_acesso = ? AND Senha = ? ");

        $stmtB = $pdo->prepare($buscar);
        $stmtB->execute([$User, $Password]);

        while($i = $stmtB->fetch(PDO::FETCH_BOTH)) {

            $Nivel = $i['Nivel'];

        };

        $login = ("SELECT *
        FROM acessos
        WHERE Nome_acesso = ? AND Senha = ? AND Nivel = ?");

        $stmt = $pdo->prepare($login);
        $stmt->execute([$User, $Password, $Nivel]);
        $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(empty($linhas)){
            echo "Erro";
        } else if($Nivel === 1){
            header("Location: assets/pages/adm.html");
            exit();
        } else {
            header("Location: assets/pages/assistente.php");
            exit();
        }

    };

?>