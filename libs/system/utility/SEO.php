<?php

class SEO extends String {

    private $stringA = "";
    private $stringB = "";

    public function __construct($stringA, $stringB) {
        $this->stringA = $stringA;
        $this->stringB = $stringB;
    }

    public static function metaDescription($string = "") {
        $string = self::AccentsRemakes(self::clearStripTags($string));
        $string = str_replace("&nbsp;", "", $string);
        $string = self::resume($string, 255, "...");
        return $string;
    }

    public static function metaKeyWords($string = "") {
        if ($string == "") {
            return null;
        }
        $arr = explode('-', self::urlSEO($string));
        $newString = "";
        if (sizeof($arr) < 20) {
            $limit = sizeof($arr);
        } else {
            $limit = 20;
        }
        for ($i = 0; $i < $limit; $i++) {
            $string = str_replace(" ", "", $arr[$i]);
            $string = str_replace("...", "", $string);
            $newString .= $string . ", ";
        }
        return $newString;
    }

    /** Transforma uma palavra em uma alias, usada em URL's / TITLE's amigáveis */
    public static function geraAlias($var = "") {
        if (self::$var == "" || self::$var == null || self::$var == false) {
            return null;
        }
        if ($var != "") {
            self::$var = strtolower($var);
        } else {
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
    public static function traduzAcentos($var = "") {
        if ($var == "") {
            if (self::$var == "" || self::$var == null || self::$var == false) {
                return null;
            }
        } else {
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
        self::$var = str_replace("à ", "&agrave;", self::$var);
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
    public static function AccentsRemakes($var = "") {
        return htmlspecialchars_decode($var, ENT_QUOTES);
    }

    /**
     * Tranforma caracteres especiais em codificação.
     * @param type $var
     * @return type
     */
    public static function TranslateAccents($var = "") {
        return htmlspecialchars($var, ENT_QUOTES);
    }

    /**
     * URL SEO
     * @param type $string
     * @return null 
     */
    public static function urlSEO($string = "") {
        $varA = strtolower($string);
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??"!@#$%&*()_-+={[}]/?;:.,\\\'<>¬`´~^ªº°|¹²³£¨¢';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby                                               ';
        $varB = strip_tags(trim(utf8_decode(strtr($varA, $a, $b))));
        /* Agora, remove qualquer espaço em branco duplicado */
        $varC = preg_replace('/\s(?=\s)/', '', $varB);
        /* Ssubstitui qualquer espaço em branco (não-espaço), com um espaço */
        $varD = preg_replace('/[\n\r\t]/', ' ', $varC);
        /* Remove qualquer espaço vazio */
        $var = strtolower(utf8_encode(str_replace(" ", "-", str_replace("?", "-", $varD))));
        return $var;
    }

    public static function agent() {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (!$userAgent) {
            return false;
        }
        for ($i = 0; $i < sizeof($this->agentList); $i++) {
            if (strstr($_SERVER['HTTP_USER_AGENT'], strtolower($this->agentList[$i]))) {
                return true;
                break;
            } else {
                return false;
            }
        }
    }

    public static function clearSpecialChars($var = "") {
        return strtr($var, "ÀÁÃÂàáâãÈÉÈÊèéêëÒÓÕÔóôõçÇÑñÍÌìí%;ºª?!_&()?", "AAAAaaaaEEEEeeeeOOOOooocCNnIIii-------e---");
    }

    public static function link($location = "", $date = "", $id = "", $titleFriendly = "") {
        if ($id == "" || $id == null || $id == 0) {
            $urlString = ROOT . "/$location/" . self::urlSEO($titleFriendly) . "/";
        } else if ($date == "" || $date == null) {
            $urlString = ROOT . "/$location/$id/" . self::urlSEO($titleFriendly) . "/";
        } else {
            $urlString = ROOT . "/$location/" . DataHoje::live('Y', $date) . "/" . DataHoje::live('m', $date) . "/" . DataHoje::live('d', $date) . "/" . $id . "/" . self::urlSEO($titleFriendly) . "/";
        }
        return $urlString;
    }

    public static function resume($string = "", $length = 0, $delim = '...') {
        if (strlen($string) > $length) {
            $string = substr($string, 0, $length) . $delim;
        }
        return $string;
    }
    
    private $agentList = array(
        "ABCdatos BotLink",
        "ht://Dig",
        "Resume Robot",
        "The Web Wombat",
        "Acme.Spider",
        "HTMLgobble",
        "RoadHouse Crawling System",
        "The World Wide Web Worm",
        "Ahoy! The Homepage Finder",
        "Hyper-Decontextualizer",
        "RixBot", "WWWC Ver 0.2.5",
        "Ask",
        "Yandex",
        "Yahoo",
        "uol",
        "Alkaline",
        "iajaBot",
        "Road Runner: The ImageScape Robot",
        "WebZinger",
        "Anthill",
        "IBM_Planetwide",
        "Robbie the Robot",
        "XGET",
        "Walhello appie",
        "Popular Iconoclast",
        "ComputingSite Robi/1.0",
        "Arachnophilia",
        "Ingrid",
        "RoboCrawl Spider",
        "Jakarta",
        "Arale",
        "Imagelock",
        "RoboFox",
        "Araneo",
        "IncyWincy",
        "Robozilla",
        "AraybOt",
        "Informant",
        "Roverbot",
        "ArchitextSpider",
        "InfoSeek Robot 1.0",
        "RuLeS", "Aretha",
        "Infoseek Sidewinder",
        "SafetyNet Robot",
        "ARIADNE",
        "InfoSpiders",
        "Scooter",
        "Alexa",
        "arks",
        "Inspector Web",
        "Sleek",
        "AskJeeves",
        "IntelliAgent",
        "Search.Aus-AU.COM",
        "ASpider (Associative Spider)",
        "I, Robot",
        "SearchProcess",
        "ATN Worldwide",
        "Iron33",
        "Senrigan",
        "Atomz.com Search Robot",
        "Israeli-search",
        "SG-Scout",
        "AURESYS",
        "JavaBee",
        "ShagSeeker",
        "BackRub",
        "JBot Java Web Robot",
        "Shai'Hulud",
        "Bay Spider",
        "JCrawler",
        "Sift", "Big Brother",
        "Jeeves",
        "Simmany Robot Ver1.0",
        "Bjaaland",
        "JoBo Java Web Robot",
        "Site Valet",
        "BlackWidow",
        "Jobot",
        "Open Text Index Robot",
        "Die Blinde Kuh",
        "JoeBot",
        "SiteTech-Rover",
        "Bloodhound",
        "The Jubii Indexing Robot",
        "Skymob.com",
        "Borg-Bot",
        "JumpStation",
        "SLCrawler",
        "BoxSeaBot",
        "image.kapsi.net",
        "Inktomi Slurp",
        "bright.net caching robot",
        "Katipo",
        "Smart Spider",
        "BSpider",
        "KDD-Explorer",
        "Snooper",
        "CACTVS Chemistry Spider",
        "Kilroy",
        "Solbot",
        "Calif",
        "KO_Yappo_Robot",
        "Spanner",
        "churl",
        "LinkScan",
        "SpiderMan",
        "cIeNcIaFiCcIoN.nEt",
        "LinkWalker",
        "SpiderView(tm)",
        "Cassandra",
        "LabelGrabber",
        "Speedy Spider",
        "Digimarc Marcspider/CGI",
        "larbin",
        "spider_monkey",
        "Checkbot",
        "legs",
        "SpiderBot",
        "ChristCrawler.com",
        "Link Validator",
        "Spiderline Crawler",
        "CMC/0.01", "Lockon",
        "Spry Wizard Robot",
        "Collective",
        "logo.gif Crawler",
        "Site Searcher",
        "CombineSystem",
        "Lycos",
        "Suke",
        "Conceptbot",
        "Mac WWWWorm",
        "suntek search engine",
        "ConfuzzledBot",
        "Magpie",
        "Sven",
        "CoolBot",
        "marvin/infoseek",
        "Sygol",
        "Web Core / Roots",
        "Mattie",
        "TACH Black Widow",
        "XYLEME Robot",
        "MediaFox",
        "Tarantula",
        "Internet Cruiser Robot",
        "MerzScope",
        "tarspider",
        "Cusco",
        "NEC-MeshExplorer",
        "Tcl W3 Robot",
        "CyberSpyder Link Test",
        "MindCrawler",
        "TechBOT",
        "CydralSpider",
        "mnoGoSearch search engine software",
        "Templeton",
        "Desert Realm Spider",
        "moget",
        "TeomaTechnologies",
        "DeWeb(c) Katalog/Index",
        "MOMspider", "TITAN",
        "DienstSpider",
        "Monster",
        "TitIn",
        "Digger",
        "Motor",
        "The TkWWW Robot",
        "DigitalIntegrity Robot",
        "MSNBot",
        "TLSpider",
        "Direct Hit Grabber",
        "Muncher", "UCSD Crawl",
        "DNAbot",
        "Muninn",
        "UdmSearch",
        "DownLoad Express",
        "Muscat Ferret",
        "UptimeBot",
        "DragonBot",
        "Mwd.Search",
        "URL Check",
        "DWCP (Dridus' Web Cataloging Project)",
        "Internet Shinchakubin",
        "URL Spider Pro",
        "e-collector",
        "NDSpider",
        "Valkyrie",
        "EbiNess",
        "Nederland.zoek",
        "Verticrawl",
        "EIT Link Verifier Robot",
        "NetCarta WebMap Engine",
        "Victoria",
        "ELFINBOT",
        "NetMechanic",
        "vision-search",
        "Emacs-w3 Search Engine",
        "NetScoop",
        "void-bot",
        "ananzi",
        "newscan-online",
        "Voyager", "esculapio",
        "NHSE Web Forager",
        "VWbot",
        "Esther",
        "Nomad",
        "The NWI Robot",
        "Evliya Celebi",
        "The NorthStar Robot",
        "W3M2", "FastCrawler",
        "nzexplorer",
        "WallPaper (alias crawlpaper)",
        "Fluid Dynamics Search Engine robot",
        "ObjectsSearch",
        "the World Wide Web Wanderer",
        "Felix IDE",
        "Occam",
        "w@pSpider by wap4.com",
        "Wild Ferret Web Hopper #1, #2, #3",
        "HKU WWW Octopus",
        "WebBandit Web Spider",
        "FetchRover",
        "OntoSpider",
        "WebCatcher",
        "fido",
        "Openfind data gatherer",
        "WebCopy",
        "Hämähäkki",
        "Orb Search",
        "webfetcher",
        "KIT-Fireball",
        "Pack Rat",
        "The Webfoot Robot",
        "Fish search",
        "PageBoy",
        "Webinator",
        "Fouineur",
        "ParaSite",
        "weblayers",
        "Robot Francoroute",
        "Patric",
        "WebLinker",
        "Freecrawl",
        "pegasus",
        "MJ12bot",
        "WordPress",
        "Netcraft",
        "WebMirror",
        "FunnelWeb",
        "The Peregrinator",
        "The Web Moose",
        "gammaSpider",
        "FocusedCrawler",
        "PerlCrawler 1.0",
        "WebQuest",
        "gazz",
        "Phantom",
        "Digimarc MarcSpider",
        "GCreep",
        "PhpDig",
        "WebReaper",
        "GetBot",
        "PiltdownMan",
        "webs",
        "GetURL",
        "Pimptrain.com's robot",
        "Websnarf",
        "Golem", "Pioneer",
        "WebSpider",
        "Googlebot",
        "html_analyzer",
        "WebVac",
        "Grapnel/0.01 Experiment",
        "Portal Juice Spider",
        "webwalk",
        "Griffon",
        "PGP Key Agent",
        "WebWalker",
        "Gromit",
        "PlumtreeWebAccessor",
        "WebWatch",
        "Northern Light Gulliver",
        "Poppi", "Wget",
        "Gulper Bot",
        "PortalB Spider",
        "whatUseek Winona",
        "HamBot", "psbot",
        "WhoWhere Robot",
        "Harvest",
        "GetterroboPlus Puu",
        "Wired Digital",
        "havIndex",
        "The Python Robot",
        "Weblog Monitor",
        "HI (HTML Index) Search",
        "Raven Search",
        "w3mir",
        "Hometown Spider Pro",
        "RBSE Spider",
        " WebStolperer",
        "bingbot",
        "facebook",
        "discovery",
        "facebookexternalhit"
    );    

}

?>
