<h2>Cadastrar Serviços</h2>


<form  class='form_padrao' method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
	<input name='id' type='hidden'/>
	<label><span>Data:</span><input type='date' name='data_execucao' required><br /></label>
	<label><span>Executor:</span> 
		<?php $sql = 'select * from funcionarios;';
			//Execute a query
			$resultado = mysql_query($sql);
			echo '<select name=\'funcionario_id\'>';
			//Enquanto fetch retornar algo diferente de nulo
			while ($funcionarios = mysql_fetch_assoc($resultado)) {
		?>
			<option value='<?php echo $funcionarios['id']?>'>
					<?php echo $funcionarios['nome']?>
			</option>';
			
		<?php
			}
			echo '</select>';
		?>

		<br /></label>
	<label><span>Cliente:</span>
		<?php $sql = 'select * from clientes;';
			//Execute a query
			$resultado = mysql_query($sql);
			echo '<select name=\'cliente_id\'>';
			//Enquanto fetch retornar algo diferente de nulo
			while ($clientes = mysql_fetch_assoc($resultado)) {
		?>
				<option value='<?php echo $clientes['id']?>'>
					<?php echo $clientes['nome']?>
				</option>';
		
		<?php
			}
			echo '</select>';

		?>


		<br /></label>
		<label><span>Tempo de Garantia:</span><input type='text' name='tempo_garantia' placeholder='Digite valor em meses'required><br /></label>
		<label><span>Observações:</span><input type='text' name='observacoes' required><br /></label>
		<label><span>Status:</span><select type='text' name='status' required>
			<option>Executado</option>
			<option>Agendado</option>
		</select><br /></label>



	<!--
	<label>Tipo de Serviço
		<?php 
			//$sql = 'select * from tipo_servico;';
			//Execute a query
			//$resultado// = mysql_query($sql);
				//echo '<select name=\'tipo_servico\'>';
				//Enquanto fetch retornar algo diferente de nulo
				//while ($tipo_servico = mysql_fetch_assoc($resultado)) {
		
				//	echo '<option>'.$tipo_servico['nome_servico'].'</option>';
			
			//	}
		//	echo '</select>';

		?>

	<br /></label>
		-->

	<button type='submit'>Cadastrar</button>
</form>

<?php 

	if (count($_POST) > 0){
		insert($_POST,'servico_tecnico');
		ob_clean();
		header('LOCATION: /'.BASE.'/index.php/servico/listar/');
		
	}

?>