<?php 
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();

	require_once "../../classes/financeiros.php";
	
	$valor = str_replace(",", ".", $_POST['valorU']);
	$obj= new financeiros();


	$dados=array(
		$_POST['idGasto'],
		$_POST['descricaoU'],
		$valor,
		$_POST['dataGastoU']
	);

	  echo $obj->atualizarGasto($dados);

 ?>