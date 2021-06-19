<?php
    session_start();
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sobre Nós</title>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat|Fredoka%20One">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/estilos_global.css">
    <link rel="stylesheet" type="text/css" href="../_css/css_sobre_nos/estilo.css">
    <link rel="stylesheet" type="text/css" href="../_css/tela_login20.css">

    <!-- Ícone da guia -->
    <link rel="shortcut icon" href="../images/icon-guia.png" type="image/png">
</head>
<body>

    <?php
        if($_SESSION["logado"]){
            include_once '../include/nav-bar-cadastrado.php';
        } else {
            include_once '../include/nav-bar-nao-cadastrado.php';
        }

        include_once '../include/tela_login.php';
    ?>
    
    <div class="sobre">
        <div class="inner-container">
            <h1>Sobre Nós</h1>
            <p class="texto">
                &nbsp Somos alunos da Escola Técnica Estadual de Araçatuba (Etec), mediante ao curso de Desenvolvimento de Sistemas 2020-2021, resolvemos criar um website que a princípio visa combater o abandono de animais de estimação e, promover a adoção dos mesmos.   
            </p>
        </div>
    </div>

    <?php include_once '../include/footer.php' ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>