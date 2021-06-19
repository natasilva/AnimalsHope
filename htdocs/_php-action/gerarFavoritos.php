<?php
    
        function meusFavoritos($conexao, $inicio, $quantidade_pg){
            session_start(); //inicio a sessão
            $ID = $_SESSION['id_usuario']; // ID de quem está logado
            $sql = "SELECT * FROM ItemFavorito WHERE ItemFavorito_FK = '$ID' AND atividade = 'ativo' ORDER BY ID_item DESC LIMIT $inicio, $quantidade_pg"; 
            $query = mysqli_query($conexao, $sql);
            if(!$query){
                exit ("<div class='alert alert-danger'>Erro na query!</div>");
            }
            $rows = mysqli_num_rows($query); //número de doações que o usuário favoritou
            if($rows <= 0){ //verifico se existe alguma doação
                exit ("<div class='alert alert-danger'>Nenhuma doação favoritada!</div><br>");
                }
            else {
                while ($resultado = mysqli_fetch_assoc($query)){
                        $ItemDoacao = $resultado['ItemDoacao_FK']; 
                        $sql1 = "SELECT * FROM doacao WHERE ID_doacao = '$ItemDoacao' and atividade_doacao = 'ativo'"; //selecionamos todas doações favoritadas por quem está logado
                        $query1 = mysqli_query($conexao, $sql1);
                        
                        while ($dados = mysqli_fetch_assoc($query1)){ 
                            $UserID = $dados ["ID_usuario_FK"]; // ID do usuário que fez a doação
                            $AnimalID = $dados ["ID_animal_FK"]; // ID do animal
                            $DoacaoID = $dados ["ID_doacao"]; //ID da doação
                            $sql2 = "SELECT * FROM usuarios WHERE id_user = '$UserID'"; 
                            $query2 = mysqli_query($conexao, $sql2); 
                            $resulado2 = mysqli_fetch_assoc($query2); //selecionamos todos dados do doador
                            
                            $sql3 = "SELECT * FROM animais WHERE ID_animal = '$AnimalID'"; 
                            $query3 = mysqli_query($conexao, $sql3); 
                            $resultado3 = mysqli_fetch_assoc($query3);
                            //selecionamos todos dados do animal doado
                        ?>             
                                <!-- Aqui criaremos o layout de cada post ao ser exibido na tela de lista de desejos -->
                                <link rel="stylesheet" type="text/css" href="../_css/css_favoritos/style.css">


                                
                            

                                <div class="anuncio">
                                    <div class="botoes">
                                      <a href ="http://animalshope.epizy.com/_php-action/ExclusãoDeFavoritos.php?ID_doacao=<?php echo $DoacaoID; ?> "<span class="btn-deletar"></span> </a>
                                    </div>
                                    
                                    <div class="imagem">
                                        <img class="tamanho" src="../images/<?php echo $resultado3['img_animal']; ?> " alt="" />
                                    </div>

                                    <div class="descricao">
                                        <span> <?php echo $resultado3['nome_animais']; if ($resultado3['sexo_animal'] == "macho") {echo " <img src='../images/sexo-masc.png' class='img-masc justify-content-end'>";} else {echo " <img src='../images/sexo-fem.png' class='img-fem'>";}?> </span>
                                        <span> <?php echo mb_strimwidth($resultado3['descri_animal'], 0, 50, "..."); ?> </span>                                       
                                        

                                    </div>

                                        <div class="btn_visitar">
                                            <div class="box">
                                                <a href='anuncio.php?doacao_id=<?php echo $DoacaoID; ?>' class="btn btn-white btn-animation-1">VISITAR</a> 
                                            </div>
                                        </div>  
                                </div>    
                            
        <?php } } } }  ?>  <!-- fechando a function, o else e os whiles -->







