
<?php 
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
 ?>

	<div class="row" style="margin-top: 1%;">
		<div class="col-sm-12" style="padding-left: 4%; padding-right: 4%;">
			<form id="frmBuscarCaixa" method="post"	action="caixa.php">
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
					<button class="btn btn-primary btn-block" type="submit" id="buscar" name="buscar">Buscar</button>
				</div>
				
			</form>	
		</div>
	</div>

	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Relatório de entrada de produtos</label></caption>
	<tr>
		<thead><tr>
		<td>Data</td>
		<td>Valor</td>
		<td>Editar</td>
		<!--<td>Excluir</td>-->
		</thead>
	</tr>

	<?php
		if(isset($_POST['de'])){
			$de = $_POST['de'];
			$ate = $_POST['ate'];
			echo $de;

			$sql="SELECT id_caixa, dataCaixa, valor, id_usuario FROM caixa WHERE dataCaixa BETWEEN '$de' AND '$ate' ORDER BY id_caixa desc";
			$result=mysqli_query($conexao,$sql);

			while($mostrar=mysqli_fetch_row($result)):
		
	?>

	<tr>
		<td><?php echo date("d/m/Y", strtotime($mostrar[1])) ?></td>
		<td>R$<?php echo number_format($mostrar[2], 2, ',', '.'); ?></td>

		<td>
			<span  data-toggle="modal" data-target="#abremodalUpdateCompra" class="btn btn-warning btn-xs" onclick="addDadosCaixa('<?php echo $mostrar[0] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<!--<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarProduto('<?php echo $mostrar[6] ?>', '<?php echo $mostrar[0] ?>', '<?php echo $mostrar[1] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>-->
		</td>
	</tr>
<?php endwhile; ?>
</table>

<?php } ?>


	