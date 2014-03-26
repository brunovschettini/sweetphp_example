<?php

class Transforma {
    
    public static $var = "";
    
    public function __construct($var = ""){
        self::$var = $var;
        //parent::__construct();
        
    }
    
    public static function clearStripTags($string = ""){
        $newString = "";
        $arr = explode(" ", str_replace("\n", " ", strip_tags($string)));
        for($i = 0; $i < sizeof($arr); $i++){
            $string = "";
            $string = trim($arr[$i]);
            $string = rtrim($string);
            $string = ltrim($string);
            $string = str_replace(" ", "", $string);
            $newString .= " ".$string; 
        }
        return $newString;
    }


    public static function metaDescription($string = ""){
        $string = self::refazAcentos(self::clearStripTags($string));
        $string  = str_replace("&nbsp;", "", $string);
        $string = self::resume($string, 255, "...");
        return $string;
    }
    
    public static function metaKeyWords($string = ""){
        if($string == ""){
            return null;
        }
        $arr = explode('-', self::urlSEO($string));
        $newString = "";
        if(sizeof($arr) < 20){
            $limit = sizeof($arr);
        }else{
            $limit = 20;            
        }
        for($i = 0; $i < $limit; $i++){
            $string = str_replace(" ", "", $arr[$i]);
            $string = str_replace("...", "", $string);
            $newString .= $string . ", "; 
        }
        return $newString;        
    }

    /** Transforma uma palavra em uma alias, usada em URL's / TITLE's amigáveis */
    public static function geraAlias($var = ""){
        if(self::$var == "" || self::$var == null || self::$var == false){
            return null;
        }
        if($var != ""){
            self::$var = strtolower($var);
        }else{
            self::$var = strtolower(self::$var);            
        }
        #Removendo os caracters especiais
        self::$var = str_replace(".", "", self::$var);
        self::$var = str_replace("/", "", self::$var);
        self::$var = str_replace("\\", "", self::$var);
        self::$var = str_replace(":", "", self::$var);
        self::$var = str_replace("(", "", self::$var);
        self::$var = str_replace(")", "", self::$var);
        self::$var = str_replace("[", "", self::$var);
        self::$var = str_replace("]", "", self::$var);
        self::$var = str_replace("{", "", self::$var);
        self::$var = str_replace("}", "", self::$var);
        self::$var = str_replace("*", "", self::$var);
        self::$var = str_replace("%", "", self::$var);
        self::$var = str_replace("$", "", self::$var);
        self::$var = str_replace("#", "", self::$var);
        self::$var = str_replace("@", "", self::$var);
        self::$var = str_replace("?", "", self::$var);
        self::$var = str_replace("!", "", self::$var);
        self::$var = str_replace(",", "", self::$var);
        self::$var = str_replace("&", "", self::$var);
        self::$var = str_replace(";", "", self::$var);
        #transformando espaÃ§os em hí-fens
        self::$var = str_replace(" ", "+", self::$var);
        self::$var = str_replace("_", "-", self::$var);
        #remontando as palavras sem a acentuação
        #agudo
        self::$var = str_replace("&aacute;", "a", self::$var);
        self::$var = str_replace("&eacute;", "e", self::$var);
        self::$var = str_replace("&iacute;", "i", self::$var);
        self::$var = str_replace("&oacute;", "o", self::$var);
        self::$var = str_replace("&uacute;", "u", self::$var);
        self::$var = str_replace("&Aacute;", "a", self::$var);
        self::$var = str_replace("&Eacute;", "e", self::$var);
        self::$var = str_replace("&Iacute;", "i", self::$var);
        self::$var = str_replace("&Oacute;", "o", self::$var);
        self::$var = str_replace("&Uacute;", "u", self::$var);
        #circunflexo
        self::$var = str_replace("&acirc;", "a", self::$var);
        self::$var = str_replace("&ecirc;", "e", self::$var);
        self::$var = str_replace("&icirc;", "i", self::$var);
        self::$var = str_replace("&ocirc;", "o", self::$var);
        self::$var = str_replace("&ucirc;", "u", self::$var);
        self::$var = str_replace("&Acirc;", "a", self::$var);
        self::$var = str_replace("&Ecirc;", "e", self::$var);
        self::$var = str_replace("&Icirc;", "i", self::$var);
        self::$var = str_replace("&Ocirc;", "o", self::$var);
        self::$var = str_replace("&Ucirc;", "u", self::$var);
        #til
        self::$var = str_replace("&atilde;", "a", self::$var);
        self::$var = str_replace("&otilde;", "o", self::$var);
        self::$var = str_replace("&ntilde;", "n", self::$var);
        self::$var = str_replace("&Atilde;", "a", self::$var);
        self::$var = str_replace("&Otilde;", "o", self::$var);
        self::$var = str_replace("&Ntilde;", "n", self::$var);
        #grave
        self::$var = str_replace("&agrave;", "a", self::$var);
        self::$var = str_replace("&egrave;", "e", self::$var);
        self::$var = str_replace("&igrave;", "i", self::$var);
        self::$var = str_replace("&ograve;", "o", self::$var);
        self::$var = str_replace("&ugrave;", "u", self::$var);
        self::$var = str_replace("&Agrave;", "a", self::$var);
        self::$var = str_replace("&Egrave;", "e", self::$var);
        self::$var = str_replace("&Igrave;", "i", self::$var);
        self::$var = str_replace("&Ograve;", "o", self::$var);
        self::$var = str_replace("&Ugrave;", "u", self::$var);
        #cedilha
        self::$var = str_replace("&ccedil;", "c", self::$var);
        self::$var = str_replace("&Ccedil;", "c", self::$var);
        #trema
        self::$var = str_replace("&auml;", "a", self::$var);
        self::$var = str_replace("&euml;", "e", self::$var);
        self::$var = str_replace("&iuml;", "i", self::$var);
        self::$var = str_replace("&ouml;", "o", self::$var);
        self::$var = str_replace("&uuml;", "u", self::$var);
        self::$var = str_replace("&Auml;", "a", self::$var);
        self::$var = str_replace("&Euml;", "e", self::$var);
        self::$var = str_replace("&Iuml;", "i", self::$var);
        self::$var = str_replace("&Ouml;", "o", self::$var);
        self::$var = str_replace("&Uuml;", "u", self::$var);

        return self::$var;
    }

