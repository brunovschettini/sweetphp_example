<?php

class Object implements Reflector{

    private $object;
    private $array = array();

    private function  __construct($array = "", $object = "") {
        $this->array = $array;
        $this->object = $object;
    }

    /**
     * @example CONVERTE UM OBJETO EM ARRAY ABAIXO FORMA DE USO
     * $object = array();
     * $object['0'] = object($var1);
     * $object['1'] = object($var2);
     * $result = objectToArray($object);
     * @param <type> OBJETO
     * @return Array
     */
    public static function objectToArray ($object){        
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array = array_keys(get_object_vars($object));
        }
        return $array;
    }
    
    public static function objectsToArray ($object){        
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array = get_object_vars($object[$i]);
        }
        return $array;
    }
    
    public static function objectToArrays ($object){        
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array[$i] = get_object_vars($object);
        }
        return $array;
    }
    
    public static function objectsToArrays ($object){        
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array[] = get_object_vars($object[$i]);
        }
        return $array;
    }
    
    /**
     * Abstrai a chave do Array
     * @param type $object
     * @return type 
     */
    public static function objectToKeysArray ($object){
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array = array_keys(get_object_vars($object));
        }
        return $array;
    }
    
    public static function objectToKeysArrays ($object){        
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array[] = array_keys(get_object_vars($object));
        }
        return $array;
    }
    
    public static function objectsToKeysArrays ($object){        
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array[] = array_keys(get_object_vars($object[$i]));
        }
        return $array;
    }
    
    /**
     * Abstrai o valor do ARRAY
     * @param type $object
     * @return type 
     */
    public static function objectToValueArray ($object){        
        $array = array();
        for ($i = 0; $i < sizeof($object); $i++) {
            $array = array_values(get_object_vars($object));
        }
        return $array;
    }
    
    public static function objectsToValueArray ($object){        
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array = array_values(get_object_vars($object[$i]));
        }
        return $array;
    }
    
    public static function objectToValueArrays ($object){        
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array[] = array_values(get_object_vars($object));
        }
        return $array;
    }
    
    public static function objectsToValueArrays ($object){        
        $array = array();
        for ($i = 0; $i < count($object); $i++) {
            $array[] = array_values(get_object_vars($object[$i]));
        }
        return $array;
    }
    
    public static function arrayToObject($array=array()){
        return (object) $array;
    }
    
    /**
     * Construct (Edit)
     * @param type $date 
     */
    public function getArray(){
        return $this->array;
    }

    public function setArray($array){
        $this->array = $array;
    }

    public function getObject(){
        return $this->object;
    }

    public function setObject($object){
        $this->object = $object;
    }

    public function __toString() {
        
    }

    public static function export() {
        
    }
}
?>
