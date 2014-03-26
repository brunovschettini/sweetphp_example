<?php

/*
 * Define config of the area project
 */
/* Security */
define('AREA_SECURE', "admin");
define('AREA_PUBLIC', 'public');
// Project name
define('PROJECT', 'sweetphp');
// Default page
define('DEFAULT_PAGE', 'welcome');

// PÁGINAS PRIVADAS
$safe_pages = array("");

// LOAD FUNCTIONS
$autoload['functions'] = array();
if (!empty($autoload)) {
    foreach ($autoload['functions'] as $key => $value) {
        include('libs/core/' . $value . '.php');
    }
}