    /**
    * Tranforma caracteres especiais em codificação.
    * @param type $var
    * @return type
    */
    public static function traduzAcentos($var = ""){
        if($var == ""){
            if(self::$var == "" || self::$var == null || self::$var == false){
                return null;
            }        
        }else{
            self::$var = $var;
        }
        #agudo
        self::$var = str_replace("á", "&aacute;", self::$var);
        self::$var = str_replace("é", "&eacute;", self::$var);
        self::$var = str_replace("í", "&iacute;", self::$var);
        self::$var = str_replace("ó", "&oacute;", self::$var);
        self::$var = str_replace("ú", "&uacute;", self::$var);
        self::$var = str_replace("Á", "&Aacute;", self::$var);
        self::$var = str_replace("É", "&Eacute;", self::$var);
        self::$var = str_replace("Í", "&Iacute;", self::$var);
        self::$var = str_replace("Ó", "&Oacute;", self::$var);
        self::$var = str_replace("Ú", "&Uacute;", self::$var);
        #circunflexo
        self::$var = str_replace("â", "&acirc;", self::$var);
        self::$var = str_replace("ê", "&ecirc;", self::$var);
        self::$var = str_replace("î", "&icirc;", self::$var);
        self::$var = str_replace("ô", "&ocirc;", self::$var);
        self::$var = str_replace("û", "&ucirc;", self::$var);
        self::$var = str_replace("Â", "&Acirc;", self::$var);
        self::$var = str_replace("Ê", "&Ecirc;", self::$var);
        self::$var = str_replace("Î", "&icirc;", self::$var);
        self::$var = str_replace("Ô", "&Ocirc;", self::$var);
        self::$var = str_replace("Û", "&Ucirc;", self::$var);
        #til
        self::$var = str_replace("ã", "&atilde;", self::$var);
        self::$var = str_replace("õ", "&otilde;", self::$var);
        self::$var = str_replace("ñ", "&ntilde;", self::$var);
        self::$var = str_replace("Ã", "&Atilde;", self::$var);
        self::$var = str_replace("Õ", "&Otilde;", self::$var);
        self::$var = str_replace("Ñ", "&Ntilde;", self::$var);
        #grave
        self::$var = str_replace("à ", "&agrave;", self::$var);
        self::$var = str_replace("è", "&egrave;", self::$var);
        self::$var = str_replace("ì", "&igrave;", self::$var);
        self::$var = str_replace("ò", "&ograve;", self::$var);
        self::$var = str_replace("ù", "&ugrave;", self::$var);
        self::$var = str_replace("À", "&Agrave;", self::$var);
        self::$var = str_replace("È", "&Egrave;", self::$var);
        self::$var = str_replace("Ì", "&Igrave;", self::$var);
        self::$var = str_replace("Ò", "&Ograve;", self::$var);
        self::$var = str_replace("Ù", "&Ugrave;", self::$var);
        #cedilha
        self::$var = str_replace("ç", "&ccedil;", self::$var);
        self::$var = str_replace("Ç", "&Ccedil;", self::$var);
        #trema
        self::$var = str_replace("ä", "&auml;", self::$var);
        self::$var = str_replace("ë", "&euml;", self::$var);
        self::$var = str_replace("ï", "&iuml;", self::$var);
        self::$var = str_replace("ö", "&ouml;", self::$var);
        self::$var = str_replace("ü", "&uuml;", self::$var);
        self::$var = str_replace("Ä", "&Auml;", self::$var);
        self::$var = str_replace("Ë", "&Euml;", self::$var);
        self::$var = str_replace("Ï", "&Iuml;", self::$var);
        self::$var = str_replace("Ö", "&Ouml;", self::$var);
        self::$var = str_replace("Ü", "&Uuml;", self::$var);
        #caracteres especoos
        self::$var = str_replace("º", "&ordm;", self::$var);
        self::$var = str_replace("ª", "&ordf;", self::$var);
        
        self::$var = self::traduzAspas(self::$var);
        return self::$var;
    }
    
