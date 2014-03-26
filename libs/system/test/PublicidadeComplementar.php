<?php

class PublicidadeComplementar {
   
    public static function googleAdsense(){
        $tipoAnuncio = isset($_POST['tipoAnuncio']) ? $_POST['tipoAnuncio'] : "";
        if($tipoAnuncio == ""){
            return null;
        }
        switch ($tipoAnuncio){
            case 'v-160-600':
                ?><iframe class="no-margin" src="http://www.cadernomais.com.br/bannerArranhaCeu160x600.html" height="600"></iframe><?
                break;
            case 'v-160-90':
                ?><iframe class="no-margin" src="http://www.cadernomais.com.br/160x90-Vertical-Medio.html" width="160"></iframe><?
                break;
            case 'h-728-90':
                ?><iframe class="no-margin" src="http://www.cadernomais.com.br/banner728x90.html" width="728" height="90"></iframe><?
                break;
            case 'h-300-250':
                ?><iframe class="no-margin" src="http://www.cadernomais.com.br/banner300x250AllMercado.html" height="250"></iframe><?
                break;
            case 'h-234-60':
                ?><iframe class="no-margin" src="http://www.cadernomais.com.br/banner234x60.html" height="60"></iframe><?
                break;
        }
        
    }

    
}

?>
