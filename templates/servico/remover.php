	<?php 
		//include_once('templates/provas/listar.php');
		echo 'Codigo para remover serviço de id='.$_GET['id'].'.';

		delete($_GET['id'],'servico_tecnico');
		ob_clean();
		header('LOCATION: /'.BASE.'/index.php/servico/listar/');
	?>