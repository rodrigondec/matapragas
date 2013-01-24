<?php requerer_usuario('agendamento'); ?>
<br /><br />

<h2>Cadastrar Serviços</h2>

<table>
	<form  class='form_padrao' method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
		<tr>
			<td>Data:</td>
			<td><input type='date' name='data_execucao' required/></td>
		</tr>
		<tr>
			<td>Executor:</td> 
			<td><?php $sql = 'select * from funcionarios;';
				//Execute a query
				$resultado = mysql_query($sql);
				echo '<select name=\'funcionario_id\'>';
				//Enquanto fetch retornar algo diferente de nulo
				while ($funcionarios = mysql_fetch_assoc($resultado)) {
			?>
				<option value='<?php echo $funcionarios['id']?>'>
						<?php echo $funcionarios['nome'];?>
				</option>';
				
			<?php } echo '</select>';?>
			</td>
		</tr>
		<tr>
			<td>Cliente:</td>
			<td><?php $sql = 'select * from clientes;';
				$resultado = mysql_query($sql);
				echo '<select name=\'cliente_id\'>';
				while ($clientes = mysql_fetch_assoc($resultado)):
					// esse IF Retira os clientes q ja possuem servicos cadastrados do option.
					if ($clientes['id'] == buscar_id_servico($clientes['id'])){	
					}
					else {
					?>
					<option value='<?php echo $clientes['id']?>'>
						<?php echo $clientes['nome']?>
					</option>
			<?php }endwhile;
			echo '</select>';
			?>
			</td>
		</tr>
		<tr>
			<td>Tempo de Garantia:</td><td><input type='text' name='tempo_garantia' placeholder='Digite valor em meses'required/></td>
		</tr>
		<tr>
			<td>Observações:</td><td><input type='text' name='observacoes' required/></td>
		</tr>
		<tr>
			<td hidden>Status:</td>
			<td hidden><select type='text' name='status' >
					<option>Executado</option>
					<option>Agendado</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Tipo de Serviço/Praga:</td>
			<td><input type='checkbox' name='tipo_servico[]' value='rato' />Rato
				<input type='checkbox' name='tipo_servico[]' value='barata' />Barata
				<input type='checkbox' name='tipo_servico[]' value='formiga' />Formiga
				<input type='checkbox' name='tipo_servico[]' value='escorpiao' />Escorpiao
			<td>
		</tr>
		<tr><td><button type='submit'>Cadastrar</button></td></tr>
	</form>
</table>
<?php 
	if (count($_POST) > 0){
		$_POST['status'] = definir_status($_POST['data_execucao']);
		$_POST['funcionario_id'] = (int)$_POST['funcionario_id'];
		$_POST['cliente_id'] = (int)$_POST['cliente_id'];
		insert($_POST,'servico_tecnico');
		ob_clean();
		header('LOCATION: /'.BASE.'/index.php/servico/listar/');
	}
?>