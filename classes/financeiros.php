<?php 
	class financeiros{

	public function inserirCompra($dados){
		$c= new conectar();
		$conexao=$c->conexao();
		$ativo = 1;

		$sql="INSERT into compras (
									id_produto,
									id_fornecedor,
									quantidade,
									preco,
									dataCompra,
									id_usuario,
									ativo) 
							values (
								'$dados[0]',
								'$dados[1]',
								'$dados[2]',
								'$dados[3]',
								'$dados[4]',
								'$dados[5]',
								'$ativo')";
		return mysqli_query($conexao,$sql);
		}

	}
?>