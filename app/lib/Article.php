<?php
namespace app\lib;
class Article
{
    private \mysqli $db;

    public function __construct()
    {
        $this->db = new \mysqli(DB_HOST, DB_USER,DB_PASSWORD,DB_NAME);
        if($this->db->connect_errno != 0){
            exit($this->db->connect_error);
        }
    }
    public function getArticles() : array
    {
        $query = "SELECT * FROM articles";
        $result = $this->db->query($query);
        if(!$result){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getId_TitleArticles() : array
    {
        $query = "SELECT id,title FROM articles";
        $result = $this->db->query($query);
        if(!$result){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function addArticle(string $title, string $content,int $author_id) : bool
    {
        $query = "INSERT INTO articles(title, content, author_id) VALUES 
                ('" . $title . "','" . $content. "','" . $author_id . "');";
        return $this->db->query($query);

    }
    public function delArticle(int $id) : bool
    {
        $query = "DELETE FROM articles WHERE id=" . $id . ";";
        return $this->db->query($query);
    }

}