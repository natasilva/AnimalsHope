<?php
    session_start();

    if(!$_SESSION["logado"]) {
        header("location: home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
    <!-- Importando fontes -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat|Fredoka%20One">    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/estilos_global.css">
    <link rel="stylesheet" href="../_css/edit_animal1.css">
    <link rel="stylesheet" href="../_css/botao-laranja1.css">

    <!-- Ícone da guia -->
    <link rel="shortcut icon" href="../images/icon-guia.png" type="image/png">
</head>
<body>
    <?php
        include_once '../include/nav-bar-cadastrado.php';
        include "../include/conexao.php";

        $DoacaoID = $_GET['doacao_id'];
        $sql = "SELECT * FROM doacao WHERE ID_doacao = {$DoacaoID}";
        $query = mysqli_query($conexao, $sql);
        $resultado = mysqli_fetch_assoc($query);
        $animalID = $resultado['ID_animal_FK'];

        $sql1 = "SELECT * FROM animais WHERE ID_animal = $animalID "; 
        $query1 = mysqli_query($conexao, $sql1);
        $resultado1 = mysqli_fetch_assoc($query1);
    ?>
    <br>
    <main>
    <section>
        <!-- Alterar a action -->
        <form action="http://animalshope.epizy.com/_php-action/editarAnuncio.php?doacao_id=<?php echo $DoacaoID; ?>" method="post" enctype="multipart/form-data">
            <center><h1 class="titulo">Dê uma nova casa para o seu pet!</h1></center>

            <br><br>
                <div class="form-group">
                    <img src="../images/<?php echo $resultado1['img_animal']; ?>" class="d-block w-100 img" id="img" alt="...">
                    <br>
                    <label for="imagem" class="btn-select-image btn btn-outline-orange titulo">
                        <p>Selecionar imagem</p>
                        <!-- Para permitir o upload de multiplos arquivos é necessário colocar o parâmetro multiple no input file ex: <input type="file" multiple> -->
                        <input type="file" name="imagem[]" id="imagem" onchange="previewImage()">
                    </label>  
                </div>
            </div>
            <br>

            <div class="form-group">
                <label for="apelido_animal">Apelido:</label>
                <input class="form-control" name= "apelido" value="<?php echo $resultado1['nome_animais']; ?>" type="text" name="apelido_animal" placeholder="Insira o apelido do animal" required><br>
            </div>

            <div class="form-group">
                <label for="sexo_animal">Sexo: </label>
                <select class="form-control" name="sexo_animal" required>
                    <option value="macho" <?php if($resultado1['sexo_animal'] == "macho"){echo "selected";}?>>Macho</option>
                    <option value="femea" <?php if($resultado1['sexo_animal'] == "femea"){echo "selected";}?>>Fêmea</option>
                </select><br>
            </div>

            <div class="form-group">
                <label for="especie_animal">Especie:</label>
                <select class="form-control" id="especie_animal" name="especie_animal" required onchange="buscaRaca(this.value)">
                    <option value="Gato" <?php if($resultado1['especie_animal'] == "Gato"){echo "selected";}?>>Gato</option>
                    <option value="Cachorro" <?php if($resultado1['especie_animal'] == "Cachorro"){echo "selected";}?>>Cachorro</option>
                </select><br>
            </div>

            <div class="form-group">
                <label for="raça_animal">Raça:</label>
                <input type="hidden" id="pre-raca" value="<?php echo $resultado1['raca_animal']; ?>">
                <select class="form-control" name="raca_animal" id="raça_animal" required>
                    <option></option>
                </select><br>
            </div>

            <div class="form-group">
                <label for="fase_animal">Fase:</label>
                <select class="form-control" name="fase_animal" required>
                    <option value="filhote"<?php if($resultado1['idade_animal'] == "filhote"){echo "selected";}?>>Filhote</option>
                    <option value="juvenil"<?php if($resultado1['idade_animal'] == "juvenil"){echo "selected";}?>>Juvenil</option>
                    <option value="adulto"<?php if($resultado1['idade_animal'] == "adulto"){echo "selected";}?>>Adulto</option>
                    <option value="idoso"<?php if($resultado1['idade_animal'] == "idoso"){echo "selected";}?>>Idoso</option>
                </select><br>
            </div>

            <div class="form-group">
                <label for="descri_animal">Descrição:</label>
                <textarea class="form-control" name="descri_animal" id="" cols="30" rows="10" required placeholder="Conte um pouco sobre esse animal"><?php echo $resultado1['descri_animal']; ?></textarea><br>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" <?php if($resultado1['vacina_animal'] == 1){echo "checked";}?> type="checkbox" value="1" name="vacina_animal">
                    <label class="form-check-label" for="vacina_animal">Vacinado</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" <?php if($resultado1['castra_animal'] == 1){echo "checked";}?> type="checkbox" value="1" name="castra_animal">
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
                <center><input class="form-control btn btn-orange" type="submit" value="Salvar alterações"></center>
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
        var animal_especie = document.getElementById("especie_animal");
        window.onload = buscaRaca(animal_especie.value);
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