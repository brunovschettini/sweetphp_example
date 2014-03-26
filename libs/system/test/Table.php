<?php
/**
 * Description of Tabela
 * 
 * @author ilines
 * @param Object to table
 * @return table 
 */

Class Table{

    /**
     * @example Into object return table name
     * @param type $object
     * @return string|boolean 
     */
    public static function tableName($object = ""){
        
        if($object != ""){
            
            $tabela = null;

            if(is_object($object)){
                $objeto = get_class($object);
            }else{
                $objeto = $object;
            }
            
            $db = new DB();
            $exe = $db->prepare("SELECT * FROM seg_rotina WHERE ds_classe LIKE '$objeto'");
            $rotina = new SegRotina();
            if($exe->execute()){
                if($exe->rowCount() > 0){
                    $rotina = $exe->fetch(PDO::FETCH_OBJ);
                    $tabela = "$rotina->ds_tabela";
                }
            }
            
            if($tabela == null || $tabela == "" || $tabela == false){
                
                switch ($objeto){

                    case "Admin":
                        $tabela = "seg_admin";
                        break;

                    case "GrupoUsuario":
                        $tabela = "seg_grupo_usuario";
                        break;

                    case "SegNivel":
                        $tabela = "seg_nivel";
                        break;
                    
                    case "SegRotina":
                        $tabela = "seg_rotina";
                        break;

                }
            }
            
            return $tabela;
        }

        return false;
    }

}
?>
