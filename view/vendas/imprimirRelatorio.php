

<?php 
	require_once "../../classes/conexao.php"; 
	$c= new conectar();
	$conexao=$c->conexao();

	$de = $_POST['de'];
	$ate = $_POST['ate'];
	$id = $_POST['id'];
	$html = '<table class="table table-condensed table-bordered" style="text-align: center";>';
	$html .= '<thead style="font-weight: bold">';
	$html .= '<tr>';
	$html .= '<td>#</td>';
	$html .= '<td>Data</td>';
	$html .= '<td>Produto</td>';
	$html .= '<td>Qtd</td>';
	$html .= '<td>Preço Unitário</td>';
	$html .= '<td>Total</td>';
	$html .= '</tr>';
	$html .= '</thead>';


	$nome = "SELECT nome FROM clientes WHERE id_cliente = '$id'";
	$nomeq = mysqli_query($conexao, $nome);
	$nomeCliente=mysqli_fetch_row($nomeq)[0];

	$sql = "SELECT 	fi.id_fiado,
									fi.data,
									cl.nome,
									pr.nome,
									pr.preco,
									fi.quantidade,
									pr.preco * fi.quantidade as total
									FROM fiado AS fi
									INNER JOIN clientes AS cl ON fi.id_cliente = cl.id_cliente
									INNER JOIN produtos AS pr ON fi.id_produto = pr.id_produto
									WHERE fi.id_cliente = '$id' and data BETWEEN '$de' AND '$ate'
									ORDER BY fi.data";
	$result=mysqli_query($conexao,$sql);
	$total = 0;
		$html .= '<tbody>';
	while($row=mysqli_fetch_row($result)):
		$total = $total + $row[6];
		$html .= '<tr><td>'.$row[0] . "</td>";
		$html .= '<td>'.$row[1] . "</td>";
		$html .= '<td>'.$row[3] . "</td>";
		$html .= '<td>'.$row[5] . "</td>";
		$html .= '<td> R$ '.number_format($row[4], 2, ',', '.') . "</td>";
		$html .= '<td> R$ '.number_format($row[6], 2, ',', '.') . "</td></tr>";
		$html .= '</tbody>';
	endwhile;
	$html .= '<tr>';
	$html .= '<td colspan="5"><strong>TOTAL</strong></td>';
	$html .= '<td>'."R$ ". number_format($total, 2, ',', '.') .'</td>';
	$html .= '</tr>';
	$html .= '</tbody>';
	$html .= '</table>';
	
	//referenciar o DomPDF com o namespace (evita conflito entre nomes)
	use Dompdf\Dompdf;
	
	//include autoloader
	require_once '../../lib/dompdf/autoload.inc.php';

	//iniciando a instância DOMPDF
	$relatorio = new DOMPDF();

	$de = date("d/m/Y", strtotime($de));
	$ate = date("d/m/Y", strtotime($ate));
	$relatorio->load_html('
		<link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.css">
		<script type="text/javascript" src="../../lib/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>

		<h4 align="center">Relatório de consumo ('.$nomeCliente.' - de '.$de.' até '.$ate.')</h4>
		' . $html . '
	');

	//renderizar o html
	$relatorio->render();

	//exibir a página
	$relatorio->stream(
		"relatorio_vendas.pdf",
		array(
			"Attachment" => false //Para não baixar automaticamente
		)
	);
?>

