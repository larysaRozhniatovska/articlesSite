<?php
namespace app\lib;
class User
{
    private \mysqli $db;
    public function query(string $query) : bool
    {
        return $this->db->query($query);
    }
    public function __construct()
    {
        $this->db = new \mysqli(DB_HOST, DB_USER,DB_PASSWORD,DB_NAME);
        if($this->db->connect_errno != 0){
            exit($this->db->connect_error);
        }
        $users = $this->getUsers();
        if (count($users) == 0) {
            $hash = password_hash("admin", PASSWORD_DEFAULT);
            $str = "INSERT INTO users(login, password) VALUES ('admin','". $hash . "');";
            var_dump($str);
            $this->query($str);
        }
    }
    public function getUsers() : array
    {
        $query = "SELECT * FROM users";
        $result = $this->db->query($query);
        if(!$result){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getId_LoginUser() : array
    {
        $query = "SELECT id,login FROM users";
        $result = $this->db->query($query);
        if(!$result){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getIdUser(string $login) : array
    {
        $query = "SELECT id FROM users WHERE login = '" . $login . "' LIMIT 1";
        $result = $this->db->query($query);
        if(!$result){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addUser(string $login, string $pass) : bool
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $query = "INSERT INTO users(login, password) VALUES ('" . $login . "','" . $hash. "');";
        return $this->db->query($query);

    }
    public function delUser(int $id) : bool
    {
        $query = "DELETE FROM users WHERE id=" . $id . ";";
        return $this->db->query($query);
    }
}