
<?php 
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
	$sql="SELECT 	pr.nome,
								fo.nome,
								co.quantidade,
								(co.preco / co.quantidade),
								co.preco,
								co.dataCompra
						from compras as co 
						inner join produtos as pr
						on pr.id_produto=co.id_produto
						inner join fornecedores as fo
						on fo.id_fornecedor=co.id_fornecedor
						WHERE fo.ativo = 1
						ORDER BY co.dataCompra";
	$result=mysqli_query($conexao,$sql);

	

 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Produtos</label></caption>
	<tr>
		<td>Produto</td>
		<td>Fornecedor</td>
		<td>Quantidade</td>
		<td>Preço und.</td>
		<td>Preço total</td>
		<td>Data</td>
		<td>Editar</td>
		<td>Excluir</td>
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
			<span  data-toggle="modal" data-target="#abremodalUpdateProduto" class="btn btn-warning btn-xs" onclick="addDadosProduto('<?php echo $mostrar[4] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarProduto('<?php echo $mostrar[4] ?>', '<?php echo $mostrar[0] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>