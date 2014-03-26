<?php

/**
 * SweetPHP <br />
 * <p><b>Integer</b></p>
 * @link  http://www.ilines.com.br/documentacao/Integer/
 * @author sweetphp
 * <p>Realiza conversoes para manter tipos de forma organizada<p><br />
 */
class Integer {

    /**
     * SweetPHP <br />
     * <p><b>String To Integer (stringToInteger)</b></p>
     * @link  http://www.ilines.com.br/documentacao/stringToInteger/
     * @author sweetphp 
     * @param string $var <p>Entra String e retorna Integer</p>
     * @return Integer
     * @example stringToInteger int number = 0; number = stringToInteger("500"); (Integer) echo 500;
     */
    public static function stringToInteger($var) {
        if (is_string($var)) {
            $var = (int) $var;
        }
        return intval($var);
    }

    /**
     * SweetPHP <br />
     * <p><b>Integer To String(integerToString)</b></p>
     * @link  http://www.ilines.com.br/documentacao/integerToString/
     * @author sweetphp 
     * @param int $var <p>Entra Integer e retorna String</p>
     * @return String
     * @example integerToString int number = 0; number = integerToString(500); (String) echo 500;
     */
    public static function integerToString($var = 0) {
        if (is_int($var)) {
            (string) $var = (int) $var;
            return $var;
        }
        return false;
    }

    /**
     * SweetPHP <br />
     * <p><b>Integer To Float(integerToFloat)</b></p>
     * @link  http://www.ilines.com.br/documentacao/integerToFloat/
     * @author sweetphp 
     * @param int $var <p>Entra Integer e retorna Float</p>
     * @return Float
     * @example integerToFloat int number = 0; number = integerToFloat(500); (String) echo 500.00;
     */
    public static function integerToFloat($var = 0) {
        if (is_int($var)) {
            (float) $var = (int) $var;
            return $var;
        }
        return false;
    }

    /**
     * SweetPHP <br />
     * <p><b>Compare Int(compareInt)</b></p>
     * @link  http://www.ilines.com.br/documentacao/compareInt/
     * @author sweetphp 
     * @param int $intA, $intB <p>Compara Integer A e igual a Integer B? Accept Method POST and GET </p>
     * @return bool (true / false)
     * @example compareInt(1,5) Se 1 for igual a 5 retorna verdadeiro senao retorna falso;
     */
    public static function compareInt($intA = 0, $intB = 0) {
        if ($intA == $intB) {
            return true;
        } else {
            return false;
        }
    }

}
