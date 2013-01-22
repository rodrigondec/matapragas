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
				<td>'.$cliente['data_ultima_visita'].'</td>
				<td>'.$cliente['data_proxima_visita'].'</td>
				<td>'.$cliente['status'].'</td>
				<td><a href=\'/'.BASE.'/index.php/clientes/alterar/?id='.$cliente['id'].'\'>Alterar</a></td>
				<td><a href=\'/'.BASE.'/index.php/clientes/remover/?id='.$cliente['id'].'\'>Remover</a></td>
			  </tr>';
	}
echo '</table>';

?>

