<?php

/**
 * SweetPHP <br />
 * <p><b>DBInterage</b></p>
 * @link  http://www.ilines.com.br/documentacao/DBInterage/
 * @author sweetphp
 * <p>DBInterage<p><br />
 */
class DBInterage extends DB {

    public function __construct() {
        parent::__construct();
    }

    /**
     * SweetPHP <br />
     * <p><b>DBInterage / insertObject</b></p>
     * @link  http://www.ilines.com.br/documentacao/DBInterage/insertObject/
     * @example  insertObject($user) Insere o objeto na tabela, os nomes dos campos da tabela devem corresponder aos mesmos nomes dados na declaração das variáveis no objeto. Não há necessidade de abrir transação se inserir somente um objeto.
     * @author sweetphp
     * @return boolean TRUE/FALSE
     */
    public function insertObject($object = null) {
        if (!empty($object)) {
            $array = (array) $object;
            $queryInsert = self::queryPDOInsert($array, $object);
            try {
                $this->beginTransaction();
                $exe = $this->prepare(" $queryInsert ");
                foreach ($array as $key => $value) {
                    $exe->bindValue(":$key", $value, self::pdoType($value));
                }
                if ($exe->execute()) {
                    $id = $this->lastInsertId();
                    $this->commit();
                    $object->id = $id;
                    return $object;
                }
            } catch (Exception $e) {
                $this->rollBack();
                echo $e->getMessage();
                return false;
            }
        }
        return false;
    }

