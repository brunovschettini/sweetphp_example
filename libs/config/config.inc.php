<?php
// IS AJAX
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
include 'libs/config/database.php';
include 'libs/config/area.php';
include 'libs/config/path.php';
require_once 'libs/ClassAutoloader.php';
$autoloader = new ClassAutoloader();
$session = new Session();
Routers::ajax();
Verify::load();
Routers::load();

/**
 * CONFIG TIMEZONE
 * Reference timezones
 * @link http://php.net/manual/pt_BR/timezones.php
 */
ini_set('date.timezone', "America/SAO_PAULO");

