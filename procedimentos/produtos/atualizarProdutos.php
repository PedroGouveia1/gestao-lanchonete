<?php 

	require_once "../../classes/conexao.php";
	require_once "../../classes/produtos.php";
	$preco = str_replace(",", ".", $_POST['precoU']);
	$obj= new produtos();

	$dados=array(
		$_POST['idProduto'],
		$_POST['categoriaSelectU'],
		$_POST['nomeU'],
		$_POST['quantidadeU'],
		$preco
	);

	  echo $obj->atualizar($dados);

 ?>