
<?php 


require_once "../../classes/conexao.php";
	$c = new conectar();
	$conexao=$c->conexao();

	$sql = "SELECT id, nome, user, email, cantina, cargo FROM usuarios";
	$result = mysqli_query($conexao, $sql);

?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Usuários Cadastrados</label></caption>
	<tr>
			<td>Nome</td>
	 		<td>Usuário</td>
	 		<td>E-mail</td>
	 		<td>Cantina</td>
	 		<td>Cargo</td>
	 		<td>Editar</td>
			<td>Excluir</td>
	</tr>

	<?php
	while($mostrar = mysqli_fetch_row($result)):

		$cantina = "SELECT nome FROM cantinas WHERE id_cantina = $mostrar[4]";
		$nomeCantina = mysqli_query($conexao, $cantina);
		$exibirNomeCantina = mysqli_fetch_row($nomeCantina);

		$cargo = "SELECT nomeCargo FROM cargos WHERE id_cargo = $mostrar[5]";
		$nomeCargo = mysqli_query($conexao, $cargo);
		$exibirNomeCargo = mysqli_fetch_row($nomeCargo);

	?>

	<tr>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td><?php echo $mostrar[3]; ?></td>
		<td><?php echo $exibirNomeCantina[0]; ?></td>
		<td><?php echo $exibirNomeCargo[0]; ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalFornecedoresUpdate" onclick="adicionarDado('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminar('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>


<?php endWhile; ?>
</table>