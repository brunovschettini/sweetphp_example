<?php

class Helpers {

    /**
     * SweetPHP <br />
     * <p><b>Helpers / baseUrl </b></p>
     * @link  http://www.ilines.com.br/documentacao/Helpers/baseUrl
     * @author sweetphp
     * <p>Caminho absoluto para específicação da URL para links, arquivos, imagens.<p><br />
     * @example baseUrl('style.css')
     * @param string $url - Caminho / Arquivo
     * @return string echo 'www.mypage.com/style.css'
     */ 
    static function baseUrl($uri = '') {
        $uri = PATH . '/' . trim($uri);
        return $uri;
    }

    /**
     * URL Link
     */
    static function linkUrl($uri = '', $settings = array()) {
        $linkString = '';
        if (sizeof($settings) > 0) {
            
        }
        $uri = PATH . '/' . trim($uri);
        $_SESSION['current_uri'] = $uri;
        return $uri;
    }

    /**
     * SweetPHP <br />
     * <p><b>Helpers / redirect </b></p>
     * @link  http://www.ilines.com.br/documentacao/Helpers/redirect
     * @author sweetphp
     * <p>Redireciona a página para o local especificado.<p><br />
     * <p>Se a requisição for ajax $isAjax = true.<p>
     * @example redirect('home') vai redirecionar para home (header("Location: www.meypage.com/home");)
     * @example redirect('home', true) vai redirecionar para home quando a requisição for ajax (window.location = 'www.meypage.com/home')
     * @param string $url - URL para redirecionamento
     * @param bool $isAjax - Se redirecionamento via é ajax
     * @return string
     */    
    static function redirect($url = "", $isAjax = false) {
        $uri = self::baseUrl($url);
        if ($isAjax) {
            $json = json_encode(array('redirect' => $uri));
        } else {
            header("Location: $uri");
        }
        return $json;
    }

}
