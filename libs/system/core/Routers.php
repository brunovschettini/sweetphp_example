<?php

/**
 * @global string $GLOBALS['parans']
 * @name $parans 
 */
$GLOBALS['parans'] = null;

/**
 * SweetPHP <br />
 * <p><b>Routers</b></p>
 * @link  http://www.ilines.com.br/documentacao/Routers/
 * @author sweetphp
 * <p>Específica o caminho da página.<p><br />
 * <p>Exemplo: Ao chamar a página home, estarei 
 * instanciando a classe Home, para acessar o 
 * index estarei acessando a function() -> index. 
 * Dentro do index deverá estar específicado o 
 * caminho da view.<p><br />
 */
class Routers {

    public static function load() {
        if (sizeof(self::getParam()) > 0) {
            if (self::getParam() == '') {
                $view = self::getParam(0);
            } else {
                $view = self::getParam();
            }
        }
        $heading = "";
        $message = "";
        $include = "";
        if (sizeof(self::getParam()) == 0) {
            $view = DEFAULT_PAGE;
        }
        try {
            if (is_array($view)) {
                if (empty($view[0])) {
                    $view[0] = DEFAULT_PAGE;
                }
                $view = $view[0];
            } else {
                $include = $view;
            }
            if (!class_exists($view)) {
                $heading = "Erro 404";
                $message = "Página não encontrada!";
                include("libs/system/errors/error_404.php");
                exit();
            }
            $view = ucfirst($view);
            $class = new $view();
            $page = (string) self::getParam(1) ? self::getParam(1) : 'index';
            if (method_exists($class, $page)) {
                $class->$page();
            }
        } catch (Exception $ex) {
            $heading = "Erro 404";
            $message = "Página não encontrada! {$ex->getMessage()}";
            include("libs/system/errors/error_404.php");
        }
    }

    /**
     * SweetPHP <br />
     * <p><b>Routers / getParam</b></p>
     * @link  http://www.ilines.com.br/documentacao/Routers/getParam/
     * @author sweetphp
     * <p>Retorna a posição do valor da requisição get da URL.<p><br />
     * <p>Exemplo: URL de entrada http://localhost/project/product/portables/pendrive/</p>
     * <p>Instanciando o método: <br /> Routers::getParam(value);</p>
     * <p>Resultado: 
     * <br /> echo Routers::getParam(0) => 'product';
     * <br /> echo Routers::getParam(1) => 'portables';
     * <br /> echo Routers::getParam(2) => 'pendrive';</p><br />
     */
    public static function getParam($param = -1) {
        $request = str_replace(" ", "", $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : array());
        $projectName = PROJECT;
        $list = explode("/", $request);
        $newList = array();
        $j = 0;
        for ($i = 0; $i < sizeof($list); $i++) {
            if ($projectName != $list[$i] && $list[$i] != '') {
                $newList[$j] = $list[$i];
                $j++;
            }
        }
        $list = $newList;
        if ($param != -1) {
            try {
                return @$list[$param];
            } catch (Exception $ex) {
                return $list[0];
            }
        } else {
            $routes[0] = DEFAULT_PAGE;
        }
        return $list;
    }

    /**
     * SweetPHP <br />
     * <p><b>Routers / changePage</b></p>
     * @link  http://www.ilines.com.br/documentacao/Routers/changePage/
     * @author sweetphp
     * <p>Carrega as views do projeto conforme a página requisitada e espefícado no controle do projeto na URL de entrada.<p><br />
     * <p>Exemplo: URL de entrada http://localhost/project/home/</p>
     * <br /> changePage('index_view', array());
     * <p>Resultado: </p>
     * @example path '<html><head><title>Hello Word!!!</title></head><body>Hello Word!!!</body></html>';
     * @return include Inclui a pagina solicita
     */
    public static function changePage($param = "", $parans = array()) {
        Param::set($parans);
        if (!file_exists("libs/app/views/$param.php")) {
            include("libs/system/errors/error_404.php");
            exit();
        }
        include "libs/app/views/$param.php";
    }

    /**
     * SweetPHP <br />
     * <p><b>Routers / ajax</b></p>
     * @link  http://www.ilines.com.br/documentacao/Routers/ajax/
     * @author sweetphp
     * <p>Verifica se o tipo de entrada é 'xmlhttprequest'.<p><br />
     * @return ajax Resultado do AJAX
     */    
    public static function ajax() {
        // Alternative - if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        if (IS_AJAX) {
            try {
                $act = new Request();
                $valor = $act->action();
                echo $valor ? $valor : "";
            } catch (Exception $e) {
                $e->getMessage();
            }
            exit();
        }
    }

}
