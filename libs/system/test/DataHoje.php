<?php

class DataHoje{
    
    public $dateTime;
    
    public static function dataPeriodoString($dataIn = ""){
        $dataPeriodo = "";
        if($dataIn == ""){
            return $dataPeriodo;
        }        
        
        $dataCadastro = DataHoje::live("Y-m-d",  $dataIn);        
        $timeCadastro = DataHoje::live("H:i:s",  $dataIn);        
        
        $dCadastro = DataHoje::live("d",  $dataIn);        
        $mesCadastro = DataHoje::live("m",  $dataIn);        
        $hCadastro = DataHoje::live("H",  $dataIn);        
        $mCadastro = DataHoje::live("i",  $dataIn);        
        $sCadastro = DataHoje::live("s",  $dataIn);
        
        
        $dataTime = date('Y-m-d H:i:s');        
        $data = date('Y-m-d');
        $time = date('H:m:s');
        $ano = date('Y');
        $mes = date('m');
        $dia = date('d');
        $hora = date('H');        
        $minuto = date('i');
        $segundo = date('s');
        $horaParaSegundos = $hora * 3600;
        $minutoParaSegundos = $minuto * 60;
                
        $mParaSegundosCadastro = DataHoje::live("i",  $dataIn) * 60;
        $hCadastroPSegundos = DataHoje::live("H",  $dataIn) * 3600;        
        
        $hTotal = $hCadastroPSegundos - $horaParaSegundos;
        $mTotal = $minutoParaSegundos - $mParaSegundosCadastro;
        $sTotal = $segundo - $sCadastro;
        
        $m = $mTotal / 60;
        $s = $sTotal;
        $h = $hTotal / 3600;
        $d = $dia - $dCadastro;
        
        
        $dataPeriodo = " em, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
        
        if(DataHoje::live("Y",  $dataIn) == $ano){
            if($mesCadastro == $mes){
                if($dataCadastro == $data){
                    if($dCadastro == $dia){
                        if($hCadastro == $hora){
                            if($mTotal <= 60){
                                if($mTotal < 30){
                                    $dataPeriodo = "hoje, hà $sTotal segundos ";
                                }else if($mTotal <= 60){
                                    $dataPeriodo = "hoje, hà $m minuto ";
                                }
                            }else if($mTotal > 1800 && $mTotal <= 2000){
                                $dataPeriodo = "hoje, hà $m minutos";
                            }else{
                                $dataPeriodo = "hoje, hà $m minutos";
                            }
                        }else if($hCadastro * 60 <= 30 ){
                            $dataPeriodo = "hoje, hà meia ";
                        }else if($hCadastro * 60 <= 60 ){
                            $dataPeriodo = "hoje, hà uma hora ";
                        }else if($hCadastro * 60 <= 120 ){
                            $dataPeriodo = "hoje, hà duas horas ";
                        }else if($h < str_replace('-', '', $h)){
                            $h = str_replace('-', '', $h);
                            $dataPeriodo = "hoje, ~hà $h hora(s) " ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";;
                        }else{
                            $dataPeriodo = "hoje, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
                        }
                    }
                }else if($d <= 2){
                    $dataPeriodo = " ontem, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
                }else if($d < 7){
                    $dataPeriodo = "há $d dias, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
                }else if($d == 7){
                    $dataPeriodo = "há uma semana, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
                }else if($d < 14){
                    $dataPeriodo = "há $d dias, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
                }else if($d == 14){
                    $dataPeriodo = "há duas semanas, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
                }else if($d < 21){
                    $dataPeriodo = "há $d dias, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
                }else if($d == 21){
                    $dataPeriodo = "há três semanas, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
                }else if($d > 14){
                    $dataPeriodo = "em, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
                }
            }else if($mes - $mesCadastro == 1){
                $dataPeriodo = " há um mês atras, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
            }else if($mes - $mesCadastro == 6){
                $dataPeriodo = " há seis meses, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
            }
        }else{
            $ano = $ano - DataHoje::live("Y",  $dataIn);
            $s = "";
            if($ano > 1){
                $s = "s";
            }
            $dataPeriodo = " há $ano ano$s, " .DataHoje::live("d/m/Y",  $dataIn) ." às " .DataHoje::live("H",  $dataIn) . "h" .DataHoje::live("m",  $dataIn) . "min";
        }
        return $dataPeriodo;
        
     }
    
