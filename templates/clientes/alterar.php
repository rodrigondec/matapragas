<br /><br />
<?php 

echo '<table>
			<form action=\''.$_SERVER['PHP_SELF'].'?id='.$_GET['id'].'\' method=\'post\'>';
$cliente = buscar_por_id('clientes',$_GET['id']);
		echo    '<tr>
					<td>Modifique o nome do cliente: </td>
					<td><input name=\'nome\' value=\''.$cliente['nome'].'\' required/></td>
				</tr>
				<tr>
					<td>Modifique a razao social do cliente: </td>
					<td><input name=\'razao_social\' value=\''.$cliente['razao_social'].'\' required/></td>
				</tr>
				<tr>
					<td>Modifique o cnpj do cliente: </td>
					<td><input name=\'cnpj\' value=\''.$cliente['cnpj'].'\' required/></td>
				</tr>
				<tr>
					<td>Modifique o endereco do cliente: </td>
					<td><input name=\'endereco\' value=\''.$cliente['endereco'].'\' required/></td>
				</tr>
				<tr>
					<td>Modifique o status do cliente: </td>
					<td><select name=\'status\'>
							<option value=\'contratado\''; 
								if ($cliente['status'] == 'contratado'){
									echo 'selected';
								}
		echo 							'>Contratado</option>
							<option value=\'sob demanda\'';
								 if ($cliente['status'] == 'sob demanda'){
								 	echo 'selected';
								}
		echo 							'>Sob demanda</option>
							 selected>Sob Demanda</option>
					</select></td>
				</tr>
				<tr>
					<td><button type=\'submit\'>Enviar</button>
				</tr>';
echo '		</form>
	</table>';


if (count($_POST) > 0){
		update($_POST, $_GET['id'], 'clientes');
		ob_clean();
		header('LOCATION: http://localhost/matapragas/index.php/clientes/listar/');
	}

?>