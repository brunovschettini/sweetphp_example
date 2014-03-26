<?php

/**
 * Description of File
 *
 * @author Rtools
 */
class Image {
    
    public $file;
    public $path;
    public $md5Unique;
    public $dimension;
    public $acceptType;
    public $img;
    
    public function __construct(
        $file = null, 
        $path = "", 
        $md5Unique = false, 
        $dimension = array(),
        $acceptType = array()
    ){
        $this->file = $file;
        $this->path = $path;
        $this->md5Unique = $md5Unique;
        $this->dimension = $dimension;
        $this->acceptType = $acceptType;
    }
    
    /**
     * Retorna largura e altura da imagem
     * @return type - L[0] * H[1]
     */
    public static function getDimensions(){
        
        $file = $this->file;
        
        if($file == null){
            return false;
        }
        
        $dimension =  getimagesize($file);
        $newDimension =  array('width'  => $dimension[0],
                               'height' => $dimension[1]);
        return $newDimension;
    }
    
    /**
     * Retorna o tamanho da imagem
     * @return size
     */
    public static function getSize(){
        
        $file = $this->file;
        
        if($file == null){
            return false;
        }
        
        $size = $file['size'];
        $resize = $size / 6000;
        return $resize;
    }
    
    /**
     * Retorna o tipo da imagem
     * @return type
     */
    public static function getType(){
        
        $file = $this->file;
        
        if($file == null){
            return false;
        }
        
        $type = $file['type'];
        return $type;
    }
    
    public static function createImageType($type = ""){
        
        if($type == ""){
            return false;
        }
        
        if($type == "gif"){
            $img = imagecreatefromgif($this->file['tmp_name']);
        }else if($type == "jpeg" || $type == "jpg"){
            $img = imagecreatefromjpeg($this->file['tmp_name']);
        }else if($type == "png"){
            $img = imagecreatefrompng($this->file['tmp_name']);
        }
        
        return $img;
    }
    
    public static function createImageDimensions($w = 0, $h = 0){
        
        if($w != 0 && $h != 0){
            return false;
        }
        
        if($type == "gif"){
            $img = imagecreatefromgif($this->file['tmp_name']);
        }else if($type == "jpeg" || $type == "jpg"){
            $img = imagecreatefromjpeg($this->file['tmp_name']);
        }else if($type == "png"){
            $img = imagecreatefrompng($this->file['tmp_name']);
        }
        
        return $img;
    }


    public static function validUpload(){
        
        if($this->file == null){
            mensagemStatus1("Arquivo não existe!");
            return false;
        }
        
        if(is_file($this->file)){
            mensagemStatus1("Não é um arquivo!");
            return false;            
        }
        
        //$name = $this->filename['name'];
        //$temp = $this->filename['tmp_name'];
        //$size = $this->filename['size'];
        $type = $this->filename['type'];        
        $type = explode("/", $type);
        
        $fileExist = $this->path."/".$this->filename['name'];
        
        if(file_exists($fileExist)){
            mensagemStatus1("Imagem ja existe!");
            return false;
        }
        
        if(sizeof($this->acceptType) > 0){
            if(!$type[1] == $this->acceptType){
                mensagemStatus1("Tipo / extensão inválida!");
                return false;
            }
        }
    }
    
    public static function png(){
        
    }


    public static function upload(){
        
        $newFilename = null;
        
        if($this->md5Unique == true){
            $newFilename = md5(uniqid(date(rand(), true)));
        }else{
            $newFilename = $this->md5Unique[''];
        }
    }
    
    /**
     * Retorna imagem com mascará d'agua
     * @return size wattermask - L[0] * H[1]
     */
    public static function createWatterMask($watterMask = ""){
        
        if($watterMask == ""){
            return false;
        }
        
        $dimension =  getimagesize($file);
        $newDimension =  array('width'  => $dimension[0],
                               'height' => $dimension[1]);
        return $newDimension;
    }
    
    static function dataImage($file, $mime) {
        $contents = file_get_contents($file);
        $base64 = base64_encode($contents);
        return "data:$mime;base64,$base64";
    }
}

?>