    /**
     * SweetPHP <br />
     * <p><b>DBInterage / insertObjects</b></p>
     * @link  http://www.ilines.com.br/documentacao/DBInterage/insertObjects/
     * @author sweetphp
     * @example  insertObjects($user) Insere o objetos na tabela, os nomes dos campos da tabela devem corresponder aos mesmos nomes dados na declaração das variáveis no objeto.
     * $db = new DBInterage(); 
     * $db->beginTransaction();
     * if($db->insertObjects($user) == true) {
     * $db->commit();
     * } else {
     * $db->rollback();
     * }
     * @return boolean TRUE/FALSE
     */
    public function insertObjects($object = null) {
        if (!empty($object)) {
            $array = (array) $object;
            $queryInsert = self::queryPDOInsert($array, $object);
            try {
                $exe = $this->prepare(" $queryInsert ");
                foreach ($array as $key => $value) {
                    $exe->bindValue(":$key", $value, self::pdoType($value));
                }
                if ($exe->execute()) {
                    $id = $this->lastInsertId();
                    $object->id = $id;
                    return $object;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        return false;
    }
    
    /**
     * @ignore
     */
    private static function queryPDOInsert($array = null, $object = null) {
        $queryKey = "";
        $queryValue = "";
        $tabela = Entity::getTableName($object);
        $i = 1;
        foreach ($array as $key => $value) {
            $sepatator = ",";
            if (sizeof($array) == $i) {
                $sepatator = "";
            }
            $queryKey .= " $key $sepatator ";
            $queryValue .= ":$key $sepatator ";
            $i++;
        }
        $query = " INSERT INTO `$tabela` ( $queryKey ) VALUES ( $queryValue ) ";
        return $query;
    }

    /**
     * SweetPHP <br />
     * <p><b>DBInterage / updateObject</b></p>
     * @link  http://www.ilines.com.br/documentacao/DBInterage/updateObject/
     * @author sweetphp
     * @example  updateObject($user) Atualiza o objeto na tabela, os nomes dos campos da tabela devem corresponder aos mesmos nomes dados na declaração das variáveis no objeto. Não há necessidade de abrir transação se inserir somente um objeto. Não há necessidade de abrir transação.
     * @return boolean TRUE/FALSE
     */    
    public function updateObject($object = null) {
        if (!empty($object)) {
            try {
                $this->beginTransaction();
                $valida = $this->prepare(" SELECT * FROM " . Entity::getTableName($object) . " WHERE id = " . $object->id);
                if ($valida->execute()) {
                    if ($valida->rowCount() > 0) {
                        $array = (array) $object;
                        $queryUpdate = self::queryPDOupdate($array, $object);
                        $exe = $this->prepare(" $queryUpdate ");
                        foreach ($array as $key => $value) {
                            $exe->bindValue(":$key", $value, self::pdoType($value));
                        }
                        if ($exe->execute()) {
                            $this->commit();
                            return true;
                        } else {
                            Message::messageUISimple("Falha na atualiza��o do(a) " . Entity::getTableName($object) . "!");
                            $this->rollBack();
                            return false;
                        }
                    } else {
                        Message::messageUISimple("ID {$object->id} n�o existe na tabela!')");
                        $this->rollBack();
                        return false;
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
        return false;
    }

    /**
     * SweetPHP <br />
     * <p><b>DBInterage / updateObject</b></p>
     * @link  http://www.ilines.com.br/documentacao/DBInterage/updateObjects/
     * @author sweetphp
     * @example  updateObject($user) Atualiza o objetos na tabela, os nomes dos campos da tabela devem corresponder aos mesmos nomes dados na declaração das variáveis no objeto. Não há necessidade de abrir transação se inserir somente um objeto.
     * $db = new DBInterage(); 
     * $db->beginTransaction();
     * if($db->updateObjects($user) == true) {
     * $db->commit();
     * } else {
     * $db->rollback();
     * }
     * @return boolean TRUE/FALSE
     */
    public function updateObjects($object = null) {
        if ($object != null) {
            try {
                $this->beginTransaction();
                for ($i = 0; $i < sizeof($object); $i++) {
                    $valida = $this->prepare(" SELECT * FROM " . Entity::getTableName($object) . " WHERE id = " . $object->id);
                    if ($valida->execute()) {
                        if ($valida->rowCount() > 0) {
                            $array = (array) $object[$i];
                            $queryUpdate = self::queryPDOupdate($array, $object[$i]);
                            $exe = $this->prepare(" $queryUpdate ");
                            foreach ($array as $key => $value) {
                                $exe->bindValue(":$key", $value, self::pdoType($value));
                            }
                            if (!$exe->execute()) {
                                Message::messageUISimple("Falha na atualiza��o do(a) " . Entity::getTableName($object[$i]) . "!");
                                $this->rollBack();
                                return false;
                            }
                        } else {
                            Message::messageUISimple("ID {$object[$i]->id} n�o existe na tabela!')");
                            $this->rollBack();
                            return false;
                        }
                    }
                }
                $this->commit();
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
        return false;
    }

    /**
     * 
     * @ignore
     */
    private static function queryPDOupdate($array = null, $object = null) {
        $queryUpdate = "";
        $tabela = Entity::getTableName($object);
        $i = 1;
        foreach ($array as $key => $value) {
            $sepatator = ",";
            if (sizeof($array) == $i) {
                $sepatator = "";
            }
            $queryUpdate .= " $key = :$key $sepatator";
            $i++;
        }
        $query = " UPDATE `$tabela` SET $queryUpdate WHERE id = {$object->id} ; ";
        return $query;
    }

    /**
     * 
     * @ignore
     */
    private static function pdoType($var = null) {
        $type = gettype($var);
        if ($type == "string") {
            return PDO::PARAM_STR;
        } else if ($type == "int") {
            return PDO::PARAM_INT;
        } else if ($type == "bool") {
            return PDO::PARAM_BOOL;
        } else {
            return PDO::PARAM_NULL;
        }
    }

    /**
     * SweetPHP <br />
     * <p><b>DBInterage / deleteObject</b></p>
     * @link  http://www.ilines.com.br/documentacao/DBInterage/deleteObject/
     * @author sweetphp
     * @example  deleteObject($user) Atualiza o objetos na tabela, os nomes dos campos da tabela devem corresponder aos mesmos nomes dados na declaração das variáveis no objeto. Não há necessidade de abrir transação se inserir somente um objeto. Não há necessidade de abrir transação.
     * @return boolean TRUE/FALSE
     */    
    public function deleteObject($object = null) {
        $delete = "";
        if (!empty($object)) {
            try {
                $this->beginTransaction();
                $delete = $this->queryDelete($object);
                if ($this->query($delete)) {
                    $this->commit();
                    return true;
                } else {
                    $this->rollBack();
                    return false;
                }
            } catch (Exception $e) {
                $e->getMessage();
                $this->rollBack();
            }
        }
    }

    /**
     * SweetPHP <br />
     * <p><b>DBInterage / deleteObjects</b></p>
     * @link  http://www.ilines.com.br/documentacao/DBInterage/deleteObjects/
     * @author sweetphp
     * @example  deleteObjects($user) Atualiza o objetos na tabela, os nomes dos campos da tabela devem corresponder aos mesmos nomes dados na declaração das variáveis no objeto.
     * $db = new DBInterage(); 
     * $db->beginTransaction();
     * if($db->deleteObjects($user) == true) {
     * $db->commit();
     * } else {
     * $db->rollback();
     * }
     * @return boolean TRUE/FALSE
     */
    public function deleteObjects($object = null, $className = "") {
        if ($object != null) {
            try {
                $delete = $this->queryDelete($object, $className);
                $exe = $this->prepare($delete);
                if ($exe->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                $e->getMessage();
                return false;
            }
        }
        return false;
    }

    /**
     * SweetPHP <br />
     * <p><b>DBInterage / deleteObjectNative</b></p>
     * @link  http://www.ilines.com.br/documentacao/DBInterage/deleteObjectNative/
     * @author sweetphp
     * @example  deleteObjectNative($user, 'User') Deleta o objetos na tabela, os nomes dos campos da tabela devem corresponder aos mesmos nomes dados na declaração das variáveis no objeto.
     * @return boolean TRUE/FALSE
     */    
    public function deleteObjectNative($object = null, $table = "") {
        if (!empty($object)) {
            try {
                $delete = "DELETE FROM `{$table}` WHERE (`id` = $object->id) ";
                if ($this->query($delete)) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                $e->getMessage();
                return false;
            }
        }
        return false;
    }
    
    /**
     * 
     * @deprecated
     */
    public function deleteId($id, $table = "") {
        if ($id != null) {
            try {
                $delete = "DELETE FROM `{$table}` WHERE (`id` = $id) ";
                if ($this->query($delete)) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                $e->getMessage();
                return false;
            }
        }
        return false;
    }

    public function queryNative($query = "", PDO $fetch = null) {
        $lista = null;
        if (!empty($query)) {
            $exe = $this->prepare($query);
            if ($exe->execute()) {
                if ($exe->rowCount() == 1) {
                    $lista = $exe->fetch($fetch);
                } else {
                    $lista = $exe->fetchAll($fetch);
                }
            }
        }
        return $lista;
    }

    public function queryDelete($object = "", $class = "") {
        $query = "";
        if ($class != "") {
            $query = "DELETE FROM `" . Entity::getTableName($class) . "` WHERE (`id` = {$object->id} )";
        } else {
            $query = "DELETE FROM `" . Entity::getTableName($object) . "` WHERE (`id` = {$object->id} )";
        }
        if ($object->id) {
            return $query;
        }
        return null;
    }

    
    public function find($value = "", $object = "", $param = "id", $isObject = true) {
        $table = Entity::getTableName($object);
        if ($table == "" && $table == false) {
            $table = Entity::tableExist($object);
            if ($table == "" && $table == false) {
                return null;
            }
        }
        try {
            $db = new DB();
            $exe = $db->prepare("SELECT * FROM {$table} WHERE $param = ? ");
            if ($exe->execute(array($value))) {
                if ($exe->rowCount() > 0) {
                    $param = $exe->fetchObject();
                    if ($isObject == true) {
                        $object = new $object();
                        foreach ($param as $property => $value) {
                            $object->$property = $value;
                        }
                    } else {
                        $object = $param;
                    }
                    return $object;
                }
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return new $object();
    }

}
