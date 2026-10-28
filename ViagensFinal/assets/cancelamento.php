<?php
include_once("conexao.php");

$mensagem = "";
$passagens = [];

// PASSO 2: o cliente clicou em "Cancelar passagem"
if (isset($_POST['cancelar'])) {

    $idPassagem = (int) $_POST['id_passagem'];

    $stmt = mysqli_prepare($conexao, "DELETE FROM passagem WHERE Id_Passagem = ?");
    mysqli_stmt_bind_param($stmt, "i", $idPassagem);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $mensagem = "Cancelamento feito com sucesso!";
    } else {
        $mensagem = "Não foi possível cancelar a passagem.";
    }

// PASSO 1: o cliente digitou o CPF para consultar
} elseif (isset($_POST['cpf'])) {

    $cpf = $_POST['cpf'];

    $stmt = mysqli_prepare($conexao,
        "SELECT passagem.Id_Passagem, cliente.Nome_Cliente, cliente.CPF, viagem.*
         FROM passagem
         INNER JOIN cliente ON passagem.Id_Cliente = cliente.Id_Cliente
         INNER JOIN viagem  ON passagem.Id_Viagem  = viagem.Id_Viagem
         WHERE cliente.CPF = ?");
    mysqli_stmt_bind_param($stmt, "s", $cpf);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    while ($linha = mysqli_fetch_assoc($resultado)) {
        $passagens[] = $linha;
    }

    if (count($passagens) === 0) {
        $mensagem = "CPF Inválido ou sem passagens.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cancelamento.css">
    <title>Travel Company</title>
</head>

<body>

    <header>
        <div class="title">
            <h1>Travel Company</h1>
        </div>

        <div class="pages">
            <table>
                <td> <a href="index.php"> Início </a> </td>
                <td> <a href="pages/cancelamento.php"> Cancelamento </a> </td>
                <td> <a href="pages/sobre.html"> Sobre </a> </td>
                <td> <a href="logout.php"> Sair </a> </td>
            </table>
        </div>
    </header>

    <main>
        <div class="container">

            <div class="titleCan">
                <h3>Cancelamento de Viagem</h3>
            </div>

            <div class="pesquisa">
                <div class="filters">

                    <?php if ($mensagem !== ""): ?>
                        <p><?= htmlspecialchars($mensagem) ?></p>
                    <?php endif; ?>

                    <?php foreach ($passagens as $p): ?>
                        <div class="passagem">
                            <p><strong>Passageiro:</strong> <?= htmlspecialchars($p['Nome_Cliente']) ?></p>
                            <p><strong>CPF:</strong> <?= htmlspecialchars($p['CPF']) ?></p>
                            <p><strong>Passagem nº:</strong> <?= $p['Id_Passagem'] ?></p>
                            <p><strong>Origem:</strong> <?= htmlspecialchars($p['Origem']) ?></p>
                            <p><strong>Destino:</strong> <?= htmlspecialchars($p['Destino']) ?></p>
                            <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($p['Dia'])) ?></p>

                            <form method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar esta passagem?');">
                                <input type="hidden" name="id_passagem" value="<?= $p['Id_Passagem'] ?>">
                                <button type="submit" name="cancelar">Cancelar passagem</button>
                            </form>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>
    </main>

</body>
</html>