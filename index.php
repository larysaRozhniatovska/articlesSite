<?php
include_once 'app' . DIRECTORY_SEPARATOR  . 'bootstrap.php';

$router = new \app\lib\Router();
require $router->redirect();