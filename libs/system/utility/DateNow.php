<?php

class DateNow extends DataHoje {

    public $dateTime = "";

    const DATE_TIME_FORMAT = "Y-m-d H:i:s";
    const DATE_FORMAT = "Y-m-d";
    const TIME_FORMAT = "H:i:s";

    public static function datePeriodString($dataIn = "") {
        $date1 = new DateTime($dataIn);
        $date2 = new DateTime();
        $interval = $date1->diff($date2);
        if ($interval->y != 0) {
            $ago = "" . ($interval->y == 1 ? "{$interval->y} year" : "{$interval->y} years");
        } else if ($interval->m != 0) {
            $ago = " " . ($interval->m == 1 ? "{$interval->m} month" : "{$interval->m} months");
        } else if ($interval->d != 0) {
            if ($interval->d == 1) {
                $ago = "ontem,  " . DateNow::live("H:i", $dataIn);
            } else {
                $ago = " " . ($interval->d == 1 ? "{$interval->d} day" : "{$interval->d} days");
            }
        } else if ($interval->h != 0) {
            $ago = " " . ($interval->h == 1 ? "{$interval->h} hour" : "{$interval->h} hours");
        } else if ($interval->i != 0) {
            $ago = " " . ($interval->i == 1 ? "{$interval->i} minute" : "{$interval->i} minutes");
        } else {
//            $ago = "hoje,  " . ($interval->s == 1 ? "{$interval->s} alguns segundos atr�s" : "{$interval->s} segundos");
        }
        return $ago;
    }

    /**
     * 
     * @param DateTime $date
     * @param (Integet) $add
     * @param (String) $default 
     * @return \DateTime
     * @tutorial use -> add (5) + default (y, m, d, h, i, s)  
     * @link http://www.php.net/manual/en/datetime.add.php DateNow::Add
     */
    public static function Add($date = "", $add = 0, $default = "D") {
        if ($add <= 0) {
            return new DateTime();
        }
        $date = new DateTime($date);
        $interval = $date->add(new DateInterval("P{$add}{$default}"));
        return $interval->format(self::DATE_TIME_FORMAT);
    }

    /**
     * 
     * @param DateTime $date
     * @param (Integet) $add
     * @param (String) $default 
     * @return \DateTime
     * @tutorial use -> add (5) + default (days, y, m, d, h, i, s)  
     * @link http://www.php.net/manual/en/datetime.sub.php DateNow::Sub
     */
    public static function Sub($date = "", $remove = 0, $default = "days") {
        if ($remove <= 0) {
            return new DateTime();
        }
        $date = new DateTime($date);
        $interval = $date->add("-{$remove}{$default}");
        return $interval;
    }

    public function dateTime() {
        $this->setDateTime();
        return $this->getDateTime();
    }

    /**
     * @param type $default = us, option  -> br
     * @param type $delim
     * @return type date
     */
    public static function getDateNow($default = "us", $delim = "-") {
        if ($default == "br") {
            return date("d{$delim}m{$delim}Y");
        }
        return date("Y{$delim}m{$delim}d");
    }

