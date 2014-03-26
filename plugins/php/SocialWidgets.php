<?php

class SocialWidgets {
    
    public $facebookLikeButton;
            
    public function __construct(){
        
    }

    public static function twitterScript(){
        ?><script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script><?
    }
    
    
    public function loadTwitterTimeline(){
        ?><div><?=SocialWidgets::twitterTimeline(300, 500);?></div><?
    }
    
    public function loadfacebookLikeButton(){
        ?><div><?=SocialWidgets::facebookLikeButton();?></div><?
    }
    
    public static function twitterTimeline($w = 300, $h = 500){
        ?><a class="twitter-timeline" href="https://twitter.com/<?=TWITTER_PROFILE;?>" width="<?=$w;?>" height="<?=$h;?>" data-widget-id="<?=TWITTER_ID;?>"></a><?
    }
    
    public static function facebookLikeButton($w = 300, $h = 340, $isShowFaces = "true", $isDataStream = "false"){
        ?><div class="fb-like-box" data-href="http://www.facebook.com/<?=FACEBOOK_PROFILE;?>" data-width="<?=$w;?>" data-height="<?=$h;?>" data-show-faces="<?=$isShowFaces;?>" data-stream="<?=$isDataStream;?>" data-header="false"></div><?
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
    public static function facebookStats($url = "", $q = "") {
        if($url == ""){
            $url = self::$var;
        }
        $var = null;
        //$url = "https://graph.facebook.com/comments/?ids=".urlencode($url);
        $url = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".urlencode($url);
        $xml = file_get_contents($url);
        $xml = simplexml_load_string($xml);

        if(!$xml || $xml == null || $xml == false || $xml == "" || sizeof($xml) == 0 || !is_array($xml)){
            return false;
        }

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
            if ($var == 0 || !($var)) {
                $var = 0;
            }
        }   

        return $var;    
    }
    
    public static function facebookComments($url = "", $countFace = 0, $dataWidth = 470, $dataHeight = 300, $numPosts = 2){
            $dataHeight = "";
            if($countFace == 0){
                $countFace = self::facebookStats($url, 'comment_count');
            }            
            if($countFace == 0){
                ?><h3>Seja o primeiro a comentar</h3><?
            }else{
                if($countFace == 1){
                    ?><h3><?=$countFace;?> Comentario</h3><?                                                                    
                }else{
                    ?><h3><?=$countFace;?> Comentarios</h3><?                                    
                }
            }
            ?><div class="fb-comments" data-href="<?=$url;?>" data-num-posts="<?=$numPosts;?>" data-width="<?=$dataWidth;?>"></div><?
    }
    
    public static function facebookLikeButtonConfig($type = "html5", 
                                                    $class = "fb-like", 
                                                    $send = true, 
                                                    $layout = "button_count", 
                                                    $width = 450, 
                                                    $showFaces = false,
                                                    $live = ""){
        $data = "";
        if($type == "html5"){
            $data = "data-";
        }else if($type == "xfbml"){
            $data = "";
        }
        
        $dataFace = "";
        if($class == null){
            $dataFace .= ' class="fb-like" ';
        }else{
            $dataFace .= " class=\"$class\" ";
        }
        if($send == true){
            $dataFace .= " {$data}send=\"true\" ";
        }else{
            $dataFace .= " {$data}send=\"$send\" ";
        }
        if($width == null){
            $width .= " {$data}layout=\"button_count\" ";
        }else{
            $width .= " {$data}layout=\"$class\" ";
        }
        if($layout == 0){
            $dataFace .= " {$data}width=\"450\" ";
        }else{
            $dataFace .= " {$data}width=\"$width\" ";
        }
        if($type == "html5"){
            if($showFaces == false){
                $dataFace .= " data-show-faces=\"false\" ";
            }else{
                $dataFace .= ' data-show-faces="true" ';
            }
            ?><div  
                   <?=$dataFace;?>
                   data-font="verdana" 
                   data-colorscheme="dark" 
                   data-action="recommend"
                   <?=$live;?>
                   >
            </div><?                
        }else if($type == "xfbml"){
            ?><fb:like send="true" 
                       layout="button_count" 
                       width="450" 
                       show_faces="true" 
                       font="verdana" 
                       colorscheme="dark" 
                       action="recommend"
                   <?=$live;?>>
            </fb:like><?
                
        }else if($type == "iframe"){
            echo "Indisponível no momento!";
        }
    }
    
    public static function youtubeThumb($codigo = "", $padrao = "default.jpg", $livre = ""){
        ?><img src="http://img.youtube.com/vi/<?=$codigo;?>/<?=$padrao;?>" <?=$livre;?> /><?
    }
    
    public static function facebookCountComments(){
        
    }
    
    
}

?>
