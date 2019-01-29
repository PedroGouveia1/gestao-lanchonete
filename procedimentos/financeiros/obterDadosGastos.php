<?php 
	
	require_once "../../classes/conexao.php";
	require_once "../../classes/financeiros.php";

	$obj= new financeiros();

	$idgasto=$_POST['idgasto'];

	echo json_encode($obj->obterDadosGastos($idgasto));

?>