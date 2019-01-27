<?php 
	
	require_once "../../classes/conexao.php";
	require_once "../../classes/financeiros.php";

	$obj= new financeiros();

	$idcompra=$_POST['idcompra'];

	echo json_encode($obj->obterDados($idcompra));

?>