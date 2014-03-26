<?php
class FuncaoComuns {


    public function paginacao($limit, $lista, $order, $linkPagina){
        $order = 0;
        $tamanho = sizeof($lista);
        $pagina = (isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1);
        for($i = 0; $i < $limit; $i++){
            echo $lista[$i][0];
            echo $lista[$i][1];
        }
        $totalPagina = ceil($tamanho/$limit);
        if ($totalPagina > 1) {
        ?><a href="<? echo $linkPagina; ?>&pagina=1">Primeira Página</a><?
            for($i = 1; $i <= $totalPagina; $i++){
                if($i == $pagina){
                    echo $i . '';
                }else{?>
                        <a href="<? echo $linkPagina; ?>&pagina=<?echo $i;?>"><?echo $i;?></a><?
                }
            }
        ?><a href="<? echo $linkPagina; ?>&pagina=<?echo $totalPagina;?>">Última Página</a><?
        }
    }

    public function paginator($table, $limit, $order, $linkPagina){
        $order = 0;
        $quantidade = $limit;
        // Verificando se existe $_GET['pagina'], caso não exista atribuimos o valor 1 a ele
        $pagina = (isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1);
        // Fazendo um conta para saber apartir de qual registro ira começar a paginação
        $inicio = ($quantidade * $pagina) - $quantidade;
        $query = "SELECT * FROM `{$table}` ORDER BY id ASC LIMIT $inicio, $quantidade";

        // executamos a query
        $sql = mysql_query($query) or die(mysql_error());

        while ($result = mysql_fetch_assoc($sql)){
            echo $result['id'];
            echo $result['ds_titulo'];
        }
        //$resultTotalRows = mysql_num_rows($resultRows);

        // Agora precisamos verificar a quantidade de registros
        // Montamos a query
        $sqlTotal    = "SELECT id FROM ". $table;

        // Executamos a query
        $qrTotal     = mysql_query($sqlTotal) or die(mysql_error());

        //recuperamos o total de registros
        $numTotal    = mysql_num_rows($qrTotal);

        // Aqui faremos uma conta, pegamos o total de registro e dividimos pela quantidade de registros que

        //queremos mostrar e usamos a função ceil para arredondar o resultado
        $totalPagina = ceil($numTotal/$quantidade);

        /********************************************************/

        //exibindo a paginação
        // Verificamos se o total de paginas é maior que 1, se for vamos mostrar a paginação
        if ($totalPagina > 1) {
        // Criando o link para a página 1
        echo '<a href="'.$linkPagina.'&pagina=1">Primeira Página</a> - ';

        // vamos começar um for para percorrer a quantidade de páginas
        for($i = 1; $i <= $totalPagina; $i++){
                // verificamos se esta é a página atual, se for tiramos o link
            if($i == $pagina){
                echo $i . '';
                } else {
                                // se não for colocamos o link
                    echo '<a href="'.$linkPagina.'"&pagina='.$i.'">'.$i.'</a>';
                    }
            }
        // Criando link para a ultima página
        echo ' - <a href="'.$linkPagina.'&pagina='.$totalPagina.'">Última Página</a>';
        // Fim da paginação
        } // fim do else

    }


    public function getLista($query) {
        $lista = "";
        $i = 0;
        // Aqui criamos um array bidimensional, que poderá vi do banco de
        // dados da mesma forma
        // basta você fazer um select * from tabela_marca -> a tabela_marca
        // deve conter: id_marca, ds_marca
    //            $marcas = array(
    //            array('id_marca' => 1, 'ds_marca' => 'Chevrolet'),
    //            array('id_marca' => 2, 'ds_marca' => 'Fiat'),
    //            array('id_marca' => 3, 'ds_marca' => 'Ford')
    //            );
        $sql  = mysql_query($query);
        while ($listaB = mysql_fetch_object($sql)){
            $lista[$i] = $listaB;
            $i++;
        }
        return $lista;
    }