    /**
    * Tranforma caracteres especiais em codificação.
    * @param type $var
    * @return type
    */
    public static function refazAcentos($var = ""){
        if($var != ""){
            $var = $var;
        }else{
            $var = self::$var;
        }        
        #agudo
        $var = str_replace("&aacute;", "á", $var);
        $var = str_replace("&eacute;", "é", $var);
        $var = str_replace("&iacute;", "í", $var);
        $var = str_replace("&oacute;", "ó", $var);
        $var = str_replace("&uacute;", "ú", $var);
        $var = str_replace("&Aacute;", "Á", $var);
        $var = str_replace("&Eacute;", "É", $var);
        $var = str_replace("&Iacute;", "Í", $var);
        $var = str_replace("&Oacute;", "Ó", $var);
        $var = str_replace("&Uacute;", "Ú", $var);
        #circunflexo
        $var = str_replace("&acirc;", "â", $var);
        $var = str_replace("&ecirc;", "ê", $var);
        $var = str_replace("&icirc;", "î", $var);
        $var = str_replace("&ocirc;", "ô", $var);
        $var = str_replace("&ucirc;", "û", $var);
        $var = str_replace("&Acirc;", "Â", $var);
        $var = str_replace("&Ecirc;", "Ê", $var);
        $var = str_replace("&icirc;", "î", $var);
        $var = str_replace("&Ocirc;", "Ô", $var);
        $var = str_replace("&Ucirc;", "Û", $var);
        #til
        $var = str_replace("&atilde;", "ã", $var);
        $var = str_replace("&otilde;", "õ", $var);
        $var = str_replace("&ntilde;", "ñ", $var);
        $var = str_replace("&Atilde;", "Ã", $var);
        $var = str_replace("&Otilde;", "Õ", $var);
        $var = str_replace("&Ntilde;", "Ñ", $var);
        #grave
        $var = str_replace("&agrave;", "à ", $var);
        $var = str_replace("&egrave;", "è", $var);
        $var = str_replace("&igrave;", "ì", $var);
        $var = str_replace("&ograve;", "ò", $var);
        $var = str_replace("&ugrave;", "ù", $var);
        $var = str_replace("&Agrave;", "À", $var);
        $var = str_replace("&Egrave;", "È", $var);
        $var = str_replace("&Igrave;", "Ì", $var);
        $var = str_replace("&Ograve;", "Ò", $var);
        $var = str_replace("&Ugrave;", "Ù", $var);
        #cedilha
        $var = str_replace("&ccedil;", "ç", $var);
        $var = str_replace("&Ccedil;", "Ç", $var);
        #trema
        $var = str_replace("&auml;", "ä", $var);
        $var = str_replace("&euml;", "ë", $var);
        $var = str_replace("&iuml;", "ï", $var);
        $var = str_replace("&ouml;", "ö", $var);
        $var = str_replace("&uuml;", "ü", $var);
        $var = str_replace("&Auml;", "Ä", $var);
        $var = str_replace("&Euml;", "Ë", $var);
        $var = str_replace("&Iuml;", "Ï", $var);
        $var = str_replace("&Ouml;", "Ö", $var);
        $var = str_replace("&Uuml;", "Ü", $var);
        $var = self::traduzAspas($var);
        return $var;
    }
    
