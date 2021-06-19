<?php
    function gerarAnuncio($conexao, $idDoacao, $resultado4){
        session_start(); //inicio a sessão
        
        $DoacaoID = $idDoacao;
        /*
        $sql4 = "SELECT * FROM doacao WHERE ID_doacao = $DoacaoID"; //selecionando os dados da doação aberta
        $query4 = mysqli_query($conexao, $sql4);
        $resultado4 = mysqli_fetch_assoc($query4);*/
      

        $ID_animal_FK = $resultado4['ID_animal_FK'];
        $sql = "SELECT * FROM animais WHERE ID_animal = $ID_animal_FK"; //selecionando os dados do animal do anuncio
        $query = mysqli_query($conexao, $sql);
        $UserID = $_SESSION['id_usuario'];//$resultado4['ID_usuario_FK'];
        $DoadorID = $resultado4['ID_usuario_FK'];;

        while ($registro = mysqli_fetch_assoc($query)) { 
            $sql3 = "SELECT * FROM ItemFavorito WHERE ItemDoacao_FK = {$DoacaoID} AND ItemFavorito_FK = {$UserID} AND atividade='ativo'"; 
            $query3 = mysqli_query($conexao, $sql3); //Verificamos se essa doação já foi favoritada por esse usuario
            //$result4 = mysqli_fetch_assoc($query3);
            $rows3 = mysqli_num_rows($query3);
            
            ?>
            <br>
            <main>
                <section class="sessao">
                    <!-- As imagens tem que ser alteradas acessando o banco de dados juntamente com o php -->
                    <a class="back-button" href="anuncios_recentes3.php">
                        <img src="../images/back-icon.png" alt="BACK">
                    </a>
                        
                    <div class="img-actions">
                        <!-- Imagem do anúncio -->
                        <img src="../images/<?php echo $registro['img_animal']; ?>" class="img-anuncio" alt="...">

                        <!-- Botão Favoritar -->
                        <input type="checkbox" id="favorite<?php echo $DoacaoID; ?>" onclick="favoritar(this.id)" style="display: none;">
                        <label for="favorite<?php echo $DoacaoID; ?>" class="lb-favoritagem">
                            <a href="http://animalshope.epizy.com/_php-action/favoritar.php?doacaoID=<?php echo $DoacaoID;?>&botao2=favoritar"><img src="../images/<?php if($rows3 <= 0){echo 'star-nao-favoritada.png';} else {echo 'star-favoritada.png';} ?>" id="imagem<?php echo $DoacaoID; ?>" class="img-favorito"></a>
                        </label>
                    
                        <!-- Botão Excluir -->
                        <?php if(isset($_SESSION['admin']) || ($DoadorID == $_SESSION['id_usuario'])){ ?>
                            <a type="button" data-toggle="modal" data-target="#deletar<?php echo $DoacaoID ?>"><span class="fechar">x</span></a>
                        <?php } ?>
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
                                <p>Você está prestes a excluir a sua doação de <?php echo $registro["nome_animais"]; ?>, tem certeza que deseja executar essa ação?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <a href="http://animalshope.epizy.com/_php-action/exclusaoAnuncios.php?ID_doacao=<?php echo $DoacaoID;?>&botao1=deletar"><button type="button" class="btn btn-danger">Excluir</button></a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- Os dados tem que ser alterados acessando o banco de dados juntamente com o php -->
                    <section id="dados-animal">
                        <div class="container animal">
                            <div class="container">
                                <legend class="titulo">Dados gerais</legend>
                                <ul>
                                    <?php
                                    $nomeAnimal = $registro["nome_animais"];
                                    $descriAnimal = $registro["descri_animal"];
                                    ?>
                                    <li>Apelido: <?php echo $registro["nome_animais"]; ?></li>
                                    <li>Espécie: <?php echo $registro["especie_animal"]; ?></li>
                                    <li>Raça: <?php echo $registro["raca_animal"]; ?></li>
                                    <li>Sexo: <?php echo $registro["sexo_animal"]; ?></li>
                                    <li>Vacinado:
                                        <?php if ($registro["vacina_animal"] == 1) {
                                            echo "Sim";
                                        } else {
                                            echo "Não";
                                        }
                                        ?></li>
                                    <li>Castrado:
                                        <?php if ($registro["castra_animal"] == 1) {
                                            echo "Sim";
                                        } else {
                                            echo "Não";
                                        }
                                        ?></li>
                                    <li>Fase: <?php echo $registro["idade_animal"]; ?></li>

                                    <?php
                                    $ID_usuario_FK = $resultado4['ID_usuario_FK'];
                                    $sql1 = "SELECT * FROM usuarios WHERE ID_user = $ID_usuario_FK";
                                    $query2 = mysqli_query($conexao, $sql1);
                                    $registro2 = mysqli_fetch_assoc($query2);
                                    ?>
                                    <li>Cidade: <?php echo $registro2["cidade_user"] . " - " . $registro2["estado_user"]; ?></li>
                                    <li>Endereço: Bairro <?php echo $registro2["bairro_user"] . ", Rua " . $registro2["rua_user"]; ?></li>
                                    <li>Logradouro: <?php echo $registro2["rua_user"]; ?></li>
                                    <li>Telefone: <?php echo $registro2["tel_user"]; ?></li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- A descrição tem que ser alterada acessando o banco de dados juntamente com o php -->
                    <section id="descricao">
                        <fieldset class="p-2" style="border-radius: 15px;">
                            <legend class="w-auto titulo">Descrição</legend>
                            <p><?php echo $descriAnimal; ?></p>
                        </fieldset>
                    </section>
                </section>

<?php } } ?> <!--fechando a function e o while -->