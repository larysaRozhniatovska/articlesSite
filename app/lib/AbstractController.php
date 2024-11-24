<?php

namespace app\lib;

class AbstractController
{
    protected Response $response;
    protected Session $session;
    protected ?string $login = '';
    public function __construct()
    {
        $this->response = new Response();
        $this->session = new Session();
        $this->login = $this->session->get('login');
    }
}