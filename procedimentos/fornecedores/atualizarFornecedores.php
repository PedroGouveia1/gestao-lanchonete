<?php 

require_once "../../classes/conexao.php";
require_once "../../classes/fornecedores.php";

$obj = new fornecedores();

$dados=array(
	$_POST['idfornecedorU'],
	$_POST['nomeU'],
	$_POST['enderecoU'],
	$_POST['emailU'],
	$_POST['telefoneU'],
	$_POST['obsU']
);

echo $obj->atualizar($dados);

?>