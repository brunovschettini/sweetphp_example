<?php

/**
 * SweetPHP <br />
 * <p><b>Dir</b></p>
 * @link  http://www.ilines.com.br/documentacao/Dir/
 * @author sweetphp
 * <p>Cria, altera e excluir diretorios<p><br />
 */
class Dir {
    
    public $location;
    public $name;
    public $chmod;
    public $recursive;
    public $path;

    /** 
     * Cria diret�rio e remove caracteres especiais - 
     * @return rename (md5) dir 
     */
    public static function stringToDirMD5($string = ""){
        if($string != ""){
            $string  = String::clean($string);
            $string = String::resume($string, 50, "");
            $string .= '_'.md5(date('YmdHis'));
        }
        return $string;
    }
    
    public static function create($location = "", $name = "", $chmod = 0777, $recursive = true){
        $path = $location.$name;        
        /**
        * Supressao de erro nao aconselhada, porem caso a pasta exista
        * o PHP lancarr um aviso, coisa que nao queremos caso haja
        * redirect
         * * @return bool <true / false>
        */
        if( @mkdir( $path, $chmod, $recursive ) ){
                chmod( $path, $chmod );
                return $path . '/';
        } else{
            if( is_writable($path) && is_readable($path) ){
                return $path;
            }else{
                return false;
            }
        }
    }    
    
    /**
    * Delete
    * @param $location - where?
    * @param $name - name. Warning for use special chars
    * @return bool <true / false>
    */    
    public static function delete($location = "", $name = ""){
        $path = "$location/$name";
        try{
            if(rmdir($path)){
                return true;
            }else{
                return false; 
            }
        }  catch (Exception $e){
            $e->getMessage();
            return false;
        }
    }    
    
    /**
    * Renema Direcory
    * @param $location - where
    * @param $oldname - old name
    * @param $newname - new name
    * @return bool <true / false>
    */    
    public static function rename($location = "", $oldName = "", $newName = ""){
        $oldPath = $location . $oldName;
        $newPath = $location . $newName;
        try{
            if(rename($oldPath, $newPath)){
                return true;
            }else{
                return false; 
            }
        }  catch (Exception $e){
            $e->getMessage();
            return false;
        }
    }
    
    /**
    * @return list of files this directory current
    */ 
    public function listDirectoryFiles($dir = ""){
        //$diretorio = getcwd($diretorio); // pega o endere�o do diret�rio
        $pointer  = opendir($dir);
        $itens = null;
        $dirs = null;
        $files = null;
        
        while ($itensName = readdir($pointer)) {
            $itens[] = $itensName;
        }
        sort($itens);
        
        foreach ($itens as $list) { // percorre o vetor para fazer a separacao entre arquivos e pastas
            if ($list !="." && $list!=".."){ // retira "./" e "../" para que retorne apenas pastas e arquivos
                if (is_dir($list)) {// checa se o tipo de arquivo encontrado � uma pasta
                    $dirs[] = $list;// caso VERDADEIRO adiciona o item � vari�vel de pastas
                }else{
                $files[]=$list; // caso FALSO adiciona o item � variavel de arquivos
                }
            }
        }
        
        if (sizeof($list) > 0){
            return $list; // lista os arquivos se houverem
        }else{
            return null;
        }
    }
    
    public function deleteAllDir($dir = "", $path = "") {
        $pointer  = opendir("$dir/$path/");
        while ($itensName = readdir($pointer)) {
            $filename = "$dir/$path/$itensName";
            @unlink($filename);
        }
        closedir($pointer);
        @rmdir($pointer);
        return true;

    }
    
    public function deleteAllDirs($path) {  
        $erros = array ();  
        $dir = new RecursiveDirectoryIterator ( $path );  
        $files = new RecursiveIteratorIterator ( $dir, RecursiveIteratorIterator::CHILD_FIRST );  
        // iterando o objeto  
        foreach ( $files as $file ) {  
            // verificando permissao, ou seja, se o arquivo pode ser modificado  
            if ($file->isWritable ()) {  
                // verificamos se a iteracao atual e de um diretorio  
                if ($file->isDir ()) {  
                    // se for, utilizamos rmdir para excluir  
                    rmdir ( $file->getPathname );  
                    // sen�o, testamos se � um arquivo  
                } elseif ($file->isFile ()) {  
                    // para arquivos, utilizamos o unlink  
                    unlink ( $file->getPathname );  
                }  
                // caso o arquivo nao possa ser modificado, gravamos na variavel o nome do arquivo e a permissao do arquivo  
            } else {  
                $erros [] = 'O arquivo ' . $file->getPathname . ' tem permiss�es ' . $file->getPerms () . ' e n�o pode ser exclu�do.';  
            }  
        }  
        // caso existam erros, mostramos, ou exibimos mensagem de sucesso.  
        if (count ( $erros )) {  
                return false;  
        } else {  
                return true;  
        }  
    }     
}