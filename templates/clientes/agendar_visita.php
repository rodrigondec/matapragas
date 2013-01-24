<?php requerer_usuario('agendamento'); ?>
<br /><br />
<h2>Agendar Visita Para 
	<?php $nome = select('nome', 'clientes', 'id', $_GET['id']);
	echo $nome['nome'];
	?>
</h2>

<table>
	<form action='' method='post'>
		<tr>
			<td>Selecione uma data para agendar:</td>
			<td><input type='date' name='data_proxima_visita' required /></td>
		</tr>
		<tr>
			<td><button type='submit'>Enviar</button></td>
		</tr>
	</form>
</table>

<?php  
    if (count($_POST) > 0){
    	update($_POST, $_GET['id'], 'clientes');
		ob_clean();
		header('LOCATION: /'.BASE.'/index.php/clientes/listar/');
    }
?>