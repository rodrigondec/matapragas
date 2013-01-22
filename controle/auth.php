<?php 
	function requerer_usuario($tipo_usuario) {
		if(!($_SESSION['tipo_usuario'] == $tipo_usuario)){
			ob_clean();
			header('LOCATION: /'.BASE.'/index.php');
		}				
	}
?>
