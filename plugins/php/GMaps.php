
<?
/**
 * gMaps Class
 *
 * Pega as informações de latitude, longitude e zoom de um endereço usando a API do Google Maps
 *
 * @author Thiago Belem <contato@thiagobelem.net>
 */
class GMaps {
    // Host do GoogleMaps
    private $mapsHost = 'maps.google.com';
    // Sua Google Maps API Key
//    public $mapsKey = MAPS_GKEY_CODE;

    function __construct() {
        $this->mapsKey = MAPS_GKEY_CODE;
    }

    function carregaUrl($url = "") {
        if($url == ""){
            return null;
        }
        if (function_exists('curl_init')) {
                $cURL = curl_init($url);
                curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
                //curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, true);
                $resultado = curl_exec($cURL);
                curl_close($cURL);
        } else {
                $resultado = file_get_contents($url);
        }

        if (!$resultado) {
                return false;
                //trigger_error('Não foi possível carregar o endereço: <strong>' . $url . '</strong>');
        } else {
                return $resultado;
        }
    }

    public function geoLocal($endereco = "") {
        if($endereco == ""){
            return null;
        }
        $urlEndereco = 'http://'. $this->mapsHost .'/maps/geo?output=csv&key='. $this->mapsKey .'&q='. urlencode($endereco);
        //if(!$url){
            $dados = $this->carregaUrl($urlEndereco);
            list($status, $zoom, $latitude, $longitude) = explode(',', $dados);
            if ($status != 200) {
                    return false;
                    //trigger_error('Não foi possível carregar o endereço <strong>"'.$endereco.'"</strong>, código de resposta: ' . $status);
            }
            return array('lat' => $latitude, 'lon' => $longitude, 'zoom' => $zoom, 'endereco' => $endereco);
        //}
    }
}
?>