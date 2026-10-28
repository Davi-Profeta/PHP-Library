<?php
include_once("conexao.php");

$viagens = [];
$resultado = mysqli_query($conexao, "SELECT * FROM Viagem ORDER BY Dia");
while ($linha = mysqli_fetch_assoc($resultado)) {
    $viagens[] = $linha;
}

$origens = array_values(array_unique(array_column($viagens, 'Origem')));
sort($origens);
$datas = array_values(array_unique(array_column($viagens, 'Dia')));
sort($datas);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Travel Company</title>

</head>

<body>

    <div class="container">

        <header>

            <div class="title">
                <h1>Travel Company</h1>
            </div>

            <div class="pages">
                <table>
                    <td> <a href="index.php"> Início </a> </td>
                    <td> <a href="pages/cancelamento.php"> Cancelamento </a> </td>
                    <td> <a href="pages/sobre.html"> Sobre </a> </td>
                    <td> <a href="logout.php">Sair</a></td>
                </table>
            </div>

        </header>

        <div class="imgTeste fundoHero">

        </div>

    </div>


    <div class="mainContainer">

        <section>

            <div class="titleFilter">
                <h3>Filtrar Viagens</h3>
            </div>

            <div class="filter">
                <label for="fOrigem">Origem</label>
                <select name="origem" id="fOrigem">
                    <option value="">Todas as origens</option>
                    <?php foreach ($origens as $o): ?>
                        <option value="<?= htmlspecialchars($o) ?>"><?= htmlspecialchars($o) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter">
                <label for="fData">Data</label>
                <select name="data" id="fData">
                    <option value="">Todas as datas</option>
                    <?php foreach ($datas as $d): ?>
                        <option value="<?= htmlspecialchars($d) ?>"><?= date('d/m/Y', strtotime($d)) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        </section>

        <main>

            <?php if (count($viagens) === 0): ?>

                <p>Nenhuma viagem disponível</p>

                <?php else: foreach ($viagens as $linha): ?>

                    <div class="viagens"
                        data-origem="<?= htmlspecialchars($linha['Origem']) ?>"
                        data-data="<?= htmlspecialchars($linha['Dia']) ?>">

                        <div class="imgViagen">

                        </div>

                        <div class="descriptionViagem">
                            <h3><?= htmlspecialchars($linha['Nome_Viagem']) ?></h3>
                            <p><strong>Origem:</strong> <?= htmlspecialchars($linha['Origem']) ?></p>
                            <p><strong>Destino:</strong> <?= htmlspecialchars($linha['Destino']) ?></p>
                            <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($linha['Dia'])) ?></p>
                            <p><strong>Horário:</strong> <?= htmlspecialchars($linha['Horário']) ?></p>

                            <a href="pages/agendar.php?id_viagem=<?= (int) $linha['Id_Viagem'] ?>"> <button> Agendar Viagem </button> </a>

                        </div>

                    </div>

            <?php endforeach;
            endif; ?>

        </main>

    </div>

    <script>
        // Filtros de origem e data (sem recarregar a página)
        const fOrigem = document.getElementById('fOrigem');
        const fData = document.getElementById('fData');
        const cards = document.querySelectorAll('.viagens');

        function filtrar() {
            cards.forEach(function(card) {
                const ok = (!fOrigem.value || card.dataset.origem === fOrigem.value) &&
                    (!fData.value || card.dataset.data === fData.value);
                card.style.display = ok ? '' : 'none';
            });
        }

        fOrigem.addEventListener('change', filtrar);
        fData.addEventListener('change', filtrar);
    </script>

</body>

</html>