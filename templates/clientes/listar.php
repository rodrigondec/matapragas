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
				<td>';
		if($cliente['status'] == 'contratado'){
				echo data_prox_visita($cliente['id']);
		}
		elseif($cliente['status'] == 'sob demanda'){
				echo reverter_data($cliente['data_proxima_visita']);
		}
				echo '</td>
				<td>'.$cliente['status'].'</td>';
		if($_SESSION['login'] == 'levi'){
			echo '
				<td><a href=\'/'.BASE.'/index.php/clientes/alterar/?id='.$cliente['id'].'\'>Alterar</a></td>
				<td><a href=\'/'.BASE.'/index.php/clientes/remover/?id='.$cliente['id'].'\'>Remover</a></td>';
			if ($cliente['status'] == 'sob demanda'){
				echo '<td><a href=\'/'.BASE.'/index.php/clientes/agendar_visita/?id='.$cliente['id'].'\'>Agendar/Editar Data de Visita</a></td></tr>';
			}
			else{
				echo '</tr>';
			}
		}
		else {
			echo '</tr>';
		}
	}
echo '</table>';
?>