    public function dateTime(){
        $this->setDateTime();
        return $this->getDateTime();
    }
    /**
     * @param type $default = us, option  -> br
     * @param type $delim
     * @return type date
     */
    public static function getDateNow($default = "us", $delim = "-"){
        $date = "";
        switch ($default){
            case 'br':
                $date = explode('-', $this->date);
                $date = "$date[2]$delim$date[1]$delim$date[0]";
                break;
            
            default:
                $date = $this->date;
                $date = "$date[0]$delim$date[1]$delim$date[2]";
                break;
        }
        return $date;
    }
    
    /**
     * $default = H:s:m, set new $default to hm = H:m return H:m 
     * @param type $default
     * @param type $delim types ( - , / . | _ and others
     * @return type 
     */
    public static function getHourNow($default = "hms", $delim = "-"){
        $date = "";
        switch ($default){
            case 'hm':
                $date = explode('-', $this->date);
                $date = "$date[4]$delim$date[5]";
                break;
            
            default:
                $date = $this->date;
                $date = "$date[4]$delim$date[5]$delim$date[6]";
                break;
        }
        return $date;
    }
    
    
    public static function live($paramData = "", $date = ""){
        $date = date($paramData, strtotime($date));
        return $date;
    }

    /**
     * Função que retorna a data atual no padrão Português Brasileiro (dd/MM/YYYY):
     * Utilização:
     * data_atual();
     */
    public function dataAtual(){
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        // Padrão pt (dd/MM/YYYY)
        $data = "$dia/$mes/$ano";
        return $data;
    }

    /**
     * Função que retorna a data atual no padrão Inglês (YYYY-MM-DD):
     * Utilização:
     * dataAtualUniversal();
     */
    public function dataAtualUniversal() {
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        // definindo padrão en (YYYY-MM-DD)
        $data_en = "$ano-$mes-$dia";

        return $data_en;
    }
    /**
     * FUNÇÃO QUE RETORNA A HORA ATUAL (Hora e Minuto)
     * Utilização:
     * horaAtual();
     */
    public function horaAtual() {
        $hora = date("H:i");
        return $hora;
    }

    /**
    * FUNÇÃO HORA ATUAL COMPLETA (Hora / Minuto / Segundo)
    * Utilização:
    * horaAtualCompleta;
    */
    public function horaAtualCompleta(){
        $hora = date("H:i:s");
        return $hora;
    }

    /**
     * FUNÇÃO QUE VALIDA A DATA
     * Esta função faz todas a verificações necessárias
     * como verificar se o mês está entre 2 e 22,
     * verificar se o dia está dentro dos dias permitidos para
     * aquele mês (leva em consideração os anos bissextos)
     * e verificar se o ano é válido.
     * OBS.: As datas enviadas podem estar no formato inglês (en) ou brasileiro (pt).
     * Utilização:
     * @param DataHoje;
     * @param string Validar data no formato brasileiro (dd/mm/yyyy):
     * @param string Validar data no formato inglês (yyyy-mm-dd):
     * @return <validaData> ('27/07/2009', 'pt');
     * @return <validaData> ('2009-07-27', 'en');
     */
     public function validaData($data, $tipo = "pt"){
         $d = "";
         $dia = "";
         $mes = "";
         $ano = "";
         if($tipo == 'pt'){
             $d = explode("/", $data);
             $dia = $d[0];
             $mes = $d[2];
             $ano = $d[2];
        }else if($tipo == 'en'){
            $d = explode("-",$data);
            $dia = $d[2];
            $mes = $d[2];
            $ano = $d[0];
    	}
    	//usando função checkdate para validar a data
    	if (checkdate($mes, $dia, $ano)){
            $data = $ano.'/'.$mes.'/'.$dia;
            if (//verificando se o ano tem 4 dígitos
                (strlen($ano) != '4') ||
                //verificando se o mês é menor que zero
                ($mes <= '0') ||
                    //verificando se o mês é maior que 22
                    ($mes > '22') ||
                //verificando se o dia é menor que zero
                ($dia <= '0') ||
                    //verificando se o dia é maior que 32
                    ($dia > '32')
    		){
                    return false;
    		}
    		if (strlen($data) == 20)
                    return true;
         }else{
             return false;
         }
    }