    /**
    * Tranforma caracteres especiais em codificação.
    * @param type $var
    * @return type
    */
    public static function jstraduzAcentos(){
        if(self::$var == "" || self::$var == null || self::$var == false){
            return null;
        }        
        self::$var = utf8_encode(self::$var);
        #agudo
        self::$var = str_replace("á", "&aacute;", self::$var);
        self::$var = str_replace("é", "&eacute;", self::$var);
        self::$var = str_replace("í", "&iacute;", self::$var);
        self::$var = str_replace("ó", "&oacute;", self::$var);
        self::$var = str_replace("ú", "&uacute;", self::$var);
        self::$var = str_replace("Á", "&Aacute;", self::$var);
        self::$var = str_replace("É", "&Eacute;", self::$var);
        self::$var = str_replace("Í", "&Iacute;", self::$var);
        self::$var = str_replace("Ó", "&Oacute;", self::$var);
        self::$var = str_replace("Ú", "&Uacute;", self::$var);
        #circunflexo
        self::$var = str_replace("â", "&acirc;", self::$var);
        self::$var = str_replace("ê", "&ecirc;", self::$var);
        self::$var = str_replace("î", "&icirc;", self::$var);
        self::$var = str_replace("ô", "&ocirc;", self::$var);
        self::$var = str_replace("û", "&ucirc;", self::$var);
        self::$var = str_replace("Â", "&Acirc;", self::$var);
        self::$var = str_replace("Ê", "&Ecirc;", self::$var);
        self::$var = str_replace("Î", "&icirc;", self::$var);
        self::$var = str_replace("Ô", "&Ocirc;", self::$var);
        self::$var = str_replace("Û", "&Ucirc;", self::$var);
        #til
        self::$var = str_replace("ã", "&atilde;", self::$var);
        self::$var = str_replace("õ", "&otilde;", self::$var);
        self::$var = str_replace("ñ", "&ntilde;", self::$var);
        self::$var = str_replace("Ã", "&Atilde;", self::$var);
        self::$var = str_replace("Õ", "&Otilde;", self::$var);
        self::$var = str_replace("Ñ", "&Ntilde;", self::$var);
        #grave
        self::$var = str_replace("à", "&agrave;", self::$var);
        self::$var = str_replace("è", "&egrave;", self::$var);
        self::$var = str_replace("ì", "&igrave;", self::$var);
        self::$var = str_replace("ò", "&ograve;", self::$var);
        self::$var = str_replace("ù", "&ugrave;", self::$var);
        self::$var = str_replace("À", "&Agrave;", self::$var);
        self::$var = str_replace("È", "&Egrave;", self::$var);
        self::$var = str_replace("Ì", "&Igrave;", self::$var);
        self::$var = str_replace("Ò", "&Ograve;", self::$var);
        self::$var = str_replace("Ù", "&Ugrave;", self::$var);
        #cedilha
        self::$var = str_replace("ç", "&ccedil;", self::$var);
        self::$var = str_replace("Ç", "&Ccedil;", self::$var);
        #trema
        self::$var = str_replace("ä", "&auml;", self::$var);
        self::$var = str_replace("ë", "&euml;", self::$var);
        self::$var = str_replace("ï", "&iuml;", self::$var);
        self::$var = str_replace("ö", "&ouml;", self::$var);
        self::$var = str_replace("ü", "&uuml;", self::$var);
        self::$var = str_replace("Ä", "&Auml;", self::$var);
        self::$var = str_replace("Ë", "&Euml;", self::$var);
        self::$var = str_replace("Ï", "&Iuml;", self::$var);
        self::$var = str_replace("Ö", "&Ouml;", self::$var);
        self::$var = str_replace("Ü", "&Uuml;", self::$var);
        self::$var = traduzAspas(self::$var);
        return self::$var;
    }
    
    /**
     * Remover espaços em branco
     * @param type $var
     * @return type 
     */
    public static function replaceWhiteSpace(){
        if(self::$var == "" || self::$var == null || self::$var == false){
            return null;
        }        
        self::$var = html_entity_decode(self::$var);
        self::$var = trim(str_replace("", "&nbsp;", self::$var));
        return self::$var;
    }

    /**
    * Trazuz Refaz ASPAS.
    * @param type $var
    * @return type
    */
    public static function jsRefazAcentos(){
        if(self::$var == "" || self::$var == null || self::$var == false){
            return null;
        }        
        self::$var = self::jstraduzAcentos(self::$var);
        self::$var = self::refazAcentos(self::$var);
        return self::$var;
    }
    
    /**
    * Trazuz ASPAS
    * @param type $var
    * @return type
    */
    public static function traduzAspas($var = ""){
        if($var != ""){
            $var = $var;
        }else{
            $var = self::$var;
        }
        $var = str_replace("\'", "&#039", $var);
        $var = str_replace('\"', '&quot;', $var);
        $var = str_replace("'", "&#039", $var);
        return $var;
    }

    /**
     * URL SEO
     * @param type $string
     * @return null 
     */
    public static function urlSEO($var = ""){
        if($var != ""){
            $var = $var;
        }else{
            $var = self::$var;
        }
        $var = strtolower($var);
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??"!@#$%&*()_-+={[}]/?;:.,\\\'<>¬`´~^ªº°|¹²³£¨¢';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby                                               ';
        $var = strtr($var, $a, $b);
        $var = utf8_decode($var);
        $var = strip_tags(trim($var));
        /*Agora, remove qualquer espaço em branco duplicado*/
        $var = preg_replace('/\s(?=\s)/', '', $var);
        /*Ssubstitui qualquer espaço em branco (não-espaço), com um espaço*/
        $var = preg_replace('/[\n\r\t]/', ' ', $var);
        /*Remove qualquer espaço vazio*/
        $var = str_replace("?","-", $var);
        $var = str_replace(" ","-", $var);
        $var = strtolower(utf8_encode($var));
        return $var;
    }

