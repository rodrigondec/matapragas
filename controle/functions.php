<?php 

	function data_ult_visita($id){
		$resultado = select('data_execucao', 'servico_tecnico', 'cliente_id', $id);
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
		$resultado = select('status', 'servico_tecnico', 'cliente_id', $id);
		if (isset($resultado['status'])){
			if ($resultado['status'] == 'agendado'){
				$tratamento_data = select('data_execucao', 'servico_tecnico', 'cliente_id', $id);
				$prox_data = reverter_data($tratamento_data['data_execucao']);
				return $prox_data;
			}
			else if ($resultado['status'] == 'executado'){
				$contrato = select('status', 'clientes', 'id', $id);
				if ($contrato['status'] == 'contratado'){
					$resultado = select('data_execucao', 'servico_tecnico', 'cliente_id', $id);
					$data_executada = reverter_data($resultado['data_execucao']);
					$prox_data = agendamento_para_executada($data_executada, $id);
					return $prox_data;
				}
				else {
					return 'nao agendada';
				}

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

	function agendamento_para_executada($dados, $id){
		$garantia_servico = select('tempo_garantia', 'servico_tecnico', 'cliente_id', $id);
		$garantia_int = $garantia_servico['tempo_garantia'];
		settype($garantia_int, 'int');
		$data_explode = explode('/', $dados);
		settype($data_explode[1], 'int');
		$data_explode[1] = ($data_explode[1]+$garantia_int);
		if ($data_explode[1] < 10){
			$data_final = $data_explode[0].'/0'.$data_explode[1].'/'.$data_explode[2];
			return $data_final;
		}
		else if ($data_explode[1] < 12 ){
			$data_final = $data_explode[0].'/'.$data_explode[1].'/'.$data_explode[2];
			return $data_final;
		}
		else{
			while($data_explode[1] > 12){
				settype($data_explode[2], 'int');
				$data_explode[1] = ($data_explode[1]-12);
				$data_explode[2] = ($data_explode[2]+1);
				$data_final = $data_explode[0].'/'.$data_explode[1].'/'.$data_explode[2];
				
			}
			return $data_final;
		}
	}

	function converter_data($dados){
        $str_tratamento = explode('/', $dados);
        $str_tratada = $str_tratamento[2].'-'.$str_tratamento[1].'-'.$str_tratamento[0];
        return $str_tratada;
    }

    function reverter_data($dados){
		$dados_explode = explode('-', $dados);
		$dados_tratado = $dados_explode[2].'/'.$dados_explode[1].'/'.$dados_explode[0];
		return $dados_tratado;
	}

    function definir_status($data){
    	$data_selecionada = strtotime($data);
    	$data_agora = strtotime(date('Y-m-d'));
    	if ($data_selecionada > $data_agora){
    		return 'agendado';
    	}
    	else if ($data_selecionada < $data_agora){
    		return 'executado';
    	}
    }

?>
