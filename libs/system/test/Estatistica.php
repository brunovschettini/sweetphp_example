<?php

class Estatistica {
    
    public static function countEdicao($id = 0) {
        if($id == 0){
            $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
            if($id == 0){
                return null;
            }
        }
        $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : getenv('REMOTE_ADDR');
        //$ip = "127.0.0.8";
        if(empty($ip)){
            return null;
        }
        
        if($ip == '200.158.101.9'){
            return null;
        }
        
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        
        if($userAgent){
            if(self::agente() == true){
                return null;
            }
        }
        
        $db = new DB();        
        $exeIP = $db->prepare(" SELECT id 
                                  FROM est_ip 
                                 WHERE ds_descricao LIKE :ip ");
        $exeIP->bindParam(':ip', $ip, PDO::PARAM_STR);
        $idIP = 0;
        if($exeIP->execute()){
            if($exeIP->rowCount() == 0){
                $insertIP = $db->prepare(" INSERT INTO est_ip ( id, ds_descricao , dt_acesso ) VALUES ( NULL, :ip , NOW() )");
                $insertIP->bindParam(':ip', $ip, PDO::PARAM_STR);
                if($insertIP->execute()){
                    $idIP = $db->lastInsertId();
                }else{
                    return null;
                }
                
            }else{
               $result = $exeIP->fetchObject(); 
               $idIP = $result->id;
            }
        }else{
            return null;
        }
        $idEstEdi = 0;
        $idEstEdiIP = 0;
        $exeEstEdi = $db->prepare(" SELECT est.id AS idEst, est.id_edicao AS idEdicao, ip.id AS idIp 
                                      FROM est_acesso_edicao est
                                INNER JOIN est_acesso_edicao_ip ip ON ip.id_acesso_edicao = est.id 
                                     WHERE est.id_edicao = :id
                                       AND DATE_FORMAT(est.dt_acesso, '%Y-%m-%d') = CURDATE(); ");
        $exeEstEdi->bindParam(':id', $id, PDO::PARAM_INT);
        if($exeEstEdi->execute()){
            if($exeEstEdi->rowCount() == 0){
                $db->beginTransaction();
                $insertEstEdi = $db->prepare(" INSERT INTO est_acesso_edicao 
                                                           ( id, id_edicao, nr_contador, dt_acesso ) 
                                                    VALUES ( NULL, :id , 1, NOW() ) ");
                $insertEstEdi->bindParam(':id', $id, PDO::PARAM_INT);                
                if($insertEstEdi->execute()){
                    $idEstEdi = $db->lastInsertId();                
                    $insertEstEdi = $db->prepare(" INSERT INTO est_acesso_edicao_ip 
                                                               ( id, id_acesso_edicao, id_ip, dt_acesso ) 
                                                        VALUES ( NULL, :id , :ip , NOW()) ");
                    $insertEstEdi->bindParam(':id', $idEstEdi, PDO::PARAM_INT);
                    $insertEstEdi->bindParam(':ip', $idIP, PDO::PARAM_INT);
                    if($insertEstEdi->execute()){
                        $idEstEdiIP = $db->lastInsertId();
                        if($idEstEdiIP > 0){
                            $db->commit();
                        }else{
                            $db->rollBack();
                            return false;
                        }
                    }else{
                        $db->rollBack();
                        return false;
                    }
                }else{
                    $db->rollBack();
                    return false;
                }
            }else{
                $objectB =  $exeEstEdi->fetchObject();
                $db = new DB(); 
                $db->beginTransaction();
                $insertEstEdiIP = $db->prepare(" UPDATE est_acesso_edicao 
                                                    SET nr_contador = nr_contador + 1  
                                                  WHERE id_edicao = :id 
                                                    AND DATE_FORMAT(dt_acesso, '%Y-%m-%d') = CURDATE(); ");
                $insertEstEdiIP->bindParam(':id', $id, PDO::PARAM_INT);
                if($insertEstEdiIP->execute()){                    
                    $qStringEstEdi = $db->prepare(" SELECT * 
                                                      FROM est_acesso_edicao_ip 
                                                     WHERE id_acesso_edicao = :id 
                                                       AND id_ip = :ip 
                                                       AND DATE_FORMAT(dt_acesso, '%Y-%m-%d') = CURDATE(); ");
                    $qStringEstEdi->bindParam(':id', $objectB->idEst, PDO::PARAM_INT);
                    $qStringEstEdi->bindParam(':ip', $idIP, PDO::PARAM_INT);
                    
                    if($qStringEstEdi->execute()){
                        if($qStringEstEdi->rowCount() == 0){
                            $insertEstEdi = $db->prepare(" INSERT INTO est_acesso_edicao_ip 
                                                                       ( id, id_acesso_edicao, id_ip, dt_acesso ) 
                                                                VALUES ( null, :id , :ip , NOW() ) ");
                            $insertEstEdi->bindParam(':id', $objectB->idEst, PDO::PARAM_INT);
                            $insertEstEdi->bindParam(':ip', $idIP, PDO::PARAM_INT);
                            if($insertEstEdi->execute()){
                                $idEstEdiIP = $db->lastInsertId();
                                if($idEstEdiIP > 0){
                                    $db->commit();
                                }else{
                                    $db->rollBack();
                                    return false;
                                }
                            }else{
                                $db->rollBack();
                                return false;
                            }
                        }else{
                            $db->rollBack();
                            return false;
                        }
                    }else{
                        $db->rollBack();
                        return false;
                    }
                }else{
                    $db->rollBack();
                    return false;
                }                
                
            }
        }else{
            return null;
        }           
        
    }
    
    public static function showEdicao($id = 0, $return = false) {        
        if($id == 0){
            $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
            if($id == 0){
                return '0';
            }
        }
        
        $db = new DB();
        $exe = $db->prepare(" SELECT SUM(nr_contador) AS soma FROM est_acesso_edicao WHERE id_edicao = :id ");
        $exe->bindParam(':id', $id, PDO::PARAM_INT);
        if($exe->execute()){
            if($exe->rowCount() > 0){
                $result = $exe->fetch(PDO::FETCH_OBJ);
                if($result->soma > 0){
                    if($return == false){
                        ?><?=$result->soma;?><?
                        return null;
                    }else if($return == true){
                        return $result->soma;
                    }
                }else{
                    return '1';
                }                
            }else{
                return '1';
            }
        }else{
            return '1';
        }
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
        
        if($continue == true){
            return true;
        }else if($continue == false){
            return false;
        }else{
            return false;
        }
    }
    
    public static function scriptEdicao($id = 0, $return = ".showEdicao"){
        ?><script type="text/javascript">getAjaxSimpleHTML('POST', '<?=ROOT;?>/req.php', '<?=$return;?>', {request:'estatistica', action:'countEdicao', id:<?=$id;?>}, '<?=$return;?>', 'loadingFacebook');</script><?
    }
    
    public static function scriptEdicaoMaisAcessada($retorno = "all"){
        ?><script type="text/javascript">getAjaxSimpleHTML('POST', '<?=ROOT;?>/req.php', '.edicaoMaisAcessada', {request:'estatistica', action:'edicaoMaisAcessada', retorno:'<?=$retorno;?>', periodo:'<?=$periodo;?>'}, 'edicaoMaisAcessada', 'loadingFacebook');</script><?
    }
    
    public static function edicaoMaisAcessada($return = "", $periodo = "", $periodo = null, $disabledNumber = false, $limit = 0, $showImage = false, $class = "edicao-mais-acessada"){

        
        $isNoticia = false;
        $isAgenda = false;
        $isColuna = false;
        $isReceita = false;
        $isPoema = false;
        $isSorria = false;
        $isPrograma = false;
        $isPagina = false;
        
        $tipoReturn = "";
        if($return == ""){
            $return = isset($_POST['retorno']) ? $_POST['retorno'] : "";
            if($return == ""){
                $tipoReturn == "all";
            }else{
                $tipoReturn = $return;
            }
        }
        
        if($periodo == ""){
            $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : "";
        }
        
        if($limit == 0){
            $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
        }
        
        if($disabledNumber == false){
            $disabledNumber = isset($_POST['disabledNumber']) ? $_POST['disabledNumber'] : false;            
        }
        
        if($showImage == false){
            $showImage = isset($_POST['showImage']) ? $_POST['showImage'] : false;
        }
        
        $order = "";
        if($periodo == "hoje"){
            $order = " contador DESC , est.dt_acesso DESC ";
            $periodo = " AND DATE_FORMAT(est.dt_acesso, '%Y-%m-%d') = CURDATE() ";
        }else if($periodo == "semana"){
            $order = " contador DESC , est.dt_acesso DESC";
            //$periodo = " AND est.dt_acesso BETWEEN DATE_FORMAT(est.dt_acesso, '%Y-%m-%d') AND DATE_ADD(NOW(), INTERVAL 7 DAY) ";
            $periodo = " AND est.dt_acesso >= NOW() - INTERVAL 1 MONTH ";
        }else if($periodo == "mes"){
            $order = " contador DESC , est.dt_acesso DESC ";
            $periodo = " AND DATE_FORMAT(est.dt_acesso, '%m') = DATE_FORMAT(NOW(), '%m') ";
        }else if($periodo == "sempre"){
            $order = " contador DESC , est.dt_acesso DESC";
            $periodo = " ";
        }
        
        $db = new DB();
        
        $as = "";
        $left = "";
        $where = "";
        
        $join = " INNER ";
        if($return == "all"){
            $join = " LEFT ";
        }
        
        if($return == 'agenda' || $return == "all"){
            $isAgenda = true;
            $as .= "  age.id AS aid, age.dt_inicio , age.is_cobertura , ";
            $left .= " $join JOIN edi_agenda age ON age.id_edicao = edi.id ";
            $where = "";
        }
        if($return == 'noticia' || $return == "all"){
            $isNoticia = true;
            $as .= "  n.id AS nid,  ";
            $left .= " $join JOIN edi_noticia n ON n.id_edicao = edi.id ";
            $where = "";
        }
        if($return == 'coluna' || $return == "all"){
            $isColuna = true;
            $as .= "  c.id AS cid,  ";
            $left .= " LEFT JOIN edi_coluna c ON c.id_edicao = edi.id ";
            $where = "";
        }
        if($return == 'receita' || $return == "all"){
            $isReceita = true;
            $as .= "  r.id AS rid,  ";
            $left .= " $join JOIN edi_receita r ON r.id_edicao = edi.id ";
            $where = "";
        }
        if($return == 'poema' || $return == "all"){
            $isPoema = true;
            $as .= "  p.id AS pid,  ";
            $left .= " $join JOIN edi_poema p ON p.id_edicao = edi.id ";
            $where = "";
        }
        if($return == 'sorria' || $return == "all"){
            $isSorria = true;            
            $as .= "  s.id AS sid,  ";
            $left .= " $join JOIN edi_sorria s ON s.id_edicao = edi.id ";
            $where = "";
        }
        if($return == 'pagina' || $return == "all"){
            $isSorria = true;            
            $as .= "  pag.id AS pagid,  ";
            $left .= " $join JOIN edi_pagina pag ON pag.id_edicao = edi.id ";
            $where = "";
        }
        if($return == 'programa' || $return == "all"){
            $as .= "  pc.id AS pcid , edip.ds_titulo AS tituloPrograma, cat1.ds_descricao AS categoria1 , ";
            $left .= " $join JOIN edi_programa_capitulo pc ON pc.id_edicao = edi.id ";
            $left .= " $join JOIN edi_programa t ON t.id = pc.id_programa ";
            $left .= " $join JOIN edi_edicao edip ON edip.id = t.id_edicao ";
            $left .= " $join JOIN aux_categoria_1 cat1 ON cat1.id = edip.id_categoria_1 ";
            $where = "";
        }
        
        if($showImage == true){
            $as .= " arq.ds_arquivo, alb.ds_diretorio ";
            $left = " INNER JOIN img_album alb ON alb.id = edi.id_album 
                            LEFT JOIN img_arquivo arq ON arq.id_album = alb.id 
                    ";
            $where = " AND arq.is_capa LIKE 'on' ";
        }        
        
        $queryString = 
        "SELECT edi.id, edi.ds_titulo, edi.dt_cadastro, $as SUM(est.nr_contador) AS contador 
                FROM edi_edicao edi
               $left 
           LEFT JOIN est_acesso_edicao est ON est.id_edicao = edi.id
               WHERE edi.is_ativo LIKE 'on' 
                     $periodo 
            GROUP BY edi.id
            ORDER BY $order 
               LIMIT 0 , $limit "; 
        $styleText = "";
        if($disabledNumber == true){
            $styleText = " style=\"margin-left:0!important;\" ";
        }
        $url = "";
        $exe = $db->prepare( $queryString );
        $y = 0;
        if($exe->execute()){
            if($exe->rowCount() > 0){
                $lista = $exe->fetchAll(PDO::FETCH_OBJ);
                
                ?><div class="<?=$class;?>">
                    <ol><?
                for($i = 0; $i < sizeof($lista); $i++){
                    
                    $idAgenda = 0;
                    $idNoticia = 0;
                    $idColuna = 0;
                    $idReceita = 0;
                    $idPoema = 0;
                    $idSorria = 0;                    
                    $idPagina = 0;                    
                    $idPrograma = 0;                    
                    
                    if($return == 'noticia' || $return == "all"){
                        if($lista[$i]->nid != null){
                            $idNoticia = $lista[$i]->nid;
                        }
                    }
                    
                    if($return == 'agenda' || $return == "all"){
                        if($lista[$i]->aid != null){
                            $idAgenda = $lista[$i]->aid;
                        }
                    }
                    if($return == 'coluna' || $return == "all"){
                        if($lista[$i]->cid != null){
                            $idColuna = $lista[$i]->cid;
                        }
                    }
                    if($return == 'receita' || $return == "all"){
                        if($lista[$i]->rid != null){
                            $idReceita = $lista[$i]->rid;
                        }
                    }
                    if($return == 'poema' || $return == "all"){
                        if($lista[$i]->pid != null){
                            $idPoema = $lista[$i]->pid;
                        }
                    }
                    if($return == 'sorria' || $return == "all"){
                        if($lista[$i]->sid != null){
                            $idSorria = $lista[$i]->sid;
                        }
                    }                    
                    if($return == 'pagina' || $return == "all"){
                        if($lista[$i]->pagid != null){
                            $idPagina = $lista[$i]->pagid;
                        }
                    }                    
                    if($return == 'programa' || $return == "all"){
                        if($lista[$i]->pcid != null){
                            $idPrograma = $lista[$i]->pcid;
                        }
                    }
                    
                    if($idNoticia > 0){
                        $url = Transforma::link('noticia', $lista[$i]->dt_cadastro, $idNoticia, $lista[$i]->ds_titulo);
                        self::linkEdicaoMaisAcessada($y, $url, $lista[$i]->ds_titulo, $styleText, $disabledNumber);
                        $y++;
                    }else if($idAgenda > 0){
                        $tipoTela = "evento";
                        if($lista[$i]->is_cobertura == "on"){
                            $tipoTela = "cobertura";
                        }
                        $url = Transforma::link($tipoTela, $lista[$i]->dt_inicio, $idAgenda, $lista[$i]->ds_titulo);
                        self::linkEdicaoMaisAcessada($y, $url, $lista[$i]->ds_titulo, $styleText, $disabledNumber);
                        $y++;
                    }else if($idColuna > 0){
                        $url = Transforma::link('coluna', $idColuna, $lista[$i]->cid, $lista[$i]->ds_titulo);
                        self::linkEdicaoMaisAcessada($y, $url, $lista[$i]->ds_titulo, $styleText, $disabledNumber);
                        $y++;
                    }else if($idReceita> 0){
                        $url = Transforma::link('receita', null, $idReceita, $lista[$i]->ds_titulo);
                        self::linkEdicaoMaisAcessada($y, $url, $lista[$i]->ds_titulo, $styleText, $disabledNumber);
                        $y++;
                    }else if($idPoema> 0){
                        $url = Transforma::link('poema', null, $idPoema, $lista[$i]->ds_titulo );
                        self::linkEdicaoMaisAcessada($y, $url, $lista[$i]->ds_titulo, $styleText, $disabledNumber);
                        $y++;
                    }else if($idSorria > 0){
                        $url = Transforma::link('sorria', null, $idSorria, $lista[$i]->ds_titulo);
                        self::linkEdicaoMaisAcessada($y, $url, $lista[$i]->ds_titulo, $styleText, $disabledNumber);
                        $y++;
                    }else if($idPagina > 0){
                        $url = Transforma::link('conteudo', null, null, $lista[$i]->ds_titulo);
                        self::linkEdicaoMaisAcessada($y, $url, $lista[$i]->ds_titulo, $styleText, $disabledNumber);
                        $y++;
                    }else if($idPrograma > 0){
                        $url = Transforma::link("televisao/".Transforma::urlSEO($lista[$i]->categoria1)."/".Transforma::urlSEO($lista[$i]->tituloPrograma), null, $idPrograma, $lista[$i]->ds_titulo);
                        self::linkEdicaoMaisAcessada($y, $url, $lista[$i]->ds_titulo, $styleText, $disabledNumber);
                        $y++;
                    }
                }
                    ?></ol><? 
                ?></div><? 
            }
        }
    }
    
    public static function linkEdicaoMaisAcessada($y = 0, $url = "", $titulo = "", $styleText = "", $disabledNumber = false){
        ?><li>
            <a href="<?=$url;?>">
            <?if($disabledNumber == false){?>
                <span class="num"><?=$y+1;?></span>
            <?}?>
                <div <?=$styleText;?> class="text">
                    <?if($disabledNumber == true){?>
                        <?=$y+1 ." - ";?>
                    <?}?> 
                    <?=$titulo;?>
                </div>
            </a>
        </li><?
        
    }

    public static function edicaoMaisAcessadaShow($id = "", $retorno = "", $periodos = null, $disabledNumber = false, $limit = 10, $showImage = false, $class = ""){
        $first = " id=\"tab-$id-um\" ";
        ?>
        <div id="tab-<?=$id;?>" class="no-border margin-top">
            <ul class="bg-white no-border">
            <?for($i = 0; $i < sizeof($periodos); $i++){
                if($periodos[$i] == "hoje"){?>
                    <li><a class="no-border" style="font-size: 8pt;" href="#tab-<?=$id?>-home" rel="nofollow">Hoje</a></li>
                    <?if($first != ""){
                        $first = "";
                    }?>
                <?}else if($periodos[$i] == "semana"){?>
                    <li><a <?=$first;?> class="no-border ajax-simple-click" data-request="{'request':'estatistica','action':'edicaoMaisAcessada','retorno':'<?=$retorno;?>','periodo':'semana','disabledNumber':'<?=$disabledNumber;?>','styleClass':'<?=$class;?>','limit':'<?=$limit;?>','showImage':'<?=$showImage;?>'}" data-return=".<?=$id?>-semana" style="font-size: 8pt;" href="#tab-<?=$id?>-semana" onclick="$.jAjaxSimple(this); $(this).attr('onclick');" rel="nofollow">Semana</a></li>
                    <?if($first != ""){
                        $first = "";
                    }?>                    
                <?}else if($periodos[$i] == "mes"){?>
                    <li><a <?=$first;?> class="no-border ajax-simple-click" data-request="{'request':'estatistica','action':'edicaoMaisAcessada','retorno':'<?=$retorno;?>','periodo':'mes','disabledNumber':'<?=$disabledNumber;?>','styleClass':'<?=$class;?>','limit':'<?=$limit;?>','showImage':'<?=$showImage;?>'}" data-return=".<?=$id?>-mes" style="font-size: 8pt;" href="#tab-<?=$id?>-mes" onclick="$.jAjaxSimple(this); $(this).attr('onclick');" rel="nofollow">Mês</a></li>
                    <?if($first != ""){
                        $first = "";
                    }?>                    
                <?}else if($periodos[$i] == "sempre"){?>
                    <li><a <?=$first;?> class="no-border ajax-simple-click" data-request="{'request':'estatistica','action':'edicaoMaisAcessada','retorno':'<?=$retorno;?>','periodo':'sempre','disabledNumber':'<?=$disabledNumber;?>','styleClass':'<?=$class;?>','limit':'<?=$limit;?>','showImage':'<?=$showImage;?>'}" data-return=".<?=$id?>-sempre" style="font-size: 8pt;" href="#tab-<?=$id?>-sempre" onclick="$.jAjaxSimple(this); $(this).attr('onclick');" rel="nofollow">Sempre</a></li>
                    <?if($first != ""){
                        $first = "";
                    }?>                    
                <?}?>
            <?}?>
            </ul>
            <?for($i = 0; $i < sizeof($periodos); $i++){?>
                <?if($periodos[$i] == "hoje"){?>
                <div class="ajax-simple" id="tab-<?=$id?>-home" data-request="{'request':'estatistica','action':'edicaoMaisAcessada','retorno':'<?=$retorno;?>','periodo':'hoje','disabledNumber':'<?=$disabledNumber;?>','styleClass':'<?=$class;?>','limit':'<?=$limit;?>','showImage':'<?=$showImage;?>'}" data-return=".<?=$id?>-hoje">
                    <div class="<?=$id?>-hoje"></div>
                </div>
                <?}else if($periodos[$i] == "semana"){?>
                <div id="tab-<?=$id?>-semana">
                    <div class="<?=$id?>-semana"></div>
                </div>
                <?}else if($periodos[$i] == "mes"){?>
                <div id="tab-<?=$id?>-mes">
                    <div class="<?=$id?>-mes"></div>
                </div>
                <?}else if($periodos[$i] == "sempre"){?>
                <div id="tab-<?=$id?>-sempre">
                    <div class="<?=$id?>-sempre"></div>
                </div>
                <?}?>
            <?}?>
        </div>                     
        <script>$(function(){ $("#tab-<?=$id?>").tabs(); });</script>
        <?
    }
    
    public static function avaliacao(){
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $voto = isset($_POST['voto']) ? $_POST['voto'] : 0;
        $avaliacao = self::queryAvaliacao($id);
        ?><h4><?=$avaliacao;?></h4><?
        $text = "";
        if($voto == 0 || $voto == ""){
            for($i = 0; $i < 5; $i++){
                if($i == 0){
                    $text = "Ruim";
                }else if($i == 1){
                    $text = "Regular";
                }else if($i == 2){
                    $text = "Bom";
                }else if($i == 3){
                    $text = "Muito Bom";
                }else if($i == 4){ 
                    $text = "Excelente";
                }            
                ?>  
                <input title="<?=$text;?>" class="no-margin avaliacao" data-return=".avaliacao-resultado" data-loading=".avaliacao-resultado"  data-request="{'request':'estatistica','action':'avaliacao','voto':'<?=$i+1;?>','id':'<?=$id;?>'}" type="image" src="<?=ROOT;?>/css/img/bg/Bullet-Star-32.png" value="<?=$i+1;?>" />
                <?
            }
        }else{
            if($id == 0){
                if($id == 0){
                    return null;
                }
            }

            $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : getenv('REMOTE_ADDR');

            if($ip == null || $ip == false || $ip == "" || $ip == 0){
                return null;
            }

            if($ip == '200.158.101.9'){
                return null;
            }

            $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

            if($userAgent){
                if(self::agente() == true){
                    return null;
                }
            }

            $db = new DB();        
            $exeIP = $db->prepare(" SELECT id 
                                      FROM est_ip 
                                     WHERE ds_descricao = :ip ");
            $exeIP->bindParam(':ip', $ip, PDO::PARAM_STR);
            $idIP = 0;
            if($exeIP->execute()){
                if($exeIP->rowCount() == 0){
                    $insertIP = $db->prepare(" INSERT INTO est_ip ( id, ds_descricao , dt_acesso ) VALUES ( NULL, :ip , NOW() )");
                    $insertIP->bindParam(':ip', $ip, PDO::PARAM_STR);
                    if($insertIP->execute()){
                        $idIP = $db->lastInsertId();
                    }else{
                        return null;
                    }

                }else{
                   $result = $exeIP->fetchObject(); 
                   $idIP = $result->id;
                }
            }else{
                return null;
            }
            $exeEstAva = $db->prepare(" SELECT * 
                                          FROM est_avaliacao_edicao est
                                    INNER JOIN est_ip ip ON ip.id = est.id_ip
                                         WHERE est.id_edicao = :id
                                           AND est.id_ip = :ip ;");
            $exeEstAva->bindParam(':id', $id, PDO::PARAM_INT);
            $exeEstAva->bindParam(':ip', $idIP, PDO::PARAM_INT);
            if($exeEstAva->execute()){
                if($exeEstAva->rowCount() == 0){
                    if($voto > 0){
                        $insertEstEdi = $db->prepare(" INSERT INTO est_avaliacao_edicao 
                                                                   ( id, id_edicao, id_ip, nr_avaliacao, dt_avaliacao ) 
                                                            VALUES ( NULL, :id , :ip, :voto, NOW() ) ");
                        $insertEstEdi->bindParam(':id', $id, PDO::PARAM_INT);
                        $insertEstEdi->bindParam(':ip', $idIP, PDO::PARAM_INT);
                        $insertEstEdi->bindParam(':voto', $voto, PDO::PARAM_INT);
                        if($insertEstEdi->execute()){
                            ?><h4 class="margin-top">Obrigado por nos enviar sua avaliação</h4><?
                        }
                    }
                }
            }else{
                return null;
            }      
            ?><?
        }
    }
    
    public static function queryAvaliacao($id = 0){
        if($id == 0){
            return false;
        }
        
        $db = new DB();
        $query = $db->prepare(" select sum(nr_avaliacao) / count(id_edicao) AS total , count(id_edicao) AS totalEdicao from est_avaliacao_edicao WHERE id_edicao = :id ;");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        if($query->execute()){
            if($query->rowCount() > 0){
                ?>Avaliação: <?
                $count = $query->fetch(PDO::FETCH_OBJ);
                ?><strong><?
                if($count->total == 1 && $count->total < 2 ){
                    ?>Ruim<?
                }else if($count->total >= 2 && $count->total < 3){
                    ?>Regular<?
                }else if($count->total >= 3 && $count->total < 4){
                    ?>Bom<?
                }else if($count->total >= 4 && $count->total < 5){
                    ?>Muito Bom<?
                }else if($count->total >= 5){                    
                    ?>Excelente<?
                }
                ?></strong><?
                if($count->totalEdicao > 0){
                    ?> - <?
                    $textoAvaliacao = " avaliações ";
                    if($count->totalEdicao == 1){
                        $textoAvaliacao = " avaliação ";
                    }
                    echo $count->totalEdicao . "<strong> $textoAvaliacao </strong>";
                }
            }else{
                ?>Avaliar<?
            }
        }else{
            ?>Avaliar<?
        }
        
    }
    
}

?>
