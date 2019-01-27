<?php 
	class financeiros{

	public function inserirCompra($dados){
		$c= new conectar();
		$conexao=$c->conexao();
		$ativo = 1;

		$atualizaEstoque = "UPDATE 	produtos
												SET 		quantidade = (quantidade + $dados[2])
												WHERE 	id_produto = '$dados[0]'";
		$result = mysqli_query($conexao,$atualizaEstoque);

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



		public function obterDados($idcompra){
			$c= new conectar();
			$conexao=$c->conexao();

			$sql="SELECT 	id_compras,
										id_produto,
										id_fornecedor,
										quantidade,
										preco
										FROM compras
										WHERE id_compras = '$idcompra'";
			$result=mysqli_query($conexao,$sql);

			$mostrar=mysqli_fetch_row($result);

			$dados=array(
					"id_compras" => $mostrar[0],
					"id_produto" => $mostrar[1],
					"id_fornecedor" => $mostrar[2],
					"quantidade" => $mostrar[3],
					"preco" => number_format($mostrar[4], 2, ',', '.')
					);

			return $dados;
		}


		public function atualizar($dados){
			$c= new conectar();
			$conexao=$c->conexao();

			$atualizaEstoque = "UPDATE 	produtos
													SET 		quantidade = (quantidade - $dados[5])
													WHERE 	id_produto = '$dados[4]'";
			$result = mysqli_query($conexao,$atualizaEstoque);

			$atualizaEstoque = "UPDATE 	produtos
													SET 		quantidade = (quantidade + $dados[2])
													WHERE 	id_produto = '$dados[4]'";
			$result = mysqli_query($conexao,$atualizaEstoque);

			$sql="UPDATE 	compras
						SET 		id_produto = '$dados[4]',
										id_fornecedor='$dados[1]',
										quantidade='$dados[2]',
										preco='$dados[3]'
						where 	id_compras='$dados[0]'";

			return mysqli_query($conexao,$sql);
		}



		public function excluir($idcompra){
			$c= new conectar();
			$conexao=$c->conexao();
			$ativo = 0;
			/*$idimagem=self::obterIdImg($idproduto);*/

			$sql="UPDATE compras SET ativo = '$ativo' WHERE id_compras='$idcompra'";
			$result=mysqli_query($conexao,$sql);

			return mysqli_query($conexao,$sql);

		}

	}
?>