<?php
namespace app\lib;
class Article extends AbstractDB
{
    protected string $table = 'articles';
    public function __construct()
    {
       parent::__construct();
    }
    /**
     * add article
     * @param string $title
     * @param string $content
     * @param int $author_id
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function addArticle(string $title, string $content,int $author_id) : bool
    {
        $curDateTime =  gmdate("YmdHis");
        $query = "INSERT INTO {$this->table}(title, content, created_at, author_id) VALUES ( '{$title}','{$content}','{$curDateTime}','{$author_id}')" ;
        return $this->queryBool($query);

    }

    /**
     * update {$this->table}
     * @param int $id
     * @param string $title
     * @param string $content
     * @return bool
     * @throws \Couchbase\QueryErrorException
     */
    public function editArticle(int $id, string $title, string $content) : bool
    {
        $query = "UPDATE {$this->table} SET title = '{$title}', content = '{$content}' WHERE id = {$id}"; ;
        return $this->queryBool($query);
    }

    /**
     * returns all article parameters by id and author login
     * @param int $id
     * @return bool|array
     * @throws \Couchbase\QueryErrorException
     */
    public function getArticle(int $id) : bool |array
    {
        $query = "SELECT {$this->table}.*, users.login as author FROM {$this->table} INNER JOIN users ON {$this->table}.author_id = users.id  WHERE {$this->table}.id = {$id}";
        return $this->queryRow($query);

    }

}