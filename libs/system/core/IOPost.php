<?php

/**
 * Variavel auxiliar global
 */
$varHTMLInput = "";

/**
 * SweetPHP <br />
 * <p><b>IOPost</b></p>
 * @link  http://www.ilines.com.br/documentacao/IOPost/
 * @author sweetphp
 * <p>IOPost, esta classe a se extender pega os posts ($_POST) 
 * diretamente e passa para o construtor do objeto instanciado, para 
 * seu uso e necessario apos instanciar a classe chamar a função getPost(),
 * ele verificara todas as variaveis do objeto e as passara para este objeto. 
 * <b>Importante:</b> Sempre colocar dentro do construtor do objeto extendido o 
 * parent::__construct() para que a classe funcione corretamente<p>
 * @example $user = new User(); $user->getPost(); <p>(Neste momento todas as variaveis enviadas via data post serao pegas e preenchidas dentro do objeto user, sem a necessidade de usar o $_POST para pegar cada variavel do escopo atual)</p>
 */
class IOPost {

    /**
     * SweetPHP <br />
     * <p><b>IOPost  - __construct</b></p>
     * @author sweetphp
     * <p>IOPost, esta classe a se extender pega os posts ($_POST) 
     * diretamente e passa para o construtor do objeto instanciado, para 
     * seu uso e necessario apos instanciar a classe chamar a função getPost(),
     * ele verificara todas as variaveis do objeto e as passara para este objeto. 
     * <b>Importante:</b> Sempre colocar dentro do construtor do objeto extendido o 
     * parent::__construct() para que a classe funcione corretamente<p>
     * @example $user = new User(); $user->getPost(); <p>(Neste momento todas as variaveis enviadas via data post serao pegas e preenchidas dentro do objeto user, sem a necessidade de usar o $_POST para pegar cada variavel do escopo atual)</p>
     */
    protected function __construct() {
        $this->getPost();
        if ($this->id != -1) {
            
        }
        global $varHTMLInput;
        $varHTMLInput = $this;
    }

    /**
     * Conforme documentacao no inicio da classe
     */
    public function getPost() {
        if (!empty($this) && is_object($this)) {
            $className = get_class($this);
            if (isset($_POST[$className])) {
                $param = (object) $_POST[$className];
                foreach ($param as $property => $value) {
                    $this->$property = utf8_decode($value);
                }
                unset($_POST[$className]);
            }
        }
    }

    /**
     * Conforme documentacao no inicio da classe
     */
    public static function inputPost($property = null) {
        $className = $GLOBALS['varHTMLInput'];
        if (!empty($className)) {
            return InputIOPost::getObjectPost($className, $property);
        }
        unset($GLOBALS['varHTMLInput']);
        return "";
    }

    /**
     * Conforme documentacao no inicio da classe
     */
    public function call_private_method($object, $method, $args = array()) {
        $reflection = new ReflectionClass(get_class($object));
        $closure = $reflection->getMethod($method)->getClosure($object);
        return call_user_func_array($closure, $args);
    }

}
