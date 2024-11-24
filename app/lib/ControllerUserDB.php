<?php

namespace app\lib;

class ControllerUserDB extends Controller
{
    protected User $userDB;

    public function __construct()
    {
        parent::__construct();
        $this->userDB = new \app\lib\User();
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
//            var_dump($this->login);
            $this->session->write('login', $data['login']);
            $this->response->render('admin', [
                'login' => $data['login'],
            ],'template_admin');
        }
    }


    /**
     * User registration
     *  data reading, validation and saving
     *   Redirect to note_page.php || or on error /index_page.php
     * @return void
     * @throws \Couchbase\QueryErrorException
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
        $this->userDB->addUser($data['login'], $data['password']);
        $logins = $this->userDB->getAllIdAndFieldUser('login');// getId_LoginUser();
        $this->response->render('users', [
            'login' => $this->login,
            'users' => $logins,
        ],'template_admin');
//            }
//        }
    }

    /**
     * delete user by id
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function delUser() : void
    {
        $id = filter_input(INPUT_POST, 'idDelUser');
        if(is_numeric($id)) {
            $this->userDB->delRow($id);
        }
        $logins = $this->userDB->getAllIdAndFieldUser('login');//
        $this->response->render('users', [
            'login' => $this->login,
            'users' => $logins,
        ],'template_admin');
    }

    /**
     * transferring data to the page and displaying Users
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function changeUsers() : void
    {
        $logins = $this->userDB->getAllIdAndFieldUser('login');
        $this->login = $this->session->get('login');
        $this->response->render('users', [
            'login' => $this->login,
            'users' => $logins,
        ],'template_admin');
    }
}