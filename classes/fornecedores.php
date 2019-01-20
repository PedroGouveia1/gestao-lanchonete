<?php 

class fornecedores{
	public function adicionar($dados){
		$c = new conectar();
		$conexao=$c->conexao();
		$ativo = 1;

		$sql = "INSERT into fornecedores (id_usuario, nome, endereco, email, telefone, obs, ativo) VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$dados[4]', '$dados[5]', '$ativo')";

		return mysqli_query($conexao, $sql);
	}




	public function obterDados($id){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_fornecedor, nome, endereco, email, telefone, obs from fornecedores where id_fornecedor='$id' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_fornecedor' => $mostrar[0],
				'nome' => $mostrar[1],
				'endereco' => $mostrar[2],
				'email' => $mostrar[3],
				'telefone' => $mostrar[4],
				'obs' => $mostrar[5],
			);

			return $dados;

	}


	public function atualizar($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "UPDATE fornecedores SET nome = '$dados[1]', endereco = '$dados[2]', email = '$dados[3]', telefone = '$dados[4]', obs = '$dados[5]' where id_fornecedor = '$dados[0]'";

		echo mysqli_query($conexao, $sql);
	}


	public function excluir($id){
		$c = new conectar();
		$conexao=$c->conexao();
		$ativo = 0;
		

		$sql = "UPDATE fornecedores SET ativo = '$ativo' WHERE id_fornecedor = '$id'; ";

		return mysqli_query($conexao, $sql);
	}

}

?>