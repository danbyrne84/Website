<?php

error_reporting(E_ALL);

// set up a default environment
if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', 'production');
}

define ('START_TIME', microtime() );

define ('APP_PATH',    __DIR__ . '/../application');
define ('LIB_PATH',    __DIR__ . '/../library');
define ('CONFIG_PATH', __DIR__ . '/../application/config');
define ('DATA_PATH',   __DIR__ . '/../application/data');

// require the relevent configuration
require_once APP_PATH . '/config/' . APPLICATION_ENV . '.php';

// require the autoloader
require_once LIB_PATH . '/autoload.php';

$router = new \library\routing\XmlRouter(DATA_PATH . '/routes.xml');
$router->route($_SERVER['REQUEST_URI']);

?>
