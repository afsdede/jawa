<?php
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set("America/Sao_Paulo");
define('DS', DIRECTORY_SEPARATOR);
define('MAIN_ROOT', realpath(__DIR__.DS.'..'));
define('APP_ROOT', realpath(__DIR__.DS));

if (!file_exists(APP_ROOT.DS.'KernelEngine.php')){
    throw new Exception(APP_ROOT.'KernelEngine.php'."Kernel not found!");
}

require_once APP_ROOT.DS.'KernelEngine.php';

?>