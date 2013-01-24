<?php 

	function data_ult_visita($id){
		$resultado = select('data_execucao', 'servico_tecnico', $id);
        if (isset($resultado['data_execucao'])){
			$data_execucao = strtotime($resultado['data_execucao']);
			$data_agora = strtotime(date('Y-m-d'));
			if ($data_execucao < $data_agora) {
				$ult_visita_tratamento = explode('-', $resultado['data_execucao']);
				$ultima_visita = $ult_visita_tratamento[2].'/'.$ult_visita_tratamento[1].'/'.$ult_visita_tratamento[0];
				return $ultima_visita;
			}
			else {
				return 'nao executada';
			}
		}
		else{
			return 'servico nao cadastrado';
		}
	}

	function data_prox_visita($id){
		$resultado = select('status', 'servico_tecnico', $id);
		if (isset($resultado['status'])){
			if ($resultado['status'] == 'agendado'){
				$tratamento_data = select('data_execucao', 'servico_tecnico', $id);
				$data_explode = explode('-', $tratamento_data['data_execucao']);
				$prox_data = $data_explode[2].'/'.$data_explode[1].'/'.$data_explode[0];
				return $prox_data;
			}
			else if ($resultado['status'] == 'executado'){

			}
		}
		else{
			return 'servico nao cadastrado';
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
