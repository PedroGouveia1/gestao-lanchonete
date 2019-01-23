<?php 

class vendas{
	public function obterDadosProduto($idproduto){
		$c= new conectar();
		$conexao=$c->conexao();

		$sql="SELECT nome, quantidade, preco FROM produtos WHERE id_produto='$idproduto'";
		$result=mysqli_query($conexao,$sql);
		$ver=mysqli_fetch_row($result);

		$dados=array(
			'nome' => $ver[0],
			'quantidade' => $ver[1],
			'preco' => $ver[2]
		);		
		return $dados;
	}

	public function obterDadosVendas($idcliente){
		$c= new conectar();
		$conexao=$c->conexao();

		$sql="SELECT * FROM fiados WHERE id_cliente='$idcliente'";
		$result=mysqli_query($conexao,$sql);
		$ver=mysqli_fetch_row($result);

		$dados=array(
			'id_fiado' => $ver[0],
			'id_produto' => $ver[1],
			'quantidade' => $ver[2]
			'data' => $ver[3]
		);		
		return $dados;
	}

	public function criarVenda(){
		$c= new conectar();
		$conexao=$c->conexao();

		$data=date('Y-m-d');
		$dados=$_SESSION['tabelaComprasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;

		for ($i=0; $i < count($dados) ; $i++) { 
			$d=explode("||", $dados[$i]);

			$sql="INSERT into fiado (
										id_cliente,
										id_produto,
										quantidade,
										id_funcionario,
										data)
							values (
									'$d[6]',
									'$d[0]',
									'$d[5]',
									'$idusuario',
									'$data')";

			$r=$r + $result=mysqli_query($conexao,$sql);

		}

		return $r;



		/*$c= new conectar();
		$conexao=$c->conexao();

		$data=date('Y-m-d');
		$dados=$_SESSION['tabelaComprasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;

		for ($i=0; $i< count($dados); i++){
			$g=explode("||", $dados[$i]);
		}

		$sql="INSERT into fiado (
										id_cliente,
										id_funcionario,
										data)
							values (
									'$g[7]',
									'$idusuario',
									'$data')";

		$result=mysqli_query($conexao,$sql);

		$id_venda = mysqli_insert_id($conexao);

		for ($i=0; $i < count($dados) ; $i++) { 
			$d=explode("||", $dados[$i]);

			$fiado_produto = "INSERT INTO fiado_produto (
																		id_fiado,
																		id_produto,
																		quantidade)
															VALUES (
																		'$id_venda',
																		'$d[0]',
																		'$d[5]'
																	)"
	
			$r=$r + $result=mysqli_query($conexao,$fiado_produto);
		}

		return $result;*/
	}

	public function criarComprovante(){
		$c= new conectar();
		$conexao=$c->conexao();

		$sql="SELECT id_venda from vendas group by id_venda desc";

		$resul=mysqli_query($conexao,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}
	public function nomeCliente($idCliente){
		$c= new conectar();
		$conexao=$c->conexao();


		 $sql="SELECT sobrenome,nome 
			from clientes 
			where id_cliente='$idCliente'";
		$result=mysqli_query($conexao,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[1]." ".$ver[0];
	}

	public function obterTotal($idvenda){
		$c= new conectar();
		$conexao=$c->conexao();


		$sql="SELECT total_venda 
				from vendas 
				where id_venda='$idvenda'";
		$result=mysqli_query($conexao,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}
}

?>