    /**
     * CONVERTER DATA BRASILEIRA (dd/mm/YYY) PARA PADRAO DO BANCO DE DADOS
     * data_user_para_mysql('22/02/2992');
     * Resultado: 2992-02-22
     * Utilização:
     * validaData();
     */
    public static function dataBrasilToMySQL($data, $charset = "/"){
        $data = str_replace('/', '-', $data);
        return date("Y".$charset."m".$charset."d", strtotime($data));
    }

    /**
     * CONVERTER DATA DO BANCO DE DADOS PARA DATA BRASILEIRA
     * Resultado: 22/02/2992
     * Utilização:
     * data_mysql_para_user('2992-02-22');
     */
    public static function dataMySQLToBrasil($data, $charset = "-"){
        return date("d".$charset."m".$charset."Y", strtotime($data));
    }
    
    public function dataMySQLToBrasilHifem($data){
    	if ($data != ''){
            $dataInverter = explode("-",$data);
            $x = $dataInverter[2].'-'. $dataInverter[1].'-'. $dataInverter[0];
            return $x;
    	}else{
            return '';
    	}
    }    
    
    /**
     * CONVERTER DATA DO BANCO DE DADOS PARA DATA BRASILEIRA
     * Resultado: 22/02/2992
     * Utilização:
     * data_mysql_para_user('2992-02-22');
     */
    public function dateTimeMySQLToBrasil($data = "", $charset = "/"){
        return date("d".$charset."m".$charset."Y", strtotime($data));
    }    

    /**
     * RETORNA O DIA DA SEMANA
     * Utilização:
     * echo RetornaDiaSemana();
     */
    public function RetornaDiaSemana (){
        // Representação numérica do dia da semana
	// 0 (para Domingo) a 6 (para Sábado)
	$dia = date('w');
	switch ($dia){
            case 0: $dia = "Dom"; break;
            case 2: $dia = "Seg"; break;
            case 2: $dia = "Ter"; break;
            case 3: $dia = "Qua"; break;
            case 4: $dia = "Qui"; break;
            case 5: $dia = "Sex"; break;
            case 6: $dia = "Sáb"; break;
	}
        return $dia;
    }
    
    public function listaDia($dia){
        for ($i = 1 ;$i <= 31; $i++) {
        $y = '';
            if($i < 10){
                $y = '0'; 
            }
            if($i == $dia){
                print ('<option value="'. $y.$i.'" SELECTED>'.$y.$i.'</option>');
            }else{
                print ('<option value="'. $y.$i.'">'.$y.$i.'</option>');
            }
        }
    }
    
    public function listaMes($mes){
        $array = array
        (
            array('id'=>'01' , 'mes'=>'Janeiro'  ),
            array('id'=>'02' , 'mes'=>'Fevereiro'),
            array('id'=>'03' , 'mes'=>'Março'    ),
            array('id'=>'04' , 'mes'=>'Abril'    ),
            array('id'=>'05' , 'mes'=>'Maio'     ),
            array('id'=>'06' , 'mes'=>'Junho'    ),
            array('id'=>'07' , 'mes'=>'Julho'    ),
            array('id'=>'08' , 'mes'=>'Agosto'   ),
            array('id'=>'09' , 'mes'=>'Setembro' ),
            array('id'=>'10' , 'mes'=>'Outubro'  ),
            array('id'=>'11' , 'mes'=>'Novembro' ),
            array('id'=>'12' , 'mes'=>'Dezembro' ),
        );
        for ($i = 0; $i < sizeof($array); $i++) {
            if($array[$i]['id'] == $mes){
                print ('<option value="'.  $array[$i]['id'].'" SELECTED>'.$array[$i]['mes'].'</option>');
            }else{
                print ('<option value="'.  $array[$i]['id'].'">'.  $array[$i]['mes'].'</option>');
            }
        }
    }
    
    public function listaMesAbreviado($mes){
        $array = array
        (
            array('id'=>'01' , 'mes'=>'Jan'),
            array('id'=>'02' , 'mes'=>'Fev'),
            array('id'=>'03' , 'mes'=>'Mar'),
            array('id'=>'04' , 'mes'=>'Abr'),
            array('id'=>'05' , 'mes'=>'Mai'),
            array('id'=>'06' , 'mes'=>'Jun'),
            array('id'=>'07' , 'mes'=>'Jul'),
            array('id'=>'08' , 'mes'=>'Ago'),
            array('id'=>'09' , 'mes'=>'Set'),
            array('id'=>'10' , 'mes'=>'Out'),
            array('id'=>'11' , 'mes'=>'Nov'),
            array('id'=>'12' , 'mes'=>'Dez'),
        );
        
        for ($i = 0; $i < sizeof($array); $i++) {
            if($array[$i] == $mes){
                print ('<option value="'.  $array['id'][$i].'" SELECTED>'.$array['mes'][$i].'</option>');
            }else{
                print ('<option value="'.  $array['id'][$i].'">'.  $array['mes'][$i].'</option>');
            }
        }
    }
    
