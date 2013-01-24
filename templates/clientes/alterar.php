<?php requerer_usuario('agendamento'); ?>
<br /><br />
<h2>Alterar Dados</h2>

<?php 
	echo '<table>
				<form action=\''.$_SERVER['PHP_SELF'].'?id='.$_GET['id'].' method=\'post\'>';
	$cliente = buscar_por_id('clientes',$_GET['id']);
?>
			    <tr>
					<td>Modifique o nome do cliente:</td>
					<td><input name='nome' value='<?php echo $cliente['nome']?>' required/></td>
				</tr>
				<tr>
					<td>Modifique a razao social do cliente:</td>
					<td><input name='razao_social' value='<?php echo $cliente['razao_social']?>' required/></td>
				</tr>
				<tr>
					<td>Modifique o cnpj do cliente:</td>
					<td><input name='cnpj' value='<?php echo $cliente['cnpj']?>' required/></td>
				</tr>
				<tr>
					<td>Modifique o endereco do cliente:</td>
					<td><input name='endereco' value='<?php echo $cliente['endereco']?>' required/></td>
				</tr>
				<tr>
					<td>Modifique o status do cliente:</td>
					<td><select name='status'>
							<option value='<?php echo 'contratado'; 
								if ($cliente['status'] == 'contratado'){
									echo 'selected';
								}
								echo '>Contratado</option>'?>
							<option value='<?php echo 'sob demanda';
								 if ($cliente['status'] == 'sob demanda'){
								 	echo 'selected';
								}
								echo '>Sob demanda</option>
							 selected>Sob Demanda</option>';?>
					</select></td>
				</tr>
				<tr>
					<td><button type='submit'>Enviar</button>
				</tr>
		</form>
	</table>

<?php

if (count($_POST) > 0){
		update($_POST, $_GET['id'], 'clientes');
		// ob_clean();
		// header('LOCATION: /'.BASE.'/index.php/clientes/listar/');
	}

?>