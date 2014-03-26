<?php
/**
 * SweetPHP <br />
 * <p><b>InputIOPost</b></p>
 * @link  http://www.ilines.com.br/documentacao/InputIOPost/
 * @author sweetphp
 * <p>Classe para espeficicar o nome do objeto e variavel dentro do input, select, checkbox.<p><br />
 */
class InputIOPost {

    /**
     * SweetPHP <br />
     * <p><b>Data Update (data-update)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_update/
     * @author sweetphp 
     * @param string $input <p>Retorna o valor da variavel montada em tempo de execução @example inputText("Pessoa", "nome", "Bruno"), retornara Pessoa[Bruno] = "Bruno" e mostrara no input text </p>
     * @param type $object - Nome do objeto / classe
     * @param type $varName - Nome da variavel
     * @param type $varValue* - Valor da variavel
     * @return (string) $input
     */
    public static function inputText($object = "", $varName = "", $varValue = "") {
        $value = "";
        if($varValue != ""){
            $value = " value=\"$varValue\"";
        }
        $input = "name=\"$object".'['.$varName.']'."\" $value ";
        echo $input;
    }
    
    /**
     * 
     * @param type $class
     * @param type $property
     * @test
     */
    public static function getObjectPost($class, $property) {
        $className = get_class($class);
        @$name = $property;
        @$value = $class->$property ? $class->$property : "";
        if($value != "" && $value != null){
            $value = " value=\"{$value}\"";
        }
        $input = "name=\"$className".'['.$name.']'."\" $value ";
        echo $input;
    }
    
}
?>
