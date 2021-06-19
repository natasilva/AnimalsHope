<?php
  include('../include/conexao.php');
      session_start();
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL); //email do usuario filtrado
        $senha = $_POST["senha"]; //password_hash($_POST['senha'], PASSWORD_DEFAULT);  //senha do usuário criptografada
        
        if(empty($email) or empty($senha)){ //verifica se os campos de email e senha estão vazios
          $mensagem = '<div class="alert alert-danger" role="alert">Todos campos precisam ser preenchidos!</div>';
          header('Location: http://animalshope.epizy.com/templates/home.php?mensagem='.$mensagem);
          //$mensagem = '<div class="alert alert-danger" role="alert">Esse email já foi cadastrado!</div>'; //colocar aqui uma notificação com css
          exit();
        }
        else{
          if($email == 'admin@hotmail.com' && $senha == 'admin'){
              $_SESSION['admin'] = true;
          }
          $sql = "SELECT * FROM usuarios WHERE email_user = '{$email}'"; 
          $resultado = mysqli_query($conexao, $sql);
          $dados = mysqli_fetch_assoc($resultado);

          if(mysqli_num_rows($resultado) > 0){ //verifica se existe alguma conta com o email inserido
            if($dados){
              if(password_verify($senha, $dados['senha_user'])) { //compara a senha informada com a senha do banco de dados
                if(!empty($_POST["remember"])){
                  setcookie ("user_login",$dados['email_user'],time()+ (30 * 24 * 60 * 60));
                  setcookie ("user_password",$dados['senha_user'],time()+ (30 * 24 * 60 * 60));
                }
                else {
                  if(isset($_COOKIE["user_login"])){  
                    setcookie ("user_login","");  
                  }
                  if(isset($_COOKIE["user_password"])){  
                    setcookie ("user_password","");  
                  }
                }
                $_SESSION['logado'] = true; //estabelece que o usuário está logado
                $_SESSION['id_usuario'] = $dados['id_user']; //registra o ID do usuário que está logado
                header('location: ../templates/anuncios_recentes3.php'); //envia ele para a home 
                exit();
              } 
              else {
                $mensagem = '<div class="alert alert-danger" role="alert">Senha inválida!</div>';
                // $_SESSION['mensagem'] = "<div class='alert alert-danger' role='alert' style='position: fixed; top: 50%; background-color: #F8D7DA;'>Senha inválida!</div>";
                $_SESSION['mensagem'] = "<div class='alert alert-danger' role='alert'>Senha inválida!</div>";
                header('Location: http://animalshope.epizy.com/templates/home.php');
                exit();
              } 
            }
            else {
              $_SESSION['mensagem'] = "<div class='alert alert-danger' role='alert' style='position: fixed; top: 50%; background-color: #F8D7DA;'>Falha na consulta!</div>";
              header('Location: http://animalshope.epizy.com/templates/home.php');
              exit();
            }
          }
          else {
            //    $_SESSION['mensagem'] = "<div class='alert alert-danger' role='alert' style='position: fixed; top: 45%; left: 45%; background-color: #F8D7DA;'>Email Inexistente</div>";
                $_SESSION['mensagem'] = "<div class='alert alert-danger' role='alert'>Email Inexistente</div>";
               header('Location: http://animalshope.epizy.com/templates/home.php');
               exit();
              
          }
        }

        mysqli_close($conexao);
?>
  