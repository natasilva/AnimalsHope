<?php
    function gerarAnuncios($conexao, $inicio, $quantidade_pg){
        if (mysqli_connect_errno()) {
            echo "A conexão com o MySql falhou: " . mysqli_connect_error();
            exit();
        }
        //Selecionar os cursos a serem apresentado na página
        $result_doacoes = "SELECT * FROM doacao WHERE atividade_doacao = 'ativo' ORDER BY ID_doacao DESC LIMIT $inicio, $quantidade_pg";
        $query = mysqli_query($conexao, $result_doacoes);
        $total = mysqli_num_rows($query);

        if($total <= 0): //verifico se existe alguma doação
            echo "<div class='alert alert-danger'>Nenhuma publicação encontrada!</div>";                   
        else:
            while ($dados = mysqli_fetch_assoc($query)):
                $UserID = $_SESSION['id_usuario']; //ID de quem está logado
                $DoadorID = $dados ["ID_usuario_FK"];
                $AnimalID = $dados ["ID_animal_FK"]; // ID do animal
                $DoacaoID = $dados ["ID_doacao"]; //ID da doação
                $sql2 = "SELECT * FROM usuarios WHERE id_user = '$DoadorID'"; 
                $query2 = mysqli_query($conexao, $sql2); //selecionamos todos dados do usuario
                $result = mysqli_fetch_assoc($query2);
                
                $sql3 = "SELECT * FROM animais WHERE id_animal = '$AnimalID'"; 
                $query3 = mysqli_query($conexao, $sql3); //selecionamos todos dados do animal doado
                $result2 = mysqli_fetch_assoc($query3);

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
            endwhile;
        endif;

        mysqli_close($conexao); 
       }
    ?>