<?php

/**
 * SweetPHP <br />
 * <p><b>Session</b></p>
 * @link  http://www.ilines.com.br/documentacao/Session/
 * @author sweetphp
 * <p>Session<p><br />
 */
class Session {

    private $alive = true;

    public function __construct() {
        @session_set_save_handler(array(&$this, 'open'), array(&$this, 'close'), array(&$this, 'read'), array(&$this, 'write'), array(&$this, 'destroy'), array(&$this, 'clean'));
        session_start();
    }

    /**
     * SweetPHP <br />
     * <p><b>Session Destruct (__destruct)</b></p>
     * @link  http://www.ilines.com.br/documentacao/sessionDestruct/
     * @author sweetphp 
     * Limpa todas as sessões do servidor
     */
    public function __destruct() {
        if ($this->alive) {
            session_write_close();
            $this->alive = false;
        }
    }

    /**
     * SweetPHP <br />
     * <p><b>Session Delete (delete)</b></p>
     * @link  http://www.ilines.com.br/documentacao/sessionDelete/
     * @author sweetphp 
     * Limpa e destroi todas as sessões correntes no servidor
     */
    public function delete() {
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']
            );
        }
        session_destroy();
        $this->alive = false;
    }

    /**
     * SweetPHP <br />
     * <p><b>Session Get (get)</b></p>
     * Retorna uma sessao conforme nome especificado na declaracao
     * @link  http://www.ilines.com.br/documentacao/sessionGet/
     * @author sweetphp 
     * @param type $sessionName <p>Nome da variavel de sessao</p>
     * Usuario da sessao = (String) Paulo
     * @example $usuario = get("usuario"); echo $usuario = (String) Paulo
     * @return type Session especificada, se nao existir sessao retorna false
     */
    public static function get($sessionName = null, $remove = false) {
        if (self::exists($sessionName)) {
            $sessionName = $_SESSION[$sessionName];
            if($remove) {
                self::remove($sessionName);
            }
            return $sessionName;
        }
        return false;
    }

    /**
     * SweetPHP <br />
     * <p><b>Session Exists (get)</b></p>
     * Retorna uma sessao conforme nome especificado na declaracao
     * @link  http://www.ilines.com.br/documentacao/sessionGet/
     * @author sweetphp 
     * @param type $sessionName <p>Nome da variavel de sessao</p>
     * Usuario da sessao = (String) Paulo
     * @example $usuario = get("usuario"); echo $usuario = (String) Paulo
     * @return type Session especificada, se nao existir sessao retorna false
     */
    public static function exists($sessionName = null) {
        if (isset($_SESSION[$sessionName]) ? true : false) {
           return true;
        }
        return false;
    }

    /**
     * @deprecated since 0
     */
    public static function getAll() {
        
    }

    /**
     * SweetPHP <br />
     * <p><b>Session Put (put)</b></p>
     * Passa um valor para sessao
     * @link  http://www.ilines.com.br/documentacao/sessionPut/
     * @param type $sessionName <p>Nome da variavel de sessao</p>
     * @param type $value <p>Valor que sera passado para a variavel de sessao</p>
     * @example $usuario = "Paulo"; put("usuario", $usuario);
     */
    public static function put($sessionName = null, $value = null) {
        if (isset($_SESSION[$sessionName]) ? true : false) {
            if ($_SESSION[$sessionName] != $value) {
                unset($_SESSION[$sessionName]);
            }
        }
        $_SESSION[$sessionName] = $value;
    }

    /**
     * SweetPHP <br />
     * <p><b>Session Remove (remove)</b></p>
     * Passa um valor para sessao
     * @link  http://www.ilines.com.br/documentacao/sessionRemove/
     * @param type $sessionName <p>Nome da variavel de sessao</p>
     * @example remove("usuario"); $_SESSION (null)
     * @return null se sessão existir
     */
    public static function remove($sessionName = null) {
        if (self::exists($sessionName)) {
            unset($_SESSION[$sessionName]);
        }
    }

    /**
     * remove all sessions current
     * @param type $sessionName
     * @return null 
     */
    public static function removeAll() {
        
    }

    /**
     * convert session to object std class
     * @param type $arraySession
     * @return null|Object 
     */
    public static function sessionArrayToObject($arraySession = null) {
        if ($arraySession == null || sizeof($arraySession) == 0) {
            return null;
        }
        $object = (object) $arraySession;
        return $object;
    }

    /**
     * new session object
     * @param type $object
     * @return null 
     */
    public static function objectToSession($object = null, $sessionName = "") {
        if ($object == null && !is_object($object)) {
            return null;
        }
        $getClass = get_class($object);
        if ($sessionName != "" || $sessionName != null) {
            $_SESSION[$getClass] = $object;
        } else {
            $_SESSION[$sessionName] = $object;
        }
    }

    /**
     * new session object
     * @param type $object
     * @return null 
     */
    public static function getObjectSession($object = null, $sessionName = "") {
        if ($object == null && !is_object($object)) {
            return null;
        }
        $getClass = get_class($object);
        if (($_SESSION[$getClass] ? true : false == true) || ($_SESSION[$sessionName] ? true : false == true)) {
            if ($sessionName != "" || $sessionName != null) {
                $object = (object) $_SESSION[$getClass];
            } else {
                $object = (object) $_SESSION[$sessionName];
            }
            return $object;
        }
        return null;
    }

}
