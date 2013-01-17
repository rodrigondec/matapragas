<h2>Alterar Serviço</h2>

	<?php 
 
		$sql = 'SELECT * FROM servico_tecnico WHERE id='.$_GET['id'].';';
		$resultado = mysql_query($sql);
		$servicos = mysql_fetch_assoc($resultado);

	?>




	<form method='POST' action='matapragas/index.php/servico/alterar/?id=<?php echo $_GET['id'] ?>'>
		<input name='id' value='<?php echo $_GET['id']; ?>' type='hidden'/>
		<label>Data:<input type='text' name='data_execucao' 
						value='<?php 
									$servicos['data_execucao']=implode("/",array_reverse(explode("-",$servicos['data_execucao'])));
									echo $servicos['data_execucao'] 
								?>' required><br />
		</label>

		<label>Executor: 
		<?php 
			$sql = 'select * from funcionarios;';
			//Execute a query
			$resultado = mysql_query($sql);
			echo '<select name=\'funcionario_id\' >';
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
		<br />
		</label>

		<label>Cliente: 
			<?php $sql = 'select * from clientes;';
			//Execute a query
			$resultado = mysql_query($sql);
			echo '<select name=\'cliente_id\' value=\'<?php echo $servicos[\'cliente_id\']?>\'>';
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
		<br />
		</label>

		<label>Tempo de Garantia:<input type='text' name='tempo_garantia'value='<?php echo $servicos['tempo_garantia'] ?>' required>meses<br /></label>
		<label>Observações:<input type='text' name='observacoes' value='<?php echo $servicos['observacoes'] ?>' required><br /></label>
		
		<button type='submit'>Alterar Cadastro</button>

	</form>

	<?php 


		if(count($_POST) > 0){
				$_POST['data_execucao']=converteData($_POST['data_execucao']);
				update($_POST,$_POST['id'],'servico_tecnico');
				ob_clean();
				header('LOCATION: /'.BASE.'/index.php/servico/listar/');
		}
	?>

		
		





