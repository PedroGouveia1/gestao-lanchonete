<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../classes/conexao.php";
	/*$c= new conectar();
	$conexao=$c->conexao();*/
	require_once "../../classes/financeiros.php";

	$preco = str_replace(",", ".", $_POST['preco']);
	$obj = new financeiros();

	/*$fornecedor = $_POST['fornecedorSelect'];

	$sql = "SELECT pro.quantidade
			FROM produtos as pro
			INNER JOIN compras as com
			on com.id_produto=pro.id_produto
			WHERE com.id_produto = '$fornecedor'";

	$result=mysqli_query($conexao,$sql);
	$estoqueAtual=mysqli_fetch_row($result)[0];*/

	$dados=array(
		$_POST['produtoSelect'],
		$_POST['fornecedorSelect'],
		$_POST['quantidade'],
		$preco,
		$_POST['dataCompra'],
		$iduser

	);

	echo $obj->inserirCompra($dados);
 ?>