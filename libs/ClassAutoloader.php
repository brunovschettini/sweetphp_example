<?php
/**
 * -----------------------------------------------------------------------------
 * 
 * Carrega automátivamente as funções instanciadas
 * 
 * -----------------------------------------------------------------------------
 */
class ClassAutoloader {

    private $directory = "";

    const PATH = "libs";
    const SEPARATOR = "/";

    public function __construct() {
        spl_autoload_extensions('.php');
        spl_autoload_register(array($this, 'loader'));
    }

    private function loader($className) {
        $file = "";
        if ($className == null) {
            return false;
        }
        $newList = $this->getDirectory();
        for ($i = 0; $i < sizeof($newList); $i++) {
            $file = "{$newList[$i]}{$className}.php";
            if (file_exists($file)) {
                if (!class_exists($className)) {
                    include($file);
                    return true;
                }
                try {
                    require_once($file);
                } catch (Exception $ex) {
                    include($file);
                }
                return true;
            }
        }
        return false;
    }

    private function directorys() {
        $diretorios = array();
        $dir = new RecursiveDirectoryIterator(self::PATH);
        $recursive = new RecursiveIteratorIterator($dir);
        $memoryDir = "";
        foreach ($recursive as $splFileInfo){
            if($splFileInfo->isDir()){
                $fileName = $splFileInfo->getPathname();
                $rFileName = str_replace(".", "", $fileName);
                if($memoryDir != $rFileName) {
                    if($rFileName != "libs\config\\") {
                        $diretorios[] = $rFileName;
                        $memoryDir = $rFileName;
                    }
                }
            }
        }
        $_SESSION['autoload_dir'] = $diretorios;
        return $diretorios;
    }

    public function getDirectory() {
        if (empty($_SESSION['autoload_dir'])) {
            return $this->directorys();
        }
        return $_SESSION['autoload_dir'];
    }

}