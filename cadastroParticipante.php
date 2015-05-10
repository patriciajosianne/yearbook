<?php
	include_once("templates/cabecalho_login.html");
	require_once("bd/conexao.php");
?>

    <div class="container">
		<div>    
			<form role="form" method="post" action="./cadastroNovoParticipante.php" enctype="multipart/form-data">
				<h3 class="form-signin-heading">Cadastro de Participante</h3>
				<div class="form-group">
					<label for="InputNome">Nome Completo:</label>
					<input type="text" class="form-control" id="InputNome" name="nomeCompleto" placeholder="Nome completo" required autofocus/>
				</div>
				<div class="form-group">
					<label for="InputNome">E-mail:</label>
					<input type="text" class="form-control" id="InputEmail" name="email" placeholder="E-mail" required autofocus/>
				</div>
				<div class="form-group">
					<label for="InputNome">Descrição:</label>
					<textarea type="text" class="form-control" id="InputDescricao" name="descricao" placeholder="Descrição" rows="3" required autofocus></textarea>
				</div>
				<div class="form-group">
					<label for="InputFoto">Foto:</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
					<input type="file" class="form-control" id="InputFoto" name="foto" data-bfi-disabled required autofocus>
				</div>
				
				<div class="form-group">
					<label for="InputEstado">Estado:</label>
					<select class="form-control" id="InputEstado" name="estado" onchange="carregarCidades('InputCidade',this.value,'carregarCidades.php', '');" required autofocus>
						<?php
							try{
								$conexao = conn_mysql();
								$SQLSelect = 'SELECT * FROM estados';
								$operacao = $conexao->prepare($SQLSelect);					  
								$pesquisar = $operacao->execute();
								$estados = $operacao->fetchAll();
								$conexao = null;							
								
							}catch (PDOException $e){
								echo "Erro!: " . $e->getMessage() . "<br>";
								die();
							}
							if(count($estados)>0){
								foreach($estados as $estado){
									echo "\n<option value=".utf8_encode($estado["idEstado"]).">".utf8_encode($estado["nomeEstado"])."</option>";
								}
							}
						?>
					</select>
				</div>
				
				<div class="form-group">
					<label for="InputCidade">Cidade:</label>
					<select class="form-control" id="InputCidade" name="cidade" required autofocus>
					</select>
				</div>				
				
				<div class="form-group">
					<label for="InputLogin">Login:</label>
					<input type="text" class="form-control" id="InputLogin" name="login" placeholder="Login desejado" required/>
				</div>
				<div class="form-group">
					<label for="InputSenha">Senha:</label>
					<input type="password" class="form-control" id="InputSenha" name="password" placeholder="Senha (4 a 8 caracteres)" required autofocus/>
				</div>
				<div class="form-group">
					<label for="InputSenhaConf">Confirmação de Senha:</label>
					<input type="password" class="form-control" id="InputSenhaConf" name="passwordConf" placeholder="Confirme a senha" required autofocus/>
				</div>

				<button type="submit" class="btn btn-primary">Cadastrar</button>
				
			</form>
			<p style="text-align:right;padding-top:15px;"><a class="btn btn-primary" href="./index.php">Cancelar</a></p>
			
		</div>
    </div>

<?php
	include_once("templates/rodape_login.html");
?>