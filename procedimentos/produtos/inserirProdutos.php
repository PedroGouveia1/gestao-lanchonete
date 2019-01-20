<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../classes/conexao.php";
	require_once "../../classes/produtos.php";

	$preco = str_replace(",", ".", $_POST['preco']);
	$obj = new produtos();

	$dados=array(
		$_POST['categoriaSelect'],
		$iduser,
		$_POST['nome'],
		$_POST['quantidade'],
		$preco

	);

	echo $obj->inserirProduto($dados);

 ?>