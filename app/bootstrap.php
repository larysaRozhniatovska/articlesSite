<?php
const APP_DIR = 'app'.DIRECTORY_SEPARATOR;
include_once APP_DIR . 'config.php';

spl_autoload_register(function($className){
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $classFile = $className.'.php';
    if(file_exists($classFile)){
        include_once $classFile;
        return true;
    }
    return false;
});
$router = new \app\lib\Router();
$router->init();