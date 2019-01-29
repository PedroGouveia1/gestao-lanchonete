<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../classes/conexao.php";
	require_once "../../classes/financeiros.php";

	$valor = str_replace(",", ".", $_POST['valor']);
	$obj = new financeiros();


	$dados=array(
		$_POST['descricao'],
		$valor,
		$iduser,
		$_POST['dataGasto']

	);

	echo $obj->inserirGastosExtras($dados);
 ?>