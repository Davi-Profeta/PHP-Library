<?php

    session_start();
    include_once("conexao.php");

    $Name = $_POST['name'];
    $Senha = $_POST['senha'];


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastrar.css">
    <title>DP - Viagens</title>

</head>

<body>

<header>

        <div class="title">
            <h1>DP - VIAGENS</h1>
        </div>


    </header>

    <main>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
        <div class="container"> 

            <?php

                
                $consultarLogin = mysqli_query($conexao,
                "SELECT * FROM usuarios
                WHERE Nome_Cliente = '$Name' AND  Senha = '$Senha' ;");

                if(mysqli_num_rows($consultarLogin) >= 1){
                    
                    while($i = mysqli_fetch_array($consultarLogin)){

                        $Id_Login = $i["Id_Cliente"];
                        $name = $i['Nome_Cliente'];
                        $cpf = $i['CPF'];
                        $tel = $i['Telefone'];
                        $email = $i['Email'];

                        $_SESSION['Id_Login'] = $Id_Login; 
                        $_SESSION['NAME'] = $name;
                        $_SESSION['CPF'] = $cpf;
                        $_SESSION['TEL'] = $tel;
                        $_SESSION['EMAIL'] = $email;

                    };

                    if($Name == "Administrador" && $Senha == 123456){
                        header("Location: adm/index.html");
                    } else {
                        
                        header("Location: index.php");
                        exit;
                    }


                } else {

                    header("Refresh: 3; url=pages/login.html");
                    echo "Algum dos dados inválidos, verifique os dados novamente";


                };

            ?>

        </div>

    </main>
    
</body>

</html>
