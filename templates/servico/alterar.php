<h2>Alterar Serviço</h2>

<?php 
	$sql = 'SELECT * FROM servico_tecnico WHERE id='.$_GET['id'].';';
	$resultado = mysql_query($sql);
	$servicos = mysql_fetch_assoc($resultado);
?>
<table>
	<form method='POST' action='matapragas/index.php/servico/alterar/?id=<?php echo $_GET['id'] ?>'>
		<tr>
			<td>Modifique a data:</td>
			<td><input type='text' name='data_execucao' value=
				<?php 
					echo '\'';
					$servicos['data_execucao']=implode("/",array_reverse(explode("-",$servicos['data_execucao'])));
					echo trim($servicos['data_execucao'],'\t').'\'';
				?>
				required>
			</td>
		</tr>
		<tr>
			<td>Modifique o executor:</td> 
			<td>
			<select name='funcionario_id'>
			<?php 
				$sql = 'select * from funcionarios;';
				$resultado = mysql_query($sql);
				while ($funcionarios = mysql_fetch_assoc($resultado)):
			?>
				<option value='<?php echo $funcionarios['id']?>'>
				<?php echo $funcionarios['nome']?>
				</option>';
				<?php endwhile; ?>
			</select>
			</td>
		</tr>
		<tr>
			<td>Modifique o cliente:</td>
			<td>
			<select name='cliente_id' value='<?php echo $servicos['cliente_id']?>'>
			<?php
				$sql = 'select * from clientes;';				
				$resultado = mysql_query($sql);
				echo '';
				while ($clientes = mysql_fetch_assoc($resultado)):
			?>
				<option value='<?php echo $clientes['id']?>'>
				<?php echo $clientes['nome']?>
				</option>';	
				<?php endwhile; ?>
			</select>
			</td>
		</tr>
		<tr>
			<td class='form'>Tempo de Garantia (em meses):</td>
			<td><input type='text' name='tempo_garantia'value='<?php echo $servicos['tempo_garantia'] ?>' required></td>
		<tr>
			<td>Observações:</td>
			<td><input type='text' name='observacoes' value='<?php echo $servicos['observacoes'] ?>' required></td>
		</tr>
		<tr>
			<td>Modifique o status:</td>
			<td>
			<select name='status'>
			<?php
				$sql = 'SELECT status from servico_tecnico';
				$resultado = mysql_query($sql);
				$tratamento = mysql_fetch_assoc($resultado);
				$status = $tratamento['status'];				
		echo 	'<option value=\'executado\''; 
					if ($status == 'executado'){
					echo 'selected';
			}
		echo 	'>executado</option>
				<option value=\'agendado\'';
					if ($status == 'agendado'){
				 	echo 'selected';
			}
		echo 	'>agendado</option>
			</select></td>';?>
		<tr>
			<td>Tipo de Serviço/Praga:</td>
			<td><input type='checkbox' name='tipo_servico[]' value='rato' 
					<?php
						$sql = 'SELECT tipo_servico from servico_tecnico WHERE id=\''.$_GET['id'].'\'';
						$resultado = mysql_query($sql);
						$distratada = mysql_fetch_assoc($resultado);
						$tratamento = $distratada['tipo_servico'];
						$tipo_servico = explode(', ', $tratamento);
						foreach ($tipo_servico as $value) {
							if ($value == 'rato'){
								echo 'checked';
							}
						}
					?>
				/>Rato
				<input type='checkbox' name='tipo_servico[]' value='barata' 
					<?php
						$sql = 'SELECT tipo_servico from servico_tecnico WHERE id=\''.$_GET['id'].'\'';
						$resultado = mysql_query($sql);
						$distratada = mysql_fetch_assoc($resultado);
						$tratamento = $distratada['tipo_servico'];
						$tipo_servico = explode(', ', $tratamento);
						foreach ($tipo_servico as $value) {
							if ($value == 'barata'){
								echo 'checked';
							}
						}
					?>
				/>Barata
				<input type='checkbox' name='tipo_servico[]' value='formiga' 
					<?php
						$sql = 'SELECT tipo_servico from servico_tecnico WHERE id=\''.$_GET['id'].'\'';
						$resultado = mysql_query($sql);
						$distratada = mysql_fetch_assoc($resultado);
						$tratamento = $distratada['tipo_servico'];
						$tipo_servico = explode(', ', $tratamento);
						foreach ($tipo_servico as $value) {
							if ($value == 'formiga'){
								echo 'checked';
							}
						}
					?>
				/>Formiga
				<input type='checkbox' name='tipo_servico[]' value='escorpiao' 
					<?php
						$sql = 'SELECT tipo_servico from servico_tecnico WHERE id=\''.$_GET['id'].'\' LIMIT 1';
						$resultado = mysql_query($sql);
						$distratada = mysql_fetch_assoc($resultado);
						$tratamento = $distratada['tipo_servico'];
						$tipo_servico = explode(', ', $tratamento);
						foreach ($tipo_servico as $value) {
							if ($value == 'escorpiao'){
								echo 'checked';
							}
						}
					?>
				/>Escorpiao
			<td>
		</tr>
		<tr>
			<td><button type='submit'>Alterar Cadastro</button></td>
		</tr>
	</form>
</table>

<?php 

	if(count($_POST) > 0){
		$_POST['data_execucao'] = converterdata($_POST['data_execucao']);
		update($_POST,$_GET['id'],'servico_tecnico');
		ob_clean();
		header('LOCATION: /'.BASE.'/index.php/servico/listar/');
	}

?>