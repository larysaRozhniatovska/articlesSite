<?php

namespace app\lib;

use Couchbase\IndexNotFoundException;

class Router
{
    // Маршруты
// [маршрут => функция которая будет вызвана]
    protected static array $routes = [
        '/' => 'home.php',
        '/admin' => 'admin.php',
    ];

    /**
     * Init application
     * @return void
     */
    public static function init() : void
    {
        $action = '';
        if (isset($_GET['action'])) {
            $action = filter_input(INPUT_GET, 'action');
        }
        if ($action !== '')
        {
            $controller = new Controller();
            if (!method_exists($controller, $action)) {
                $controllerUser = new ControllerUserDB();
                if (!method_exists($controllerUser, $action)){
                    $controllerArticle = new ControllerArticleDB();
                    if (!method_exists($controllerArticle, $action)){
                        self::notFound();
                    }else {
                        $controllerArticle->$action();
                    }
                }else{
                    $controllerUser->$action();
                }
            }else {
                $controller->$action();
            }
        }
    }

    /**
     * Home application
     * @return void
     */
    public static  function home() : void
    {
        $action = 'home';
        if (isset($_GET['action'])) {
            $action = filter_input(INPUT_GET, 'action');
        }
        $controller = new Controller();
        if (!method_exists($controller, $action)) {
            self::notFound();
        }
        $controller->$action();
    }

    /**
     *  Mode admin application
     * @return void
     */
    public static  function admin() : void
    {
        $action = 'login';
        if (isset($_GET['action'])) {
            $action = filter_input(INPUT_GET, 'action');
        }
        $controller = new Controller();
        if (!method_exists($controller, $action)) {
            self::notFound();
        }
        $controller->$action();
    }

    /**
     * notFound page
     * @return never
     */
    public static function notFound() : never
    {
        http_response_code(404);
        exit;
    }
    /**
     * generate url by action
     * @param string $action
     * @return string
     */
    public static function url(string $action = 'home') : string
    {
        return '/?action=' . $action;
    }

    /**
     * redirect to specify url
     * @return mixed|string|void
     */
    public static  function redirect()
    {
        if (array_key_exists($_SERVER['REQUEST_URI'], self::$routes)) {
            return self::$routes[$_SERVER['REQUEST_URI']];
        }
        self::notFound();
    }
}