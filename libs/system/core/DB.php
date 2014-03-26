<?php
/**
 * SweetPHP <br />
 * <p><b>DB</b></p>
 * @link  http://www.ilines.com.br/documentacao/DB/
 * @author sweetphp
 * <p>Realiza conexão com o banco de dados utilizando o PDO. DB extends PDO</p>
 */

class DB extends PDO {
    
    private $server;
    private $database;
    private $user;
    private $passwd;
    private $charset;
    private $engine; // mysql, postgree
    
     public function __construct(){
        $this->server = DB_HOST;
        $this->user = DB_USER;
        $this->passwd = DB_PASSWORD;
        $this->setDatabase(DB_DATABASE);
        $this->setEngine(DB_ENGINE);
        $dns = $this->getEngine().':dbname='.$this->database.";host=".$this->server;
        try {
            parent::__construct( $dns, $this->user, $this->passwd);
        }  catch (PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    } 
    
    public function getServer() {
        return $this->server;
    }

    public function setServer($server) {
        $this->server = $server;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function setDatabase($database) {
        $this->database = $database;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getPasswd() {
        return $this->passwd;
    }

    public function setPasswd($passwd) {
        $this->passwd = $passwd;
    }

    public function getCharset() {
        return $this->charset;
    }

    public function setCharset($charset) {
        $this->charset = $charset;
    }

    public function getEngine() {
        return $this->engine;
    }

    public function setEngine($engine) {
        $this->engine = $engine;
    }
}

?>
