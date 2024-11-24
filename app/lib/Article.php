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

}