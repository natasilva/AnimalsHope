<?php
    session_start();
            include "../include/conexao.php";
            //campos possiveis de alteração
            $_nome =  filter_input (INPUT_POST, "nome" , FILTER_SANITIZE_STRING);
            $_tel = filter_input (INPUT_POST, "telefon" , FILTER_SANITIZE_STRING);
            $_rua = filter_input (INPUT_POST, "rua" , FILTER_SANITIZE_STRING);
            $_data = filter_input (INPUT_POST, "data" , FILTER_SANITIZE_STRING);
            $_cidade = $_POST['cidade'];
            $_estado = $_POST['estado'];
            $_bairro = filter_input (INPUT_POST, "bairro" , FILTER_SANITIZE_STRING);
            $_email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

            //coloco em uma variável o ID do usuário logado
            $_UserID = 1; //$_SESSION['id_usuario'];

            //verifica se tem algum campo vazio
            if(empty($_nome)||empty($_tel)||empty($_rua)||empty($_data)||empty($_cidade)||empty($_estado)||empty($_bairro)||empty($_email)){
                $mensagem = '<div class="alert alert-danger" role="alert">Preencha todos campos!</div>';
                header('Location: http://animalshope.epizy.com/templates/seus_dados.php?mensagem='.$mensagem);
                exit();
            }
            else {
                //verifica se o número de telefone digitado é válido
                if ((strlen($_tel)<=15) && preg_match("/\(?\d{2}\)?\s?\d{5}\-?\d{4}/", $_tel)){
                    //realiza a alteração no database

                    $query = "UPDATE usuarios SET email_user = '$_email', nome_user = '$_nome', tel_user = '$_tel', rua_user = '$_rua', data_user = '$_data', 
                    cidade_user = '$_cidade', estado_user = '$_estado', bairro_user = '$_bairro' WHERE id_user = '$_UserID'";
                    
                    //verifica se a alteração foi bem sucedida
                    if (mysqli_query($conexao, $query)) {
                        $mensagem = '<div class="alert alert-success" role="alert">Dados salvos com sucesso!!</div>';
                        header('Location: http://animalshope.epizy.com/templates/seus_dados.php?mensagem='.$mensagem);
                        exit();
                    } 
                    else {
                        $mensagem = '<div class="alert alert-danger" role="alert">Falha ao salvar os dados!</div>';
                        header('Location: http://animalshope.epizy.com/templates/seus_dados.php?mensagem='.$mensagem);
                        exit();
                    }           
                }
                else{
                    $mensagem = '<div class="alert alert-danger" role="alert">Número de telefone inválido!!</div>';
                    header('Location: http://animalshope.epizy.com/templates/seus_dados.php?mensagem='.$mensagem);
                    exit();
                }
            }
                mysqli_close($conexao);
        
