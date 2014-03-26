<?php

/**
 * SweetPHP <br />
 * <p><b>ExampleModel</b></p>
 * @link  http://www.ilines.com.br/documentacao/ExampleModel/
 * @author sweetphp
 * <p>Exemplo de model, objeto<p><br />
 */

/** @Table("User") */
class User extends IOPost {

    /** @var (int) id */
    public $id = "";

    /** @var (string) login */
    public $login = "";

    /** @var (string) password */
    public $password = "";

    public function __construct($id = 0, $login = "", $password = "") {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        parent::__construct();
    }

    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId($var = 0) {
        $this->id = $var;
    }

    public function setLogin($var = "") {
        $this->login = $var;
    }

    public function setPassword($var = "") {
        $this->password = $var;
    }

    public function createtable() {
        $sql = "
            CREATE TABLE IF NOT EXISTS User(
                id               int(11)      AUTO_INCREMENT,
                login            VARCHAR(20)  NOT NULL      ,
                password         VARCHAR(100)               
                CONSTRAINT PRIMARY KEY(id)
            )ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ";
        return $sql;
    }

}
