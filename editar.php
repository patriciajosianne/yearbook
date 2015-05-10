<?php
	require_once("./authSession.php");  
	require_once("./bd/conexao.php");
	include_once("templates/cabecalho.html");
?>
	<div class="container">
		<div class="starter-template">
			<h3 class="sub-header">Yearbook - Editar dados pessoais</h3>    
		</div>
<?php
	try{
		if(!isset($_SESSION['nomeUsuario'])){
			header("Location:./erroEdicao.php");
			die();
		}        
		
		$nomeUsuario = utf8_encode(htmlspecialchars($_SESSION['nomeUsuario']));
		
		$conexao = conn_mysql();			
		$SQLSelect = 'SELECT * FROM participantes p inner join cidades c on p.cidade = c.idCidade WHERE login=?';
		$operacao = $conexao->prepare($SQLSelect);					  
		$pesquisar = $operacao->execute(array($nomeUsuario));
		$participante = $operacao->fetch();
?>
			<form role="form" method="post" action="./editarParticipante.php" enctype="multipart/form-data">
				<div class="form-group">
					<label for="InputNome">Nome Completo:</label>
					<input type="text" class="form-control" id="InputNome" name="nomeCompleto" placeholder="Nome completo" value="<?php echo utf8_encode($participante['nomeCompleto'])?>" required autofocus/>
				</div>
				<div class="form-group">
					<label for="InputNome">E-mail:</label>
					<input type="text" class="form-control" id="InputEmail" name="email" placeholder="E-mail" value="<?php echo utf8_encode($participante['email'])?>" required autofocus/>
				</div>
				<div class="form-group">
					<?php echo '<label for="InputNome">'.utf8_encode('Descrição:').'</label>'; ?>
					<?php echo "<textarea type='text' class='form-control' id='InputDescricao' name='descricao' placeholder='".utf8_encode('Descrição')."' rows='3' required autofocus>".utf8_encode($participante['descricao'])."</textarea>";?>
				</div>
				<div class="form-group">
					<label for="InputFoto">Foto:</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
					<input type="file" class="form-control" id="InputFoto" name="foto" data-bfi-disabled autofocus>
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
									$selected='';
									if($estado["idEstado"]==$participante['idEstado']){
										$selected = 'selected="selected"';
										echo "<script>carregarCidades('InputCidade',".$estado["idEstado"].",'carregarCidades.php', ".$participante["cidade"].");</script>";
									}
									echo "\n<option value=".utf8_encode($estado["idEstado"])." ".$selected.">".utf8_encode($estado["nomeEstado"])."</option>";
								}
							}
						?>
					</select>
				</div>
				
				<div class="form-group">
					<label for="InputCidade">Cidade:</label>
					<select class="form-control" id="InputCidade" name="cidade" value="<?php echo utf8_encode($participante['cidade'])?>" required autofocus>
					</select>
				</div>				
				
				<div class="form-group">
					<label for="InputLogin">Login:</label>
					<input type="text" class="form-control" id="InputLogin" name="login" placeholder="Login desejado" disabled="true" value="<?php echo utf8_encode($participante['login'])?>" required/>
				</div>
				<div class="form-group">
					<label for="InputSenha">Senha:</label>
					<input type="password" class="form-control" id="InputSenha" name="password" placeholder="Senha (4 a 8 caracteres)"/>
				</div>
				<div class="form-group">
					<?php echo '<label for="InputSenhaConf">'.utf8_encode('Confirmação de Senha:').'</label>'; ?>
					<input type="password" class="form-control" id="InputSenhaConf" name="passwordConf" placeholder="Confirme a senha"/>
				</div>
			  
			  
				<button type="submit" class="btn btn-default">Confirmar</button>
			</form>
		</div>
    </div>
<?php
	}		//fim do try
	catch (PDOException $e)
	{
		// caso ocorra uma exceção, exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
	}

	include_once("templates/rodape.html");
?>