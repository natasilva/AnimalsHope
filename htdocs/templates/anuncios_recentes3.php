<?php
  session_start();
  //include_once("../include/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anúncios</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat|Fredoka%20One">

    <!-- LINK PARA BOOTSTRAP - CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- LINK CSS PRINCIPAL - Anúncios Recentes -->
    <link rel="stylesheet" href="../_css/anuncios_recente4.css">
    <link rel="stylesheet" href="../_css/estilos_global.css">
    <link rel="stylesheet" href="../_css/paginacão.css">

    <!-- LINK CSS - TELA DE LOGIN -->
    <link rel="stylesheet" href="../_css/tela_login20.css">

    <!-- Ícone da guia -->
    <link rel="shortcut icon" href="../images/icon-guia.png" type="image/png">
</head>
<body id="corpo" style="background-color: #E7DFDD;">

    <img src="https://i.pinimg.com/originals/19/d7/70/19d770104d9b6879c903ecdd8b036571.gif" id="loading">

    <!-- Include da navegação -->
    <?php
        if($_SESSION['logado']){
            //include_once "../include/nav-bar-cadastrado.php";

            require_once "../include/conexao.php";

            // Não sei onde está armazenando o ID do usuário logado
            $id_user = $_SESSION['id_usuario'];
            $select_NI = "SELECT nome_user, img_user FROM usuarios WHERE id_user = {$id_user}";
            $query_NI = mysqli_query($conexao, $select_NI);
            $user_dados = mysqli_fetch_assoc($query_NI);

            include_once '../include/nav-bar-cadastrado-anuncios_recentes.php';
            mysqli_close($conexao);
            echo "<div class='voltar-ao-topo' href='#'></div>";
        } else {
            include_once "../include/nav-bar-nao-cadastrado-anuncios_recentes.php";
            echo "<div class='voltar-ao-topo' href='#'></div>";
        }

        include_once "../include/tela_login.php";
    ?>

    <script>
        var prevScrollpos = window.pageYOffset
        var nav = document.querySelector('nav.nav-main')
        window.onscroll = function() {
        var currentScrollPos = window.pageYOffset
        if(prevScrollpos > currentScrollPos) {
            nav.style.top = "0"
        } else {
            nav.style.top = "-100px"
        }
            prevScrollpos = currentScrollPos
        }
    </script>

    <!-- Cabeçalho | Barra de pesquisa - Filtro -->
    <header id="cabecalho" style="display: none;">
        <!-- SESSÃO DA BARRA DE PESQUISA -->
        <section class="barra de pesquisa">
            <form action="anuncios_recentes3.php" method="get">
                <div id="container">
                    <div class="container-search">
                        <label class="sub-container">
                        <input name="busca" type="text" autocomplete="email" maxlength="50" dir="ltr" class="pesquisa" onclick="animarPlaceHolder()" onmouseout="desanimarPlaceHolderSaindoMouse()" onkeyup="animarPlaceHolder()">
                        </label>
                        <span id="placeholder">Busque:</span>
                        <button name="Pesquisar" type="submit" value="submit" class="btn-search">
                            Pesquisar
                        </button>
                    </div>
                </div>
            </form>

    
            <!-- Barra de Pesquisa Mobile -->
            <form action="anuncios_recentes3.php" method="get">
                <div id="container-mobile">
                    <div class="subcontainer-mobile">
                        <div class="container-search-mobile">
                        <input name="busca" type="text" autocomplete="email" maxlength="50" dir="ltr" class="pesquisa-mobile" placeholder="Busque Aqui">
                        </div>
                        <button name="Pesquisar" type="submit" value="submit" class="btn-search-mobile">
                        <span>Vamos Lá</span>
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <form action="anuncios_recentes3.php" method="get">
            <!-- SESSÃO DO FILTRO -->
            <section class="filtro">
                <div class="container-filtro">
                <h2 class="titulo">ENCONTRE SEU NOVO PET</h2>

                <div class="container mt-5" style="display: flex; width: fit-content;">
                    <div class="row">
                        <div class="col-sm">
                            <select name="data_doacao" class="form-control form-control-lg selects-filtro">
                                <option value="DESC">Mais Recentes</option>
                                <option value="ASC">Mais Antigos</option>
                            </select>
                            <select name="idade_animal" class="form-control form-control-lg selects-filtro">
                                <option value="">Fase de Idade</option>
                                <option value="filhote">Filhote</option>
                                <option value="juvenil">Juvenil</option>
                                <option value="adulto">Adulto</option>
                                <option value="idoso">Idoso</option>
                            </select>
                            <select name="especie_animal" class="form-control form-control-lg selects-filtro">
                                <option value="">Espécie</option>
                                <option value="cachorro">Cachorro</option>
                                <option value="gato">Gato</option>
                            </select>
                            <select name="vacina_animal" class="form-control form-control-lg selects-filtro">
                                <option value="">Vacinação</option>
                                <option value="1">Vacinado</option>
                                <option value="0">Não vacinado</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <select name="castra_animal" class="form-control form-control-lg selects-filtro">
                                <option value="">Castração</option>
                                <option value="1">Castrado</option>
                                <option value="0">Não Castrado</option>
                            </select>
                            <select name="sexo_animal" class="form-control form-control-lg selects-filtro">
                                <option value="">Sexo</option>
                                <option value="macho">Masculino</option>
                                <option value="femea">Feminino</option>
                            </select>
                            <select name="estado_user" class="form-control form-control-lg selects-filtro" id="uf" name="estados" onchange="buscaCidades(this.value)">
                                <option value="">Estado</option>
                                <option value="Acre">Acre</option>
                                <option value="Alagoas">Alagoas</option>
                                <option value="Amapá">Amapá</option>
                                <option value="Amazonas">Amazonas</option>
                                <option value="Bahia">Bahia</option>
                                <option value="Ceará">Ceará</option>
                                <option value="Espírito Santo">Eespírito Santo</option>
                                <option value="Goiás">Goiás</option>
                                <option value="Maranhão">Maranhão</option>
                                <option value="Mato Grosso">Mato Grosso</option>
                                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                <option value="Minas Gerais">Minas Gerais</option>
                                <option value="Pará">Pará</option>
                                <option value="Paraíba">Paraíba</option>
                                <option value="Paraná">Paraná</option>
                                <option value="Pernambuco">Pernambuco</option>
                                <option value="Piauí">Piauí</option>
                                <option value="Rio de Janeiro">Rio de Janeiro</option>
                                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                <option value="Rondônia">Rondônia</option>
                                <option value="Roraima">Roraima</option>
                                <option value="Santa Catarina">Santa Catarina</option>
                                <option value="São Paulo">São Paulo</option>
                                <option value="Sergipe">Sergipe</option>
                                <option value="Tocantins">Tocantins</option>
                                <option value="Distrito Federal">Distrito Federal</option>
                            </select>
                            <input type="hidden" value="" id="pre-cidade">
                            <select name="cidade_user" class="form-control form-control-lg selects-filtro" id="cidade" disabled>
                                <option value=" " id="cidades">Cidade</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="btn-pesquisar-filtro">
                    <button name="Filtro" type="submit" value="submit">PROCURAR</button>
                </div>

                </div>
            </section>
        </form>
    </header>

    <!-- Conteúdo Princiapl -->
    <main id="principal" style="display: none;">
        <!-- SESSÃO DOS CARDS DE ANÚNCIOS -->
        <section id="section-anuncios">
            <div class="container-cards justify-content-center">
                <?php 
                    if(isset($_GET['Pesquisar'])){
                        include "../include/conexao.php";
                        include "../_php-action/PesquisaFiltro.php";                       
                        //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
                        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
                        //Selecionar todos as doações da tabela
                        $busca = $_GET['busca'];
                        $result_doacao = "SELECT * FROM animais INNER JOIN doacao ON animais.ID_animal = doacao.ID_animal_FK WHERE animais.nome_animais LIKE '%{$busca}%' AND doacao.atividade_doacao = 'ativo' ";
                        $resultado_doacao = mysqli_query($conexao, $result_doacao);

                        //Contar o total de doações
                        $total_doacoes = mysqli_num_rows($resultado_doacao);

                        //Seta a quantidade de doações por pagina
                        $quantidade_pg = 15;

                        //calcular o número de paginas necessárias para apresentar os doações
                        $num_pagina = ceil($total_doacoes/$quantidade_pg);

                        //Calcular o inicio da visualizacao
                        $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;
                        Busca($conexao, $inicio, $quantidade_pg);
                    }
                    else if(isset($_GET['Filtro'])){
                        include "../include/conexao.php";
                        include "../_php-action/PesquisaFiltro.php";
                        //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
                        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

                        //Seta a quantidade de doações por pagina
                        $quantidade_pg = 15;

                        //Calcular o inicio da visualizacao
                        $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

                        //Selecionar todos as doações da tabela
                        $result_doacao = "SELECT * FROM doacao INNER JOIN animais ON doacao.ID_animal_FK = animais.ID_animal 
                                                                INNER JOIN usuarios ON doacao.ID_usuario_FK = usuarios.id_user 
                                                                WHERE doacao.atividade_doacao = 'ativo' ";
                            if(!empty($_GET['especie_animal'])){
                                $especie = $_GET['especie_animal'];
                                $result_doacao .= "AND animais.especie_animal ='$especie' ";
                            }
                            
                            if(is_numeric($_GET['vacina_animal'])){
                                $vacinacao = $_GET['vacina_animal'];
                                $result_doacao .= "AND animais.vacina_animal ='$vacinacao' ";
                            }

                            if(!empty($_GET['sexo_animal'])){
                                $sexo = $_GET['sexo_animal'];
                                $result_doacao .= "AND animais.sexo_animal ='$sexo' ";
                            }

                            if(is_numeric($_GET['castra_animal'])){
                                $raca = $_GET['castra_animal'];
                                $result_doacao .= "AND animais.castra_animal ='$raca' ";
                            }

                            if(!empty($_GET['estado_user'])){
                                $estado = $_GET['estado_user'];
                                $result_doacao .= "AND usuarios.estado_user ='$estado' ";
                            }

                            if(!empty($_GET['idade_animal'])){
                                $idade = $_GET['idade_animal'];
                                $result_doacao .= "AND animais.idade_animal ='$idade' ";
                            }

                            if((!empty($_GET['cidade_user'])) && ($_GET['cidade_user'] != "Especifique a Cidade")){
                                //if ($_GET['cidade_user'] == "Especifique a Cidade"){
                                  //  $_GET['cidade_user'] = "";
                               // }
                                $cidade = $_GET['cidade_user'];
                                $result_doacao .= "AND usuarios.cidade_user ='$cidade' ";
                            }

                            if(!empty($_GET['data_doacao'])){
                                $data = $_GET['data_doacao'];
                                $result_doacao .= "ORDER BY doacao.ID_doacao {$data} LIMIT {$inicio}, {$quantidade_pg} ";
                            }
                        $resultado_doacao = mysqli_query($conexao, $result_doacao);

                        //Contar o total de doações
                        $total_doacoes = mysqli_num_rows($resultado_doacao);


                        //calcular o número de paginas necessárias para apresentar os doações
                        $num_pagina = ceil($total_doacoes/$quantidade_pg);
                        filtro($conexao, $inicio, $quantidade_pg, $result_doacao, $total_doacoes);
                    }
                    else {
                        include "../include/conexao.php";
                        include "../_php-action/GerarAnunciosRecentes.php";
                        //Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
                        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
                        //Selecionar todos as doações da tabela
                        $result_doacao = "SELECT * FROM doacao";
                        $resultado_doacao = mysqli_query($conexao, $result_doacao);
                        if(!$resultado_doacao){
                            echo "erro na query";
                        }
                        
                        //Contar o total de doações
                        $total_doacoes = mysqli_num_rows($resultado_doacao);

                        //Seta a quantidade de doações por pagina
                        $quantidade_pg = 15;

                        //calcular o número de paginas necessárias para apresentar os doações
                        $num_pagina = ceil($total_doacoes/$quantidade_pg);

                        //Calcular o inicio da visualizacao
                        $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;
                        gerarAnuncios($conexao, $inicio, $quantidade_pg);
                    }
                  
                    //Verificar a pagina anterior e posterior
                  $pagina_anterior = $pagina - 1;
                  $pagina_posterior = $pagina + 1;
                ?>
            </div>

            <!-- Paginação -->
            <nav id="navegacao-cards">
              <ul class="pagination justify-content-center">
                <li class="page-item">
                  <?php
                    if($pagina_anterior != 0){ ?>
                      <a href="anuncios_recentes3.php?pagina=<?php echo $pagina_anterior; ?>" class="page-link" aria-label="Previous">
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
                        <li><a href="anuncios_recentes3.php?pagina=<?php echo $i; ?>" class="page-link page-active"><?php echo $i; ?></a></li>
                    <?php else: ?>
                        <li><a href="anuncios_recentes3.php?pagina=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                    <?php endif;?>
                <?php } ?>
                <li>
                  <?php
                    if($pagina_posterior <= $num_pagina){ ?>
                      <li class="page-item">
                        <a class="page-link" href="anuncios_recentes3.php?pagina=<?php echo $pagina_posterior; ?>">Próximo</a>
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
        </section>
    </main>

    <!-- Include do Rodapé -->
    <footer class="rodapé" style="display: none;">
        <div id="container-rodape">
            <div>
                <a href="../templates/home.php"><img src="../images/logotipo-final.png" style="width: 150px;"></a>
            </div>
            <ul>
                <li><a href="../templates/home.php">Home</a></li>
                <li><a href="../templates/anuncios_recentes3.php">Anúncios Recentes</a></li>
                <li><a href="../templates/sobre_nos.php">Sobre Nós</a></li>
            </ul>
            <ul>
                <li><a onclick="mostrarTelaLogin()" style="cursor: pointer;">Login</a></li>
                <li><a href="../templates/cadastro_doador.php">Cadastro</a></li>
                <li><a href="../templates/cadastro_animal.php">Cadastrar Pet</a></li>
            </ul>
        </div>
        <p>Copyright © 2021-<span id="ano-atual"></span> Alguns direitos reservados. LTDA</p>
    </footer>

    <!-- Links de Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script src="../_jquery/jquery-3.6.0.js"></script>
    <script src="../_javascript/anuncios_recentes23.js"></script>
    <script src="../_javascript/cidades1.js"></script>
</body>
</html>