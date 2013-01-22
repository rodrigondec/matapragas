<?php requerer_usuario('agendamento'); ?>
<br /><br />
<h2>Cadastrar Cliente</h2>
<table>
	<form action='<?php echo $_SERVER['PHP_SELF']?>' method='post'>
		<tr>
			<td>Digite o nome do cliente: </td>
			<td><input name='nome' required/></td>
		</tr>
		<tr>
			<td>Digite a razao social do cliente: </td>
			<td><input name='razao_social' required/></td>
		</tr>
		<tr>
			<td>Digite o nome o cnpj do cliente: </td>
			<td><input name='cnpj' placeholder='Ex: 12.123.123/124-12' required/></td>
		</tr>
		<tr>
			<td>Digite o endereco do cliente: </td>
			<td><input name='endereco' required/></td>
		</tr>
		<tr>
			<td>Selecione o status do cliente: </td>
			<td><select name='status'>
				<option value='contratado'>Contratado</option>
				<option value='sob demanda'>Sob Demanda</option>
			</select></td>
		</tr>
		<tr>
			<td><button type='submit'>Enviar</button>
		</tr>
	</form>
</table>

<?php 
	if (count($_POST) > 0){
		insert($_POST, 'clientes');
		ob_clean();
		header('LOCATION: /'.BASE.'/index.php/clientes/listar/');
	}
?>