<?php 
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();

	require_once "../../classes/financeiros.php";
	
	$preco = str_replace(",", ".", $_POST['precoU']);
	$obj= new financeiros();

	$idCompra = $_POST['idCompra'];

	$sql = "SELECT quantidade
			FROM compras
			WHERE id_compras = '$idCompra'";

	$result=mysqli_query($conexao,$sql);
	$quantidadeAntiga=mysqli_fetch_row($result)[0];

	$dados=array(
		$_POST['idCompra'],
		$_POST['fornecedorSelectU'],
		$_POST['quantidadeU'],
		$preco,
		$_POST['produtoSelectU'],
		$quantidadeAntiga
	);

	  echo $obj->atualizar($dados);

 ?>