<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Array
 *
 * @author Bruno
 * @return string
 */
class Arrays {

    public static function extractKeyObjectPost($keys = ""){
        $return = null;
        for($i = 0; $i < sizeof($keys); $i++) {
            $v = ",";
            if($i == 0){
                $v = "";
            }
            $key = strtolower($keys[$i]);
            $key = str_replace("ds_", "", $key);
            $key = str_replace("id_", "", $key);
            $key = str_replace("is_", "", $key);
            $key = str_replace("nr_", "", $key);
            $key = str_replace("i_",  "", $key);            
            $key = str_replace("dt_", "", $key);            
            $return .= $v.$key;
        }
        return $return;
    }     
    
}
?>
