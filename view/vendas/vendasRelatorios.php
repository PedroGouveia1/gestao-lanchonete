<?php 

	require_once "../../classes/conexao.php";
	require_once "../../classes/vendas.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$obj= new vendas();

	$sql="SELECT id_venda,
				dataCompra,
				id_cliente 
			from vendas group by id_venda";
	$result=mysqli_query($conexao,$sql); 
	?>

<div class="row" style="margin-top: 1%;">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<form id="frmBuscarVendas">
			<div class="form-group row">
				<label for="cliente" class="col-sm-1 col-form-label">Cliente: </label>
				<div class="col-sm-9">
					<select class="form-control input-group" id="cliente" name="cliente">
						<?php
							$sql="SELECT id_cliente, nome from clientes WHERE ativo = 1 ORDER BY nome;";
							$result=mysqli_query($conexao,$sql);
							while ($cliente=mysqli_fetch_row($result)):
						?>
						<option value="<?php echo $cliente[0] ?>"><?php echo $cliente[1];?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-sm-2">
					<button id="buscarVendas" class="btn btn-primary btn-xs">Buscar</button>
				</div>
			</div>
		</form>	
	</div>
</div>


<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div id="tabelaVendasIDLoad"></div> <!-- Carregar tabela de compras do cliente -->
		
	</div>
	<div class="col-sm-1"></div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tabelaVendasIDLoad').load("vendas/tabelaVendasID.php");

		$('#cliente').change(function(){

			$.ajax({
				type:"POST",
				data:"idcliente=" + $('#cliente').val(),
				url:"../procedimentos/vendas/obterDadosVendas.php",
				success:function(r){
					dado=jQuery.parseJSON(r);

					$('#descricaoV').val(dado['descricao']);

					$('#quantidadeV').val(dado['quantidade']);
					$('#precoV').val(dado['preco']);
					
					$('#imgProduto').prepend('<img class="img-thumbnail" id="imgp" src="' + dado['url'] + '" />');
					
				}
			});
		});
	}
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteRelatorio').select2();

	});
</script>