<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../classes/conexao.php";
	require_once "../../classes/financeiros.php";

	$preco = str_replace(",", ".", $_POST['preco']);
	$obj = new financeiros();

	$dados=array(
		$_POST['dataCaixa'],
		$preco,
		$iduser

	);

	echo $obj->inserirCaixa($dados);
 ?>