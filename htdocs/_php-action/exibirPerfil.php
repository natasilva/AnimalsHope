<?php
    function exibirPerfil($conexao){
        session_start();
            $UserID = $_SESSION['id_usuario'];
            $sql = "SELECT * FROM usuarios WHERE id_user = '$UserID'"; //Seleciona os dados de quem está logado
            $query = mysqli_query($conexao, $sql);

            while($resultado = mysqli_fetch_assoc($query)){?> <!-- Aqui é a exibição dos dados do usuário-->
                    
                    <div class="group">
                        <label for="name">Nome Completo</label>
                        <input name="nome" type="text" id="name" class="" type="text" value="<?php echo $resultado['nome_user']; ?>">
                    </div>

                    <div class="group">
                        <label for="name">Email</label>
                        <input name="email" type="text" id="name" class="" type="text" value="<?php echo $resultado['email_user']; ?>">
                    </div>

                    <div class="group">
                        <label for="name">Data de nascimento</label>
                        <input name="data" type="text" id="name" class="" type="text" value="<?php echo $resultado['data_user']; ?>">
                    </div>

                    <div class="group">
                        <label for="name">Telefone</label>
                        <input name="telefon" type="text" id="name" class="" type="text" value="<?php echo $resultado['tel_user']; ?>">
                    </div>

                    <div class="group">
                    	<div class="form-row">
                        	<div class="col mb-1">
                            	<label for="name">UF</label>
                            		<select class="form-control" id="uf" name="estado" required onchange="buscaCidades(this.value)">
                                        <option value="<?php echo $resultado['estado_user']; ?>" select><?php echo $resultado['estado_user']; ?></option>
		                                <option value="Acre">Acre</option>
		                                <option value="Alagoas">Alagoas</option>
		                                <option value="Amapá">Amapá</option>
		                                <option value="Amazonas">Amazonas</option>
		                                <option value="Bahia">Bahia</option>
		                                <option value="Ceará">Ceará</option>
		                                <option value="Espírito Santo">Espírito Santo</option>
		                                <option value="Goiás">Goiás</option>
		                                <option value="Maranhão">Maranhão</option>
		                                <option value="Mato Grosso">Mato Grosso</option>
		                                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
		                                <option value="Minas Gerais">Minas Gerais</option>
		                                <option value="Pará">Pará</option>
		                                <option value="Paraíba">Paraíba</option>
		                                <option value="Paraná">Paraná</option>
		                                <option value="Pernambuco">Pernambuco</option>
		                                <option value="Piauí">Piauí</option>
		                                <option value="Rio de Janeiro">Rio de Janeiro</option>
		                                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
		                                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
		                                <option value="Rondônia">Rondônia</option>
		                                <option value="Roraima">Roraima</option>
		                                <option value="Santa Catarina">Santa Catarina</option>
		                                <option value="São Paulo">São Paulo</option>
		                                <option value="Sergipe">Sergipe</option>
		                                <option value="Tocantins">Tocantins</option>
		                                <option value="Distrito Federal">Distrito Federal</option>
                                    </select>
                            </div>
                        </div>            
                    </div>

                    <div class="group">
                        <div class="form-row">   
                            <div class="col mb-1">
                                <input type="hidden" value="<?php echo $resultado['cidade_user']; ?>" id="pre-cidade">
                            	<label for="cidade_user">Município</label>
                            	<select class="form-control" name="cidade" id="cidade">
        
                            	</select>
                        	</div>
                        </div>    
                    </div>
                    
                    <div class="group">
                        <label for="name">Rua</label>
                        <input name="rua" type="text" id="name" class="" type="text" value="<?php echo $resultado['rua_user']; ?>">
                    </div>

                    <div class="group digi-end">
                        <label for="name">Bairro</label>
                        <input name="bairro" type="text" id="name" class="" type="text" value="<?php echo $resultado['bairro_user']; ?>">
                    </div>

                    <div class="grup submit-group">
                        <span class="arrow"></span>
                        <input type="submit" class="submit" value="SALVAR DADOS">
                    </div>

                
        <?php } //fechando o While
    } ?> <!-- fechando a function -->
