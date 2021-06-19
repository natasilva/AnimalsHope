<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php //Imprimir o nome do anúncio aqui;?></title>

    <!-- Importando fontesdo Google -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat|Fredoka%20One">    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="../_css/estilos_global.css">
    <link rel="stylesheet" href="../_css/anuncio5.css">
    <link rel="stylesheet" href="../_css/tela_login20.css">

    <!-- Ícone da guia -->
    <link rel="shortcut icon" href="../images/icon-guia.png" type="image/png">
</head>
<body>
        <?php
              
            if(isset($_GET['doacao_id'])){

                if($_SESSION['logado']){
                    include_once "../include/nav-bar-cadastrado.php";
                    
                } else {
                    include_once "../include/nav-bar-nao-cadastrado.php";
                }
                $conexao = mysqli_connect("sql312.epizy.com", "epiz_28009425", "665dRaiA7P1", "epiz_28009425_animals_hope");
                mysqli_set_charset($conexao, "utf8");

                include_once "../include/tela_login.php";      
                include "../_php-action/gerarAnuncio.php";

                $DoacaoID = $_GET['doacao_id'];
                $sql4 = "SELECT * FROM doacao WHERE ID_doacao = $DoacaoID"; //selecionando os dados da doação aberta
                $query4 = mysqli_query($conexao, $sql4);
                $resultado4 = mysqli_fetch_assoc($query4); 
                
                if($resultado4['atividade_doacao'] == "inativo"){
                    echo "<script language='javaScript'>window.location.href='http://animalshope.epizy.com/templates/anuncios_recentes3.php'</script>";
                    exit();
                }
                else {
                    gerarAnuncio($conexao, $_GET['doacao_id'], $resultado4);
                }
            }
            else {
                echo "<script language='javaScript'>window.location.href='http://animalshope.epizy.com/templates/anuncios_recentes3.php'</script>";
                exit();
            }
        ?>
    </main>
    <br>
    
    <?php

        include_once '../include/footer.php';
    ?>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="../_javascript/data_automatica_copyright.js"></script>
</body>
</html>