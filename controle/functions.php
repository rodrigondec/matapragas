<?php 

	function data_ult_visita($id){
		$sql = 'SELECT data_execucao from servico_tecnico WHERE cliente_id ='.$id.';';
        $query = mysql_query($sql);
        $resultado = mysql_fetch_assoc($query);
        if (isset($resultado['data_execucao'])){
			$data_execucao = strtotime($resultado['data_execucao']);
			$data_agora = strtotime(date('Y-m-d'));
			if ($data_execucao < $data_agora) {
				$ult_visita_tratamento = explode('-', $resultado['data_execucao']);
				$ultima_visita = $ult_visita_tratamento[2].'/'.$ult_visita_tratamento[1].'/'.$ult_visita_tratamento[0];
				return $ultima_visita;
			}
			else {
				return;
			}
		}
	}

	function requerer_usuario($tipo_usuario) {
		if(!($_SESSION['tipo_usuario'] == $tipo_usuario)){
			ob_clean();
			header('LOCATION: /'.BASE.'/index.php');
		}				
	}

	function converter_data($dados){
        $str_tratamento = explode('/', $dados);
        $str_tratada = $str_tratamento[2].'-'.$str_tratamento[1].'-'.$str_tratamento[0];
        return $str_tratada;
    }

    function definir_status($data){
    	$data_selecionada = strtotime($data);
    	$data_agora = strtotime(date('Y-m-d'));
    	if ($data_selecionada > $data_agora){
    		return 'Agendado';
    	}
    	else if ($data_selecionada < $data_agora){
    		return 'Executado';
    	}
    }

?>
