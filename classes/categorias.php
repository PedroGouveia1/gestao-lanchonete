<?php 

class categorias{
	public function adicionarCategoria($dados){
		$c = new conectar();
		$conexao=$c->conexao();
		$ativo = 1;

		$sql = "INSERT into categorias (id_usuario, nome_categoria, dataCaptura, ativo) VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$ativo')";

		return mysqli_query($conexao, $sql);
	}


	public function atualizarCategoria($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "UPDATE categorias SET nome_categoria = '$dados[1]' where id_categoria = '$dados[0]'";

		echo mysqli_query($conexao, $sql);
	}


	public function excluirCategoria($idcategoria){
		$c = new conectar();
		$conexao=$c->conexao();
		$ativo = 0;

		$sql = "UPDATE categorias SET ativo = '$ativo' WHERE id_categoria = '$idcategoria' ";

		return mysqli_query($conexao, $sql);
	}

}

?>