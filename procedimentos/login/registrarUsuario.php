<?php 

require_once "../../classes/conexao.php";
require_once "../../classes/usuarios.php";


$obj = new usuarios();

$senha = sha1($_POST['senha']);

$dados=array(
	$_POST['nome'],
	$_POST['usuario'],
	$_POST['email'],
	$senha,
	$_POST['cantina'],
	$_POST['cargo']
	

);

echo $obj->registroUsuario($dados);

 ?>