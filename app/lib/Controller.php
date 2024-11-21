<?php

namespace app\lib;

class Controller
{
    /**
     * transferring data to the page and displaying admin
     * @return void
     */
    public function home(): void
    {
        $response = new Response();
        $response->render('home',['errors' => []], 'template_home');
    }
    /**
     * transferring data to the page and displaying admin
     * @return void
     */
    public function login(): void
    {
        $response = new Response();
        $response->render('login',['errors' => []], 'template_login');
    }

    /**
     * sign Out sign out of mode admin
     * @return void
     */
    public function signOutUser(): void
    {
        $session = new Session();
        $session->delete('login');
        $this->home();
    }
    /**
     * User login
     *  data reading, validation and saving
     *   Redirect to note_page.php || or on error /index_page.php
     * @return void
     */
    public function loginUser() : void
    {
        $data = [
            'login' => filter_input(INPUT_POST, 'login'),
            'password' => filter_input(INPUT_POST, 'pass'),
        ];
        $response = new Response();
        if (empty($data['login'])) {
            $response->render('login',['errorsLogin' => ERROR_LOGIN], 'template_login');
        }else {
//            $res = $this->users->validationLoginUser($data['login'],$data['password']);
//            if (!empty($res)){
//                $this->response->render('index', ['errorsLogin' => $res]);
//            }else {
                $session = new Session();
                $session->write('login', $data['login']);
//                $notes = $this->notesManager->notesUser($data['login']);
                $response->render('admin', [
                    'login' => $data['login'],
//                    'notes' => $notes,
                ],'template_admin');
            }
    }
    public function changeUsers() : void
    {
        $userDB = new \app\lib\User();
        $logins = $userDB->getId_LoginUser();
        $response = new Response();
        $session = new Session();
        $login = $session->get('login');
        $response->render('users', [
            'login' => $login,
            'users' => $logins,
        ],'template_admin');
    }
    public function changeArticles() : void
    {
        $articleDB = new \app\lib\Article();
        $article = $articleDB->getId_TitleArticles();
        $response = new Response();
        $session = new Session();
        $login = $session->get('login');
        $response->render('articles', [
            'login' => $login,
            'articles' => $article,
        ],'template_admin');
    }
}