<?php

/**
 * SweetPHP <br />
 * <p><b>Float</b></p>
 * @link  http://www.ilines.com.br/documentacao/Float/
 * @author sweetphp
 * <p>Realiza conversoes para manter tipos de forma organizada<p><br />
 */
class Float {

    /**
     * SweetPHP <br />
     * <p><b>To String(ToString)</b></p>
     * @link  http://www.ilines.com.br/documentacao/ToString/
     * @author sweetphp 
     * @param float $var <p>Entra Float e retorna String</p>
     * @return String
     * @example ToString float number = 0.0; number = ToString(0.6); (String) echo number = 0.6;
     */
    public static function ToString($var = 0.0) {
        if (is_float($var)) {
            (string) $var = (float) $var;
            return $var;
        }
        return false;
    }

    /**
     * SweetPHP <br />
     * <p><b>To Integer(ToInteger)</b></p>
     * @link  http://www.ilines.com.br/documentacao/ToInteger/
     * @author sweetphp 
     * @param float $var <p>Entra Float e retorna Integer</p>
     * @return String
     * @example ToInteger float number = 0.0; number = ToInteger(1.4); (String) echo number = 1;
     */
    public static function ToInteger($var = 0.0) {
        if (is_float($var)) {
            (int) $var = ceil($var);
            return $var;
        }
        return false;
    }

}
