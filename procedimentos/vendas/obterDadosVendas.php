<?php 
	
	require_once "../../classes/conexao.php";
	require_once "../../classes/vendas.php";

	$obj= new vendas();

	echo json_encode($obj->obterDadosCompras($_POST['idcliente']));

 ?>