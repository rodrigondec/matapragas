<br /><br />
<h2>Lista de Clientes</h2>
<?php 

echo '<table class=\'lista\'>
			<tr>
				<th>Nome</th>
				<th>Razao social</th>
				<th>Cnpj</th>
				<th>Endereço</th>
				<th>Ultima visita</th>
				<th>Proxima visita</th>
				<th>Status</th>
			</tr>';
	$clientes = select_all('clientes');
	foreach ($clientes as $cliente) {
		echo '<tr>
				<td>'.$cliente['nome'].'</td>
				<td>'.$cliente['razao_social'].'</td>
				<td>'.$cliente['cnpj'].'</td>
				<td>'.$cliente['endereco'].'</td>
				<td>'.data_ult_visita($cliente['id']).'</td>
				<td>'.data_prox_visita($cliente['id']).'</td>
				<td>'.$cliente['status'].'</td>';
		if($_SESSION['login'] == 'levi'){
			echo '
				<td><a href=\'/'.BASE.'/index.php/clientes/alterar/?id='.$cliente['id'].'\'>Alterar</a></td>
				<td><a href=\'/'.BASE.'/index.php/clientes/remover/?id='.$cliente['id'].'\'>Remover</a></td>
			  </tr>';
			}
		else {
			echo '</tr>';
		}
	}
echo '</table>';

?>

