<div id="id01" class="modal-login" style="display: none;">
    <form class="modal-content animate" action="../_php-action/Login.php" method="post">
        <div class="imgcontainer">
            <span onclick="tirarTelaLogin()" class="close" title="Close Modal">&times;</span>
            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">
        </div>
        <div class="container">
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Insira seu email" name="email" maxlength="50" minlenght="10" required> <!--uname-->

            <label for="senha"><b>Senha</b></label>
            <input type="password" placeholder="Insira a sua senha" name="senha" required> <!--psw-->
            <label>
                <input type="checkbox" checked="checked" name="remember"> Lembrar-me
            </label>
                        
            <button type="submit" style="background-color: #059862;" class="btn_login">Login</button>
            <?php
                if(isset($_SESSION['mensagem'])){
                    echo $_SESSION["mensagem"];
                    unset($_SESSION["mensagem"]);
                }
            ?>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="tirarTelaLogin()" class="cancelbtn">Cancelar</button>
            <span class="psw">Ainda não têm uma conta? <a href="../templates/cadastro_doador.php">Cadastre-se</a></span>
        </div>
    </form>
</div>

<script>
    var modal_login = document.getElementById('id01');
    var body = document.getElementsByTagName('body')[0];
    var nav = document.getElementsByTagName('nav')[0];
    var btn_login = document.querySelector("button#button-login");
    var indicadores_carrossel = document.querySelector("ol.indicadores");
    var btn_topo = document.querySelector("div.voltar-ao-topo");

    function mostrarTelaLogin() {
        modal_login.style.display ="block";
        modal_login.style.overflow = "auto";
        body.style.overflow = "hidden";
        nav.style.display = "none";
        indicadores_carrossel.style.zIndex = "-1";
        btn_topo.style.display = "none";
    }
    function tirarTelaLogin() {
        modal_login.style.display = "none";
        body.style.overflow = "auto";
        nav.style.display = "inherit";
        indicadores_carrossel.style.zIndex = "1";
        btn_topo.style.display = "initial";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if(event.target == modal_login) {
            modal_login.style.display = "none";
            body.style.overflow = "auto";
            nav.style.display = "inherit";
            btn_topo.style.display = "initial";
            indicadores_carrossel.style.zIndex = "1";
        }
    }
</script>