<?php

function filtro($conexao, $inicio, $quantidade_pg, $result_doacao, $total_doacoes){
            $query = mysqli_query($conexao, $result_doacao);
            
            $total1 = $total_doacoes;
            
            if($total1 <= 0){
                echo "<div class='alert alert-danger'>Nenhuma publicação encontrada!</div>"; 
            }
            else {
        while($result1 = mysqli_fetch_assoc($query)) { 
            $animalID = $result1['ID_animal_FK'];
            $DoacaoID = $result1['ID_doacao'];
            $DoadorID = $result1['ID_usuario_FK'];
            $UserID = $_SESSION['id_usuario']; //ID de quem está logado

            $sql1 = "SELECT * FROM usuarios WHERE id_user = '$DoadorID'"; 
            $query1 = mysqli_query($conexao, $sql1); //selecionamos todos dados do usuario
            $result = mysqli_fetch_assoc($query1);

            $sql2 ="SELECT * FROM animais WHERE ID_animal = '$animalID' ";
            $query2 = mysqli_query($conexao ,$sql2 );
            $result2 = mysqli_fetch_assoc($query2);

            $sql4 = "SELECT * FROM ItemFavorito WHERE ItemDoacao_FK = '$DoacaoID' AND ItemFavorito_FK = '$UserID' AND atividade='ativo'"; 
            $query4 = mysqli_query($conexao, $sql4); //Verificamos se essa doação já foi favoritada por esse usuario
            //$result4 = mysqli_fetch_assoc($query4);
            $rows = mysqli_num_rows($query4);
            
            ?>
            <!-- Aqui criaremos o layout de cada post ao ser exibido na tela de anuncios recentes --> 
                     <div class="card" style="width: 18rem;" data-anime="bottom">
                        <div class="embed-responsive embed-responsive-1by1">
                             <img src="../images/<?php echo $result2['img_animal']?>" class="embed-responsive-item card-img-top" alt="IMAGEM">
                        </div>

                        <input type="checkbox" id="favorite<?php echo $DoacaoID; ?>" onclick="favoritar(this.id)" style="display: none;">
                        <label for="favorite<?php echo $DoacaoID; ?>" class="lb-favoritagem">
                            <a href="http://animalshope.epizy.com/_php-action/favoritar.php?doacaoID=<?php echo $DoacaoID;?>&botao1=favoritar"><img src="../images/<?php if($rows <= 0){echo 'star-nao-favoritada.png';} else {echo 'star-favoritada.png';} ?>" id="imagem<?php echo $DoacaoID; ?>" class="img-favorito"></a>
                        </label>
                        <!-- Botão Excluir -->
                        <?php if(isset($_SESSION['admin']) || ($DoadorID == $_SESSION['id_usuario'])){ ?>
                        <a type="button" data-toggle="modal" data-target="#deletar<?php echo $DoacaoID ?>"><span class="fechar">x</span></a>
                        <?php } ?>

                        <!--<a href='anuncio.php?doacao_id=<?php echo $DoacaoID; ?>' class="stretched-link"></a>-->

                        <div class="card-body" style="padding-bottom: 20px;">
                            <h5 class="card-title titulo"><?php echo $result2['nome_animais']; if ($result2['sexo_animal'] == "macho") {echo " <img src='../images/sexo-masc.png' class='img-masc justify-content-end'>";} else {echo " <img src='../images/sexo-fem.png' class='img-fem'>";}?></h5>
                            <p class="card-text"><?php echo $result2['raca_animais']; ?></p>
                            <p class="card-text"><?php echo $result['cidade_user'] . " - " . $result['estado_user']; ?></p>
                            <p class="card-text"><?php echo mb_strimwidth($result2['descri_animal'], 0, 54, "..."); ?></p>
                        </div>
                        <a href='anuncio.php?doacao_id=<?php echo $DoacaoID; ?>' class="btn btn-primary btn-saiba-mais" style="background-color: #F48024; border-color: #F48024;">SAIBA MAIS</a>
                    </div>

                     <!-- Janela Para excluir anúncio -->
                        <div class="modal fade" id="deletar<?php echo $DoacaoID ?>"tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Excluir Anúncio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Você está prestes a excluir a doação de <?php echo $result2['nome_animais']; ?>, tem certeza que deseja executar essa ação?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <a href="http://animalshope.epizy.com/_php-action/exclusaoAnuncios.php?ID_doacao=<?php echo $DoacaoID;?>&botao1=deletar"><button type="button" class="btn btn-danger">Excluir</button></a>
                                </div>
                                </div>
                            </div>
                        </div>

<?php
    }
 }
}




      function Busca($conexao, $inicio, $quantidade_pg){
          if(!isset($_GET['Pesquisar'])){  
              header('Location: http://animalshope.epizy.com/templates/home.php');
              exit();         
          }

          $busca = $_GET['busca'];  // salva o que foi buscado em uma variavel

          $sql = "SELECT * FROM animais INNER JOIN doacao ON animais.ID_animal = doacao.ID_animal_FK WHERE nome_animais LIKE '%{$busca}%' AND doacao.atividade_doacao = 'ativo'";
          $query = mysqli_query($conexao, $sql);
          $total = mysqli_num_rows($query);

            if($total <= 0){
                echo "<div class='alert alert-danger'>Nenhuma publicação encontrada!</div>";
            }
            else {
                while($result2 = mysqli_fetch_assoc($query)) { 
                    $IDanimal = $result2['ID_animal'];
                    $query4 = "SELECT * FROM doacao WHERE ID_animal_FK = '$IDanimal' AND atividade_doacao = 'ativo' ORDER BY data_doacao DESC LIMIT {$inicio}, {$quantidade_pg}";
                    $sql4 = mysqli_query($conexao, $query4);
                    $result_query4 = mysqli_fetch_assoc($sql4);

                    $DoacaoID = $result_query4['ID_doacao'];
                    $DoadorID = $result_query4['ID_usuario_FK'];
                    $UserID = $_SESSION['id_usuario']; //ID de quem está logado

                    $sql1 = "SELECT * FROM usuarios WHERE id_user = '$DoadorID'"; 
                    $query1 = mysqli_query($conexao, $sql1); //selecionamos todos dados do usuario
                    $result = mysqli_fetch_assoc($query1);

                    $sql3 = "SELECT * FROM ItemFavorito WHERE ItemDoacao_FK = '$DoacaoID' AND ItemFavorito_FK = '$UserID' AND atividade='ativo'"; 
                    $query3 = mysqli_query($conexao, $sql3); //Verificamos se essa doação já foi favoritada por esse usuario
                    //$result3 = mysqli_fetch_assoc($query3);
                    $rows3 = mysqli_num_rows($query3);
                    ?>  

                    <!-- Aqui criaremos o layout de cada post ao ser exibido na tela de anuncios recentes --> 
        
                    <div class="card" style="width: 18rem;" data-anime="bottom">
                        <div class="embed-responsive embed-responsive-1by1">
                             <img src="../images/<?php echo $result2['img_animal']?>" class="embed-responsive-item card-img-top" alt="IMAGEM">
                        </div>

                        <input type="checkbox" id="favorite<?php echo $DoacaoID; ?>" onclick="favoritar(this.id)" style="display: none;">
                        <label for="favorite<?php echo $DoacaoID; ?>" class="lb-favoritagem">
                            <a href="http://animalshope.epizy.com/_php-action/favoritar.php?doacaoID=<?php echo $DoacaoID;?>&botao1=favoritar"><img src="../images/<?php if($rows <= 0){echo 'star-nao-favoritada.png';} else {echo 'star-favoritada.png';} ?>" id="imagem<?php echo $DoacaoID; ?>" class="img-favorito"></a>
                        </label>
                        <!-- Botão Excluir -->
                        <?php if(isset($_SESSION['admin']) || ($DoadorID == $_SESSION['id_usuario'])){ ?>
                            <a type="button" data-toggle="modal" data-target="#deletar<?php echo $DoacaoID ?>"><span class="fechar">x</span></a>
                        <?php } ?>

                        <!--<a href='anuncio.php?doacao_id=<?php echo $DoacaoID; ?>' class="stretched-link"></a>-->

                        <div class="card-body" style="padding-bottom: 20px;">
                            <h5 class="card-title titulo"><?php echo $result2['nome_animais']; if ($result2['sexo_animal'] == "macho") {echo " <img src='../images/sexo-masc.png' class='img-masc justify-content-end'>";} else {echo " <img src='../images/sexo-fem.png' class='img-fem'>";}?></h5>
                            <p class="card-text"><?php echo $result2['raca_animais']; ?></p>
                            <p class="card-text"><?php echo $result['cidade_user'] . " - " . $result['estado_user']; ?></p>
                            <p class="card-text"><?php echo mb_strimwidth($result2['descri_animal'], 0, 54, "..."); ?></p>
                        </div>
                        <a href='anuncio.php?doacao_id=<?php echo $DoacaoID; ?>' class="btn btn-primary btn-saiba-mais" style="background-color: #F48024; border-color: #F48024;">SAIBA MAIS</a>
                    </div>

                     <!-- Janela Para excluir anúncio -->
                        <div class="modal fade" id="deletar<?php echo $DoacaoID ?>"tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Excluir Anúncio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Você está prestes a excluir a doação de <?php echo $result2['nome_animais']; ?>, tem certeza que deseja executar essa ação?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <a href="http://animalshope.epizy.com/_php-action/exclusaoAnuncios.php?ID_doacao=<?php echo $DoacaoID;?>&botao1=deletar"><button type="button" class="btn btn-danger">Excluir</button></a>
                                </div>
                                </div>
                            </div>
                        </div>

                        <?php  
                }
            }    
        }
?>
