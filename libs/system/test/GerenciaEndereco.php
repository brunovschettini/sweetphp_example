<?php

	function getNomePagina($pag){
		global $modulo_internet;
		$aux = explode(".php", $pag, 2);
		//Para Funcionar na Internet
		if ($modulo_internet)
			$aux2 = explode("/", $aux[0]);
		//Para funcionar local
		else
			$aux2 = explode("\\", $aux[0]);
		$pg = $aux2[count($aux2)-1];
		return $pg;
	}

	function acertaEndereco(){
		global $url_site;

		$pag_array = explode("/", curPageURL());

		$pagina = $pag_array[count($pag_array)-1];
		$pasta = $pag_array[count($pag_array)-2];
		$endereco_errado = str_replace("www.", "", $url_site);
		$aux = (str_replace("http://", "", $endereco_errado));
		if ($pasta == $aux)
			$pasta = "";
		$endereco_errado .= (($pasta)?"/".$pasta:"")."/".$pagina;
//		echo $endereco_errado."<br>";
//		echo curPageURL()."<br>";
		if (curPageURL() == $endereco_errado || curPageURL() == $endereco_errado."/"){
			$errado_array = explode("://", $endereco_errado);
			$certo = $errado_array[0]."://www.".$errado_array[1];
//			echo $certo;
			header("Location: ".$certo);
		}
	}

	function curPageURL() {
		$pageURL = 'http';
                $_GET['fb_comment_id'] = isset($_GET['fb_comment_id']) ? $_GET['fb_comment_id'] : null;
		if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "8090") {
                    if($_GET['fb_comment_id'] ? true : false){
                        $var = $_SERVER["QUERY_STRING"];
                        $var = removeTrechoURLFacebook($var);
                          $pageURL .= $_SERVER["PHP_SELF"].":".$_SERVER["SERVER_PORT"].'?'.$var;
                    }else{
                    }
		} else {
                    if(isset($_GET['fb_comment_id']) ? true : false){
                        $var = $_SERVER["QUERY_STRING"];
                        $var = removeTrechoURLFacebook($var);
                        $pageURL .= $_SERVER["PHP_SELF"].'?'.$var;
                    }else{
                        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                    }
		}
		return $pageURL;
	}

        function removeTrechoURLFacebook($var){
            $var = explode('&', $var);
            for($i = 0; $i < sizeof($var); $i++){
                $varB[$i] = explode('=', $var[$i]);
                if($varB[$i][0] == "fb_comment_id"){
                    unset($varB[$i]);
                }else{
                    $varC[$i] = implode('=', $varB[$i]);
                }
            }
            $var = implode('&', $varC);
            return $var;
        }

	function getNome_site(){
		$query = "select nome_site from configuracoes where id = 1";
		$resultado = executaQuery($query);
		while($nome_site = mysql_fetch_object($resultado)){
			$aux = $nome_site->nome_site;
		}
		return $aux;
	}

	function geraUrlLimpa($texto){
		//desconvertendo do padrão entitie (tipo &aacute; para á)
		$texto = html_entity_decode($texto);
		//tirando os acentos
		$texto = eregi_replace('[aáàãâä]','a',$texto);
		$texto = eregi_replace('[eéèêë]','e',$texto);
		$texto = eregi_replace('[iíìîï]','i',$texto);
		$texto = eregi_replace('[oóòõôö]','o',$texto);
		$texto = eregi_replace('[uúùûü]','u',$texto);
		//parte que tira o cedilha e o ñ
		$texto = eregi_replace('[ç]','c',$texto);
		$texto = eregi_replace('[ñ]','n',$texto);
		//trocando espaço em branco por underline
		$texto = eregi_replace('( )','+',$texto);
		//tirando outros caracteres invalidos
		//$texto = eregi_replace('[^a-z0-9\-]','',$texto);
		//trocando duplo espaço (hifen) por 1 hifen só
		$texto = eregi_replace('--','-',$texto);
		return strtolower($texto);
	}

	function URLamigator($titulo, $tabela, $id){
		$guia = strtolower($titulo);
		$guia = geraUrlLimpa($guia);
		if(!empty($id)){
			if($guia != getQQ($id, "guia", $tabela, "")){
				$data = getQQ($id, "data", $tabela, "");
				$query = "select * from  $tabela where titulo = '$titulo' and id <> '$id'";
				$num_rows1 = mysql_num_rows(executaQuery($query));
				$query .= " and data < '$data'";
				$num_rows2 = mysql_num_rows(executaQuery($query));
				if($num_rows1 > 0){
					if($num_rows1 >= $num_rows2){
						$guia .= "-".($num_rows1 +1);
					}
					else $guia .= "-".($num_rows2 +1);
				}
			}
		}
		else{
			$query = "select * from  $tabela where titulo = '$titulo'";
			$num_rows1 = mysql_num_rows(executaQuery($query));
			if($num_rows1 > 0)
				$guia .= "-".($num_rows1 +1);
		}
		return $guia;
	}

	function valida_Guia($titulo,$tabela,$id,$i = 0){

		$titulo = str_replace("\'", "", $titulo);
		$titulo = str_replace('\"', '', $titulo);
		$titulo = str_replace("&#039", "", $titulo);
		$titulo = str_replace('&quot;', '', $titulo);

		if ($id > 0){
			$query = "select titulo,guia from $tabela where id = $id";
			$result = executaQuery($query);
			$tit = mysql_result($result, 0, "titulo");
			$tit = str_replace("\'", "", $tit);
			$tit = str_replace('\"', '', $tit);
			$tit = str_replace("&#039", "", $tit);
			$tit = str_replace('&quot;', '', $tit);
			$guia = mysql_result($result, 0, "guia");
			if ($tit == $titulo)
				return $guia;
		}
		$guia = geraUrlLimpa($titulo);
		if ($i > 0)
			$guia .= "-".$i;
		$query = "select guia from $tabela where guia = '".$guia."'";
		$resultado = executaQuery($query);
		if (mysql_num_rows($resultado) > 0){
			$i++;
			$guia = valida_Guia($titulo, $tabela, $id, $i);
		}

		return $guia;

	}

?>