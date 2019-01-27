<?php 
	
	require_once "../../classes/conexao.php";
	require_once "../../classes/financeiros.php";

	$obj= new financeiros();

	$idcaixa=$_POST['idcaixa'];

	echo json_encode($obj->obterDadosCaixa($idcaixa));

?>