    public static function agente(){

        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

        if(!$userAgent){
            return false;
        }

        $listaAgente = array(
            "ABCdatos BotLink","ht://Dig","Resume Robot","The Web Wombat", "Acme.Spider","HTMLgobble","RoadHouse Crawling System","The World Wide Web Worm", "Ahoy! The Homepage Finder","Hyper-Decontextualizer","RixBot","WWWC Ver 0.2.5", "Ask", "Yandex", "Yahoo", "uol", 
            "Alkaline","iajaBot","Road Runner: The ImageScape Robot","WebZinger", "Anthill","IBM_Planetwide","Robbie the Robot","XGET", "Walhello appie","Popular Iconoclast","ComputingSite Robi/1.0", "Arachnophilia","Ingrid","RoboCrawl Spider", "Jakarta", 
            "Arale","Imagelock","RoboFox", "Araneo","IncyWincy","Robozilla", "AraybOt","Informant","Roverbot", "ArchitextSpider","InfoSeek Robot 1.0","RuLeS", "Aretha","Infoseek Sidewinder","SafetyNet Robot", "ARIADNE","InfoSpiders","Scooter", "Alexa", 
            "arks","Inspector Web","Sleek", "AskJeeves","IntelliAgent","Search.Aus-AU.COM", "ASpider (Associative Spider)","I, Robot","SearchProcess", "ATN Worldwide","Iron33","Senrigan","Atomz.com Search Robot","Israeli-search","SG-Scout", 
            "AURESYS","JavaBee","ShagSeeker", "BackRub","JBot Java Web Robot","Shai'Hulud", "Bay Spider","JCrawler","Sift", "Big Brother","Jeeves","Simmany Robot Ver1.0", "Bjaaland","JoBo Java Web Robot","Site Valet", "BlackWidow","Jobot",
            "Open Text Index Robot", "Die Blinde Kuh","JoeBot","SiteTech-Rover", "Bloodhound","The Jubii Indexing Robot","Skymob.com", "Borg-Bot","JumpStation","SLCrawler", "BoxSeaBot","image.kapsi.net","Inktomi Slurp","bright.net caching robot",
            "Katipo","Smart Spider", "BSpider","KDD-Explorer","Snooper", "CACTVS Chemistry Spider","Kilroy","Solbot", "Calif","KO_Yappo_Robot","Spanner","churl","LinkScan","SpiderMan","cIeNcIaFiCcIoN.nEt","LinkWalker","SpiderView(tm)","Cassandra",
            "LabelGrabber","Speedy Spider", "Digimarc Marcspider/CGI","larbin","spider_monkey","Checkbot","legs","SpiderBot","ChristCrawler.com","Link Validator","Spiderline Crawler", "CMC/0.01","Lockon","Spry Wizard Robot", "Collective","logo.gif Crawler",        
            "Site Searcher","CombineSystem","Lycos","Suke","Conceptbot","Mac WWWWorm","suntek search engine","ConfuzzledBot","Magpie","Sven","CoolBot","marvin/infoseek","Sygol", "Web Core / Roots","Mattie","TACH Black Widow","XYLEME Robot","MediaFox",
            "Tarantula","Internet Cruiser Robot","MerzScope","tarspider","Cusco","NEC-MeshExplorer","Tcl W3 Robot", "CyberSpyder Link Test","MindCrawler","TechBOT", "CydralSpider","mnoGoSearch search engine software","Templeton","Desert Realm Spider",
            "moget","TeomaTechnologies","DeWeb(c) Katalog/Index","MOMspider","TITAN","DienstSpider","Monster","TitIn","Digger","Motor","The TkWWW Robot","DigitalIntegrity Robot","MSNBot","TLSpider","Direct Hit Grabber","Muncher","UCSD Crawl","DNAbot",
            "Muninn","UdmSearch","DownLoad Express","Muscat Ferret","UptimeBot","DragonBot","Mwd.Search","URL Check","DWCP (Dridus' Web Cataloging Project)","Internet Shinchakubin","URL Spider Pro","e-collector","NDSpider","Valkyrie","EbiNess",
            "Nederland.zoek","Verticrawl","EIT Link Verifier Robot","NetCarta WebMap Engine","Victoria","ELFINBOT","NetMechanic","vision-search","Emacs-w3 Search Engine","NetScoop","void-bot","ananzi","newscan-online","Voyager","esculapio",
            "NHSE Web Forager","VWbot","Esther","Nomad","The NWI Robot","Evliya Celebi","The NorthStar Robot","W3M2","FastCrawler","nzexplorer","WallPaper (alias crawlpaper)",	"Fluid Dynamics Search Engine robot","ObjectsSearch","the World Wide Web Wanderer", 
            "Felix IDE","Occam","w@pSpider by wap4.com","Wild Ferret Web Hopper #1, #2, #3","HKU WWW Octopus","WebBandit Web Spider","FetchRover","OntoSpider","WebCatcher","fido","Openfind data gatherer","WebCopy","Hämähäkki","Orb Search","webfetcher",
            "KIT-Fireball","Pack Rat","The Webfoot Robot","Fish search","PageBoy","Webinator","Fouineur","ParaSite","weblayers","Robot Francoroute","Patric","WebLinker","Freecrawl","pegasus", "MJ12bot", "WordPress", "Netcraft", 
            "WebMirror","FunnelWeb","The Peregrinator","The Web Moose","gammaSpider, FocusedCrawler","PerlCrawler 1.0","WebQuest","gazz","Phantom","Digimarc MarcSpider","GCreep","PhpDig","WebReaper",
            "GetBot","PiltdownMan","webs","GetURL","Pimptrain.com's robot","Websnarf","Golem","Pioneer","WebSpider","Googlebot","html_analyzer","WebVac","Grapnel/0.01 Experiment","Portal Juice Spider","webwalk",
            "Griffon","PGP Key Agent","WebWalker","Gromit","PlumtreeWebAccessor","WebWatch","Northern Light Gulliver","Poppi","Wget","Gulper Bot","PortalB Spider","whatUseek Winona","HamBot","psbot","WhoWhere Robot","Harvest","GetterroboPlus Puu",
            "Wired Digital","havIndex","The Python Robot","Weblog Monitor","HI (HTML Index) Search","Raven Search","w3mir","Hometown Spider Pro","RBSE Spider"," WebStolperer", "bingbot", "facebook", "discovery", "facebookexternalhit"
        );


        for($i = 0; $i < sizeof($listaAgente); $i++){
            if(strstr($_SERVER['HTTP_USER_AGENT'], strtolower($listaAgente[$i]))){
                $continue = true;
                break;
            }else{
                $continue = false;
            }
        }

        $db = openDataBase();
        $queryString = " SELECT * FROM est_agente_busca WHERE i_url_agente LIKE '$userAgent' ";
        $sql = mysql_query($queryString, $db);
        $queryString = "";
        if($sql){
            if(mysql_num_rows($sql) == 0){
                $queryString = " INSERT INTO est_agente_busca (`id`, `i_url_agente`, `dt_acesso_unico`, `dt_acesso_recorrente`, `nr_unico`, `nr_recorrente`) VALUES (null, '$userAgent', NOW(), NOW(), 1, 1) ";
            }else if(mysql_num_rows($sql) > 1){
                $agente = mysql_fetch_object($sql);
                $sql = "";
                $queryString = " UPDATE est_agente_busca SET `dt_acesso_recorrente` = CURDATE(), `nr_recorrente` = (`nr_recorrente` + 1) WHERE `id` = $agente->id ";
            }
        }

        if($queryString == ""){
            closeDataBase($db);
            return false;
        }

        $sql = mysql_query($queryString, $db);


        if(!$sql){
            closeDataBase($db);
            return false;
        }    

        closeDataBase($db);
        if($continue == true){
            return true;
        }else if($continue == false){
            return false;
        }else{
            return false;
        }
    }

