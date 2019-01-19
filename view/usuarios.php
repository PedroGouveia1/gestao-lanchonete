<?php 
	session_start();
	if(isset($_SESSION['usuario'])){

	require_once "../classes/conexao.php";
	$c = new conectar();
	$conexao=$c->conexao();
	
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Usuarios</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Administrar usuários</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmRegistro">
						<div class="form-group">
							<label>Nome</label>
							<input type="text" class="form-control input-sm" name="nome" id="nome">
						</div>

						<div class="form-group">
							<label>Usuário</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control input-sm" name="email" id="email">
						</div>

						<div class="form-group">
							<label>Cantina</label>
							<select class="form-control" name="cantina" id="cantina">
							<?php
								$consulta = "SELECT id_cantina, nome FROM cantinas";
								$consultaCantina = mysqli_query($conexao, $consulta);
								while($mostrar = mysqli_fetch_row($consultaCantina)):
							?>
							<option value="<?php echo $mostrar[0]; ?>"><?php echo $mostrar[1]; ?></option>
							<?php endWhile; ?>
							</select>

						</div>

						<div class="form-group">

						<label>Cargo</label>
							<select class="form-control" name="cargo" id="cargo">
								<?php
									$consulta = "SELECT id_cargo, nomeCargo FROM cargos";
									$consultaCargo = mysqli_query($conexao, $consulta);
									while($mostrar = mysqli_fetch_row($consultaCargo)):
								?>
								<option value="<?php echo $mostrar[0]; ?>"><?php echo $mostrar[1]; ?></option>
								<?php endWhile; ?>
							</select>

						</div>

						<div class="form-group">

							<label>Senha</label>
							<input type="password" class="form-control input-sm" name="senha" id="senha">
						</div>

						<div class="form-group">
							<label>Confirme a senha</label>
							<input type="password" class="form-control input-sm" name="csenha" id="csenha">
						</div>
						<p></p>
						<span class="btn btn-primary" id="registro">Cadastrar</span>

					</form>
				</div>
				<div class="col-sm-7">
					<div id="tabelaUsuariosLoad"></div>
				</div>
			</div>
		</div>


		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="atualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuarioU" name="idUsuarioU">
							<div class="form-group">
							<label>Nome</label>
							<input type="text" class="form-control input-sm" name="nomeU" id="nomeU">
						</div>

						<div class="form-group">
							<label>Usuário</label>
							<input type="text" class="form-control input-sm" name="userU" id="userU">
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control input-sm" name="emailU" id="emailU">
						</div>

						<!--<div class="form-group">
							<label>Cantina</label>
							<select class="form-control" name="cantinaU" id="cantinaU">
							<?php
								$consulta = "SELECT id_cantina, nome FROM cantinas";
								$consultaCantina = mysqli_query($conexao, $consulta);
								while($mostrar = mysqli_fetch_row($consultaCantina)):
							?>
							<option value="<?php echo $mostrar[0]; ?>"><?php echo $mostrar[1]; ?></option>
							<?php endWhile; ?>
							</select>

						</div>

						<div class="form-group">

						<label>Cargo</label>
							<select class="form-control" name="cargoU" id="cargoU">
								<?php
									$consulta = "SELECT id_cargo, nomeCargo FROM cargos";
									$consultaCargo = mysqli_query($conexao, $consulta);
									while($mostrar = mysqli_fetch_row($consultaCargo)):
								?>
								<option value="<?php echo $mostrar[0]; ?>"><?php echo $mostrar[1]; ?></option>
								<?php endWhile; ?>
							</select>

						</div>-->

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAtualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Editar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idusuario){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procedimentos/usuarios/obterDadosUsuarios.php",
				success:function(r){
					dado=jQuery.parseJSON(r);

					$('#idUsuarioU').val(dado['id']);
					$('#nomeU').val(dado['nome']);
					$('#userU').val(dado['user']);
					$('#emailU').val(dado['email']);
				}
			});
		}

		function eliminar(idusuario){
			alertify.confirm('Deseja excluir este funcionário?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procedimentos/usuarios/eliminarUsuarios.php",
					success:function(r){
						if(r==1){
							$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php');
							alertify.success("Funcionário excluido com sucesso!");
						}else{
							alertify.error("Erro ao excluir funcionário.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}


	</script>


	<!-- ATUALIZAR UM FUNCIONÁRIO -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAtualizaUsuario').click(function(){
				datos=$('#frmRegistroU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procedimentos/usuarios/atualizarUsuarios.php",
					success:function(r){

						if(r==1){
							$('#frmRegistro')[0].reset();
							$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php');
							alertify.success("Funcionário atualizado com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar o funcionário.");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php');

			$('#registro').click(function(){

				vazios=validarFormVazio('frmRegistro');

				if(vazios > 0){
					alertify.alert("Preencha os campos!");
					return false;
				}

				datos=$('#frmRegistro').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procedimentos/login/registrarUsuario.php",
					success:function(r){
						

						if(r==1){
							$('#frmRegistro')[0].reset();
							$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php');
							alertify.success("Adicionado com sucesso");
						}else{
							alertify.error("Falha ao adicionarrr");
						}
					}
				});
			});
		});
	</script>




<?php 
}else{
	header("location:../index.php");
}
?>