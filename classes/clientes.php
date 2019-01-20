<?php 

class clientes{
	public function adicionarCliente($dados){
		$c = new conectar();
		$conexao=$c->conexao();
		$ativo = 1;

		$sql = "INSERT into clientes (id_usuario, nome, setor, email, telefone, cpf, obs, ativo) VALUES ('$dados[0]', '$dados[1]', 
		   '$dados[2]',
		   '$dados[3]',
			'$dados[4]',
			'$dados[5]',
			'$dados[6]',
			'$ativo')";

		return mysqli_query($conexao, $sql);
	}




	public function obterDadosCliente($idcliente){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_cliente, nome, setor, email, telefone, cpf, obs from clientes where id_cliente='$idcliente' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_cliente' => $mostrar[0],
				'nome' => $mostrar[1],
				'setor' => $mostrar[2],
				'email' => $mostrar[3],
				'telefone' => $mostrar[4],
				'cpf' => $mostrar[5],
				'obs' => $mostrar[6]
			);

			return $dados;

	}


	public function atualizarCliente($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "UPDATE clientes SET nome = '$dados[1]', setor = '$dados[2]', email = '$dados[3]', telefone = '$dados[4]', cpf = '$dados[5]', obs = '$dados[6]' where id_cliente = '$dados[0]'";


		echo mysqli_query($conexao, $sql);
	}


	public function excluirCliente($id){
		$c = new conectar();
		$conexao=$c->conexao();
		$ativo = 0;

		$sql = "UPDATE clientes SET ativo = '$ativo' where id_cliente = '$id' ";

		return mysqli_query($conexao, $sql);
	}

}

?>