
<?php 
	session_start();
	if(isset($_SESSION['usuario'])){


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Início</title>
	<?php require_once "menu.php" ?>

	<script type="text/javascript" src="../js/jquery.maskMoney.min.js" ></script>
		<script type="text/javascript">
				$(document).ready(function(){
					$("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
				});
		</script>

</head>
	<body>
		<div class="container" style="margin-top: 5px;">
			<div class="col-sm-4"></div>
			<div class="col-sm-4"></div>

			<div class="col-sm-4">
				<h3>Fechar caixa</h3>
				<form id="frmCaixa" enctype="multipart/form-data">
					<label for="produtoSelect">Data</label>
					<input class="form-control input-sm" type="date" name="dataCaixa" id="dataCaixa">
					<label>Valor</label>
					<input type="text" class="form-control input-sm dinheiro" id="preco" name="preco">
					<p></p>
					<span id="btnAddCaixa" class="btn btn-primary">Adicionar</span>
				</form>
			</div>
		</div>
	



<!--FECHAR CAIXA-->
<script type="text/javascript">
		$(document).ready(function(){
			$('#tabelaCaixaLoad').load("financeiros/tabelaCaixa.php");

			$('#btnAddCaixa').click(function(){

				vazios=validarFormVazio('frmCaixa');

				if(vazios > 0){
					alertify.alert("Preencha todos os campos!");
					return false;
				}

				var formData = new FormData(document.getElementById("frmCaixa"));

				$.ajax({
					url: "../procedimentos/financeiros/inserirCaixa.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){
						
						if(r == 1){
							$('#frmCaixa')[0].reset();
							$('#tabelaCaixaLoad').load("financeiros/tabelaCaixa.php");
							alertify.success("Adicionado com sucesso!");
						}else{
							alertify.error("Falha ao adicionar");
						}
					}
				});
				
			});
		});
	</script>

</body>
</html>
<?php 
} else{
	header("location:../index.php");
}

 ?>
