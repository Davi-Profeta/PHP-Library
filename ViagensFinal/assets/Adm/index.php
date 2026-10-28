<?php
$loginUrl = '../pages/login.html';
include_once('assets/php/auth.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Company | Administração</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <h1>Painel do Administrador</h1>
        <h2>Cadastre as viagens disponíveis e acompanhe as passagens vendidas</h2>
    </header>

    <nav>
        <a href="assets/php/criar_viagem.php">Cadastrar Viagem</a>
        <a href="assets/php/consulta.php">Consultar Viagens</a>
        <a href="assets/php/cancelar.php">Excluir Viagens</a>
        <a href="../index.php">Ver site dos usuários</a>
        <a href="../logout.php">Sair</a>
    </nav>

    <main>
        <div class="cadastro">
            <h4>Como funciona</h4>
            <p>As viagens cadastradas aqui aparecem automaticamente na página inicial para os usuários agendarem.</p>
        </div>
    </main>
</body>

</html>
