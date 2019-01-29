<?php 
session_start();
if(isset($_SESSION['usuario'])){
?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Gastos extras</title>
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
			<h1>Gastos extras</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmGE" enctype="multipart/form-data">
						<label>Descrição</label>
						<input type="text" class="form-control input-sm" id="descricao" name="descricao">
						<label>Valor</label>
						<input type="text" class="form-control input-sm dinheiro" id="valor" name="valor">
						<label>Data</label>
						<?php date_default_timezone_set('America/Sao_Paulo'); ?>
						<input type="date" class="form-control input-sm" id="dataGasto" name="dataGasto" value="<?php echo date('Y-m-d'); ?>">
						
						<p></p>
						<button id="btnAdd" class="btn btn-primary">Adicionar</button>
					</form>
				</div>


				<div class="col-sm-8">
					<div id="tabelaLoad"></div>
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
						<form id="frmGEU" enctype="multipart/form-data">
							<input type="text" id="idGasto" hidden="" name="idGasto">
							<label>Descrição</label>
						<input type="text" class="form-control input-sm" id="descricaoU" name="descricaoU">
						<label>Valor</label>
						<input type="text" class="form-control input-sm dinheiro" id="valorU" name="valorU">
						<label>Data</label>
						<?php date_default_timezone_set('America/Sao_Paulo'); ?>
						<input type="date" class="form-control input-sm" id="dataGastoU" name="dataGastoU" value="<?php echo date('Y-m-d'); ?>">
							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAtualizar" type="button" class="btn btn-warning" data-dismiss="modal">Editar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function addDadosGasto(idgasto){
			$.ajax({
				type:"POST",
				data:"idgasto=" + idgasto,
				url:"../procedimentos/financeiros/obterDadosGastos.php",
				success:function(r){
					dado=jQuery.parseJSON(r);
					$('#idGasto').val(dado['id_gasto']);
					$('#descricaoU').val(dado['descricao']);
					$('#valorU').val(dado['valor']);
					$('#dataGastoU').val(dado['dataGasto']);

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
			$('#btnAtualizar').click(function(){

				dados=$('#frmGEU').serialize();
				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/financeiros/atualizarGasto.php",
					success:function(r){
						if(r==1){
							$('#tabelaLoad').load("financeiros/tabelaGastosExtras.php");
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
			$('#tabelaLoad').load("financeiros/tabelaGastosExtras.php");

			$('#btnAdd').click(function(){

				vazios=validarFormVazio('frmGE');

				if(vazios > 0){
					alertify.alert("Preencha todos os campos!");
					return false;
				}

				var formData = new FormData(document.getElementById("frmGE"));

				$.ajax({
					url: "../procedimentos/financeiros/inserirGastosExtras.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){	
						if(r == 1){
							$('#frmGE')[0].reset();
							$('#tabelaLoad').load("financeiros/tabelaGastosExtras.php");
							alertify.success("Adicionado com sucesso!");
						}else{
							alertify.error("Falha ao adicionar");
						}
					}
				});
				
			});
		});
	</script>

		
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>