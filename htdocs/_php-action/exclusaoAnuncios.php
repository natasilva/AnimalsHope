<?php


        session_start(); //inicio a sessão
            include "../include/conexao.php";
            $doacao = $_GET['ID_doacao']; 
            $ID = $_SESSION['id_usuario']; 
            
            $sql3= "UPDATE doacao SET atividade_doacao = 'inativo' WHERE ID_doacao = $doacao";
            $query3 = mysqli_query($conexao, $sql3); 

            if($query3) {
                $sql4= "UPDATE ItemFavorito SET atividade = 'inativo' WHERE ItemDoacao_FK = $doacao";
                $query4 = mysqli_query($conexao, $sql4); 

                if(isset($_GET['botao1'])){
                    header("Location: http://animalshope.epizy.com/templates/anuncios_recentes3.php");
                }
                if(isset($_GET['botao3'])){
                    header("Location: http://animalshope.epizy.com/templates/meus_anuncios.php");
                }
            } 
            else {
                echo "erro na query";
            }


?>
