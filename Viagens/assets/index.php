<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>DP - Viagens</title>

</head>

<body>

    <div class="container">

        <header>

            <div class="title">
                <h1>DP - VIAGENS</h1>
            </div>

            <div class="pages">
                <table>
                    <td> <a href="index.php"> Início </a> </td>
                    <td> <a href="pages/cancelamento.html"> Cancelamento </a> </td>
                    <td> <a href="pages/sobre.html"> Sobre </a> </td>
                </table>
            </div>

        </header>

        <div class="imgTeste">

        </div>

    </div>


    <div class="mainContainer">

        <section>

            <div class="titleFilter">
                <h3>Filtrar Viagens</h3>
            </div>

            <div class="filter">
                <label for="">Origem</label>
                <select name="" id="">
                    <option value="">DASDA</option>
                </select>
            </div>

            <div class="filter">
                <label for="">Data</label>
                <select name="" id="">
                    <option value="">DASDA</option>
                </select>
            </div>

        </section>

        <main>

            <?php

            include_once("conexao.php");

            $description = mysqli_query(
                $conexao,
                "SELECT * FROM Viagem"
            );

            if (mysqli_num_rows($description) == 0) {
                echo "Nenhuma viagem disponível";
            } else {

                while ($linha = mysqli_fetch_array($description)) {
                    echo "
                        <div class='viagens'>

                            <div class='imgViagen'>

                            </div>

                            <div class='descriptionViagem'>
                                <h3>{$linha['Nome_Viagem']}</h3>
                                <p><strong>Origem:</strong> {$linha['Origem']}</p>
                                <p><strong>Destino:</strong> {$linha['Destino']}</p>
                                <p><strong>Data:</strong> " . date('d/m/Y', strtotime($linha['Dia'])) . "</p>
                                <p><strong>Horário:</strong> {$linha['Horário']}</p>

                                <a href='pages/agendar.php ? id_viagem={$linha['Id_Viagem']}'> <button> Agendar Viagem </button> </a>
                                
                            </div>
                                    
                        </div>
                        ";
                };
            }



            ?>

        </main>

    </div>


</body>

</html>