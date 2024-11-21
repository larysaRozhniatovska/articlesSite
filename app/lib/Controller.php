<?php

namespace app\lib;

class Controller
{
    protected Response $response;
    protected Session $session;
    protected string $login = '';
    public function __construct()
    {
        $this->response = new Response();
        $this->session = new Session();
//        $this->login = $this->session->get('login');

//        $this->users = new Users();
//        $this->validators = new Validators();
//        $this->notesManager = new Notes();
    }
    /**
     * transferring data to the page and displaying admin
     * @return void
     */
    public function home(): void
    {
        $this->response->render('home',['errors' => []], 'template_home');
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
     */
    public function signOutUser(): void
    {
        $this->session->delete('login');
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
        if (empty($data['login'])) {
            $this->response->render('login',['errorsLogin' => ERROR_LOGIN], 'template_login');
        }else {
//            $res = $this->users->validationLoginUser($data['login'],$data['password']);
//            if (!empty($res)){
//                $this->response->render('index', ['errorsLogin' => $res]);
//            }else {
                $this->session->write('login', $data['login']);
                $this->response->render('admin', [
                    'login' => $data['login'],
                ],'template_admin');
            }
    }
    /**
     * User registration
     * data reading, validation and saving
     *  Redirect to note_page.php || or on error /index_page.php
     * @return void
     */
    public function addUser() : void
    {
        $data = [
            'login' => filter_input(INPUT_POST, 'reglogin'),
            'password' => filter_input(INPUT_POST, 'regpass'),
            'repassword' => filter_input(INPUT_POST, 'reregpass'),
        ];

//        $errors = $this->validators->validateInfoUser($data);
//        if (!empty($errors)) {
//            $this->response->render('index', ['errorsAdd' => $errors]);
//        }else {
//            $res = $this->users->validationAddUser($data['login']);
//            if (!empty($res)){
//                $this->response->render('index', ['errorsAdd' => $res]);
//            }else {
//                $this->users->addUser([
//                    'login' => $data['login'],
//                    'password' => $data['password'],
//                ]);
//                $this->session->write('login', $data['login']);
//                $this->response->render('note', [
//                    'login' => $data['login'],
//                ]);
//            }
//        }
    }

    public function changeUsers() : void
    {
        $userDB = new \app\lib\User();
        $logins = $userDB->getId_LoginUser();
        $this->login = $this->session->get('login');
        $this->response->render('users', [
            'login' => $this->login,
            'users' => $logins,
        ],'template_admin');
    }
    public function changeArticles() : void
    {
        $articleDB = new \app\lib\Article();
        $article = $articleDB->getId_TitleArticles();
        $this->login = $this->session->get('login');
        $this->response->render('articles', [
            'login' => $this->login,
            'articles' => $article,
        ],'template_admin');
    }
}