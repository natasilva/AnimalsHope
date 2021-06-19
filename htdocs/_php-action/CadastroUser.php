<?php

    include_once('../include/conexao.php');
    session_start();

        $nome =  filter_input (INPUT_POST, "nome_user" , FILTER_SANITIZE_STRING);
        $telefone = filter_input (INPUT_POST, "telefon_user" , FILTER_SANITIZE_STRING);
        $rua = filter_input (INPUT_POST, "rua_user" , FILTER_SANITIZE_STRING);
        $estado = filter_input (INPUT_POST, "estado_user" , FILTER_SANITIZE_STRING);
        $bairro = filter_input (INPUT_POST, "bairro_user" , FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "mail_user", FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha_user']; 
        $confirma_senha = $_POST['confirma_senha']; 
        $cidade = filter_input(INPUT_POST, "cidade_user" , FILTER_SANITIZE_STRING);
        $nascimento1 = $_POST['nascim_user'];
        $nascimento = implode("-",array_reverse(explode("/",$nascimento1))); //data de nascimento no formato do banco de dados
        $img = $_POST['img_user'];

        if (empty($nome) || empty($img) || empty($telefone) || empty($rua)|| empty($estado)|| empty($bairro)|| empty($email)|| empty($senha)|| empty($confirma_senha)|| empty($cidade) || empty($nascimento1)) {
            $mensagem = '<div class="alert alert-danger" role="alert">Preencha todos campos!</div>';
            header('Location: http://animalshope.epizy.com/templates/cadastro_doador.php?mensagem='.$mensagem);
            //$mensagem = '<div class="alert alert-danger" role="alert">Esse email já foi cadastrado!</div>'; //colocar aqui uma notificação com css
            exit();
        }

        $verificaemail = "SELECT * FROM usuarios WHERE email_user = '$email'";
        $executaemail = mysqli_query($conexao, $verificaemail);
        $rowemail = mysqli_num_rows($executaemail); //números de registros com o email == $email

        if ($rowemail >= 1) {
            $mensagem = '<div class="alert alert-danger" role="alert">Esse email já foi cadastrado!</div>';
            header('Location: http://animalshope.epizy.com/templates/cadastro_doador.php?mensagem='.$mensagem);
            //$mensagem = '<div class="alert alert-danger" role="alert">Esse email já foi cadastrado!</div>'; //colocar aqui uma notificação com css
            exit();
        }
        
        else if ($confirma_senha != $senha) {
            $mensagem = '<div class="alert alert-danger" role="alert">As senhas não conferem!</div>';
            header('Location: http://animalshope.epizy.com/templates/cadastro_doador.php?mensagem='.$mensagem);
            //echo '<div class="alert alert-danger" role="alert">As senhas não conferem!</div>';
            exit();
        }
        else {
            if($email == 'admin@hotmail.com' && $senha == 'admin'){
                $_SESSION['admin'] = true;
            }
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT); 
            $sql = "INSERT INTO usuarios (nome_user, tel_user, bairro_user, rua_user, email_user, estado_user, senha_user, cidade_user, data_user, img_user) 
                    VALUES ('$nome', '$telefone', '$bairro', '$rua', '$email', '$estado', '$senhaHash', '$cidade', '$nascimento', '$img')";
            $query = mysqli_query($conexao, $sql); //registra o usuário no banco

            $sql2 = "SELECT * FROM usuarios WHERE nome_user = '$nome' and tel_user = '$telefone' and bairro_user = '$bairro' and rua_user = '$rua' 
                     and email_user = '$email' and estado_user = '$estado' and senha_user = '$senhaHash' and cidade_user = '$cidade' and data_user = '$nascimento' and img_user = '$img'";

            echo $sql2;

            $query2 = mysqli_query($conexao, $sql2);
            $resultado = mysqli_fetch_assoc($query2); //dados do usuário registrado
            $UserID  = $resultado['id_user'];
            

            if ($query) {
                $sql1 = "INSERT INTO favorito (UserFav_FK, total_favs) VALUES ($UserID, 0)";
                $query1 = mysqli_query($conexao, $sql1);
                
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $resultado['id_user'];
                    if($query1){
                        $mensagem = '<div class="alert alert-success" role="alert">O usuário foi cadastrado com sucesso!</div>';
                        header('Location: http://animalshope.epizy.com/templates/anuncios_recentes3.php?mensagem='.$mensagem);
                        exit();
                    }
                    else {
                        $mensagem = '<div class="alert alert-danger" role="alert">Erro na query!</div>';
                        header('Location: http://animalshope.epizy.com/templates/cadastro_doador.php?mensagem='.$mensagem);
                        exit();
                    }   
            }
        }
    
    mysqli_close($conexao);
    
?>