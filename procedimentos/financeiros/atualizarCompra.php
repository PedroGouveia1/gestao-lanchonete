<?php 

	require_once "../../classes/conexao.php";
	require_once "../../classes/financeiros.php";
	
	$preco = str_replace(",", ".", $_POST['precoU']);
	$obj= new financeiros();

	$dados=array(
		$_POST['idCompra'],
		$_POST['fornecedorSelectU'],
		$_POST['quantidadeU'],
		$preco
	);

	  echo $obj->atualizar($dados);

 ?>