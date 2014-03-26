<?php

/**
 * SweetPHP <br />
 * <p><b>Param</b></p>
 * @link  http://www.ilines.com.br/documentacao/Param/
 * @author sweetphp
 * <p>Retorna o parâmetro das variáveis ($_GLOBALS).<p>
 */
class Param {
    
    /**
     * SweetPHP <br />
     * <p><b>Param / get</b></p>
     * @link  http://www.ilines.com.br/documentacao/Param/get
     * @author sweetphp
     * <p>Retorna o parâmetro da $_GLOBAL param.<p>
     * @example get('title') Retornará o title
     */
    public static function get($paramName = "") {
        return @$GLOBALS['parans'][$paramName];
    }

    /**
     * SweetPHP <br />
     * <p><b>Param / set</b></p>
     * @link  http://www.ilines.com.br/documentacao/Param/set
     * @author sweetphp
     * <p>Insere um novo parâmetro a $_GLOBAL param.<p>
     * @example set(array('title'=>'Hello')) Retornará o title
     */
    public static function set($param = array()) {
        if(is_array($param)) {
            $GLOBALS['parans'] = @$param;
        }
    }

}
