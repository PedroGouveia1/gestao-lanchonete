<?php 
	class produtos{
		public function addImagem($dados){
			$c= new conectar();
			$conexao=$c->conexao();

			$data=date('Y-m-d');

			$sql="INSERT into imagens (id_categoria,
										nome,
										url,
										dataUpload)
							values ('$dados[0]',
									'$dados[1]',
									'$dados[2]',
									'$data')";
			$result=mysqli_query($conexao,$sql);

			return mysqli_insert_id($conexao);
		}

		public function inserirProduto($dados){
			$c= new conectar();
			$conexao=$c->conexao();
			$ativo = 1;
			$data=date('Y-m-d');

			$sql="INSERT into produtos (id_categoria,
										id_usuario,
										nome,
										quantidade,
										preco,
										dataCaptura,
										ativo) 
							values ('$dados[0]',
									'$dados[1]',
									'$dados[2]',
									'$dados[3]',
									'$dados[4]',
									'$data',
									'$ativo')";
			return mysqli_query($conexao,$sql);
		}



		public function obterDados($idproduto){
			$c= new conectar();
			$conexao=$c->conexao();

			$sql="SELECT id_produto, 
						id_categoria, 
						nome,
						quantidade,
						preco 
				from produtos 
				where id_produto='$idproduto'";
			$result=mysqli_query($conexao,$sql);

			$mostrar=mysqli_fetch_row($result);

			$dados=array(
					"id_produto" => $mostrar[0],
					"id_categoria" => $mostrar[1],
					"nome" => $mostrar[2],
					"quantidade" => $mostrar[3],
					"preco" => number_format($mostrar[4], 2, ',', '.')
						);

			return $dados;
		}

		public function atualizar($dados){
			$c= new conectar();
			$conexao=$c->conexao();

			$sql="UPDATE produtos set id_categoria='$dados[1]', 
										nome='$dados[2]',
										quantidade='$dados[3]',
										preco='$dados[4]'
						where id_produto='$dados[0]'";

			return mysqli_query($conexao,$sql);
		}



		public function excluir($idproduto){
			$c= new conectar();
			$conexao=$c->conexao();
			$ativo = 0;
			/*$idimagem=self::obterIdImg($idproduto);*/

			$sql="UPDATE produtos SET ativo = '$ativo' WHERE id_produto='$idproduto'";
			$result=mysqli_query($conexao,$sql);

			return mysqli_query($conexao,$sql);

		}

		/*public function obterIdImg($idProduto){
			$c= new conectar();
			$conexao=$c->conexao();

			$sql="SELECT id_imagem 
					from produtos 
					where id_produto='$idProduto'";
			$result=mysqli_query($conexao,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obterUrlImagem($idImg){
			$c= new conectar();
			$conexao=$c->conexao();

			$sql="SELECT url 
					from imagens 
					where id_imagem='$idImg'";

			$result=mysqli_query($conexao,$sql);

			return mysqli_fetch_row($result)[0];
		}*/

		
	}

 ?>