<?php

/**
 * Description of Mascara
 *
 * @author Bruno
 */
class Mask {
    
    /**
     * Mascará Telefone
     * Converte 99999999 para 9999-9999 
     * @param string $string
     * @return string 
     */
    public static function maskPhone($string){
        $prefixo = substr($string, 0, 4);
        $sufixo = substr($string, 4, 4);
        $string = $prefixo."-".$sufixo;
        return $string;
    }

    /**
     * Mascará CEP
     * Converte 45000000 para 45.000-000
     * @param string $string
     * @return string 
     */
    public static function maskPostalCode($string){
        $prefixo = substr($string, 0, 5);
        $sufixo = substr($string, 5, 3);
        $string = $prefixo."-".$sufixo;
        return $string;
    }

    /**
     * Mascará CPF
     * @example Converte 32487178825 para 324.871.788-25
     * @param string $string
     * @return string 
     */
    public static function maskCPF($string){
        $a = substr($string, 0, 2);
        $b = substr($string, 3, 3);
        $c = substr($string, 5, 3);
        $digito = substr($string, 8, 2);
        $string = $a.'.'.$b.'.'.$c.'-'.$digito;
        return $string;
    }

    /**
     * Mascará CNPJ
     * 
     * @example Converte 06168370000119 para 06.168.370/0001-19 
     * @param string $string
     * @return string 
     */
    public static function maskCNPJ($string){
        $a = substr($string, 0, 2);
        $b = substr($string, 2, 3);
        $c = substr($string, 5, 3);
        $d = substr($string, 8, 4);
        $digito = substr($string, 12, 2);
        $string = $a.'.'.$b.'.'.$c.'/'.$d.'-'.$digito;
        return $string;
    }
    
    
}

?>
