<?php

/**
 * Description of Globals
 *
 * @author Bruno
 */
class Globals {
    
    /**
     * $input
     * @acept $type = int, string, null, bool, date, active
     * @param type $type
     * @param type $var 
     */
    public static function getPost($var = "", $type = "", $setId = false){
        $int = 0;
        if(!String::isEmpty($var)){
            switch ($type){
                case 'int':
                    $var = isset($_POST[$var]) ? $_POST[$var] : $int;
                    if($setId == true){
                        if($var == 0){
                            $var = -1;                            
                        }
                    }
                    break;
                case 'string':
                    $var = isset($_POST[$var]) ? $_POST[$var] : "";
                    break;
                case 'null':
                    $var = isset($_POST[$var]) ? $_POST[$var] : null;
                    break;
                case 'bool':
                    $var = isset($_POST[$var]) ? true : false;
                    break;
                case 'date':
                    $var = isset($_POST[$var]) ? $_POST[$var] : date('Y-m-d H:m:s');
                    break;
                case 'active':
                    $var = isset($_POST[$var]) ? "on" : "off";
                    break;
                default :
                    $var = isset($_POST[$var]) ? $_POST[$var]: "";
                    break;
            }
        }
        return $var;
    }    
    
    /**
     * INPUT GET
     * @param type $type
     * @param type $var
     * @param type $setId
     * @return null 
     */
    public static function getGet($type, $var, $setId = false){
        $int = 0;
        if($setId){
            $int = -1;
        }
        if(!String::isEmpty($var)){
            switch ($type){
                case 'int':
                    $var = isset($_GET[$var]) ? $_GET[$var] : $int;
                    break;
                case 'string':
                    $var = isset($_GET[$var]) ? $_GET[$var] : "";
                    break;
                case 'null':
                    $var = isset($_GET[$var]) ? $_GET[$var] : null;
                    break;
                case 'bool':
                    $var = isset($_GET[$var]) ? true : false;
                    break;
                case 'date':
                    $var = isset($_GET[$var]) ? $_GET[$var] : date();
                    break;
                case 'active':
                    $var = isset($_GET[$var]) ? "on" : "off";
                    break;
                default :
                    $var = isset($_GET[$var]) ? $_GET[$var]: "";
                    break;
            }
            return $var;
        }
        return null;        
    }
    
    /**
     * 
     */
    public static function getGlobalVarsToObject($input = "", $object = null){
        $string = null;
        $string = Object::objectToKeysArray( $object );
        $stringKey = $string;
        $string = Arrays::extractKeyObjectPost( $string );
        $string = explode(',', $string);
        $ob = null;
        $arr = null;
        $ob = strtolower(get_class($object)."_");
        for($i = 0; $i < sizeof($string); $i++){
            $v = ",";
            if($i == 0){
                $v = "";
            }
            $var = $ob.$string[$i];
            if($input == 'post'){    
                $ob = $_POST["$var"];
                $stringKey[$i] = "$v $ob";
                $arr .= "$v $ob";
            }else if($input == 'get'){
                $ob = $_GET["$var"];
                $arr .= "$v $ob";
            }else if($input == 'request'){
                $ob = $_REQUEST["$var"];          
                $arr .= "$v $ob";
            }
        }
        $arr = explode(",", $arr);
        //$arr = split($arr, 0, null);
        $x = (object) $arr;
        return $object; 
    }
}