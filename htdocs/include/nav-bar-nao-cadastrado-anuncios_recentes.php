<script src="../_jquery/jquery-3.6.0.js"></script>

<nav class="navbar navbar-expand-sm navbar-dark nav-main sticky-top" style="display: none;">
      <div class="container-fluid" style="margin-top: 0px;">
          <a class="navbar-brand" href="home.php"><img src="../images/logotipo-final.png" alt="LOGO" style="width: 150px;"></a>
          <button id="btn-mobile" class="navbar-toggler border-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon text-light"></span>
          </button>
          <div class="collapse titulo navbar-collapse" id="navbarSupportedContent">
              
              <!-- Aqui estão os botões de cadastrar e de logar -->
              <ul class="navbar-nav ml-auto" style="margin-bottom: 0; display: flex;">
                  <li class="nav-item mr-1" style="list-style-type: none;">
                        <a href="../templates/anuncios_recentes3.php" class="btn btn-primary titulo" style="width: 131.6px; height: 54px; padding-top: 14px">VER ANIMAIS</a>
                  </li>
                  <div class="divider" style="height: .25rem"></div>
                  <li class="nav-item mr-1" style="list-style-type: none">
                        <a class="btn btn-success titulo" onclick="mostrarTelaLogin()" style="height: 54px; padding-top: 14px">FAZER LOGIN</a>
                  </li>
                  <div class="divider" style="height: .25rem"></div>
                  <li class="nav-item" style="list-style-type: none;">
                        <a href="../templates/cadastro_doador.php" class="btn btn-outline-light titulo" style="width: 131.6px;height: 54px; padding-top: 14px">CADASTRAR</a>
                  </li>
              </ul>
          </div>
      </div>
</nav>
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