<?php



    // conexão com banco
    $link = mysql_connect(DB_HOST, DB_USER, DB_PASS);
    if (!$link) {
        die('Erro de conexão com o banco de dados: '.mysql_error());
    } else if (isset($debug)) {
        echo '<p>Conectado ao banco com sucesso</p>';
    }
    mysql_select_db(DB_NAME);

    // função que executa SQL para insert
    // INSERT INTO $tabela ($chaves,...) VALUES ($valores)



    function insert($dados, $tabela) {
        $sql = 'INSERT INTO '.$tabela;
        $chaves = array();
        $valores = array();
        foreach ($dados as $chave => $valor) {
            $chaves[] = $chave;
            $valores[] = '\''.$valor.'\'';
        }
        $str_chaves = implode(',', $chaves);
        $str_valores = implode(',', $valores);

        $sql .= ' ('.$str_chaves.') VALUES ('.$str_valores.');';
        var_dump($sql);
        return mysql_query($sql);
    }

    // função que executa SQL para DELETE
    // DELETE FROM $tabela WHERE id=$id
    function delete($id, $tabela) {
        $sql = 'DELETE FROM '.$tabela.' WHERE id='.$id.';';
        return mysql_query($sql);
        // var_dump($sql);
    }

    // função que executa SQL para UPDATE
    // UPDATE $tabela SET $chave=$valor,... WHERE id=$id
    function update($dados, $id, $tabela) {
        $sql = 'UPDATE '.$tabela.' SET ';
        $alteracoes = array();
        foreach ($dados as $chave => $valor) {
          $alteracoes[] = $chave.'=\''.$valor.'\'';
        }
        $sql .= implode(', ', $alteracoes);
        $sql .= ' WHERE id='.$id.';';
        return mysql_query($sql);
    }

    // função que executa SQL para SELECT
    // SELECT * FROM $tabela
    function select_all($tabela){
        $sql = 'SELECT * from '.$tabela.';';
        $resultado = mysql_query($sql);
        if(!$resultado) return array();
        $objetos = array();
        while($row = mysql_fetch_assoc($resultado)){
            $objetos[] = $row;
        }
        return $objetos;
    }

    // Função que executa SQL para SELECT das provas
    // Também conta o número de questões associadas
    function select_provas(){
        $sql = 'SELECT P1.id id, P1.nome nome, 
                P1.data_alteracao data_alteracao, 
                count(P2.id) num_perguntas  
                FROM provas P1 LEFT JOIN perguntas P2 
                ON P1.id=P2.prova_id
                GROUP BY P1.id;';
        $resultado = mysql_query($sql);
        if(!$resultado) return array();
        $objetos = array();
        while($row = mysql_fetch_assoc($resultado)){
            $objetos[] = $row;
        }
        return $objetos;
    }

    // função que executa SQL para SELECT com WHERE
    // SELECT * FROM $tabela WHERE ID = $id
    function buscar_por_id($tabela, $id){
        $sql = 'SELECT * from '.$tabela.' WHERE id=\''.$id.'\' LIMIT 1;';
        $resultado = mysql_query($sql);
        return mysql_fetch_assoc($resultado);        
    }

    // Seleciona as tentativas de uma determinada prova
    function buscar_tentativas($prova_id) {
        $sql = 'SELECT T1.id, A1.nome from tentativas T1
        INNER JOIN alunos A1
        ON T1.aluno_id=A1.id
        WHERE T1.prova_id=\''.$prova_id.'\';';
        $resultado = mysql_query($sql);
        if(!$resultado) return array();
        $objetos = array();
        while($row = mysql_fetch_assoc($resultado)){
            $objetos[] = $row;
        }
        return $objetos;
    }

    // Seleciona as perguntas de uma determinada prova
    function buscar_perguntas($prova_id) {
        $sql = 'SELECT * from perguntas WHERE prova_id=\''.$prova_id.'\';';
        $resultado = mysql_query($sql);
        if(!$resultado) return array();
        $objetos = array();
        while($row = mysql_fetch_assoc($resultado)){
            $objetos[] = $row;
        }
        return $objetos;
    }

    function converterdata($dados){
        $str_tratamento = explode('/', $dados);
        $str_tratada = $str_tratamento[2].'-'.$str_tratamento[1].'-'.$str_tratamento[0];
        return $str_tratada;
    }

?>