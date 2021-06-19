<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Doador</title>
    <!-- Importando fontes -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat|Fredoka%20One">    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/estilos_global.css">
    <link rel="stylesheet" href="../_css/cadastro_doador4.css">
    <link rel="stylesheet" href="../_css/tela_login20.css">

    <!-- Ícone da guia -->
    <link rel="shortcut icon" href="../images/icon-guia.png" type="image/png">
</head>
<body>
    <?php
        include_once '../include/nav-bar-nao-cadastrado.php';
        //include_once '../_php-action/CadastroUser.php';
    ?>
    <?php
        include_once "../include/tela_login.php";
    ?>
    <br>
    <main>
        <section>
            <!-- Alterar a action -->
            <form action="../_php-action/CadastroUser.php" method="post" enctype="multipart/form-data">
                <center><h1 class="titulo">Cadastro de Doador</h1></center>
                                        
             <!--Os dois alerts para erro e sucesso no cadastro-->  
            <!--<div class="alert alert-success" role="alert">
                Cadastro concluído com sucesso 
            </div>-->   
                <?php
                    if(isset($_GET["mensagem"])){
                        echo $_GET["mensagem"];
                        //unset($_SESSION["mensagem"]);
                    }    
                ?>
                <br>
                <div class="form-group">
                    <div class="icon">
                        <div class="embed-responsive embed-responsive-1by1">
                            <center>
                                <img src="../images/dog2-user.jpg" class="portrait" id="portrait">
                                <input type="hidden" id="input-portrait" name="img_user">
                            </center>
                        </div>
                        <!-- edit button -->
                        <input type="checkbox" id="show-images" onclick="show_images()">
                        <label for="show-images">
                            <img src="../images/add-user.png"></img>
                        </label>
                    </div>
                    <div class="pre-images-inactive" id="pre-images">
                        <h5 class="titulo pre-images-title">Escolha uma imagem</h5>
                        <span class="float-right" onclick="close_images()"></span>
                        
                        <br>
                        
                        <h6 class="titulo">Cachorros</h6>

                        <center>
                            <ul>
                                <li><img src="../images/dog-user.jpg" id="icone1" onclick="display_image(this.id)"></li>
                                <li><img src="../images/dog2-user.jpg" id="icone2" onclick="display_image(this.id)"></li>
                                <li><img src="../images/dog3-user.jpg" id="icone3" onclick="display_image(this.id)"></li>
                            </ul>
                        </center>

                        <br>

                        <h6 class="titulo">Gatos</h6>
                        <center>
                            <ul>
                                <li><img src="../images/gato-user.jpg" id="icone4" onclick="display_image(this.id)"></li>
                                <li><img src="../images/gato2-user.jpg" id="icone5" onclick="display_image(this.id)"></li>
                                <li><img src="../images/gato3-user.jpg" id="icone6" onclick="display_image(this.id)"></li>
                            </ul>
                        </center>
                    </div>
                    
                </div>

                <div class="form-group">
                    <label for="nome_user">Nome:</label>
                    <input class="form-control" type="text" name="nome_user" placeholder="Insira seu nome" required><br>
                </div>

                <div class="form-group">
                    <label for="nascim_user">Nascimento:</label>
                    <input class="form-control" type="date" name="nascim_user" required><br>
                </div>
                
                <div class="form-group">
                    <label for="mail_user">E-Mail:</label>
                    <input class="form-control" type="email" name="mail_user" placeholder="Insira seu e-mail" required><br>
                </div>

                <div class="form-group">
                    <label for="senha_user">Senha:</label>
                    <input class="form-control" type="password" name="senha_user" placeholder="Insira sua senha" required><br>
                </div>

                <div class="form-group">
                    <label for="confirma_senha">Confirmar Senha:</label>
                    <input class="form-control" type="password" name="confirma_senha" placeholder="Confirme sua senha" required><br>
                </div>

                <div class="form-group">
                    <label for="telefon_user">Telefone:</label>
                    <input class="form-control" type="text" id="telefon_user" name="telefon_user" placeholder="(11) 11111-1111" required><br>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col col-first mb-1">
                            <label for="estado_user">UF:</label>
                            <select class="form-control" id="uf" name="estado_user" required onchange="buscaCidades(this.value)">
                                <option value="">Escolher</option>
                                <option value="Acre">AC</option>
                                <option value="Alagoas">AL</option>
                                <option value="Amapá">AP</option>
                                <option value="Amazonas">AM</option>
                                <option value="Bahia">BA</option>
                                <option value="Ceará">CE</option>
                                <option value="Espírito Santo">ES</option>
                                <option value="Goiás">GO</option>
                                <option value="Maranhão">MA</option>
                                <option value="Mato Grosso">MT</option>
                                <option value="Mato Grosso do Sul">MS</option>
                                <option value="Minas Gerais">MG</option>
                                <option value="Pará">PA</option>
                                <option value="Paraíba">PB</option>
                                <option value="Paraná">PR</option>
                                <option value="Pernambuco">PE</option>
                                <option value="Piauí">PI</option>
                                <option value="Rio de Janeiro">RJ</option>
                                <option value="Rio Grande do Norte">RN</option>
                                <option value="Rio Grande do Sul">RS</option>
                                <option value="Rondônia">RO</option>
                                <option value="Roraima">RR</option>
                                <option value="Santa Catarina">SC</option>
                                <option value="São Paulo">SP</option>
                                <option value="Sergipe">SE</option>
                                <option value="Tocantins">TO</option>
                                <option value="Distrito Federal">DF</option>
                            </select>
                        </div>

                        <div class="col mb-1">
                            <input type="hidden" value="" id="pre-cidade">
                            <label for="cidade_user">Cidade:</label>
                            <select class="form-control" id="cidade" disabled name="cidade_user" id="cidade">
                        
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col teste mb-1">
                            <label for="bairro_user">Bairro:</label>
                            <input class="form-control"type="text" name="bairro_user" placeholder="Insira o nome do seu bairro" required>
                        </div>

                        <div class="col teste mb-1">
                            <label for="rua_user">Rua:</label>
                            <input class="form-control"type="text" name="rua_user" placeholder="Insira o nome da sua rua" required>
                        </div>
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <center><input class="form-control btn btn-primary" type="submit" value="Cadastrar" name="cadastrar"></center>
                </div>
            </form>
        </section>
    </main>
    <br>
    <?php include_once '../include/footer.php' ?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    <!-- Máscara para telefone -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    
    <script type="text/javascript">
        $("#telefon_user").mask("(00) 00000-0000");
    </script>

    <script src="../_javascript/show_images1.js"></script>
    <script src="../_javascript/cidades1.js"></script>
    <script src="../_javascript/data_automatica_copyright.js"></script>
</body>
</html>