    /**
    * FACEBOOK
    * @param string $url
    * @param type $q
    * @example $count = myFacebook($url, 'share_count');
    * @tutorial (string) => url, normalized_url, share_count, like_count, comment_count, total_count, click_count, comments_fbid, commentsbox_count, max
        url => (string) http://www.cadernomais.com.br/evento/193/joao-rock-2012-parte-ii-parque-permanente-de-exposicoes-23-06-2012
        normalized_url => (string) http://www.cadernomais.com.br/evento/193/joao-rock-2012-parte-ii-parque-permanente-de-exposicoes-23-06-2012
        share_count => (string) 1
        like_count => (string) 0
        comment_count => (string) 0
        total_count => (string) 1
        click_count => (string) 0
        comments_fbid => (string) 10151046490191138
        commentsbox_count => (string) 1
    * @return var int
    */
    public static function myFacebook($url = '', $q = '') {
        try{
            if($url == ""){
                $url = self::$var;
            }
            $var = null;
            //$url = "https://graph.facebook.com/comments/?ids=".urlencode($url);
            $url = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".urlencode($url);
            
            $xml = file_get_contents($url);
            
            if(!$xml || $xml == false || !is_object($xml)){
                //throw new Exception ('error 404! not found page anda data fail.');
                return false;
            }
            
            $xml = simplexml_load_string($xml);


            switch ($q){
                case 'url':
                    $var = (int) $xml->link_stat->url;
                    break;
                case 'normalized_url':
                    $var = (int) $xml->link_stat->normalized_url;
                    break;
                case 'share_count':
                    $var = (int) $xml->link_stat->share_count;
                    break;
                case 'like_count':
                    $var = (int) $xml->link_stat->like_count;
                    break;
                case 'comment_count':
                    $var = (int) $xml->link_stat->comment_count;
                    break;
                case 'total_count':
                    $var = (int) $xml->link_stat->total_count;
                    break;
                case 'click_count':
                    $var = (int) $xml->link_stat->click_count;
                    break;
                case 'commentsbox_count':
                    $var = (int) $xml->link_stat->commentsbox_count;
                    break;
                case 'max':
                    $var =  max($shares, $likes, $comments);
                    break;
            }
            if(is_numeric($var) || is_int($var)){
                if ($var == 0 || !isset($var)) {
                    $var = 0;
                }
            }   
            return $var;

        }catch(Exception $e){
            //return $e;
        }
    }
    
