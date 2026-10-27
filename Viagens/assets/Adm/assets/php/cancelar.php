<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelar Viagem</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Cancelamento de Viagens</h1>
        <h3>Querido cliente, para cancelar sua viagem faça uma busca no campo abaixo pelo seu nome.</h3>
    </header>

    <main>
        <div class="quadro-cancelamento">
            <form action="cancelar.php" method="get">
                <input type="search" placeholder="Pesquisar" size="20" name="pesquisa" required>

                <?php

                include_once('conexao.php');
                $busca = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

                $consulta = mysqli_query(
                    $conexao,
                    "SELECT  
                        cliente.nome as nome_cliente,
                        cliente.telefone as telefone_cliente,
                        viagem.origem as origem,
                        viagem.destino as destino,       
                        DATE_FORMAT(viagem.data_viagem, '%d/%m/%Y') as 'Data',
                        viagem.horario as horario,
                        viagem.id_viagem as id_viagem,
                        empresa.nome as empresa_onibus
                        FROM viagem 

                        INNER JOIN cliente ON cliente.id_cliente = viagem.id_cliente
                        INNER JOIN empresa ON empresa.id_empresa = viagem.id_empresa
                        WHERE cliente.nome LIKE '%$busca%'"
                )
                ?>
                <button type="submit" value="Buscar">Buscar</button>
            </form>
            </form>

            <?php if ($busca != '' && mysqli_num_rows($consulta) > 0) { ?>

                <table border="1">
                    <tr>
                        <th>Cliente</th>
                        <th>Telefone</th>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Empresa</th>
                        <th>Ação</th>
                    </tr>

                    <?php while ($v = mysqli_fetch_array($consulta)) { ?>
                        <tr>
                            <td><?= $v['nome_cliente'] ?></td>
                            <td><?= $v['telefone_cliente'] ?></td>
                            <td><?= $v['origem'] ?></td>
                            <td><?= $v['destino'] ?></td>
                            <td><?= $v['Data'] ?></td>
                            <td><?= substr($v['horario'], 0, 5) ?></td>
                            <td><?= $v['empresa_onibus'] ?></td>
                            <td>
                                <a href="deletar.php?id=<?= $v['id_viagem'] ?>"
                                    onclick="return confirm('Cancelar esta viagem?')">
                                    Cancelar
                                </a>
                            </td>
                        </tr>
                    <?php } ?>

                </table>

            <?php } elseif ($busca != '') { ?>
                <h3>Nenhuma viagem encontrada para esse nome.</h3>
            <?php } ?>

        </div>
        </div>
    </main>

    <a href="../../index.html"> <button>Voltar</button></a>
</body>

</html>