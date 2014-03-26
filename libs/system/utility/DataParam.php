<?php

/**
 * SweetPHP <br />
 * <p><b>DataParam</b></p>
 * @link  http://www.ilines.com.br/documentacao/DataParam/
 * @author sweetphp
 * <p>Cria botões input de maneira organizada e segura.<p><br />
 */
class DataParam {

    public $dataUpdate = "";
    public $dataLoadingText = "";
    public $dataLoadingClass = "";
    public $dataLoading = "";
    public $dataType = "";
    public $dataListener = "";
    public $dataAction = "";
    public $dataRequest = "";
    public $dataReturn = "";
    public $dataMethod = "";
    public $dataId = "";

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function getDataUpdate() {
        return $this->dataUpdate;
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Update (data-update)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_update/
     * @author sweetphp 
     * @param string $dataUpdate <p>Execulta eventos click / change no complete da requisição ajax. Ex. Ao clicar no botão 1, dou um click no botão 2, após a requisição ter sido processada. Simitar ao complete/render/update do primefaces.</p>
     * @return data-update
     */
    public function setDataUpdate($var = "") {
        $this->dataUpdate = " data-update=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function getDataLoadingText() {
        return $this->dataLoadingText;
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Loading Text (data-loading-text)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_loading_text/
     * @author sweetphp 
     * @param string $dataLoadingText <p>Adiciona um texto ao componente referenciado. Ex: span :: Aguarde :: /span </ span>:</p>
     * @return data-loading-text
     */
    public function setDataLoadingText($var = "") {
        $this->dataLoadingText = " data-loading-text=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function getDataLoadingClass() {
        return $this->dataLoadingClass;
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Loading Class (data-loading-class)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_loading/
     * @author sweetphp 
     * @param string $dataLoadingClass <p>Adiciona a nova classe preloader ao componente referenciado.</p>
     * @return data-loading-class 
     */
    public function setDataLoadingClass($var = "") {
        $this->dataLoadingClass = " data-loading-class=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function getDataLoading() {
        return $this->dataType;
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Loading (data-loading)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_loading/
     * @author sweetphp 
     * @param string $dataLoading <p>class ou id onde será mostrado um preloader durante a requisição ajax solicitada. Ex. data-loading=".loadingA" <span class="loadingA">Aguarde</span></p>
     * @return data-loading 
     */
    public function setDataLoading($var = "") {
        $this->dataType = " data-loading=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function getDataType() {
        return $this->dataType;
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Type (data-type)</b></p>
     * @link  http://api.jquery.com/jQuery.ajax/
     * @link  http://www.ilines.com.br/documentacao/data_type/
     * @author sweetphp 
     * @param string $dataType <p>O tipo de dados que você está esperando de volta a partir do servidor. Se nenhum for especificado, jQuery vai tentar inferir-lo com base no tipo de MIME da resposta (um tipo de MIME XML trará XML, JSON em 1,4 produzirá um objeto JavaScript, em 1,4 script irá executar o script, e qualquer outra coisa será retornado como uma string). Os tipos disponíveis (eo resultado passado como o primeiro argumento para o seu sucesso de retorno de chamada) são: (xml, json, script, or html)</p>
     * @return data-type
     */
    public function setDataType($var = "") {
        $this->dataType = " data-type=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function getDataListener() {
        return $this->dataListener;
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Listener (data-listener)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_listener/
     * @author sweetphp 
     * @param string $dataListener <p>Faz uma pré requisição antes do processamento atual.</p>
     * @example {'request':'bean','action':'method/function','parameters':'p1'}
     * @return data-listener
     */
    public function setDataListener($var = "") {
        $this->dataListener = " data-listener=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function getDataAction() {
        return $this->dataAction;
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Action (data-action)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_param/
     * @author sweetphp 
     * @param string $dataRequest <p>Método, função ou ação da requisição request. Ex. new LoginBean()->$action(), LoginBean::$action() ou if($_POST['action'] == 'validar'). Similar aos métodos java. $_POST/$_REQUEST/$_GET -> $['action']</p>
     * @return data-action
     */
    public function setDataAction($var = "") {
        $this->dataAction = " data-action=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function getDataRequest() {
        return $this->dataRequest;
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Request (data-request)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_request/
     * @author sweetphp 
     * @param string $dataRequest <p>Específica a classe onde a função será processada. Para receber o parâmetro utilize as variáveis globais $_POST/$_REQUEST/$_GET -> $['action']</p>
     * @return data-request
     */
    public function setDataRequest($var = "") {
        $this->dataRequest = " data-request=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Return (data-return)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_return/
     * @author sweetphp 
     * @param string $dataReturn <p>Local onde a requisição processada no ajax será retornada.</p>
     * @return data-request
     */
    public function getDataReturn() {
        return $this->dataReturn;
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function setDataReturn($var = "") {
        $this->dataReturn = " data-return=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function getDataMethod() {
        return $this->dataMethod;
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Method (data-method)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_return/
     * @author sweetphp 
     * @param string $dataMethod <p>Método da requisição ajax. Tipos aceitos: request, post e get.</p>
     * @return data-method
     */
    public function setDataMethod($var = "") {
        $this->dataMethod = " data-method=\"$var\" ";
    }

    /**
     * SweetPHP <br />
     * <p><b>Data Ii (data-id)</b></p>
     * @link  http://www.ilines.com.br/documentacao/data_return/
     * @author sweetphp 
     * @param string $dataId <p>Id do combonente.</p>
     * @return data-id
     */
    public function getDataId() {
        return $this->dataId;
    }

    /**
     * SweetPHP <br />
     * <p><b>Consultar no método set</b></p>
     */
    public function setDataId($var = "") {
        $this->dataId = " data-id=\"$var\" ";
    }

    public function toString() {
        $param = $this->dataId .
                $this->dataRequest .
                $this->dataAction .
                $this->dataMethod .
                $this->dataLoading .
                $this->dataLoadingClass .
                $this->dataLoadingText .
                $this->dataType .
                $this->dataListener .
                $this->dataReturn .
                $this->dataUpdate;
        return $param;
    }

}
