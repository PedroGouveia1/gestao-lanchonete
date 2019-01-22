<?php 

require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
?>


<h4>Vender produto</h4>
<div class="row">
	<div class="col-sm-4">

		<!-- Formulário de venda de produtos -->
		<form id="frmVendasProdutos">
			<label>Selecionar cliente</label>
			<select class="form-control input-sm" id="clienteVenda" name="clienteVenda">
				<?php
				$sql="SELECT id_cliente, nome FROM clientes WHERE ativo = 1 ORDER BY nome";
				$result=mysqli_query($conexao,$sql);
				while ($cliente=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $cliente[0] ?>"><?php echo $cliente[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Produto</label>
			<select class="form-control input-sm" id="produtoVenda" name="produtoVenda">
				<option value="0" disabled="" selected="">Selecione</option>
				<?php
				$sql="SELECT id_produto, nome	FROM produtos ORDER BY nome";
				$result=mysqli_query($conexao,$sql);

				while ($produto=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $produto[0] ?>"><?php echo $produto[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Quantidade em estoque</label>
			<input readonly="" type="text" class="form-control input-sm" id="quantidadeV" name="quantidadeV">
			<label>Preço</label>
			<input readonly="" type="text" class="form-control input-sm" id="precoV" name="precoV">
			<label>Quantidade</label>
			<input type="text" value="1" class="form-control input-sm" id="quantV" name="quantV">
			<p></p>
			<span class="btn btn-primary" id="btnAddVenda">Adicionar</span>
			<span class="btn btn-danger" id="btnLimparVendas">Limpar</span>
		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgProduto"></div>
	</div>
	<div class="col-sm-4">
		<div id="tabelaVendasTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");

		$('#produtoVenda').change(function(){

			$.ajax({
				type:"POST",
				data:"idproduto=" + $('#produtoVenda').val(),
				url:"../procedimentos/vendas/obterDadosProdutos.php",
				success:function(r){
					dado=jQuery.parseJSON(r);

					$('#quantidadeV').val(dado['quantidade']);
					$('#precoV').val(dado['preco']);
					
				}
			});
		});

		$('#btnAddVenda').click(function(){
			vazios=validarFormVazio('frmVendasProdutos');

			quant = 0;
			quantidade = 0;

			quant = $('#quantV').val();
			quantidade = $('#quantidadeV').val();



			if(parseInt(quant) > parseInt(quantidade)){
				alertify.alert("Quantidade inexistente em estoque!");
				quant = $('#quantV').val("");
				return false;
			}else{
				quantidade = $('#quantidadeV').val();
			}

			if(vazios > 0){
				alertify.alert("Preencha os campos.");
				return false;
			}

			dados=$('#frmVendasProdutos').serialize();
			$.ajax({
				type:"POST",
				data:dados,
				url:"../procedimentos/vendas/adicionarProdutoTemp.php",
				success:function(r){
					$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");

				}
			});
		});

		$('#btnLimparVendas').click(function(){

		$.ajax({
			url:"../procedimentos/vendas/limparTemp.php",
			success:function(r){
				$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">

	function editarP(dados){
		
		$.ajax({
			type:"POST",
			data:"dados=" + dados,
			url:"../procedimentos/vendas/editarEstoque.php",
			success:function(r){
				
				$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
				alertify.success("Estoque Atualizado com Sucesso!!");
			}
		});
	}


	function fecharP(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procedimentos/vendas/fecharProduto.php",
			success:function(r){
				$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
				alertify.success("Produto Removido com Sucesso!!");
			}
		});
	}

	function criarVenda(){
		$.ajax({
			url:"../procedimentos/vendas/criarVenda.php",
			success:function(r){

				if(r > 0){
					$('#tabelaVendasTempLoad').load("vendas/tabelaVendasTemp.php");
					$('#frmVendasProdutos')[0].reset();
					alertify.alert("Venda criada com sucesso!");
				}else if(r==0){
					alertify.alert("Não possui lista de vendas");
				}else{
					alertify.error("Venda não efetuada");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteVenda').select2();
		$('#produtoVenda').select2();

	});
</script>