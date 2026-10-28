<?php
include_once('auth.php');
include_once('conexao.php');

$busca = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

$consulta = mysqli_query(
    $conexao,
    "SELECT
        viagem.Id_Viagem,
        viagem.Nome_Viagem,
        viagem.Origem,
        viagem.Destino,
        DATE_FORMAT(viagem.Dia, '%d/%m/%Y') AS Data,
        viagem.`Horário` AS Horario,
        (SELECT COUNT(*) FROM passagem WHERE passagem.Id_Viagem = viagem.Id_Viagem) AS vendidas
     FROM viagem
     WHERE viagem.Nome_Viagem LIKE '%$busca%'
        OR viagem.Origem LIKE '%$busca%'
        OR viagem.Destino LIKE '%$busca%'
     ORDER BY viagem.Dia"
);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Viagens</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Excluir viagens</h1>
        <h3>Busque pelo nome, origem ou destino. Excluir uma viagem também cancela as passagens vendidas dela.</h3>
    </header>

    <main>
        <div class="quadro-cancelamento">
            <form action="cancelar.php" method="get">
                <input type="search" placeholder="Pesquisar" name="pesquisa" value="<?= htmlspecialchars($busca) ?>">
                <button type="submit">Buscar</button>
            </form>

            <?php if (mysqli_num_rows($consulta) > 0) { ?>
                <table>
                    <tr>
                        <th>Viagem</th>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Ação</th>
                    </tr>

                    <?php while ($v = mysqli_fetch_assoc($consulta)) { ?>
                        <tr>
                            <td><?= $v['Nome_Viagem'] ?></td>
                            <td><?= $v['Origem'] ?></td>
                            <td><?= $v['Destino'] ?></td>
                            <td><?= $v['Data'] ?></td>
                            <td><?= substr($v['Horario'], 0, 5) ?></td>
                            <td>
                                <a href="deletar.php?id=<?= $v['Id_Viagem'] ?>"
                                    onclick="return confirm('Excluir esta viagem?')">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <h3>Nenhuma viagem encontrada.</h3>
            <?php } ?>
        </div>
    </main>

    <a href="../../index.php"><button>Voltar</button></a>
</body>

</html>
