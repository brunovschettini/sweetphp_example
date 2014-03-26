<?php


/**
 * SweetPHP <br />
 * <p><b>Form</b></p>
 * @link  http://www.ilines.com.br/documentacao/InputText/
 * @author sweetphp
 * <p>Formulário utilizado pelo plugin jSweetPHP durante o processamento e reuisições via ajax.<p><br />
 * <p>Este classe é utilizada como herança para classes primárias.
 */
class Form extends DataParam {

    private $text = "";
    private $name = "";
    private $attributes = "";
    private $class = "";

    /**
     * SweetPHP <br />
     * <p><b>__construct</b></p>
     * @author sweetphp
     * <p>Espefifica as principais características do forumário<p><br />
     * @return <form></form>
     */      
    public function __construct($name = "", $attributes = "", $class = "") {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->class = $class;
    }

    /**
     * SweetPHP <br />
     * <p><b>formOpen</b></p>
     * @author sweetphp
     * <p>Abre o formulário<p><br />
     * @return <form class="sweetForm" name="form_name"> <p>Conforme definido no __construtor</p>
     */
    public function formOpen() {
        $p = $this->toString();
        if (!empty($p)) {
            $this->text .= $p;
        }        
        return "<form class=\"sweetForm $this->class\" name=\"$this->name\" $this->attributes $this->text>";
    }

    /**
     * SweetPHP <br />
     * <p><b>formClose</b></p>
     * @author sweetphp
     * <p>Fecha o formulário<p><br />
     * @return </form> <p>Fecha o forumário</p>
     */
    public function formClose() {
        return "</form>";
    }

}
