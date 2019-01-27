
<?php 
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
	$sql="SELECT 	pr.nome,
					fo.nome,
					co.quantidade,
					(co.preco / co.quantidade),
					co.preco,
					co.dataCompra,
					co.id_compras
				from compras as co 
				inner join produtos as pr
				on pr.id_produto=co.id_produto
				inner join fornecedores as fo
				on fo.id_fornecedor=co.id_fornecedor
				WHERE co.ativo = 1
				ORDER BY co.dataCompra";
	$result=mysqli_query($conexao,$sql);

	

 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Relatório de entrada de produtos</label></caption>
	<tr>
		<thead><tr>
		<td>Produto</td>
		<td>Fornecedor</td>
		<td>Quantidade</td>
		<td>Preço und.</td>
		<td>Preço total</td>
		<td>Data</td>
		<td>Editar</td>
		<td>Excluir</td>
		</thead>
	</tr>

	<?php while($mostrar=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[0]; ?></td>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td>R$<?php echo number_format($mostrar[3], 2, ',', '.'); ?></td>
		<td>R$<?php echo number_format($mostrar[4], 2, ',', '.'); ?></td>
		<td><?php echo date("d/m/Y", strtotime($mostrar[5])) ?></td>

		<td>
			<span  data-toggle="modal" data-target="#abremodalUpdateCompra" class="btn btn-warning btn-xs" onclick="addDadosCompra('<?php echo $mostrar[6] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarProduto('<?php echo $mostrar[6] ?>', '<?php echo $mostrar[0] ?>', '<?php echo $mostrar[1] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>