<?php


class MetaTag {
    
    /**
     * Meta Configurations
     */
    const GOOGLE_CHECKER = 'C3rYw57a6pqflTecYykD0bduW8Z1GyJRtpZD9rgkGMc';
    const ALEXA_CHECKER = '_jwWMBizIf-5KiwgJDtTWB3qYuY';
    const FB_APP_ID = '241142569330568';
    const CONTENT_TYPE = 'text/html; charset=windows-1252';
    const TITLE = 'Caderno Mais';
    const DESCRIPTION = 'O Caderno Mais é um guia de anúncios e um portal de conteúdo da região de Ribeirão Preto. Cobrimos eventos e noticiamos tudo que é importante. Mapas, rotas, endereços e telefones.';
    const KEYWORDS = 'guia ribeirão preto, agenda ribeirao, músicos da regiao, site de eventos, eventos, maior cidade do inteior paulista';
    
    /**
     * --/
     * @var type 
     */    
    
    private $contentType;
    private $title;
    private $description;
    private $keyword;
    private $robots;
    private $googleVerificador;
    private $alexaVerificador;
    private $ogImage;
    private $ogType;
    private $ogSiteName;
    private $ogURL;
    private $fbAppId;
    
    public function __construct($contentType = "", $title = "", $description = "", $keyword = "", $robots = "", $googleVerificador = "", $alexaVerificador = "", $ogImage = "", $ogType = "", $ogSiteName = "", $ogURL = "", $fbApp = ""){
        $this->contentType = $contentType ? $contentType : self::CONTENT_TYPE;
        $this->title = $title ? $title : self::TITLE;
        $this->description = $description ? $description : self::DESCRIPTION;
        $this->keyword = $keyword ? $keyword : self::KEYWORDS;
        $this->robots = $robots ? $robots : "all";
        $this->googleVerificador = $googleVerificador ? $googleVerificador : self::GOOGLE_CHECKER;
        $this->alexaVerificador = $alexaVerificador ? $alexaVerificador : self::ALEXA_CHECKER;
        $this->ogImage = $ogImage ? $ogImage : "/css/img/bg/logo-cadernomais-128x128x.png";
        $this->ogType = $ogType ? $ogType : "website";
        $this->ogSiteName = $ogSiteName ? $ogSiteName : "CadernoMais.com.br";
        $this->ogURL = $ogURL ? $ogURL : "http://www.cadernomais.com.br/";
        $this->fbAppId = $fbApp ? $fbApp : self::FB_APP_ID;
    }

    public function getContentType() {
        return $this->contentType;
    }

    public function setContentType($contentType = "") {
        $this->contentType = $contentType;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title = "") {
        $this->title = $title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description = "") {
        $this->description = $description;
    }

    public function getKeyword() {
        return $this->keyword;
    }

    public function setKeyword($keyword = "") {
        $this->keyword = $keyword;
    }

    public function getRobots() {
        return $this->robots;
    }

    public function setRobots($robots = "") {
        $this->robots = $robots;
    }

    public function getGoogleVerificador() {
        return $this->googleVerificador;
    }

    public function setGoogleVerificador($googleVerificador = "") {
        $this->googleVerificador = $googleVerificador;
    }

    public function getAlexaVerificador() {
        return $this->alexaVerificador;
    }

    public function setAlexaVerificador($alexaVerificador = "") {
        $this->alexaVerificador = $alexaVerificador;
    }

    public function getOgImage() {
        return $this->ogImage;
    }

    public function setOgImage($ogImage = "") {
        $this->ogImage = $ogImage;
    }

    public function getOgType() {
        return $this->ogType;
    }

    public function setOgType($ogType = "") {
        $this->ogType = $ogType;
    }

    public function getOgSiteName() {
        return $this->ogSiteName;
    }

    public function setOgSiteName($ogSiteName = "") {
        $this->ogSiteName = $ogSiteName;
    }
    
    public function getOgURL() {
        return $this->ogURL;
    }

    public function setOgURL($ogURL = "") {
        $this->ogURL = $ogURL;
    }

    public function getFbApp() {
        return $this->fbAppId;
    }

    public function setFbApp($fbApp = "") {
        $this->fbAppId = $fbApp;
    }
}
?>