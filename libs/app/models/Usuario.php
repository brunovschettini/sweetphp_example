<?php

include 'libs/SweetPHP/Libraries/IOPost.php';

/** @Table("seg_usuario") */
class Usuario extends IOPost {

    /** @var (int) id */
    public $id = "";

    /** @var (int) id_pessoa */
    public $id_pessoa = 0;

    /** @var (int) id_album */
    public $id_album = 0;

    /** @var (string) usuario */
    public $usuario = "";

    /** @var (string) senha */
    public $senha = "";

    /** @var data */
    public $data = "";

    /** @var (datetime) atualizado */
    public $atualizado = "";

    /** @var (boolean) (off/on) ativo */
    public $ativo = "";

    public function __construct($id, $id_pessoa, $id_album, $usuario, $senha, $data, $atualizado, $ativo) {
        $this->id = $id;
        $this->id_pessoa = $id_pessoa;
        $this->id_album = $id_album;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->data = $data;
        $this->atualizado = $atualizado;
        $this->ativo = $ativo;
        parent::__construct();
    }

    public function getId() {
        return $this->id;
    }

    public function getId_pessoa() {
        return $this->id_pessoa;
    }

    public function getId_album() {
        return $this->id_album;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getData() {
        return $this->data;
    }

    public function getAtualizado() {
        return $this->atualizado;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
    }

    public function setId_album($id_album) {
        $this->id_album = $id_album;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setAtualizado($atualizado) {
        $this->atualizado = $atualizado;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function createtable() {
        $sql = "
            CREATE TABLE IF NOT EXISTS seg_usuario(
                id               int(11)      AUTO_INCREMENT,
                id_pessoa        int(11),
                id_album         int(11) ,
                ds_usuario       VARCHAR(20)  NOT NULL      ,
                ds_senha         VARCHAR(100)               ,
                dt_data          datetime                   ,
                dt_atualizado    datetime                   ,
                is_ativo         VARCHAR(3) ,
                CONSTRAINT PRIMARY KEY(id)                  ,
                CONSTRAINT FK_USUARIO_PESSOA
                    FOREIGN KEY (id_pessoa) REFERENCES pes_pessoa(id) MATCH SIMPLE
                        ON DELETE NO ACTION ON UPDATE NO ACTION,
                CONSTRAINT FK_USUARIO_ALBUM
                    FOREIGN KEY (id_album) REFERENCES img_album (id) MATCH SIMPLE
                        ON DELETE NO ACTION ON UPDATE NO ACTION
            )ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ";
        return $sql;
    }

}
