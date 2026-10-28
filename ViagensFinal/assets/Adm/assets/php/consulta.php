<?php
include_once('auth.php');
include_once('conexao.php');

$consulta = mysqli_query(
    $conexao,
    "SELECT
        viagem.Id_Viagem,
        viagem.Nome_Viagem,
        viagem.Origem,
        viagem.Destino,
        DATE_FORMAT(viagem.Dia, '%d/%m/%Y') AS Data,
        viagem.`Horário` AS Horario,
        motorista.Nome_Motorista,
        (SELECT COUNT(*) FROM passagem WHERE passagem.Id_Viagem = viagem.Id_Viagem) AS vendidas
     FROM viagem
     LEFT JOIN motorista ON motorista.Id_Motorista = viagem.Id_Motorista
     ORDER BY viagem.Dia"
);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Viagens</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Viagens disponíveis</h1>
    </header>

    <?php
    if (mysqli_num_rows($consulta) > 0) {
        echo "<table>";
        echo "<tr><th>Viagem</th><th>Origem</th><th>Destino</th><th>Data</th><th>Horário</th><th>Motorista</th></tr>";
        while ($v = mysqli_fetch_assoc($consulta)) {
            echo "<tr>
                <td>" . $v['Nome_Viagem'] . "</td>
                <td>" . $v['Origem'] . "</td>
                <td>" . $v['Destino'] . "</td>
                <td>" . $v['Data'] . "</td>
                <td>" . substr($v['Horario'], 0, 5) . "</td>
                <td>" . ($v['Nome_Motorista'] ?? '—') . "</td>
              </tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Nenhuma viagem cadastrada.</h3>";
    }
    ?>

    <a href="../../index.php"><button>Voltar</button></a>
</body>

</html>
