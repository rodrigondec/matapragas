<?php 

delete($_GET['id'],'clientes');	
ob_clean();
header('LOCATION: http://localhost/matapragas/index.php/clientes/listar/');

?>