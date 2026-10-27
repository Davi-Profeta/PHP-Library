<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelar Viagem</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include_once('conexao.php');

    $id = $_GET['id'];

    mysqli_query($conexao, "DELETE FROM viagem WHERE id_viagem = $id");

    header("Location: cancelar.php");
    exit;
    ?>

</body>

</html>