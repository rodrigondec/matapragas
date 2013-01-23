<?php 

	function requerer_usuario($tipo_usuario) {
		if(!($_SESSION['tipo_usuario'] == $tipo_usuario)){
			ob_clean();
			header('LOCATION: /'.BASE.'/index.php');
		}				
	}

	function converterdata($dados){
        $str_tratamento = explode('/', $dados);
        $str_tratada = $str_tratamento[2].'-'.$str_tratamento[1].'-'.$str_tratamento[0];
        return $str_tratada;
    }
?>
