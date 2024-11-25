<?php

namespace app\lib;

class Response
{
    /**
     * Show front
     * @param string $page
     * @param array $data
     * @param string $template
     */
    function render(string $page,array $data = [], string $template = VIEWS_TEMPLATE): void
    {
        extract($data);
        include_once VIEWS_TEMPLATES_DIR . $template . '.php';
    }

    /**
     * Redirect to specify url
     * @param string $url
     */
    function redirect(string $url) : never
    {
        Router::redirect($url);
        exit;
    }
}