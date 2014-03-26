<?php

class FuncaoHTML {

    public $name, $value, $id, $style, $size, $maxlength, $edit, $textArea, $input, $checked;

    public function __construct($name = "", $value = "", $id = "", $style = "", $size = "", $maxlength = "", $edit = "", $textArea = "", $input = "", $checked = "") {
        $this->name = $name;
        $this->value = $value;
        $this->id = $id;
        $this->style = $style;
        $this->size = $size;
        $this->maxlength = $maxlength;
        $this->edit = $edit;
        $this->textArea = $textArea;
        $this->input = $input;
        $this->checked = $checked;
    }

    public function inputText($name, $value, $id, $style, $size, $maxlength, $title, $edit){
        $input = "";
        if($name)      { $input  = $name      = ' name="'.$name.'"';}
        if($value)     { $input .= $value     = ' value="'.$value.'"';}
        if($id)        { $input .= $id        = ' id="'.$id.'" ';}
        if($style)     { $input .= $style     = $style;}
        if($size)      { $input .= $size      = ' size="'.$size.'"';}
        if($maxlength) { $input .= $maxlength = ' maxlength="'.$maxlength.'"';}
        if($title)     { $input .= $title     = ' title="'.$title.'"';}
        if($edit)      { $input .= $edit      = '" "'. $edit .'" "';}
        $input = '<input type="text"'.$input .'/>';
        return $input;
    }

    public function inputTextNo($name, $value, $id, $style, $size, $maxlength, $title, $edit){
        $input = "";
        if($name)      { $input  = $name      = ' name="'.$name.'" ';}
        if($value)     { $input .= $value     = ' value="'.$value.'" ';}
        if($id)        { $input .= $id        = ' id="'.$id.'" ';}
        if($style)     { $input .= $style     = $style;}
        if($size)      { $input .= $size      = ' size="'.$size.'" ';}
        if($maxlength) { $input .= $maxlength = ' maxlength="'.$maxlength.'" ';}
        if($title)     { $input .= $title     = ' title="'.$title.'" ';}
        if($edit)      { $input .= $edit      = '" "'. $edit .'" "';}
        return $input;
    }

    public function inputHidden($name, $value, $id, $edit){
        $input = "";
        if($name) { $input  = ' name="'.$name.'" ';  }
        if($value){ $input .= ' value="'.$value.'" '; }
        if($id)   { $input .= ' id="'.$id.'" ';  }
        if($edit) { $input .= ' '. $edit .' '; }
        $input = '<input type="hidden"'. $input. "/>";
        return $input;
    }

    public function inputDisabled($name, $value, $id, $title, $edit){
        $input = "";
        if($name) { $input  = ' name ="'.$name.'" ';  }
        if($value){ $input .= ' value="'.$value.'" '; }
        if($id)   { $input .= ' id="'.$id.'" ';  }
        if($style){ $input .= $style; }
        if($edit) { $input .= '" "'. $edit .'" "'; }
        $input = '<input type="text"' .$input. 'disabled />';
        return $input;
    }

    public function inputSubmit($name, $value, $id, $style, $title, $edit){
        $input = "";
        if($name) { $input  = ' name="'.$name.'" ';  }
        if($value){ $input .= ' value="'.$value.'" '; }
        if($style){ $input .= $style; }
        if($id)   { $input .= ' id="'.$id.'" ';  }
        if($style){ $input .= $style; }
        if($title){ $input .= ' title="'.$title.'" ';  }
        if($edit) { $input .= ' '. $edit .' '; }
        $input = '<input type="submit"' .$input. '/>';
        return $input;
    }

    public function inputSubmitNo($name, $value, $id, $style, $title, $edit){
        $input = "";
        if($name) { $input  = ' name ="'.$name.'" '; }
        if($value){ $input .= ' value="'.$value.'" '; }
        if($style){ $input .= $style; }
        if($id)   { $input .= ' id="'.$id.'" '; }
        if($style){ $input .= $style; }
        if($title){ $input .= ' title="'.$title.'" '; }
        if($edit) { $input .= '" "'. $edit .'" "'; }
        return $input;
    }

    public function inputReset ($style){
        $input = "";
        if($style)     { $input .= $style; }
        $input = '<input type="reset"' .$input. '/>';
        return $input;
    }

    public function inputCheckBox($name, $value, $id, $style, $title, $edit, $checked){
        $input = "";
        if($name)      { $input  = ' name="'.$name.'" '; }
        if($value)     { $input .= ' value="'.$value.'" '; }
        if($id)        { $input .= ' id="'.$id.'" '; }
        if($title)     { $input .= ' title="'.$title.'" '; }
        if($style)     { $input .= $style; }
        if($edit)      { $input .= ' '.$edit.' '; }
        $input .= $this->CheckBox($checked);
        $input =  '<input type="checkbox"' .$input. '/>';
        return $input;
    }

    public function inputCheckBoxNo($name, $value, $id, $style, $title, $edit, $checked){
        $input = "";
        if($name)      { $input  = ' name="'.$name.'" '; }
        if($value)     { $input .= ' value="'.$value.'" '; }
        if($id)        { $input .= ' id="'.$id.'" '; }
        if($title)     { $input .= ' title="'.$title.'" '; }
        if($style)     { $input .= $style; }
        if($edit)      { $input .= ' '.$edit.' '; }
        $input .= $this->CheckBox($checked);
        return $input;
    }

