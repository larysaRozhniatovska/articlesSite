<?php

namespace app\lib;

class Router
{
    // Маршруты
// [маршрут => функция которая будет вызвана]
    protected array $routes = [
        '/' => 'home.php',
        '/admin' => 'admin.php',
    ];
    /**
     * Init application
     * @return void
     */
    public  function init() : void
    {
        $action = '';
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
     * Home application
     * @return void
     */
    public  function home() : void
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
    public  function admin() : void
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
     * Generate 404 status
     * @return never
     */
    public static function notFound() : never
    {
        http_response_code(404);
        //TODO if need especially view
        exit();
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
     */
    public function redirect()
    {
        if (array_key_exists($_SERVER['REQUEST_URI'], $this->routes)) {
            return $this->routes[$_SERVER['REQUEST_URI']];
        }
        $this->notFound();
    }
}