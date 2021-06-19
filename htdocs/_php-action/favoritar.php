<?php 

    include "../include/conexao.php";
    session_start(); //inicio a sessão
    //$_SESSION['logado'] = true; //depois tirar isso
        //function favoritar($conexao, $DoacaoID){ //$DoacaoID = doacao ['ID_doacao']
            if(isset($_SESSION['logado'])){
                $DoacaoID = $_GET['doacaoID'];
                $ID = $_SESSION['id_usuario']; //ID de quem está logado
                $sql = "SELECT * FROM ItemFavorito WHERE ItemDoacao_FK = $DoacaoID AND ItemFavorito_FK = $ID"; 
                $query = mysqli_query($conexao, $sql);
                $resultado = mysqli_fetch_assoc($query);
                $rows = mysqli_num_rows($query); //registra a quantidade de vezes que esse anuncio foi favoritado
                echo $sql;
                if($rows <= 0){ //Se ele ainda não foi favoritado
                    $sql1 = "INSERT INTO ItemFavorito (ItemDoacao_FK, ItemFavorito_FK, atividade) VALUES ($DoacaoID, $ID, 'ativo')"; //registra como favoritado
                    $query1 = mysqli_query($conexao, $sql1);

                    if($query1){
                        //echo "Sucesso na query!";
                        if(isset($_GET['botao1'])){
                            header("Location: http://animalshope.epizy.com/templates/anuncios_recentes3.php");
                            exit();
                        }
                        if(isset($_GET['botao2'])){
                            header("Location: http://animalshope.epizy.com/templates/anuncio.php?doacao_id=".$DoacaoID);
                            exit();
                        }
                    }
                }

                else {
                    if($resultado['atividade'] != 'inativo'){
                        $sql3= "UPDATE ItemFavorito SET atividade = 'inativo' WHERE ItemDoacao_FK = $DoacaoID AND ItemFavorito_FK = $ID";
                        $query3 = mysqli_query($conexao, $sql3); //Se já estiver favoritado, marque o anuncio como inativo 
                        if($query3){
                            if(isset($_GET['botao1'])){
                                header("Location: http://animalshope.epizy.com/templates/anuncios_recentes3.php");
                                exit();
                            }
                            if(isset($_GET['botao2'])){
                                header("Location: http://animalshope.epizy.com/templates/anuncio.php?doacao_id=".$DoacaoID);
                                exit();
                            }
                        }
                    }
                    else {
                        $sql2= "UPDATE ItemFavorito SET atividade = 'ativo' WHERE ItemDoacao_FK = $DoacaoID AND ItemFavorito_FK = $ID";
                        $query2 = mysqli_query($conexao, $sql2); //Se já estiver como inativo, marque o anuncio como ativo   
                        if($query2){
                            if(isset($_GET['botao1'])){
                                header("Location: http://animalshope.epizy.com/templates/anuncios_recentes3.php");
                                exit();
                            }
                            if(isset($_GET['botao2'])){
                                header("Location: http://animalshope.epizy.com/templates/anuncio.php?doacao_id=".$DoacaoID);
                                exit();
                            }
                        }          
                    }
                }
               
            }
            else {
                    header("Location: http://animalshope.epizy.com/templates/home.php");
                    exit();
                
            }

        
         mysqli_close($conexao);
    
    //favoritar($conexao, $DoacaoID);
    //echo "<script>javascript:history.go(-1)'</script>";
?>