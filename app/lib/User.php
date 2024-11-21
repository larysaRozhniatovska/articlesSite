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
            $pass = password_hash("admin", PASSWORD_DEFAULT);
            $str = "INSERT INTO users(login, password) VALUES ('admin','". $pass . "');";
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


}