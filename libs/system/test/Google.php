<?php

class Google {
    
    public static function script(){
        ?><script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script><?
    }
    
    public static function banner728x90($code = "", $w = 728, $h = 90){
        ?>
        <script type="text/javascript"><!--
            google_ad_client = "<?=$code;?>";
            /* TopoCadernoMais */
            google_ad_slot = "9970650697";
            google_ad_width = <?=$w;?>;
            google_ad_height = <?=$h;?>;
        //-->
        </script>        
        <?
    }
    
}