<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cancelamento.css">
    <title>DP - Viagens</title>

</head>

<body>
    
    <header>

        <div class="title">
            <h1>DP - VIAGENS</h1>
        </div>

        <div class="pages">
            <table>
                <td> <a href="../index.php"> Início </a> </td>
                <td> <a href=""> Cancelamento </a> </td>
                <td> <a href="sobre.html"> Sobre </a> </td>
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
                            session_start();

                            $verificar = $_SESSION['CPF'];

                            $viagens = mysqli_query($conexao,"SELECT * 
                            FROM passagem
                            WHERE $verificar" );

                            $mostrar = mysqli_query($conexao,"
                            SELECT viagem.Nome_Viagem, viagem.Origem, viagem.Destino,
                                viagem.Dia, viagem.`Horário`, motorista.Nome_Motorista
                            FROM passagem
                            INNER JOIN viagem  ON passagem.Id_Viagem  = viagem.Id_Viagem
                            INNER JOIN usuarios ON passagem.Id_Cliente = usuarios.Id_Cliente
                            INNER JOIN motorista ON viagem.Id_Motorista = motorista.Id_Motorista;");


                            if(mysqli_num_rows($viagens) > 0){

                                while ($linha = mysqli_fetch_assoc($mostrar)){

                                    echo"
                                         <tr>
                                            <td> {$linha['Origem']} </td>
                                            <td> {$linha['Destino']} </td>
                                            <td> {$linha['Dia']} </td>
                                            <td> {$linha['Horário']} </td>
                                            <td> {$linha['Nome_Motorista']} </td>
                                            <td> Cancelar </td>
                                        </tr>
                                    ";

                                };

                            };

                        ?>

                    </table>

                </div>


            </div>
            

        </div>

    </main>


</body>

</html>