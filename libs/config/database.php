<?php
/**
 * <p>Configuração da conexão com o banco de dados/<p> 
 */
$host = 'localhost';
$database = 'mybase';
$user = 'root';
$password = '';
$driver = 'mysql';
$charset = 'UTF-8';
$port = '';
/** @name DB_HOST 
 * @example localhost
 * @tutorial Nome do host
 * 
 */
define("DB_HOST", $host);
/**
 * @name DB_DATABASE 
 * @example Nome da base de dados
 * 
 */
define("DB_DATABASE", $database);
/**
 * @name DB_USER
 * @example description Nome do usuário
 * 
 */
define("DB_USER" , $user);
/**
 * @name DB_PORT 
 * @tutorial Driver de conexão
 * @example mysql, postgres, sql
 * 
 */
define("DB_PASSWORD", $password);
/**
 * @name DB_PASSWORD 
 * @tutorial Senha do usuário
 * 
 */
define("DB_CHARSET", $charset);
/**
 * @name DB_ENGINE 
 * @example mysql, postgres, sql
 * @tutorial Driver de conexão
 * 
 */
define("DB_ENGINE", $driver);
/**
 * @name DB_ENGINE 
 * @example mysql, postgres, sql
 * @tutorial Driver de conexão
 * 
 */
define("DB_PORT", '');