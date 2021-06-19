<?php
    
        function meusAnuncios($conexao, $inicio, $quantidade_pg){
            session_start(); //inicio a sessão
            $ID = $_SESSION['id_usuario']; //ID de quem está logado
            $sql = "SELECT * FROM doacao WHERE ID_usuario_FK = $ID and atividade_doacao = 'ativo' ORDER BY ID_doacao DESC LIMIT $inicio, $quantidade_pg"; 
            $query = mysqli_query($conexao, $sql);

            $rows = mysqli_num_rows($query); //número de doações realizadas pelo usuário logado
            if($rows <= 0){ //verifico se o usuário fez alguma doação
                echo "<div class='alert alert-danger'>Nenhuma doação realizada!</div>";
            exit();
            }
            else {?>
            <table>
                    <tbody>
                <?php
                    while ($dados = mysqli_fetch_assoc($query)):
                        $UserID = $dados ["ID_usuario_FK"]; // ID do usuário que fez a doação
                        $AnimalID = $dados ["ID_animal_FK"]; // ID do animal doado
                        $DoacaoID = $dados ["ID_doacao"]; //ID da doação
                        $sql2 = "SELECT * FROM usuarios WHERE id_user = $UserID"; 
                        $query2 = mysqli_query($conexao, $sql2); 
                        $resulado2 = mysqli_fetch_assoc($query2); //selecionamos todos dados do doador
                        
                        $sql3 = "SELECT * FROM animais WHERE id_animal = $AnimalID"; 
                        $query3 = mysqli_query($conexao, $sql3); 
                        $resultado3 = mysqli_fetch_assoc($query3); //selecionamos todos dados do animal doado
                ?>  
                    
                            <!-- Anúncio -->
                            <tr>
                                <td rowspan="2" class="btn-delete"><a href="../_php-action/exclusaoAnuncios.php?ID_doacao=<?php echo $DoacaoID;?>&botao3=deletar"><img style="width: 22px" src="https://imagizer.imageshack.com/img924/6488/BfFlE7.png"></a></td>
                                <td rowspan="2" class="image"><img src="../images/<?php echo $resultado3['img_animal'] ?>"></td>
                                <td class="titulo titulo-anuncio">
                                    <?php echo $resultado3['nome_animais']; if ($resultado3['sexo_animal'] == "macho") {echo " <img src='../images/sexo-masc.png' class='img-masc justify-content-end'>";} else {echo " <img src='../images/sexo-fem.png' class='img-fem'>";}?>
                                    <a href="http://animalshope.epizy.com/templates/edit_animal.php?doacao_id=<?php echo $DoacaoID; ?>" class="btn-edit-mobile">
                                        <img src="../images/edit-anuncio.png" style="padding-bottom: 10px;max-width: 40px;min-width: 30px">
                                    </a>
                                </td>
                                <td class="btn-edit"><a href="http://animalshope.epizy.com/templates/edit_animal.php?doacao_id=<?php echo $DoacaoID; ?>"><img class="w-100" src="../images/edit-anuncio.png" style="max-width: 40px;min-width: 30px"></a></td>
                                
                            </tr>
                            <tr>
                                <td class="text-justify descricao"><?php echo mb_strimwidth($resultado3['descri_animal'], 0, 54, "..."); ?></td>
                                <td class="visitar"><a href="http://animalshope.epizy.com/templates/anuncio.php?doacao_id=<?php echo $DoacaoID; ?>" class="btn-visitar btn-white btn-animation-1">VISITAR</a></td>
                            </tr>                            
                <?php endwhile; ?>  <!-- fechando o while -->
                    </tbody>
                </table>
                <?php } } ?> <!-- Fechando o else e a function -->