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
     *  User login
     *   data reading, validation and saving
     *    Redirect to note_page.php || or on error /index_page.php
     * @return void
     * @throws \Couchbase\QueryErrorException
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
            $res = $this->userDB->validationLoginUser($data['login'], $data['password']);
            if ($res === false) {
                $this->response->render('login',['errorsLogin' => ERROR_LOGIN], 'template_login');
            }else {
                $this->session->write('login', $data['login']);
                $this->response->render('admin', [
                    'login' => $data['login'],
                ], 'template_admin');
            }
        }
    }
    /**
     * transferring data to the page and displaying Users
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function changeUsers() : void
    {
        $logins = $this->userDB->getAllIdAndField('login');
        $this->login = $this->session->get('login');
        $this->response->render('users', [
            'login' => $this->login,
            'users' => $logins,
            'modeEdit' => 'add',
        ],'template_admin');
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
        $mode = false;
        if (isset($_GET['modeEdit'])) {
            $mode = filter_input(INPUT_GET, 'modeEdit');
        }
        $user_id = 0;
        if (isset($_GET['user_id'])) {
            $user_id = (int)filter_input(INPUT_GET, 'user_id');
        }
        $data = [
            'login' => filter_input(INPUT_POST, 'reglogin'),
            'password' => filter_input(INPUT_POST, 'regpass'),
            'repassword' => filter_input(INPUT_POST, 'reregpass'),
        ];
        $errors = Validators::validateInfoUser($data);
        if (!empty($errors)) {
            $logins = $this->userDB->getAllIdAndField('login');// getId_LoginUser();
            $this->response->render('users', [
                'login' => $this->login,
                'users' => $logins,
                'modeEdit' => $mode,
                'errorsLogin' => ERROR_LOGIN,
            ], 'template_admin');
        }else {
            if ($mode === 'edit') {
                //TODO $user_id
                $this->userDB->editUser($user_id,$data['login'], $data['password']);
                $mode = 'add';
            }else {
                $res = $this->userDB->validationAddUser($data['login']);
                if ($res === false) {
                    $this->userDB->addUser($data['login'], $data['password']);
                    $mode = 'add';
                } else
                    $mode = 'check';
            }
            $logins = $this->userDB->getAllIdAndField('login');// getId_LoginUser();
            if ($mode === 'add') {
                $this->response->render('users', [
                    'login' => $this->login,
                    'users' => $logins,
                    'modeEdit' => $mode,
                ], 'template_admin');
            }else{
                $this->response->render('users', [
                    'login' => $this->login,
                    'users' => $logins,
                    'modeEdit' => $mode,
                    'errorsLogin' => ERROR_LOGIN,
                ], 'template_admin');
            }
       }
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
        $logins = $this->userDB->getAllIdAndField('login');//
        $this->response->render('users', [
            'login' => $this->login,
            'users' => $logins,
            'modeEdit' => 'add',
        ],'template_admin');
    }
    /**
     * edit user parameters
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function editUser() : void
    {
        $id = (int)filter_input(INPUT_POST, 'idEditUser');
        if(is_numeric($id)) {
            $user = $this->userDB->getAllbyId($id);
            $logins = $this->userDB->getAllIdAndField('login');
            if ($user) {
                $this->response->render('users', [
                    'login' => $this->login,
                    'users' => $logins,
                    'user' => $user,
                    'modeEdit' => 'edit',
                ],'template_admin');
            }else{
                $this->response->render('users', [
                    'login' => $this->login,
                    'users' => $logins,
                    'modeEdit' => 'add',
                ],'template_admin');
            }
        }
    }


}