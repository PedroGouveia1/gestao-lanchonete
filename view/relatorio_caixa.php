<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
?>

<!DOCTYPE html>
<html>
<head>
	<title>Relatório de fechamento de caixa</title>
	<?php
		require_once "menu.php";
		require_once "../classes/conexao.php";
		$c= new conectar();
		$conexao=$c->conexao();
	?>
</head>
<body>
	<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Relatório de fechamento de caixa</h2>

		</div>
	</div>

	<div class="row" style="margin-top: 1%;">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<form id="frmBuscar" method="get" action="relatorio_caixa.php">
				<div class=" form group row" style="margin-top: -1.5%;">
					<label for="de" class="col-sm-1 col-form-label"><p style="font-size: 20px; margin-top: 5% !important">De: </p></label>
					<div class="col-sm-5">
						<input class="form-control input-group" type="date" id="de" name="de">
					</div>

					<label for="ate" class="col-sm-1 col-form-label"><p style="font-size: 20px; margin-top: 5% !important">Até: </p></label>
					<div class="col-sm-5">
						<input class="form-control input-group" type="date" id="ate" name="ate">
					</div>
				</div>

					<div class="form-group row">
						<button type="submit" id="buscar" name="buscar" class="btn btn-primary btn-sm btn-block">Buscar</button>
					</div>
				
			</form>	
		</div>
	</div>

<?php
	if(isset($_GET['de'])){

		$de = $_GET['de'];
		$ate = $_GET['ate'];
		$sql = "SELECT 	* FROM caixa WHERE dataCaixa BETWEEN '$de' AND '$ate'";
		$result=mysqli_query($conexao,$sql);
		$total = 0;
?>
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">

			<!--Botão de imprimir 
			<form method="POST" id="imprimirRelatorio" action="vendas/imprimirRelatorio.php">
				<input type="hidden" name="de" id="de" value="<?php echo $de; ?>">
				<input type="hidden" name="ate" id="ate" value="<?php echo $ate; ?>">
				<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

				<?php
					if(isset($_GET['cliente'])){
				?>
				<button type="submit" id="imprimirRelatorio" class="btn btn-sm btn-block btn-danger">Imprimir</button>
				<?php
					}
				?>

			</form>-->

			<div class="table-responsive" style="margin-top: 1%;">

				<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
					<!--<caption><label>Vendas</label></caption>-->
					<thead>
						<tr>
							<td>#</td>
							<td>Data</td>
							<td>Valor recebido</td>
						</tr>
					</thead>
					<?php while($ver=mysqli_fetch_row($result)): ?>
					<tr>
						<td><?php echo $ver[0] ?></td>
						<td><?php echo date("d/m/Y", strtotime($ver[1])) ?></td>
						<td><?php echo "R$ " . number_format($ver[2], 2, ',', '.') ?></td>
					</tr>

					<?php
						$total = $total + $ver[2];
						endwhile;
					?>
					<thead>
						<tr>
							<td colspan="2"><strong>TOTAL</strong></td>
							<td><strong><?php echo "R$ " . number_format($total, 2, ',', '.'); ?></strong></td>
						</tr>
					</thead>
				</table>
			</div>
			
		</div>
		<div class="col-sm-1"></div>
	</div>
	</div>
</body>
</html>

<?php } ?>


<script type="text/javascript">
		$(document).ready(function(){

			$('#buscar').click(function(){

				vazios=validarFormVazio('frmBuscar');

				if(vazios > 0){
					alertify.alert("Preencha todos os campos!");
					return false;
				}
				
			});
		});
	</script>
	


<?php 
	}else{
		header("location:../index.php");
	}
 ?>