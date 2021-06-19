<?php
    session_start();

    if(!$_SESSION["logado"]) {
       header("location: cadastro_doador.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Animal</title>
    <!-- Importando fontes -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat|Fredoka%20One">    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/botao-laranja1.css">
    <link rel="stylesheet" href="../_css/estilos_global.css">
    <link rel="stylesheet" href="../_css/cadastro_animal1.css">
</head>
<body>
    <?php
        include_once '../include/nav-bar-cadastrado.php';
    ?>
    <br>
    <main>
    <section>
        <!-- Alterar a action -->
        <form action="../_php-action/doacao.php" method="post" enctype="multipart/form-data">
            <center><h1 class="titulo">Dê uma nova casa para o seu pet!</h1></center>

            <br><br>
                <div class="form-group">
                    <img src="../images/plus-simbol.png" id="img" class="img d-block w-100" alt="...">

                    <br>
                    <label for="imagem" class="btn-select-image btn btn-outline-orange titulo">
                        <p>Selecionar imagem</p>
                        <!-- Para permitir o upload de multiplos arquivos é necessário colocar o parâmetro multiple no input file ex: <input type="file" multiple> -->
                        <input required type="file" name="imagem[]" id="imagem" onchange="previewImage()">
                    </label>  
                </div>
            </div>
            <br>

            <div class="form-group">
                <label for="apelido_animal">Apelido:</label>
                <input class="form-control" type="text" name="apelido_animal" placeholder="Insira o apelido do animal" required><br>
            </div>

            <div class="form-group">
                <label for="sexo_animal">Sexo:</label>
                <select class="form-control" name="sexo_animal" required>
                    <option value="">Escolher</option>
                    <option value="macho">Masculino</option>
                    <option value="femea">Feminino</option>
                </select><br>
            </div>

            <div class="form-group">
                <label for="especie_animal">Especie:</label>
                <select class="form-control" name="especie_animal" required onchange="buscaRaca(this.value)">
                    <option value="">Escolher</option>
                    <option value="Gato">Gato</option>
                    <option value="Cachorro">Cachorro</option>
                </select><br>
            </div>

            <div class="form-group">
                <label for="raça_animal">Raça:</label>
                <input type="hidden" id="pre-raca" value="">
                <select class="form-control" name="raça_animal" id="raça_animal" required disabled>

                </select><br>
            </div>

            <div class="form-group">
                <label for="fase_animal">Fase:</label>
                <select class="form-control" name="fase_animal" required>
                    <option value="">Escolher</option>
                    <option value="filhote">Filhote</option>
                    <option value="juvenil">Juvenil</option>
                    <option value="adulto">Adulto</option>
                    <option value="idoso">Idoso</option>
                </select><br>
            </div>

            <div class="form-group">
                <label for="descri_animal">Descrição:</label>
                <textarea class="form-control" name="descri_animal" id="" cols="30" rows="10" required placeholder="Conte um pouco sobre esse animal"></textarea><br>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="vacina_animal">
                    <label class="form-check-label" for="vacina_animal">Vacinado</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="castra_animal">
                    <label class="form-check-label" for="castra_animal">Castrado</label>
                </div>
            </div>

            <br>
                <?php
                    if(isset($_GET["mensagem"])){
                            echo $_GET["mensagem"];
                            //unset($_SESSION["mensagem"]);
                        } 
                ?>
            <div class="form-group">
                <center><input class="form-control btn btn-orange" type="submit" value="Cadastrar"></center>
            </div>
        </form>
    </section>
    </main>
    <br>
    <?php include_once '../include/footer.php' ?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    <script src="../_javascript/racas5.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../_javascript/data_automatica_copyright.js"></script>
    <script>
          function previewImage(){
            var images = document.querySelector('input[name="imagem[]"]').files;
            if(images.length > 1){
                for(var contador=0;contador < images.length;contador++){
                    var preview = document.querySelector('img#img');
                    var reader = new FileReader();

                    reader.onloadend = function (){
                        preview.src = reader.result;
                    }
                    if(image){
                        reader.readAsDataURL(image);
                    }else{
                        preview.src = "";
                    }
                    
                    document.write("<div>");
                }
            }else if(images.length == 1){
                image = images[0];
                var preview = document.querySelector('img#img');

                var reader = new FileReader();

                reader.onloadend = function (){
                    preview.src = reader.result;
                }
                if(image){
                    reader.readAsDataURL(image);
                }else{
                    preview.src = "";
                }
            }
          }
      </script>
</body>
</html>