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
            if ($chave == 'tipo_servico'){
                $valor = implode(', ', $valor);
            }
            $chaves[] = $chave;
            $valores[] = '\''.$valor.'\'';
        }
        $str_chaves = implode(',', $chaves);
        $str_valores = implode(',', $valores);

        $sql .= ' ('.$str_chaves.') VALUES ('.$str_valores.');';
        // var_dump($sql);
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
            if ($chave == 'tipo_servico'){
                $valor = implode(', ', $valor);
            }
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


    // função que executa SQL para SELECT com WHERE
    // SELECT * FROM $tabela WHERE ID = $id
    function buscar_por_id($tabela, $id){
        $sql = 'SELECT * from '.$tabela.' WHERE id=\''.$id.'\' LIMIT 1;';
        $resultado = mysql_query($sql);
        return mysql_fetch_assoc($resultado);        
    }

    function buscar_id_servico($id){
        $sql = 'SELECT cliente_id from servico_tecnico WHERE cliente_id='.$id.';';
        $resultado = mysql_query($sql);
        $tratamento = mysql_fetch_assoc($resultado);
        $tratado = $tratamento['cliente_id'];
        return $tratado;
    }

    function select($campo, $tabela, $restricao, $id){
        $sql = 'SELECT '.$campo.' from '.$tabela.' WHERE '.$restricao.' = '.$id.';';
        $query = mysql_query($sql);
        $resultado = mysql_fetch_assoc($query);
        return $resultado;
    }

?>