<?php
/**
 * Description of Logger
 *
 * @author ilines
 * @return log information
 */
class Logger {
    
    private $url;
    private $timeZone;
    private $date;
    private $time;
    private $userId;
    private $userName;
    private $ip;
    private $filename;
    private $logMessage;
    
    /**
     * File of log
     * @param type $filename
     * @param type $logMessage
     * @example $log = new Logger("log_products", "Error save"); -> Print log -> $log->saveLog(); 
     * @example Save new files and directory of log for 
     * control operations and transaction of data bank 
     * reference to user current of session.
     */    
    public function __construct($filename = "", $logMessage = "") {
        $this->timeZone = "America/Sao_Paulo"; 
        date_default_timezone_set($this->timeZone);
        $this->url = "arquivos/log/";
        $this->date = date("Y-m-d");
        $this->time = date("H:i:s");
        $this->ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : getenv('REMOTE_ADDR');
        $this->userId = Session::get("usuarioID");
        $this->userName = Session::get("usuarioNome");
        $this->filename = $filename;
        $this->logMessage = $logMessage;
    }
    /**
     * Save this.
     */
    public function saveLog(){
        if($this->filename != ""){
            $this->filename = "$this->filename.txt";
            $this->logMessage = "Hour: [$this->time] ~ IP: [$this->ip] > User: $this->userId > $this->userName - $this->logMessage \r\n";
            if(!file_exists("log_".$this->url.$this->date)){
                if(!Dir::create($this->url, "log_$this->date", 0777, false)){
                    return false;
                }              
            }
            $manipular = fopen("{$this->url}log_{$this->date}/{$this->filename}" , "a+b");
            fwrite($manipular, $this->logMessage);
            fclose($manipular);
        }
    }
}