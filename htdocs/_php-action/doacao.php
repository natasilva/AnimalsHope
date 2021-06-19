<?php
    session_start();
        include "../include/conexao.php";
    
        $data1 = date('d/m/Y');
        $data = implode("-",array_reverse(explode("/",$data1)));
        $nome = filter_input (INPUT_POST, "apelido_animal" , FILTER_SANITIZE_STRING);
        $sexo = filter_input (INPUT_POST, "sexo_animal" , FILTER_SANITIZE_STRING);
        $especie = filter_input (INPUT_POST, "especie_animal" , FILTER_SANITIZE_STRING);
        $descricao = filter_input (INPUT_POST, "descri_animal" , FILTER_SANITIZE_STRING);
        $castra = filter_input (INPUT_POST, "castra_animal" , FILTER_SANITIZE_STRING);
        $raca = filter_input (INPUT_POST, "raça_animal" , FILTER_SANITIZE_STRING);
        $vacina = $_POST['vacina_animal'];
        $fase = $_POST['fase_animal'];

        // Pegando dados da Imagem
        include_once "../include/upload_image.php";
        $img = $imagem; 

        //registra os dados do animal
        $sql1 = "INSERT INTO animais (nome_animais, sexo_animal, especie_animal, descri_animal, castra_animal, img_animal, 
        vacina_animal, raca_animal, idade_animal) VALUES ('$nome', '$sexo', '$especie', '$descricao', '$castra', '$img', '$vacina', '$raca', '$fase')";           

        if (mysqli_query($conexao, $sql1)) {
            //seleciona o ID do animal
            $sql2 = "SELECT ID_animal FROM animais WHERE nome_animais = '$nome' and sexo_animal = '$sexo' and 
            especie_animal = '$especie' and descri_animal = '$descricao' and castra_animal = '$castra' and img_animal = '$img' and 
            vacina_animal = '$vacina' and raca_animal = '$raca' and idade_animal = '$fase'";
            if(mysqli_query($conexao, $sql2)){
                $resultado = mysqli_fetch_assoc(mysqli_query($conexao, $sql2));
                $AnimalID = $resultado['ID_animal']; //ID do animal doado       
                $UserID = $_SESSION['id_usuario'];// ID do doador
                //registra os dados da doação
                $sql4 = "INSERT INTO doacao (data_doacao, ID_animal_FK, ID_usuario_FK) VALUES ('$data', '$AnimalID', '$UserID')";

                if(mysqli_query($conexao, $sql4)){
                    $mensagem = '<div class="alert alert-success" role="alert">Dados salvos com sucesso!!</div>';
                    header('Location: http://animalshope.epizy.com/templates/anuncios_recentes3.php?mensagem='.$mensagem);
                    exit();
                }
                else {
                    $mensagem = '<div class="alert alert-danger" role="alert">Erro na doação!!</div>';
                    header('Location: http://animalshope.epizy.com/templates/cadastro_animal.php?mensagem='.$mensagem);
                    exit();
                }    
            }   
            else {
                $mensagem = '<div class="alert alert-success" role="alert">Erro na doação!!</div>';
                header('Location: http://animalshope.epizy.com/templates/cadastro_animal.php?mensagem='.$mensagem);
                exit();
            }
        }
        else {
            $mensagem = '<div class="alert alert-success" role="alert">Erro na doação!!</div>';
            header('Location: http://animalshope.epizy.com/templates/cadastro_animal.php?mensagem='.$mensagem);
            exit();
        }

        mysqli_close($conexao);