<?php
    session_start();
    if(!isset($_SESSION["logado"])) {
       header("location: home.php");
   }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://fonts.googleapis.com/css?family=Fredoka One' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat|Fredoka%20One">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="../_css/estiloSeusDados.css">
    <link rel="stylesheet" href="../_css/estilos_global.css">


    <title>Seus dados</title>
    
  </head>
  <body>
    <?php
        include_once '../include/nav-bar-cadastrado.php';
    ?>
    <br>
    
      <div class="estrutura">
        <div class="container">
            <article class="part detalhes" style="margin-bottom: 60px;">
                <h1>
                    Seus dados
                </h1>
                <br>
                <form action="../_php-action/alterarDados.php" method= "post" autocomplete="off">
                <?php
                    include "../_php-action/exibirPerfil.php";
                    include "../include/conexao.php";
                    if(isset($_GET["mensagem"])){
                            echo $_GET["mensagem"];
                            //unset($_SESSION["mensagem"]);
                        } 
                    exibirPerfil($conexao);

                    
                ?>  
                </form>
            </article>
        <div class="part bg" style="margin-bottom: 60px;"></div>
    </div>
</div>
 
    <?php
        include_once "../include/footer.php";
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="../_javascript/cidades1.js"></script>
    <script>
         var uf = document.getElementById("uf");
         window.onload = buscaCidades(uf.value);
    </script>

  </body>
</html>