    public function inputRadio($name, $value, $id, $style, $title, $edit){
        $input = "";
        if($name)      { $input  = ' name="'.$name.'" ';  }
        if($value)     { $input .= ' value="'.$value.'" ';}
        if($id)        { $input .= ' id="'.$id.'" ';  }
        if($style)     { $input .= $style; }
        if($title)     { $input .= ' title="'.$title.'" '; }
        if($edit)      { $input .= '" "'. $edit .'" "'; }
        $input = '<input type="radio"'. $input. '/>';
        return $input;
    }

    public function textArea($name, $text, $id, $style, $cols, $rows, $maxlength, $title, $edit){
        $textArea = "";
        if($name)      { $textArea  = ' name="'.$name.'" '; }
        if($id)        { $textArea .= ' id="'.$id.'" '; }
        if($style)     { $textArea .= $style; }
        if($cols)      { $textArea .= '" "'. $cola .'" "'; }
        if($rows)      { $textArea .= '" "'. $rows .'" "'; }
        if($maxlength) { $textArea .= ' maxlength="'.$maxlength.'" '; }
        if($title)     { $textArea .= ' title="'.$title.'" '; }
        if($edit)      { $textArea .= '" "'. $edit .'" "'; }
        //$textArea = '<textarea '.$textArea.' >'. nl2br($text).'</textarea>';
        $textArea = '<textarea '.$textArea.' >'. htmlentities($text).'</textarea>';
        return $textArea;
    }

    public function select($name, $values, $id, $style, $edit){
        if($id)   { $id    = ' id="'.$id.'" ';  } else { $id = ""; }
        if($values){
            $values = array();
            ?><select name="<? $name . $edit ?>" ><?
            foreach ($values as $valor){
               ?><option value="<?echo $valor ?>"><? $valor;?></option><?
            }
            ?></select><?
        } else { $value="";}
        if($style){ $style = $style; } else { $style = ""; }
        if($edit){ $edit = '" "'. $edit .'" "'; } else { $edit = ""; }
        if($maxlength) { $maxlength  = ' maxlength="'.$maxlength.'" ';  } else { $maxlength = ""; }
        ?><textarea name="<?echo $name;?>" <?echo $id . $style . $maxlength . $edit ?> > <? echo $value ?> </textarea> <?;
    }

    public function CheckBox($checked){
        if($checked == "on"){
            $checked = "checked";
        }else{
            $checked = "";
        }
        return $checked;
    }

    public function popUp($html, $title, $head){
        ?>
            <!-- <html>
                <head>
                    <title>
                        <? echo $title; ?>
                    </title>
<!--                    <script type="text/javascript">
                        function abrir(pagina,largura,altura) {
                            //pega a resolução do visitante
                            w = screen.width;
                            h = screen.height;
                            //divide a resolução por 2, obtendo o centro do monitor
                            meio_w = w/2;
                            meio_h = h/2;
                            //diminui o valor da metade da resolução pelo tamanho da janela, fazendo com q ela fique centralizada
                            altura2 = altura/2;
                            largura2 = largura/2;
                            meio1 = meio_h-altura2;
                            meio2 = meio_w-largura2;
                            //abre a nova janela, já com a sua devida posição
                            window.open(pagina,'','height=' + altura + ', width=' + largura + ', top='+meio1+', left='+meio2+'');
                        }
                     </script>
                </head>
                <body>
                    <? echo $html; ?>
                </body>
            </html> -->
        <?
    }

    public function montaHiperkinkUlLi($nome, $url, $title, $target, $id, $class, $style){
        $montaHiperlink = "";
        if (!is_null($title))
            $montaHiperlink  = '<a href="';
            $montaHiperlink .= $url ? $url : null;
            $montaHiperlink .= '"';
        if (!is_null($title)){
            $montaHiperlink .= ' title="';
            $montaHiperlink .= $title ? $title : null;
            $montaHiperlink .= '"';
        }
        if (!is_null($target)){
            $montaHiperlink .= ' target="';
            $montaHiperlink .= $target ? $target  : null;
            $montaHiperlink .= '"';
        }
        if (!is_null($id)){
            $montaHiperlink .= ' id="';
            $montaHiperlink .= $id ? $id  : null;
            $montaHiperlink .= '"';
        }
        if (!is_null($class)){
            $montaHiperlink .= ' class="';
            $montaHiperlink .= $class ? style : null;
            $montaHiperlink .= '"';
        }
        if (!is_null($style)){
            $montaHiperlink .= ' style="';
            $montaHiperlink .= $style ? $style  : null;
            $montaHiperlink .= '"';
        }
        if (!is_null($nome != ""))  $nome ? $nome  : null;
        if($nome && $montaHiperlink){
            $montaHiperlink .= '>'.$nome.'</a>';
            return $montaHiperlink;
        }else{
            return null;
        }
    }

    public function valueText($var){
        if(is_array($var)){
            $var = "value={$var}";
            return $var;
        }else if(is_null($var)){
            $var = "";
            return $var;
        }
    }


    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getValue(){
        return $this->value;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function getStyle(){
        return $this->style;
    }

    public function setStyle($style){
        $this->style = $style;
    }

    public function getSize(){
        return $this->size;
    }

    public function setSize($size){
        $this->size = $size;
    }

    public function getMaxlength(){
        return $this->maxlength;
    }

    public function setMaxlength($maxlength){
        $this->maxlength = $maxlength;
    }

    public function getEdit(){
        return $this->edit;
    }

    public function setEdit($edit){
        $this->edit = $edit;
    }

    public function getTextArea(){
        return $this->textArea;
    }

    public function setTextArea($textArea){
        $this->textArea = $textArea;
    }

    public function getInput(){
        return $this->input;
    }

    public function setInput($input){
        $this->input = $input;
    }

    public function getChecked(){
        return $this->checked;
    }

    public function setChecked($checked){
        $this->checked = $checked;
    }
}
?>