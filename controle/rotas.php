<?php
    include_once('globais.php');

    function montar_include($pasta, $arquivo) {
        return TEMPLATES.'/'.$pasta.'/'.$arquivo.'.php';
    }

    function mostrar_conteudo() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('?', $uri); //Separando URI dos Parametros Get
        $uri = $uri[0]; //Apenas URI (ignorando Parametros Get)
        $uri = rtrim($uri, '/'); //Removendo última barra da URI
        $partes = explode('/', $uri);

        if(count($partes) >= 5) { //Tenha mais de 5 partes
            $arquivo = array_pop($partes); //Último elemento
            $pasta = array_pop($partes); //Penúltimo elemento
        } else {
            if ($_SESSION['login'] == 'levi'){
                $pasta = 'servico';
                $arquivo = 'listar';
            } 
            elseif ($_SESSION['login'] == 'rodrigo') {
                $pasta = 'estoque';
                $arquivo = 'listar';
            }   
        }    
        $caminho = montar_include($pasta, $arquivo);
        include_once($caminho);
    }
?>





