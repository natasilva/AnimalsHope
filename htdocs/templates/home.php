<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals Hope</title>

    <!-- Importação das Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat%7CFredoka%20One%22%3E">

    <!-- Importação do CSS - Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Impotação dos estilos -->
    <link rel="stylesheet" href="../_css/home109.css">
    <link rel="stylesheet" href="../_css/estilos_global.css">
    <link rel="stylesheet" href="../_css/tela_login20.css">
    

    <!-- Ícone da guia -->
    <link rel="shortcut icon" href="../images/icon-guia.png" type="image/png">
</head>
<body id="corpo">
    <!-- Voltar ao Topo -->
    <div class="voltar-ao-topo" href="#" style="display: none;"></div>
    

    <!-- Include da Navegação -->
    <?php
        if($_SESSION['logado']){
            include_once "../include/nav-bar-cadastrado.php";
        } else {
            include_once "../include/nav-bar-nao-cadastrado.php";
        }
    ?>

    <!-- Cabeçalho -->
    <header>
        <!-- Sessão do Carrossel -->
        <section id="inicio-home">
            <div class="justify-content">
                <div class="float-left-carousel">
                
                </div>
                <div class="float-right-carousel">
                
                </div>
            </div>

            <div class="container-inicio w-100" style="position: absolute;">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin: 0 auto;">
                    <ol class="carousel-indicators indicadores">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../images/img_1-carrossel.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/img_2-carrossel.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/img_3-carrossel.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/img_4-carrossel.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </section>

        <?php
            include_once "../include/tela_login.php";
            if(!$_SESSION['logado']){ ?>
                <script>mostrarTelaLogin();</script>
        <?php } ?>

    </header>    

    <!-- Conteúdo Principal -->
    <main>
        <!-- Sessão para o cadastro do anúncio do animal -->
        <section class="cadastrar-anuncio">
        <div class="lado-esquerdo">
          <img src="../images/dog-cadastrar.png" alt="" data-anime="left">
        </div>

        <div class="meio" data-anime="top">
          <div class="container-frase-meio">
              <div class="texto" id="primeira-frase">
                CADASTRE O SEU PET
              </div>
              <div class="texto" id="segunda-frase">
                AGORA!
              </div>
          </div>
        </div>

        <div class="lado-direito">
            <div class="container-botao-cadastrar-anuncio">
                <a href="../templates/cadastro_animal.php" style="text-decoration: none;">
                    <div class="botao-cadastrar-anuncio" data-anime="left">
                        <p>CADASTRAR</p>
                    </div>
                </a>
            </div>
        </div>


        <div class="lado-esquerdo-mobile">
          <center>
            <p>CADASTRE</p>
            <p>O SEU PET</p>
            <p>AGORA!</p>
          </center>
        </div>

        <div class="lado-direito-mobile">
          <a href="../templates/cadastro_animal.php">
            <div class="botao-cadastrar-anuncio-mobile">
              <p>Cadastrar</p>
            </div>
          </a>
        </div>

        <!-- Cadastro do Anúncio mobile muito pequena -->
        <div class="cadastrar-anuncio-mobile">
          <p>CADASTRE</p>
          <p>O SEU PET</p>
          <p>AGORA!</p>

          <div class="lado-baixo-mobile">
            <a href="../templates/cadastro_animal.php">
              <div class="btn-cadastrar-mobile">
                <p>Cadastrar</p>
              </div>
            </a>
          </div>
        </div>
      </section>

      <section class="sobre-site">
        <h3 data-anime="left">O que você poderá fazer?</h3>

        <div class="container-sobre">
          <div class="cards-sobre primeiro" data-anime="left">
            <div class="img-apresentacao">
              <img src="../images/filtragem.png" alt="imagem" id="myImg1" class="imgs-sobre">
            </div>
            <div class="texto-informativo">
              <p>
                &nbsp;Aqui você poderá encontrar e adotar o seu pet preferido, podendo ser filtrado as informações que mais desejar para chegar o mais próximo de sua preferência.
              </p>
            </div>
          </div>
          <div id="myModal" class="modelo">
            <span class="fechar">&times;</span>
            <img class="modelo-conteudo" id="img01">
          </div>
          
          <div class="cards-sobre" data-anime="left">
            <div class="img-apresentacao">
              <img src="../images/informacoes-do-anuncio.png" alt="" id="myImg2" class="imgs-sobre">
            </div>
            <div class="texto-informativo">
              <p>
                &nbsp;Poderá também achar todos os pets dos mais recentes, aos mais antigos. Podendo marcar os que mais gostar como favorito, e saber mais sobre cada pet.
              </p>
            </div>
          </div>
          <div id="myModal" class="modelo">
            <span class="fechar">&times;</span>
            <img class="modelo-conteudo" id="img01">
          </div>

          <div class="cards-sobre" data-anime="left">
            <div class="img-apresentacao">
              <img src="../images/descricao-pet.png" alt="" id="myImg3" class="imgs-sobre">
            </div>
            <div class="texto-informativo">
              <p>
                &nbsp;A quem for querer acessar mais informações sobre o pet, poderá favoritar e ver todos os detalhes possíveis do determinado pet clicado, como a foto, os dados e a descrição.
              </p>
            </div>
          </div>
          <div id="myModal" class="modelo">
            <span class="fechar">&times;</span>
            <img class="modelo-conteudo" id="img01">
          </div>

          <div class="cards-sobre" data-anime="left">
            <div class="img-apresentacao">
              <img src="../images/cadastrar_pet.png" alt="" id="myImg4" class="imgs-sobre">
            </div>
            <div class="texto-informativo">
              <p>
                &nbsp;E por fim, se você estiver com algum animal para querer doar, basta se cadastrar colocando as informações pedidas e logo após, publicando um anúncio novo de seu pet.
              </p>
            </div>
          </div>
          <div id="myModal" class="modelo">
            <span class="fechar">&times;</span>
            <img class="modelo-conteudo" id="img01">
          </div>
        </div>
      </section>
    </main>

    <!-- Include do rodapé/footer -->
    <?php
        include_once "../include/footer.php";
    ?>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="../_javascript/home204.js"></script>
    <script src="../_javascript/data_automatica_copyright.js"></script>
    <script src="../_jquery/jquery-3.6.0.js"></script>
</body>
</html>