<?

class UIMessage {

    /**
     * Message Simple JQueryUI CSS - Install JQUERY UI
     * @param type $option
     * @param type $title
     * @param type $message
     * @param type $style
     * @param type $class
     * @tutorial use options confirm, error, info, disabledHighLight, disabled and priority-secondary
     */
    public static function messageUISimple($option = "", $title = "", $message = "", $style = "", $class = "") {

        switch ($option) {

            case 'confirm':
                ?>
                <div class="ui-widget" style="margin-top: 10px; margin-bottom: 10px;">
                    <div class="dialog-message-simple-confirm ui-corner-all" style="padding: 0 .7em;"><p>
                            <span class="ui-icon ui-icon-circle-check" style="float: left; margin-right: .3em;"></span>
                            <strong><?= $title; ?></strong> 
                <?= $message; ?>
                        </p>
                    </div>
                </div>
                <?
                break;

            case 'error':
                ?>
                <div class="ui-widget" style="margin-top: 10px; margin-bottom: 10px;">
                    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                        <p>
                            <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                            <strong><?= $title; ?></strong> 
                <?= $message; ?>
                        </p>
                    </div>
                </div>
                <?
                break;

            case 'info':
                ?>
                <div class="ui-widget" style="margin-top: 10px; margin-bottom: 10px;">
                    <div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
                        <p>
                            <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                            <strong><?= $title; ?></strong> 
                <?= $message; ?>
                        </p>
                    </div>
                </div>
                <?
                break;

            case 'disabledHighLight':
                ?>
                <div class="ui-widget" style="margin-top: 10px; margin-bottom: 10px;">
                    <div class="ui-state-active ui-corner-all" style="padding: 0 .7em;"> 
                        <p>
                            <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                            <strong><?= $title; ?></strong>  
                <?= $message; ?>
                        </p>
                    </div>
                </div>
                <?
                break;

            case 'disabled':
                ?>
                <div class="ui-widget" style="margin-top: 10px; margin-bottom: 10px;">
                    <div class="ui-state-disabled ui-corner-all" style="padding: 0 .7em;"> 
                        <p>
                            <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                            <strong><?= $title; ?></strong>  
                <?= $message; ?>
                        </p>
                    </div>
                </div>
                <?
                break;

            case 'priority-secondary':
                ?>
                <div class="ui-widget" style="margin-top: 10px; margin-bottom: 10px;">
                    <div class="ui-priority-secondary ui-corner-all" style="padding: 0 .7em;"> 
                        <p>
                            <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                            <strong><?= $title; ?></strong>  
                <?= $message; ?>
                        </p>
                    </div>
                </div>
                <?
                break;
        }
        ?>
    <?
    }
    
    public static function info($title = "", $message = "") {
        self::messageUISimple('info', $title, $message, "", "");
    }
    
    public static function warn($title = "", $message = "") {
        self::messageUISimple('warn', $title, $message, "", "");
    }
    
    public static function error($title = "", $message = "") {
        self::messageUISimple('error', $title, $message, "", "");
    }
    
    public static function priority($title = "", $message = "") {
        self::messageUISimple('priority-secondary', $title, $message, "", "");
    }
    
    public static function disabled($title = "", $message = "") {
        self::messageUISimple('priority-secondary', $title, $message, "", "");
    }
    
    public static function disabledHighLight($title = "", $message = "") {
        self::messageUISimple('disabledHighLight', $title, $message, "", "");
    }

    /**
     * 
     * @param type $option
     * @param type $title
     * @param type $message
     * @param type $style
     * @param type $class
     * @example  if default : <script> $(function() {$( "#dialog" ).dialog();}); </script> in file php or js
     *           if animated dialog <script>// increase the default animation speed to exaggerate the effect$.fx.speeds._default = 1000;$(function() {$( "#dialog" ).dialog({autoOpen: false,show: "blind",hide: "explode"});$( "#opener" ).click(function() {$( "#dialog" ).dialog( "open" );return false;});});</script>
     *           if modal dialog <script>$(function() {// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!$( "#dialog:ui-dialog" ).dialog( "destroy" );$( "#dialog-modal" ).dialog({height: 140,modal: true});});</script>
     *           if modal message <script>$(function() {// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!$( "#dialog:ui-dialog" ).dialog( "destroy" );$( "#dialog-message" ).dialog({modal: true,buttons: {Ok: function() {$( this ).dialog( "close" );}}});});</script>
     *                            $message is array => $message['alert'] and $message['details']
     *           if modal confirm <script>$(function() {// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!$( "#dialog:ui-dialog" ).dialog( "destroy" );$( "#dialog-confirm" ).dialog({resizable: false,height:140,modal: true,buttons: {"Delete all items": function() {$( this ).dialog( "close" );},Cancel: function() {$( this ).dialog( "close" );}}});});</script>
     *           if modal form Documentation in http://jqueryui.com/demos/dialog/#modal-form
     */
    public static function messageUIDialog($option = "default", $title = "", $message = "", $style = "", $class = "") {
        if ($class != "" || $class != null) {
            $class = " class=\"$class\" ";
        }
        if ($style != "") {
            $style = " style=\"$style\" ";
        }
        switch ($option) {
            case 'form':
                echo "Case not exists!";
                break;
            case 'confirm':
                ?>
                <div id="dialog-confirm" title="<?= $title; ?>" <?= $class; ?> <?= $style; ?>><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?= $message; ?></p></div><?
                break;
            case 'message':
                if ($class == "" || $class == null) {
                    $class = " class=\"ui-icon ui-icon-circle-check\" ";
                }
                ?>
                <script type="text/javascript">$(function() {
                                        $("#dialog-message-php").dialog({modal: true, buttons: {Ok: function() {
                                                    $(this).dialog("close");
                                                }}});
                                    });</script>
                <div id="dialog-message-php" title="<?= $title; ?>">
                <?= $message; ?>
                </div><?
                        break;
                    case 'modal':
                        ?>
                <script> $(function() {
                                        $("#dialog-modal-php").dialog({height: 140, modal: true});
                                    });</script>
                <div id="dialog-modal-php" <?= $class; ?> <?= $style; ?> title="<?= $title; ?>"><p><?= $message; ?></p></div><?
                break;
            case 'animated':
                ?><div id="dialog" <?= $class; ?> <?= $style; ?> title="<?= $title; ?>"><p><?= $message; ?></p></div><?
                break;
            case 'default':
                ?><div id="dialog" <?= $class; ?> <?= $style; ?> title="<?= $title; ?>"><p><?= $message; ?></p></div><?
                break;
        }
    }

}