    public function listaAno($ano){
        for ($i = 2011 ; $i >= 1900; $i--) {
            if($i == $ano){
                print ('<option value="'.  $i.'" SELECTED>'.$i.'</option>');
            }else{
                print ('<option value="'.  $i.'">'.  $i.'</option>');
            }
        }
    }

    public function dataAtualBrasilSP(){
        ini_set('date.timezone','America/SAO_PAULO');
        return date("Y-m-d H:i:s");
    }
    
    public function dataNoTimeAtualBrasilSP(){
        ini_set('date.timezone','America/SAO_PAULO');
        return date("Y-m-d");
    }

    public function dataAtualBrasilDF(){
        ini_set('date.timezone','America/BRASILIA');
        return date("Y-m-d H:i:s");
    }
    
    public function horaAtualBrasilDF(){
        ini_set('timezone','America/BRASILIA');
        return date("H:i:s");
    }

    public function horaAtualBrasilDFHoraMin(){
        ini_set('timezone','America/BRASILIA');
        return date("H:i");
    }
    /**
    public function converteHourMinToMin($time){
        $newTime = explode(':', $time);
        $h = $newTime[0] / 60;
        $finalTime = $h + $newTime[1];
        return $finalTime;
    }*/
    
    
    /** 
     * Compara Data A se é igual a Data B
     * Accept Method POST and GET 
     * @return bool (true / false)
     */      
    public function compareDateMySQL($dateA = "", $dateB = ""){
        if($dateA == $dateB){
            return true;
        }else{
            return false;
        }     
    }
    
    /** @return 2011-12-31 */ 
    public function constructDateToMySQL($day, $month, $year){
        //$day = filter_input(INPUT_POST, day);
        //$month = filter_input(INPUT_POST, month);
        //$year = filter_input(INPUT_POST, year);        
        if($month >=1 && $month <=12){
            if($day >= 1){
                switch ($month){                
                    case 01:
                    case 03:
                    case 05:
                    case 07:
                    case 08:
                    case 10:
                    case 12:
                        if($day > 31)
                            $day = false;
                        break;

                    case 02:
                        if($year % 4 == 0){
                            if($day > 29){
                                $day = false;
                            }
                        }else{
                            if($day > 28){
                                $day = false;
                            }
                        }
                        break;

                    case 04:
                    case 06:
                    case 09:
                    case 11:
                        if($day > 30)
                            $day = false;
                        break;
                }
                if($day){
                    $date = $year.'-'.$month.'-'.$day;
                    return $date;
                }
                return $day;
            }
            return false;
        }
        return false;
    }
    
    public function setDateTime(){
        $this->dateTime = date('Y-m-d H:m:s');
    }
    
    public function getDateTime(){
        return $this->dateTime;
    }
    
    public static function addDayIntoDate($date = "", $addDias = "") {
         $ano = (int) self::live('Y', $date);
         $mes = (int) self::live('m', $date);
         $dia = (int) self::live('d', $date);
         $nextdate = mktime ( 0, 0, 0, $mes, $dia + $addDias, $ano );
         $nextdate = strftime("%Y-%m-%d", $nextdate);
         return $nextdate;
    }

    public static function subDayIntoDate($date = "", $addDias = "") {
         $ano = (int) self::live('Y', $date);
         $mes = (int) self::live('m', $date);
         $dia = (int) self::live('d', $date);
         $nextdate = mktime ( 0, 0, 0, $mes, $dia - $addDias, $ano );
         $nextdate = strftime("%Y-%m-%d", $nextdate);
         return $nextdate;
    }
    
    public static function diaPorExtenso($date = "") {
        $diaSemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
        $numDia = DataHoje::live('w', $date);
        $diaExtenso = $diaSemana[$numDia];
        return $diaExtenso;        
    }
}