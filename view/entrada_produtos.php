<?php 
session_start();
if(isset($_SESSION['usuario'])){
?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Entrada de produtos</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../classes/conexao.php"; 
		$c= new conectar();
		$conexao=$c->conexao();
		?>


		<script type="text/javascript" src="../js/jquery.maskMoney.min.js" ></script>
		<script type="text/javascript">
				$(document).ready(function(){
					$("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
				});
		</script>

	</head>
	<body>
		<div class="container">
			<h1>Entrada de produtos</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmCompra" enctype="multipart/form-data">
						<label for="produtoSelect">Produto</label>
						<select class="form-control input-sm" id="produtoSelect" name="produtoSelect">
							<?php
								$sql="SELECT id_produto, nome FROM produtos ORDER BY nome";
								$result=mysqli_query($conexao,$sql);
								while($mostrar=mysqli_fetch_row($result)):
							?>
								<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
						</select>

						<label for="fornecedorSelect">Fornecedor</label>
						<select class="form-control input-sm" id="fornecedorSelect" name="fornecedorSelect">
							<?php
								$sql="SELECT id_fornecedor, nome FROM fornecedores ORDER BY nome";
								$result=mysqli_query($conexao,$sql);
								while($mostrar=mysqli_fetch_row($result)):
							?>
								<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Quantidade</label>
						<input type="text" class="form-control input-sm" id="quantidade" name="quantidade">
						<label>Preço total</label>
						<input type="text" class="form-control input-sm dinheiro" id="preco" name="preco">
						<label>Data</label>
						<?php date_default_timezone_set('America/Sao_Paulo'); ?>
						<input type="date" class="form-control input-sm" id="dataCompra" name="dataCompra" value="<?php echo date('Y-m-d'); ?>">
						
						<p></p>
						<span id="btnAddCompra" class="btn btn-primary">Adicionar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaFinanceirosLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->
		
		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdateCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar compra</h4>
					</div>
					<div class="modal-body">
						<form id="frmCompraU" enctype="multipart/form-data">
							<input type="text" id="idCompra" hidden="" name="idCompra">
							<label for="produtoSelectU">Produto</label>
							<select class="form-control input-sm" disabled="" id="produtoSelectU" name="produtoSelectU">
								<?php
									$sql="SELECT id_produto, nome FROM produtos ORDER BY nome";
									$result=mysqli_query($conexao,$sql);
									while($mostrar=mysqli_fetch_row($result)):
								?>
									<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
								<?php endwhile; ?>
							</select>
							<label for="fornecedorSelectU">Fornecedor</label>
							<select class="form-control input-sm" id="fornecedorSelectU" name="fornecedorSelectU">
								<?php
									$sql="SELECT id_fornecedor, nome FROM fornecedores ORDER BY nome";
									$result=mysqli_query($conexao,$sql);
									while($mostrar=mysqli_fetch_row($result)):
								?>
									<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
								<?php endwhile; ?>
							</select>
							<label>Quantidade</label>
							<input type="text" class="form-control input-sm" id="quantidadeU" name="quantidadeU">
							<label>Preço</label>
							<input type="text" class="form-control input-sm dinheiro" id="precoU" name="precoU">
							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAtualizarCompra" type="button" class="btn btn-warning" data-dismiss="modal">Editar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function addDadosCompra(idcompra){
			$.ajax({
				type:"POST",
				data:"idcompra=" + idcompra,
				url:"../procedimentos/financeiros/obterDados.php",
				success:function(r){
					dado=jQuery.parseJSON(r);
					$('#idCompra').val(dado['id_compras']);
					$('#produtoSelectU').val(dado['id_produto']);
					$('#fornecedorSelectU').val(dado['id_fornecedor']);
					$('#quantidadeU').val(dado['quantidade']);
					$('#precoU').val(dado['preco']);

				}
			});
		}

		function eliminarProduto(idCompra, nomeProduto,fornecedor){
			alertify.confirm('Deseja excluir esta compra: <strong>' + nomeProduto + '</strong> em <strong>' + fornecedor + '</strong>?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcompra=" + idCompra,
					url:"../procedimentos/financeiros/eliminarCompras.php",
					success:function(r){
						if(r==1){
							$('#tabelaFinanceirosLoad').load("financeiros/tabelaFinanceiros.php");
							alertify.success("Produto excluido com sucesso.");
						}else{
							alertify.error("Não excluido.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado.')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAtualizarCompra').click(function(){

				dados=$('#frmCompraU').serialize();
				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/financeiros/atualizarCompra.php",
					success:function(r){
						alert(r);
						if(r==1){
							$('#tabelaFinanceirosLoad').load("financeiros/tabelaFinanceiros.php");
							alertify.success("Editado com sucesso.");
						}else{
							alertify.error("Erro ao editar produto.");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tabelaFinanceirosLoad').load("financeiros/tabelaFinanceiros.php");

			$('#btnAddCompra').click(function(){

				vazios=validarFormVazio('frmCompra');

				if(vazios > 0){
					alertify.alert("Preencha todos os campos!");
					return false;
				}

				var formData = new FormData(document.getElementById("frmCompra"));

				$.ajax({
					url: "../procedimentos/financeiros/inserirCompra.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){
						alert(r);	
						if(r == 1){
							$('#frmCompra')[0].reset();
							$('#tabelaFinanceirosLoad').load("financeiros/tabelaFinanceiros.php");
							alertify.success("Adicionado com sucesso!");
						}else{
							alertify.error("Falha ao adicionar");
						}
					}
				});
				
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#produtoSelect').select2();
			$('#fornecedorSelect').select2();
		});

		
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>