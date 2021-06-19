<?php


    //function ExcluirFavorito($conexao){
        session_start(); //inicio a sessão
            include "../include/conexao.php";
            $doacao = $_GET['ID_doacao']; 
            $ID = $_SESSION['id_usuario']; 

            $sql3= "UPDATE ItemFavorito SET atividade = 'inativo' WHERE ItemDoacao_FK = $doacao AND ItemFavorito_FK = $ID";
            $query3 = mysqli_query($conexao, $sql3); 

            if($query3) {
                header("Location: http://animalshope.epizy.com/templates/favoritos.php");
            } 
            
     //}

     //tenho que corrigir ainda

?>