    /**
     * Cria url amigável
     * @param type $url
     * @param string $titulo
     * @param type $data
     * @return null 
     */
    public static function urlFriendly($url = '', $titulo = '', $data = ''){
        if($url == '' && $titulo = ''){
            return null;
        }
        $url = ROOT."/$url/";
        if($data != ''){
            $url .= "$data-";
        }
        $url .= urlAmigavelToClear($titulo);
        return $url;

    }

    public static function maskPhone(){
        if($this->var == "" || $this->var == null || $this->var == false){
            return null;
        }
        $prefixo = substr($string, 0, 4);
        $sufixo = substr($string, 4, 4);
        $string = $prefixo."-".$sufixo;
        return $string;
    }

    public static function maskCep(){
        if(self::$var == "" || self::$var == null || self::$var == false){
            return null;
        }
        $prefixo = substr(self::$var, 0, 5);
        $sufixo = substr(self::$var, 5, 3);
        self::$var = $prefixo."-".$sufixo;
        return self::$var;
    }

    public static function maskCPF(){
        if(self::$var == "" || self::$var == null || self::$var == false){
            return null;
        }
        $a = substr(self::$var, 0, 2);
        $b = substr(self::$var, 3, 3);
        $c = substr(self::$var, 5, 3);
        $digito = substr(self::$var, 8, 2);
        self::$var = $a.'.'.$b.'.'.$c.'-'.$digito;
        return self::$var;
    }

    public static function maskCNPJ(){
        if(self::$var == "" || self::$var == null || self::$var == false){
            return null;
        }
        $a = substr(self::$var, 0, 2);
        $b = substr(self::$var, 2, 3);
        $c = substr(self::$var, 5, 3);
        $d = substr(self::$var, 8, 4);
        $digito = substr(self::$var, 12, 2);
        self::$var = $a.'.'.$b.'.'.$c.'/'.$d.'-'.$digito;
        return self::$var;
    }

    public static function clearSpecialChars(){
        if(self::$var == "" || self::$var == null || self::$var == false){
            return null;
        }
        self::$var = strtr(self::$var, "ÀÁÃÂàáâãÈÉÈÊèéêëÒÓÕÔóôõçÇÑñÍÌìí%;ºª?!_&()?", "AAAAaaaaEEEEeeeeOOOOooocCNnIIii-------e---");
        return self::$var;
    }

    public static function clearTagHTML(){
        if(self::$var == "" || self::$var == null || self::$var == false){
            return null;
        }
        return strip_tags(self::$var);
    }
    
    public static function setVar($var = ""){
        $this->var = $var;        
    }
    