        public function getSublista($objetoReferencia, $descricao) {
            // Ao invés de buscar num array (é como estou fazendo aqui), você
            // pode da um select na tabela
            // do banco de dados que armazena o modelo, e retorna todos os
            //modelos da marca $id_marca
            // select * from tabela_modelo where id_marca = $id_marca -> a
            // abela_modelo deve conter: id_marca, id_modelo, ds_modelo
            // depois do select você retorna os dados do banco na função
//            $tabelaCidade = array(
//                array('id_marca' => 1, 'id_modelo' => 1, 'ds_modelo' => 'Vectra'),
//                array('id_marca' => 1, 'id_modelo' => 2, 'ds_modelo' => 'Corsa'),
//                array('id_marca' => 1, 'id_modelo' => 3, 'ds_modelo' => 'Meriva'),
//                array('id_marca' => 2, 'id_modelo' => 4, 'ds_modelo' => 'Uno'),
//                array('id_marca' => 2, 'id_modelo' => 5, 'ds_modelo' => 'Tempra'),
//                array('id_marca' => 2, 'id_modelo' => 6, 'ds_modelo' => 'Pálio'),
//                array('id_marca' => 3, 'id_modelo' => 7, 'ds_modelo' => 'Ranger'),
//                array('id_marca' => 3, 'id_modelo' => 8, 'ds_modelo' => 'Eco'),
//                array('id_marca' => 3, 'id_modelo' => 9, 'ds_modelo' => 'Fiesta')
//            );

            //$modelo = array();
            $cont = 0;
            $sql = "";
            $query =
            "SELECT c.id, c.ds_cidade
            FROM tb_cidade c
            INNER JOIN tb_estado e ON ( c.id_estado = e.id )
            WHERE c.id_estado = $objetoReferencia";

            $sql  = mysql_query($query);
            while ($listaB = mysql_fetch_object($sql)){
                $sublista[$i] = $listaB;
                $i++;
            }

               // for($i=0; $i < count($sublista); $i++) {
//                    if($sublista[$i]->id == $sublista->id) {
//                        $sublista[$cont]['id'.$lista]= $sublista[$i]->id;
//                        $sublista[$cont]->ds_.$descricao = $sublista[$i]->ds_.$descricao;
//                        $cont++;
//                    }
//                }
            return $sublista;

        switch ($_POST['acao']) {
            case "exibeSublistaSelect":
            $txt = '<select name="idSublista">';
            $txt .= '<option value="">Selecione a '.$sublista.'</option>';

        foreach(getSublista($_POST['idLista']) as $sublista) {
        $txt .= '<option value="'.$sublista->id.'">' . $sublista->ds_.$descricao. '</option>';
        }

        $txt .= "</select>";

        echo $txt;
        break;
        }

    }

    function setaVariavel($variavel){
        if($_POST == $variavel){
            if(is_int($variavel))
                $variavel = $variavel ? $variavel : 0;
            else
                $variavel = $variavel ? $variavel : null;
            return $variavel;
        }else if ($_GET == $variavel){
            if(is_int($variavel))
                $variavel = $variavel ? $variavel : 0;
            else
                $variavel = $variavel ? $variavel : null;
            return $variavel;
        }else if ($_REQUEST == $variavel){
            if(is_int($variavel))
                $variavel = $variavel ? $variavel : 0;
            else
                $variavel = $variavel ? $variavel : null;
            return $variavel;
        }
        return null;
    }
}

    function acaoAtiva($titlepag){
        $titlepag = $titlepag ? $titlepag : null;
        if($titlepag != 'Adicionar' && $titlepag != 'Excluir' && $titlepag != 'Confirmar'){
            if($titlepag){
                $titilepag = '> ' .$titlepag;
                return $titilepag;
            }
        }
    }
    
    /** return  filename cript*/
    function renameToDateTimeMD5($filename){
        if(!is_null($filename)){
            
            return $filename;
        }
        return false;
    }
    
    /** return  filename cript*/
    function renameToDateTimeMD5Unique($filename){
        if(!is_null($filename)){
            
            return $filename;
        }
        return false;
    }

    function convertPasswordToMD5($password){
        if($password){
           return md5($password); 
        }
        return false;
    }
   
    
    function redirect($filename) {
        if (!headers_sent())
            header('Location: '.$filename);
        else {
            ?><script type="text/javascript">
                window.location.href="<? echo $filename;?>"
              </script>
              <noscript>
              <meta http-equiv="refresh" content="0;url='<? echo $filename;?>'" />
              </noscript><?
        }
    }

    function imagemCalendario($mes){
              if($mes == '1'){
            return 'iconCalendarJanuary.png';
        }else if($mes == '2'){
            return 'iconCalendarFebruary.png';
        }else if($mes == '3'){
            return 'iconCalendarMarch.png';
        }else if($mes == '4'){
            return 'iconCalendarApril.png';
        }else if($mes == '5'){
            return 'iconCalendarMay.png';
        }else if($mes == '6'){
            return 'iconCalendarJune.png';
        }else if($mes == '7'){
            return 'iconCalendarJuly.png';
        }else if($mes == '8'){
            return 'iconCalendarAugust.png';
        }else if($mes == '9'){
            return 'iconCalendarSeptember.png';
        }else if($mes == '10'){
            return 'iconCalendarOctober.png';
        }else if($mes == '11'){
            return 'iconCalendarNovember.png';
        }else if($mes == '12'){
            return 'iconCalendarDecember.png';
        }        
    }
    
    /**
     * @name Limpar sessões
     * @example -> Separar por vírgulas: sessao1, sessao2...
     */
    function limparSessao($var = ""){
        if($var != null && $var != ""){
            $var = explode(",", $var);
            if(is_array($var)){
                for($i = 0; $i < sizeof($var); $i++){
                    unset($_SESSION[$var[$i]]);
                }
            }
        }
        return null;
        
    }
?>