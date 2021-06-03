<?php
//define the core paths
//Define them as absolute peths to make sure that require_once works as expected

//DIRECTORY_SEPARATOR is a PHP Pre-defined constants:
//(\ for windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS);

defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'config');

defined('CLASS_PATH') ? null : define ('CLASS_PATH',SITE_ROOT.DS.'classes');

defined('SITE_TITLE') ? null : define('SITE_TITLE', 'MMS');

//Load composer autoload
require_once(SITE_ROOT.DS."/vendor/autoload.php");
//Load Dotenv dependency
$dotenv = Dotenv\Dotenv::createImmutable(SITE_ROOT.DS."");
$dotenv->load();

?>