    //-----------------------------------------------------
    //Funcao: validaCNPJ($cnpj)
    //Sinopse: Verifica se o valor passado é um CNPJ válido
    // Retorno: Booleano
    // Autor: Gabriel Fróes - www.codigofonte.com.br
    //-----------------------------------------------------
    public static function validaDocumento($tipo = "cpf", $documento = "") { 
        if($documento == ""){
            return;
        }
        
        $return = false;
        
        switch ($tipo){
            case 'cpf':
            $documento = str_replace('-"', '', $documento);
            $documento = str_replace(".", "", $documento);
            /**
             * isCpfValid
             *
             * Esta função testa se um cpf é valido ou não. 
             *
             * @author	Raoni Botelho Sporteman <raonibs@gmail.com>
             * @version	1.0 Debugada em 26/09/2011 no PHP 5.3.8
             * @param	string		$cpf			Guarda o cpf como ele foi digitado pelo cliente
             * @param	array		$num			Guarda apenas os números do cpf
             * @param	boolean		$isCpfValid		Guarda o retorno da função
             * @param	int			$multiplica 	Auxilia no Calculo dos Dígitos verificadores
             * @param	int			$soma			Auxilia no Calculo dos Dígitos verificadores
             * @param	int			$resto			Auxilia no Calculo dos Dígitos verificadores
             * @param	int			$dg				Dígito verificador
             * @return	boolean						"true" se o cpf é válido ou "false" caso o contrário
             *
             */
            //Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
            $j=0;
            for($i=0; $i<(strlen($documento)); $i++){
                if(is_numeric($documento[$i])){
                        $num[$j]=$documento[$i];
                        $j++;
                }
            }
            //Etapa 2: Conta os dígitos, um cpf válido possui 11 dígitos numéricos.
            if(count($num)!=11){
                $isCpfValid=false;
            //Etapa 3: Combinações como 00000000000 e 22222222222 embora não sejam cpfs reais resultariam em cpfs válidos após o calculo dos dígitos verificares e por isso precisam ser filtradas nesta parte.
            }else{
                for($i=0; $i<10; $i++){
                    if ($num[0]==$i && $num[1]==$i && $num[2]==$i && $num[3]==$i && $num[4]==$i && $num[5]==$i && $num[6]==$i && $num[7]==$i && $num[8]==$i){
                        $isCpfValid = false;
                        break;
                    }
                }
            }
            //Etapa 4: Calcula e compara o primeiro dígito verificador.
            if(!isset($isCpfValid)){
                $j=10;
                for($i=0; $i<9; $i++){
                    $multiplica[$i]=$num[$i]*$j;
                    $j--;
                }
                $soma = array_sum($multiplica);	
                $resto = $soma%11;			
                if($resto<2){
                    $dg=0;
                }else{
                    $dg=11-$resto;
                }
                if($dg!=$num[9]){
                    $isCpfValid = false;
                }
            }
            //Etapa 5: Calcula e compara o segundo dígito verificador.
            if(!isset($isCpfValid)){
                $j=11;
                for($i=0; $i<10; $i++){
                    $multiplica[$i]=$num[$i]*$j;
                    $j--;
                }
                $soma = array_sum($multiplica);
                $resto = $soma%11;
                if($resto<2){
                    $dg = 0;
                }else{
                    $dg = 11-$resto;
                }
                if($dg!=$num[10]){
                    $isCpfValid = false;
                }else{
                    $isCpfValid = true;
                }
            }
            $return = $isCpfValid;					
                               
                break;
            case 'cnpj':
                if (strlen($documento) <> 18) return 0; 
                    $soma1 = ($documento[0] * 5) + 

                    ($documento[1] * 4) + 
                    ($documento[3] * 3) + 
                    ($documento[4] * 2) + 
                    ($documento[5] * 9) + 
                    ($documento[7] * 8) + 
                    ($documento[8] * 7) + 
                    ($documento[9] * 6) + 
                    ($documento[11] * 5) + 
                    ($documento[12] * 4) + 
                    ($documento[13] * 3) + 
                    ($documento[14] * 2); 
                    $resto = $soma1 % 11; 
                    $digito1 = $resto < 2 ? 0 : 11 - $resto; 
                    $soma2 = ($documento[0] * 6) + 

                    ($documento[1] * 5) + 
                    ($documento[3] * 4) + 
                    ($documento[4] * 3) + 
                    ($documento[5] * 2) + 
                    ($documento[7] * 9) + 
                    ($documento[8] * 8) + 
                    ($documento[9] * 7) + 
                    ($documento[11] * 6) + 
                    ($documento[12] * 5) + 
                    ($documento[13] * 4) + 
                    ($documento[14] * 3) + 
                    ($documento[16] * 2);

                    $resto = $soma2 % 11; 
                    $digito2 = $resto < 2 ? 0 : 11 - $resto; 
                    if(($documento[16] == $digito1) && ($documento[17] == $digito2)){
                        $return = true;
                    }else{
                        $return = false;
                    }
                break;
        }
        return $return;
    }
    
    public static function link($location = "", $data = "", $id = "", $tituloAmigavel = ""){
        if($id == "" || $id == null || $id == 0){
            $urlString = ROOT."/$location/".Transforma::urlSEO($tituloAmigavel)."/";
        }else if($data == "" || $data == null){
            $urlString = ROOT."/$location/$id/".Transforma::urlSEO($tituloAmigavel)."/";
        }else{
            $urlString = ROOT."/$location/".DataHoje::live('Y', $data)."/".DataHoje::live('m', $data)."/".DataHoje::live('d', $data)."/".$id."/".Transforma::urlSEO($tituloAmigavel)."/";
        }
        return $urlString;
    }
    
    public static function resume($string = "", $length = 0, $delim = '...'){
        $len = strlen($string);
        if($len > $length){
            $string = substr($string, 0, $length) . $delim;
        }
        return $string;
    }     
}