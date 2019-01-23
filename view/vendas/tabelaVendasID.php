<div class="table-responsive" style="margin-top: 1%;">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<!--<caption><label>Vendas</label></caption>-->
		<tr>
			<td>Código</td>
			<td>Data</td>
			<td>Produto</td>
			<td>Quantidade</td>
			<td>Total</td>
			<td>Relatório</td>
		</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
		<tr>
			<td><?php echo $ver[0] ?></td>
			<td><?php echo date("d/m/Y", strtotime($ver[1])) ?></td>
			<td>
				<?php
					if($obj->nomeCliente($ver[2])==" "){
						echo "S/C";
					}else{
						echo $obj->nomeCliente($ver[2]);
					}
				 ?>
			</td>
			<td>
				<?php 
					echo "R$ ".$obj->obterTotal($ver[0]). ",00";
				 ?>
			</td>
			<td>
				<a href="../procedimentos/vendas/criarComprovantePdf.php?idvenda=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
					Comprovante <span class="glyphicon glyphicon-list-alt"></span>
				</a>
			</td>
			<td>
				<a href="../procedimentos/vendas/criarRelatorioPdf.php?idvenda=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
					Relatório <span class="glyphicon glyphicon-file"></span>
				</a>	
			</td>
		</tr>
	<?php endwhile; ?>
	</table>
</div>