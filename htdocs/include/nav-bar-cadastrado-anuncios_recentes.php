<script src="../_jquery/jquery-3.6.0.js"></script>
<?php
    session_start();
    require_once "../include/conexao.php";

    // Não sei onde está armazenando o ID do usuário logado
    $id_user = $_SESSION['id_usuario'];
    $select_NI = "SELECT nome_user, img_user FROM usuarios WHERE id_user = {$id_user}";
    $query_NI = mysqli_query($conexao, $select_NI);
    $user_dados = mysqli_fetch_assoc($query_NI);
?>
<nav class="navbar navbar-expand-lg navbar-dark nav-main sticky-top" style="display: none;">
      <div class="container-fluid" style="margin-top: 0px;">
          <a class="navbar-brand" href="home.php"><img src="../images/logotipo-final.png" alt="LOGO" style="width: 150px;"></a>
          <button id="btn-mobile" class="navbar-toggler border-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon text-light"></span>
          </button>
          <div class="collapse titulo navbar-collapse justify-content-between" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto mr-4" id="lista-perfil">
                  <li class="nav-item">
                    <a class="nav-link text-light mt-3 titulo" href="../templates/cadastro_animal.php">DOAR ANIMAIS</a>
                  </li>
                  <li class="nav-item" style="list-style-type: none; margin-top: 10px;">
                    <a href="../templates/anuncios_recentes3.php" class="nav-link text-light titulo" style="height: 54px; padding-top: 14px;">VER ANIMAIS</a>
                  </li>
                  <!--<li class="nav-item">
                    <a class="nav-link text-light mt-3 titulo" href="../templates/anuncios_recentes3.php">VER ANIMAIS</a>
                  </li>-->
                  <!-- Fazer com que o nome de usuário apareça no span abaixo -->
                  <li class="nav-item dropdown">
                      <a class="nav-link navbar-brand mt-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: flex;">
                          <button class="btn btn-outline-light">
                              <!-- A imagem e o username deve mudar de acordo com o usuário que está logado -->
                              <img src="../images/<?php echo $user_dados['img_user']?>" style="width: 40px; height: 40px; border-radius: 100%">
                              <span class="titulo"><?php echo mb_strimwidth($user_dados['nome_user'], 0, 13, "..."); ?></span>
                          </button>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-lg-left" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item titulo" href="../templates/meus_anuncios.php">MINHAS DOAÇÕES</a></li>
                          <li><a class="dropdown-item titulo" href="../templates/favoritos.php">MEUS FAVORITOS</a></li>
                          <li><a class="dropdown-item titulo" href="../templates/seus_dados.php">MEUS DADOS</a></li>
                          <li><hr class="dropdown-divider titulo"></li>
                          <li><a class="dropdown-item text-danger titulo" href="../_php-action/logout.php">SAIR DA CONTA</a></li>
                      </ul>
                  </li>
              </ul>
          </div>
      </div>
    </nav>
    <?php mysqli_close($conexao)?>
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

    <script>
        $(window).scroll(function() {
            //var pixels = document.querySelector("nav.nav-main").getBoundingClientRect()
            var valor_scroll = $(window).scrollTop()
            //var navegacao = document.querySelector("nav.nav-main")
            if(valor_scroll >= 3) {
                nav.classList.remove("sticky-top")
                nav.classList.add("fixed-top")
            } else if(valor_scroll < 3) {
                nav.classList.remove("fixed-top")
                nav.classList.add("sticky-top")
            } else {
                nav.classList.remove("fixed-top")
                nav.classList.add("sticky-top")
            }
        })
    </script>