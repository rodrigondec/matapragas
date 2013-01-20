<br /><br />
<h2>Lista de Serviços</h2>

<?php

	$sql = 'select * from servico_tecnico;';
	$resultado = mysql_query($sql);
	echo '<table class=\'lista\'> 
		<tr>
			<th>Data Execução</th>
			<th>Executor</th>
			<th>Cliente</th>
			<th>Tempo de Garantia</th>
			<th>Observações</th>
			<th>Status</th>
			<th>Tipo de Serviços</th>
		</tr>';

	while ($servicos = mysql_fetch_assoc($resultado)) {
		$servicos['data_execucao']=implode("/",array_reverse(explode("-",$servicos['data_execucao'])));
			echo '<tr>
					<td>'.$servicos['data_execucao'].'</td>';
								
					//acessando o nome do funcionario
					$idFuncionario=$servicos['funcionario_id'];
					$sqlFuncionario = 'SELECT nome FROM funcionarios WHERE id='.$idFuncionario.';';
					$resultadoFuncionario = mysql_query($sqlFuncionario);
					$nomeFuncionario = mysql_fetch_assoc($resultadoFuncionario);
					echo 	'<td>'.$nomeFuncionario['nome'].'</td>';
			
					//acessando o nome do cliente
					$idCliente=$servicos['cliente_id'];
					$sqlCliente = 'SELECT nome FROM clientes WHERE id='.$idCliente.';';
					$resultadoCliente = mysql_query($sqlCliente);
					$nomeCliente = mysql_fetch_assoc($resultadoCliente);
					echo '<td>'.$nomeCliente['nome'].'</td>


					
					<td>'.$servicos['tempo_garantia'].' meses</td>
					<td>'.$servicos['observacoes'].'</td>
					<td>'.$servicos['status'].'</td>
					<td>'.$servicos['tipo_servico'].'</td>
					<td><a href=\'/'.BASE.'/index.php/servico/alterar/?id='.$servicos['id'].'\'>Alterar</a></td>
					<td><a href=\'/'.BASE.'/index.php/servico/remover/?id='.$servicos['id'].'\'>Remover</a></td>
				</tr>';
							
			}
			echo '</table>';
?>
