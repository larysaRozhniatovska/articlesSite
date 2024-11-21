<?php
include_once 'app' . DIRECTORY_SEPARATOR  . 'bootstrap.php';

//$user = new \app\lib\User();
//var_dump($user);
$router = new \app\lib\Router();
$router->admin();
