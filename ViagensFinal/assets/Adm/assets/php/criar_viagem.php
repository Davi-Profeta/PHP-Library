<?php
include_once('auth.php');
include_once('conexao.php');

$motoristas = mysqli_query($conexao, "SELECT Id_Motorista, Nome_Motorista FROM motorista ORDER BY Nome_Motorista");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Viagem</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Cadastrar viagem disponível</h1>
        <h3>A viagem aparecerá para os usuários assim que for cadastrada.</h3>
    </header>

    <?php if (isset($_GET['ok'])) { ?>
        <div class="aviso">Viagem cadastrada com sucesso!</div>
    <?php } ?>

    <div class="quadro">
        <form action="salvar_viagem.php" method="post">
            <label>Nome da viagem:</label>
            <input type="text" name="nome" placeholder="Ex: Feriado no Rio" maxlength="100" required>

            <label>Origem:</label>
            <input type="text" name="origem" placeholder="Ex: Belo Horizonte, MG" required>

            <label>Destino:</label>
            <input type="text" name="destino" placeholder="Ex: Rio de Janeiro, RJ" required>

            <label>Data:</label>
            <input type="date" name="dia" min="<?= date('Y-m-d') ?>" required>

            <label>Horário:</label>
            <input type="time" name="horario" required>

            <label>Motorista:</label>
            <select name="id_motorista" required>
                <option selected disabled value="">Selecione o motorista...</option>
                <?php
                while ($m = mysqli_fetch_assoc($motoristas)) {
                    echo "<option value='" . $m['Id_Motorista'] . "'>" . $m['Nome_Motorista'] . "</option>";
                }
                ?>
            </select>

            <button type="submit">Cadastrar Viagem</button>
        </form>
    </div>

    <a href="../../index.php"><button>Voltar</button></a>
</body>

</html>
