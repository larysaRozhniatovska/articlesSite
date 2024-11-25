<?php
namespace app\lib;
class User extends AbstractDB
{
    protected string $table = 'users';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * add if no users
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    protected function NotUser()
    {
        $users = $this->getAll();
        if (count($users) == 0) {
            $hash = password_hash("admin", PASSWORD_DEFAULT);
            $str = "INSERT INTO users(login, password) VALUES ('admin','$hash')";
            var_dump($str);
            $this->queryBool($str);
        }
    }

    /**
     * $login user id
     * @param string $login
     * @return bool|array
     * @throws \Couchbase\QueryErrorException
     */
    public function getIdUser(string $login) : bool | array
    {
        $query = "SELECT id FROM {$this->table} WHERE login = '{$login}' LIMIT 1";
        return $this->queryRow($query);
    }

    /**
     * add user
     * @param string $login
     * @param string $pass
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function addUser(string $login, string $pass) : bool
    {
        if ($this->validationAddUser($login))
            return false;
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $query = "INSERT INTO {$this->table}(login, password) VALUES ('{$login}','{$hash}')";
        return $this->queryBool($query);
    }

    /**
     * update {$this->table}
     * @param int $id
     * @param string $login
     * @param string $pass
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function editUser(int $id, string $login, string $pass) : bool
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $query = "UPDATE {$this->table} SET login = '{$login}', password = '{$hash}' WHERE id = {$id}"; ;
        return $this->queryBool($query);
    }

    /**
     * user validation on login
     * @param string $login
     * @param string $pass
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function validationLoginUser(string $login, string $pass) : bool
    {
        $users = $this->getAll();
        $logins = array_column($users, 'login');
        $id = array_search($login,$logins);
        if ($id === false)
            return false;
        return password_verify($pass, $users[$id]['password']);
    }

    /**
     * user validation on login
     * @param string $login
     * @return bool true - exist login
     * @throws \Couchbase\QueryErrorException
     */
    public function validationAddUser(string $login) : bool
    {
        $users = $this->getAll();
        $logins = array_column($users, 'login');
        return in_array($login, $logins);
    }

}