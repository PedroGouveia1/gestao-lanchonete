
<?php 
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
	$sql="SELECT id_gasto, descricao, valor, dataGasto FROM gastos_extras ORDER BY id_gasto desc";
	$result=mysqli_query($conexao,$sql);

	

 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Relatório de gastos extras</label></caption>
	<tr>
		<thead><tr>
		<td>Descrição</td>
		<td>Valor</td>
		<td>Data</td>
		<td>Editar</td>
		<!--<td>Excluir</td>-->
		</thead>
	</tr>

	<?php while($mostrar=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[1]; ?></td>
		<td>R$<?php echo number_format($mostrar[2], 2, ',', '.'); ?></td>
		<td><?php echo date("d/m/Y", strtotime($mostrar[3])) ?></td>
		<td>
			<span  data-toggle="modal" data-target="#abremodalUpdateCompra" class="btn btn-warning btn-xs" onclick="addDadosGasto('<?php echo $mostrar[0] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<!--<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarProduto('<?php echo $mostrar[6] ?>', '<?php echo $mostrar[0] ?>', '<?php echo $mostrar[1] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>-->
	</tr>
<?php endwhile; ?>
</table>