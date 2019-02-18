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
			<h2>Relatório Geral Mensal</h2>

		</div>
	</div>

	<div class="row" style="margin-top: 1%;">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<form id="frmBuscar" method="get" action="relatorio_geral.php">
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
	if(isset($_GET['buscar'])){

		$de = $_GET['de'];
		$ate = $_GET['ate'];
		$sql = "SELECT 	* FROM caixa WHERE dataCaixa BETWEEN '$de' AND '$ate' ORDER BY dataCaixa DESC ";
		$caixa=mysqli_query($conexao,$sql);
		$totalCaixa = 0;
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
					<caption><label>Fechamento de caixa</label></caption>
					<thead>
						<tr>
							<td>Data</td>
							<td>Valor recebido</td>
						</tr>
					</thead>
					<?php while($ver=mysqli_fetch_row($caixa)): ?>
					<tr>
						<td><?php echo date("d/m/Y", strtotime($ver[1])) ?></td>
						<td><?php echo "R$ " . number_format($ver[2], 2, ',', '.') ?></td>
					</tr>

					<?php
						$totalCaixa = $totalCaixa + $ver[2];
						endwhile;
					?>
					<thead>
						<tr>
							<td><strong>TOTAL</strong></td>
							<td><strong><?php echo "R$ " . number_format($totalCaixa, 2, ',', '.'); ?></strong></td>
						</tr>
					</thead>
				</table>
			</div>


			<!-- TABELA DE COMPRAS -->

			<?php
				$sql = "SELECT dataCompra, SUM(preco) as gasto_dia FROM compras WHERE dataCompra BETWEEN '$de' AND '$ate' GROUP BY dataCompra ORDER BY dataCompra DESC";
				$compras=mysqli_query($conexao,$sql);
				$totalCompras = 0;
			?>


			<div class="table-responsive" style="margin-top: 1%;">

				<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
					<caption><label>Entrada de produtos</label></caption>
					<thead>
						<tr>
							<td>Data</td>
							<td>Valor Gasto</td>
						</tr>
					</thead>
					<?php while($ver=mysqli_fetch_row($compras)): ?>
					<tr>
						<td><?php echo date("d/m/Y", strtotime($ver[0])) ?></td>
						<td><?php echo "R$ " . number_format($ver[1], 2, ',', '.') ?></td>
					</tr>

					<?php
						$totalCompras = $totalCompras + $ver[1];
						endwhile;
					?>
					<thead>
						<tr>
							<td><strong>TOTAL</strong></td>
							<td><strong><?php echo "R$ " . number_format($totalCompras, 2, ',', '.'); ?></strong></td>
						</tr>
					</thead>
				</table>
			</div>




			<!-- TABELA DE GASTOS EXTRAS -->

			<?php
				$sql = "SELECT dataGasto, SUM(valor) as valor FROM gastos_extras WHERE dataGasto BETWEEN '$de' AND '$ate' GROUP BY dataGasto ORDER BY dataGasto DESC";
				$gastos=mysqli_query($conexao,$sql);
				$totalGastos = 0;
			?>


			<div class="table-responsive" style="margin-top: 1%;">

				<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
					<caption><label>Gastos Extras</label></caption>
					<thead>
						<tr>
							<td>Data</td>
							<td>Valor Gasto</td>
						</tr>
					</thead>
					<?php while($ver=mysqli_fetch_row($gastos)): ?>
					<tr>
						<td><?php echo date("d/m/Y", strtotime($ver[0])) ?></td>
						<td><?php echo "R$ " . number_format($ver[1], 2, ',', '.') ?></td>
					</tr>

					<?php
						$totalGastos = $totalGastos + $ver[1];
						endwhile;
					?>
					<thead>
						<tr>
							<td><strong>TOTAL</strong></td>
							<td><strong><?php echo "R$ " . number_format($totalGastos, 2, ',', '.'); ?></strong></td>
						</tr>
					</thead>
				</table>
			</div>




			<!-- TABELA DE TOTAIS -->

			<div class="table-responsive" style="margin-top: 1%;">

				<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
					<caption><label>Gastos Extras</label></caption>
					<thead>
						<tr>
							<td>Tipo</td>
							<td>Valor</td>
						</tr>
					</thead>
						
					<tr>
						<td>Entrada em caixa:</td>
						<td><?php echo "R$ " . number_format($totalCaixa, 2, ',', '.'); ?></td>
					</tr>

					<tr>
						<td>Gasto com mercadorías:</td>
						<td><?php echo "R$ " . number_format(($totalCompras * -1), 2, ',', '.'); ?></td>
					</tr>

					<tr>
						<td>Gastos extras:</td>
						<td><?php echo "R$ " . number_format(($totalGastos * -1), 2, ',', '.'); ?></td>
					</tr>


					<thead>
						<tr>
							<td><strong>Lucro/perda no período:</strong></td>
							<td><strong><?php echo "R$ " . number_format(($totalCaixa + ($totalCompras * -1) + ($totalGastos 	* -1)), 2, ',', '.'); ?></strong></td>
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