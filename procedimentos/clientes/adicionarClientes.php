<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/clientes.php";

$idusuario = $_SESSION['iduser'];

$obj = new clientes();

$dados=array(
	$idusuario,
	$_POST['nome'],
	$_POST['sobrenome'],
	$_POST['setor'],
	$_POST['email'],
	$_POST['telefone'],
	$_POST['cpf'],
	$_POST['obs']
);

echo $obj->adicionarCliente($dados);

 ?>