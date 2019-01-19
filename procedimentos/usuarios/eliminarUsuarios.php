<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/usuarios.php";

$id = $_POST['idusuario'];

$obj = new usuarios();
echo $obj->excluir($id);

?>