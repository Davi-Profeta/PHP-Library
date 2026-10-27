<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Viagens</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <?php
    include_once('conexao.php');

    $consulta = mysqli_query(
        $conexao,
        "SELECT  
        cliente.nome as nome_cliente,
        cliente.telefone as telefone_cliente,
        viagem.origem as origem,
        viagem.destino as destino,       
        DATE_FORMAT(viagem.data_viagem, '%d/%m/%Y') as 'Data',
        viagem.horario as horario,
        empresa.nome as empresa_onibus
        
        FROM viagem 

        INNER JOIN cliente ON cliente.id_cliente = viagem.id_cliente
        INNER JOIN empresa ON empresa.id_empresa = viagem.id_empresa 
        "
    )
    ?>

    <header>
        <h1> Consulta de viagens</h1>
    </header>

    <?php
    if (mysqli_num_rows($consulta) > 0) {
        echo "<table border = '1'> ";
        echo "<tr><th>Nome Cliente</th><th>Telefone</th><th>Origem</th><th>Destino</th><th>Data</th><th>Horário</th><th>Empresa</th></tr>";
        while ($v = mysqli_fetch_assoc($consulta)) {
            echo "<tr>
                <td>" . $v['nome_cliente'] . "</td>
                <td>" . $v['telefone_cliente'] . "</td>
                <td>" . $v['origem'] . "</td>
                <td>" . $v['destino'] . "</td>
                <td>" . $v['Data'] . "</td>
                <td>" . $v['horario'] . "</td>
                <td>" . $v['empresa_onibus'] . "</td>
              </tr>";
        }

        echo "</table>";
    } else {
        echo "<h3>Nenhuma viagem agendada.</h3>";
    }
    ?>

    <a href="../../index.html"> <button>Voltar</button></a>
</body>

</html>