<?php

class PhpThumbURL{
    
    public $isReturn = false;
    public $return  = "";
    public $caminho = "";
    public $tamanho = "";
    public $diretorio = "";
    public $arquivo = "";
    public $largura = 0;
    public $altura = 0;
    public $qualidade = 0;
    public $mascaraDagua = "";
    public $mascaraDaguaPosX = 0;
    public $mascaraDaguaPosY = 0;
    public $tamanhoPermitido = array('pp','p', 'pm', 'm', 'mm', 'mg','g','gg','exg', '350x200');
    public $tipoURL = true; /* true = url amigavel else false url comum*/
    
    public function __construct($caminho = "", $tamanho = "", $diretorio = "", $arquivo = "", $largura = 0, $altura = 0, $qualidade = 0) {
        $this->caminho = $caminho;
        $this->tamanho = $tamanho;
        $this->diretorio = $diretorio;
        $this->arquivo = $arquivo;
        $this->altura = $altura;
        $this->largura = $largura;
        $this->qualidade = $qualidade;
    }
    
    public function execute(){
        $this->return = $this->caminho;
        if($this->caminho == "" || $this->caminho == null){
            if($this->tipoURL == true){
                $this->return = ROOT."/imagem/miniatura";                
            }else{
                $this->return = ROOT."/arquivos/image.php?src={$this->caminho}";
            }
        }
        if($this->tamanho != "" && $this->largura == 0){
            if($this->tipoURL == true){
                if (in_array($this->tamanho, $this->tamanhoPermitido)){
                    $this->return = "{$this->return}/{$this->tamanho}";
                }
            }
        }
        if($this->diretorio != ""){
            if($this->tipoURL == true){
                $this->return = "{$this->return}/{$this->diretorio}";
            }else{
                $this->return = "{$this->return}{$this->diretorio}";
            }
        }
        if($this->arquivo != ""){
            if($this->tipoURL == true){
                $this->return = "{$this->return}_{$this->arquivo}";
            }else{
                $this->return = "{$this->return}/{$this->arquivo}";
            }
        }
        
        if($this->tipoURL == true){
            if($this->largura > 0){
                $this->return = "{$this->return}&{$this->largura}";
                if($this->altura  > 0){
                    $this->return = "{$this->return},{$this->altura}";
                    if($this->qualidade  > 0){
                        $this->return = "{$this->return},{$this->qualidade}";
                    }
                }
            }
        }else{
            if($this->largura > 0){
                $this->return = "{$this->return}&amp;w={$this->largura}";
            }
            if($this->altura  > 0){
                $this->return = "{$this->return}&amp;h={$this->altura}";
            }
            if($this->qualidade  > 0){
                $this->return = "{$this->return}&amp;q={$this->qualidade}";
            }
        }
        return $this->return;
    }
    
    public function getSRC(){
        return $this->return;
    }
    
    public function getImage($return = "", $extra = ""){
        return "<img src=\"{$return}\" $extra />";
    }

    /**
     * top, right, bottom, left
     */
    public function getImageCropCSS($return = "", $top = 0, $right = 0, $bottom = 0, $left = 0){     
        return "<img border=\"0\" src=\"{$return}\" style=\"position:absolute; clip: rect({$top}px {$right}px {$bottom}px {$left}px);\" />";
    }
    
    public function getMascaraDagua(){
        return $this->mascaraDagua;
    }
    
    public function setMascaraDagua($var = 0){
        $this->mascaraDagua = $var;
    }    
    
    public function getMascaraDaguaPosX(){
        return $this->mascaraDaguaPosX;
    }
    
    public function setMascaraDaguaPosX($var = 0){
        $this->mascaraDaguaPosX = $var;
    }
    
    public function getMascaraDaguaPosY(){
        return $this->mascaraDaguaPosY;
    }
    
    public function setMascaraDaguaPosY($var = 0){
        $this->mascaraDaguaPosY = $var;
    }
    
    public function setTipoURL($var = true){
        $this->tipoURL = $var;
    }
    
    public function getTipoURL(){
        return $this->tipoURL;        
    }
    
    public function setCaminho($var = ""){
        $this->caminho = $var;;
    }
    
    public function setTamanho($var = ""){
        $this->tamanho = $var;
    }
    
    public function setDiretorio($var = ""){
        $this->diretorio = $var;;
    }
    
    public function setArquivo($var = ""){
        $this->arquivo = $var;
    }
    
    
    public function setLargura($var = 0){
        $this->largura = $var;
    }
    
    public function setAltura($var = 0){
        $this->altura = $var;
    }
    
    public function setQualidade($var = 0){
        $this->qualidade = $var;
    }
    
    public function isReturn($var = true){
        $this->isReturn = $var;
    }
    
}
?>