    /**
     * $default = H:s:m, set new $default to hm = H:m return H:m 
     * @param type $default
     * @param type $delim types ( - , / . | _ and others
     * @return type 
     */
    public static function getHourNow($default = "hms", $delim = "-") {
        $date = "";
        switch ($default) {
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

    public static function live($paramData = "", $date = "") {
        $date = date($paramData, strtotime($date));
        return $date;
    }

    public static function curdate() {
        return date('Y/m/d');
    }

    /**
     * Fun��o que retorna a data atual no padraoIngl�s (YYYY-MM-DD):
     * Utilizado:
     * dataAtualUniversal();
     */
    public function dataAtualUniversal() {
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        // definindo padraoen (YYYY-MM-DD)
        $data_en = "$ano-$mes-$dia";

        return $data_en;
    }

    /**
     * FUNCAO QUE RETORNA A HORA ATUAL (Hora e Minuto)
     * Utilizado:
     * curhour();
     */
    public static function curhour() {
        return date("H:i");
    }

    /**
     * FUNCAO HORA ATUAL COMPLETA (Hora / Minuto / Segundo)
     * Utilizado:
     * horaAtualCompleta;
     */
    public function curtime() {
        return date("H:i:s");
    }

    /**
     * FUNCAO QUE VALIDA A DATA
     * Esta funcao faz todas a verifica��es necess�rias
     * como verificar se o mes est� entre 2 e 22,
     * verificar se o dia est� dentro dos dias permitidos para
     * aquele mes (leva em considera��o os anos bissextos)
     * e verificar se o ano � v�lido.
     * OBS.: As datas enviadas podem estar no formato ingl�s (en) ou brasileiro (pt).
     * Utilizado:
     * @param DateNow;
     * @param string Validar data no formato brasileiro (dd/mm/yyyy):
     * @param string Validar data no formato ingl�s (yyyy-mm-dd):
     * @return <validaData> ('27/07/2009', 'pt');
     * @return <validaData> ('2009-07-27', 'en');
     */
    public function validDate($data, $tipo = "pt") {
        $d = "";
        $dia = "";
        $mes = "";
        $ano = "";
        if ($tipo == 'pt') {
            $d = explode("/", $data);
            $dia = $d[0];
            $mes = $d[2];
            $ano = $d[2];
        } else if ($tipo == 'en') {
            $d = explode("-", $data);
            $dia = $d[2];
            $mes = $d[2];
            $ano = $d[0];
        }
        //usando funcao checkdate para validar a data
        if (checkdate($mes, $dia, $ano)) {
            $data = $ano . '/' . $mes . '/' . $dia;
            if (//verificando se o ano tem 4 digitos
                    (strlen($ano) != '4') ||
                    //verificando se o mes é menor que zero
                    ($mes <= '0') ||
                    //verificando se o mes é maior que 22
                    ($mes > '22') ||
                    //verificando se o dia é menor que zero
                    ($dia <= '0') ||
                    //verificando se o dia é maior que 32
                    ($dia > '32')
            ) {
                return false;
            }
            if (strlen($data) == 20)
                return true;
        }else {
            return false;
        }
    }

    /**
     * <b>Weekday</b>
     * @param type $date
     * @param type $abb
     * @return string weekday abbreviate if $abb = true 
     */
    public static function weekday($date = "", $abb = false) {
        if (empty($date)) {
            $date = date("Y-m-d");
        }
        $nWDay = (int) DateNow::live('w', $date);
        if ($abb == true) {
            $arrWeekday = array('Domingo', 'Segunda', 'Ter�a', 'Quarta', 'Quinta', 'Sexta', 'S�bado');
        } else {
            $arrWeekday = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
        }
        return $arrWeekday[$nWDay];
    }

    public function listaDia($dia) {
        for ($i = 1; $i <= 31; $i++) {
            $y = '';
            if ($i < 10) {
                $y = '0';
            }
            if ($i == $dia) {
                print ('<option value="' . $y . $i . '" SELECTED>' . $y . $i . '</option>');
            } else {
                print ('<option value="' . $y . $i . '">' . $y . $i . '</option>');
            }
        }
    }

    /**
     * <b>Month List</b>
     * @param type $month
     * @param type $abb = abbreviated month -> default = false
     */
    public function listMonth($month, $abb = false) {
        $array = array(array('id' => '01', 'm' => 'Janeiro', 'abb' => 'Jan'), array('id' => '02', 'm' => 'Fevereiro', 'abb' => 'Fev'), array('id' => '03', 'm' => 'Mar�o', 'abb' => 'Mar'), array('id' => '04', 'm' => 'Abril', 'abb' => 'Abr'), array('id' => '05', 'm' => 'Maio', 'abb' => 'Mai'), array('id' => '06', 'm' => 'Junho', 'abb' => 'Jun'), array('id' => '07', 'm' => 'Julho', 'abb' => 'Jul'), array('id' => '08', 'm' => 'Agosto', 'abb' => 'Ago'), array('id' => '09', 'm' => 'Setembro', 'abb' => 'Set'), array('id' => '10', 'm' => 'Outubro', 'abb' => 'Out'), array('id' => '11', 'm' => 'Novembro', 'abb' => 'Nov'), array('id' => '12', 'm' => 'Dezembro', 'abb' => 'Dez'));
        if ($abb == true) {
            $m = 'abb';
        } else {
            $m = 'm';
        }
        for ($i = 0; $i < sizeof($array); $i++) {
            if ($array[$i]['id'] == $month) {
                print ("<option value=\"{$array[$i]['id']}\" SELECTED> {$array[$i][$m]} </option>");
            } else {
                print ("<option value=\"{$array[$i]['id']}\"> {$array[$i][$m]} </option>");
            }
        }
    }

    public function listaAno($ano) {
        for ($i = date('Y'); $i >= 1900; $i--) {
            if ($i == $ano) {
                print ('<option value="' . $i . '" SELECTED>' . $i . '</option>');
            } else {
                print ('<option value="' . $i . '">' . $i . '</option>');
            }
        }
    }

    /** @return 2011-12-31 */
    public function constructDateToMySQL($day, $month, $year) {
        //$day = filter_input(INPUT_POST, day);
        //$month = filter_input(INPUT_POST, month);
        //$year = filter_input(INPUT_POST, year);        
        if ($month >= 1 && $month <= 12) {
            if ($day >= 1) {
                switch ($month) {
                    case 01:
                    case 03:
                    case 05:
                    case 07:
                    case 08:
                    case 10:
                    case 12:
                        if ($day > 31)
                            $day = false;
                        break;

                    case 02:
                        if ($year % 4 == 0) {
                            if ($day > 29) {
                                $day = false;
                            }
                        } else {
                            if ($day > 28) {
                                $day = false;
                            }
                        }
                        break;

                    case 04:
                    case 06:
                    case 09:
                    case 11:
                        if ($day > 30)
                            $day = false;
                        break;
                }
                if ($day) {
                    $date = $year . '-' . $month . '-' . $day;
                    return $date;
                }
                return $day;
            }
            return false;
        }
        return false;
    }

    public function setDateTime() {
        $this->dateTime = date('Y-m-d H:m:s');
    }

    public function getDateTime() {
        return $this->dateTime;
    }

}