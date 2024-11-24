<?php

namespace app\lib;
class Controller extends AbstractController
{

    /**
     * transferring data to the page and displaying home
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function home(): void
    {
        $articleDB = new \app\lib\Article();
        $articles = $articleDB->getAll();
        $this->response->render('home', [
            'articles' => $articles,
        ],'template_home');
    }

    /**
     * transferring data to the page and displaying admin
     * @return void
     */
    public function login(): void
    {
        $this->response->render('login',['errors' => []], 'template_login');
    }

    /**
     * sign Out sign out of mode admin
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function signOutUser(): void
    {
        $this->session->delete('login');
        $this->home();
    }

}