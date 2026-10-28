<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cancelamento.css">
    <title>Travel Company</title>

</head>

<body>
    
    <header>

        <div class="title">
            <h1>Travel Company</h1>
        </div>

        <div class="pages">
            <table>
                <td> <a href="../index.php"> Início </a> </td>
                <td> <a href="cancelamento.php"> Cancelamento </a> </td>
                <td> <a href="sobre.html"> Sobre </a> </td>
                <td> <a href="../logout.php"> Sair </a> </td>
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

                    <table>

                        <tr>
                            <th>Origem</th>
                            <th>Destino</th>
                            <th>Dia</th>
                            <th>Horário</th>
                            <th>Motorista</th>
                            <th>Ação</th>
                        </tr>

                        <?php
                            include_once("../conexao.php");

                            // Só as passagens de quem está logado
                            $idCliente = $_SESSION['Id_Login'] ?? $_SESSION['Id'] ?? 0;

                            $stmt = mysqli_prepare($conexao, "
                                SELECT passagem.Id_Passagem, viagem.Origem, viagem.Destino,
                                    viagem.Dia, viagem.`Horário`, motorista.Nome_Motorista
                                FROM passagem
                                INNER JOIN viagem ON passagem.Id_Viagem = viagem.Id_Viagem
                                LEFT JOIN motorista ON viagem.Id_Motorista = motorista.Id_Motorista
                                WHERE passagem.Id_Cliente = ?");
                            mysqli_stmt_bind_param($stmt, "i", $idCliente);
                            mysqli_stmt_execute($stmt);
                            $mostrar = mysqli_stmt_get_result($stmt);

                            if (mysqli_num_rows($mostrar) > 0) {

                                while ($linha = mysqli_fetch_assoc($mostrar)) {

                                    echo "
                                        <tr>
                                            <td> " . htmlspecialchars($linha['Origem']) . " </td>
                                            <td> " . htmlspecialchars($linha['Destino']) . " </td>
                                            <td> " . date('d/m/Y', strtotime($linha['Dia'])) . " </td>
                                            <td> " . htmlspecialchars($linha['Horário']) . " </td>
                                            <td> " . htmlspecialchars($linha['Nome_Motorista'] ?? '—') . " </td>
                                            <td>
                                                <form action=\"../cancelamento.php\" method=\"post\" onsubmit=\"return confirm('Tem certeza que deseja cancelar esta passagem?');\">
                                                    <input type=\"hidden\" name=\"id_passagem\" value=\"{$linha['Id_Passagem']}\">
                                                    <button class=\"btn-cancelar\" type=\"submit\" name=\"cancelar\"> Cancelar </button>
                                                </form>
                                            </td>
                                        </tr>
                                    ";

                                };

                            } else {

                                echo "<tr><td colspan='6'> Você ainda não tem passagens. </td></tr>";

                            };

                        ?>

                    </table>

                </div>


            </div>
            

        </div>

    </main>


</body>

</html>