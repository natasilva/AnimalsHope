<?php
    session_start();
            include "../include/conexao.php";
            //campos possiveis de alteração
            $apelido =  filter_input (INPUT_POST, "apelido" , FILTER_SANITIZE_STRING);
            $sexo = $_POST['sexo_animal'];
            $especie = $_POST['especie_animal'];
            $raca = $_POST['raca_animal'];
            $fase = $_POST['fase_animal'];
            $vacina = $_POST['vacina_animal'];
            $castra = $_POST['castra_animal'];    
            //$img = $_POST['img'];
            $descricao = filter_input (INPUT_POST, "descri_animal" , FILTER_SANITIZE_STRING);
            // Pegando dados da Imagem
            include_once "../include/upload_image.php";
            $img = $imagem; 

            //coloco em uma variável o ID do usuário logado
            $UserID = 1; //$_SESSION['id_usuario'];
            $DoacaoID = $_GET['doacao_id'];

            if(empty($img)){
                $sql1 = "SELECT * FROM doacao WHERE ID_doacao = {$DoacaoID}";
                $query1 = mysqli_query($conexao, $sql1);
                $resultado1 = mysqli_fetch_assoc($query1);
                $animalID = $resultado1['ID_animal_FK'];

                $sql2 = "SELECT * FROM animais WHERE ID_animal = {$animalID} "; 
                $query2 = mysqli_query($conexao, $sql2);
                $resultado2 = mysqli_fetch_assoc($query2);
                $img = $resultado2['img_animal'];
            }

            //verifica se tem algum campo vazio
            /*if(empty($apelido)||empty($sexo)||empty($especie)||empty($raca)||empty($fase)||empty($descricao)||(empty($castra)||empty($img)||empty($vacina)){
                $mensagem = '<div class="alert alert-danger" role="alert">Preencha todos campos!</div>';
                header('Location: http://animalshope.epizy.com/templates/edit_animal.php?doacao_id='.$DoacaoID.'&mensagem='.$mensagem.$apelido.$sexo.$especie.$raca.$fase.$vacina.$castra.$img.$descricao);
                exit();
            }*/
            //else {
                    //realiza a alteração no database
                    $query = "UPDATE animais INNER JOIN doacao SET nome_animais = '$apelido', sexo_animal = '$sexo', especie_animal = '$especie', raca_animal = '$raca', idade_animal = '$fase', vacina_animal = '$vacina', castra_animal = '$castra', img_animal = '$img', descri_animal = '$descricao' WHERE animais.ID_animal = doacao.ID_animal_FK AND doacao.atividade_doacao = 'ativo' AND doacao.ID_doacao = '$DoacaoID'";

                    echo $query;
                    //verifica se a alteração foi bem sucedida
                    if (mysqli_query($conexao, $query)) {
                        $mensagem = '<div class="alert alert-success" role="alert">Alterações realizadas com sucesso!!</div>';
                        header('Location: http://animalshope.epizy.com/templates/edit_animal.php?doacao_id='.$DoacaoID.'&mensagem='.$mensagem);
                        exit();
                    } 
                    else {
                        $mensagem = $query;//'<div class="alert alert-danger" role="alert">Falha na alteração!</div>';
                        header('Location: http://animalshope.epizy.com/templates/edit_animal.php?doacao_id='.$DoacaoID.'&mensagem='.$mensagem);
                        exit();
                    }           
            //}
                mysqli_close($conexao);
        
