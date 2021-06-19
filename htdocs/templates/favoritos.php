<?php
    session_start();
    if(!$_SESSION["logado"]) {
        header("location: home.php");
    }

  include "../include/conexao.php";
  //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
  $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
  //Selecionar todos as doações da tabela
  $ID = 1; // $_SESSION['id_usuario']; ID de quem está logado
  $result_doacao = "SELECT * FROM ItemFavorito WHERE ItemFavorito_FK = '$ID' AND atividade = 'ativo'";
  $resultado_doacao = mysqli_query($conexao, $result_doacao);
  
  //Contar o total de doações
  $total_doacoes = mysqli_num_rows($resultado_doacao);

  //Seta a quantidade de doações por pagina
  $quantidade_pg = 8;

  //calcular o número de paginas necessárias para apresentar os doações
  $num_pagina = ceil($total_doacoes/$quantidade_pg);

  //Calcular o inicio da visualizacao
  $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Favoritos</title>
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
    <meta name="robots" content="noindex,follow" />
    <link href='https://fonts.googleapis.com/css?family=Fredoka One' rel='stylesheet'>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat|Fredoka%20One">
    <link rel="stylesheet" href="../_css/estilos_global.css">
    <link rel="stylesheet" type="text/css" href="../_css/css_favoritos/styles.css">
    <link rel="stylesheet" href="../_css/paginacão.css">
  </head>

  <body>
  <?php
        include_once '../include/nav-bar-cadastrado.php';
    ?>
   <br>
   
    <div class="itens-favoritos">

      <div class="titulo_AN">
        ANÚNCIOS FAVORITOS
      </div>
      <?php
        include "../include/conexao.php";
        include "../_php-action/gerarFavoritos.php";
        meusFavoritos($conexao, $inicio, $quantidade_pg);
                    //Verificar a pagina anterior e posterior
                  $pagina_anterior = $pagina - 1;
                  $pagina_posterior = $pagina + 1;
      ?>

      <!-- Paginação -->
      <nav id="navegacao-cards">
              <ul class="pagination justify-content-center">
                <li class="page-item">
                  <?php
                    if($pagina_anterior != 0){ ?>
                      <a href="favoritos.php?pagina=<?php echo $pagina_anterior; ?>" class="page-link" aria-label="Previous">
                        Anterior
                      </a>
                  <?php }else{ ?>
                    <li class="page-item disabled" style="cursor: not-allowed">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                  <?php }  ?>
                </li>
                <?php 
                //Apresentar a paginacao
                for($i = 1; $i < $num_pagina + 1; $i++){ 
                    if($i == $_GET['pagina'] || $i == 1 && $_GET['pagina'] == ''): ?>
                        <li><a href="favoritos.php?pagina=<?php echo $i; ?>" class="page-link page-active"><?php echo $i; ?></a></li>
                    <?php else: ?>
                        <li><a href="favoritos.php?pagina=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                    <?php endif;?>
                <?php } ?>
                <li>
                  <?php
                    if($pagina_posterior <= $num_pagina){ ?>
                      <li class="page-item">
                        <a class="page-link" href="favoritos.php?pagina=<?php echo $pagina_posterior; ?>">Próximo</a>
                      </li>
                  <?php }
                  else{ ?>
                    <li class="page-item disabled" style="cursor: not-allowed">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Próximo</a>
                    </li>
                <?php }  ?>
                </li>
              </ul>
        </nav>
    </div>

    <?php
        include_once "../include/footer.php";
    ?>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>





