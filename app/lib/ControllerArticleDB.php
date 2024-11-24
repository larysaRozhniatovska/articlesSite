<?php

namespace app\lib;

use DateTime;
use DateTimeZone;

class ControllerArticleDB extends Controller
{
    protected Article $articleDB;

    public function __construct()
    {
        parent::__construct();
        $this->articleDB = new \app\lib\Article();
    }

    /**
     * transferring data to the page and displaying Articles
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function changeArticles() : void
    {
        $articles = $this->articleDB->getAllIdAndField('title');
        $this->response->render('articles', [
            'login' => $this->login,
            'articles' => $articles,
        ],'template_admin');
    }

    /**
     * add Article
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function addArticle() : void
    {
        $userDB = new \app\lib\User();
        $author_id = $userDB->getIdUser($this->login);
        $data = [
            'title' => filter_input(INPUT_POST, 'title'),
            'content' => filter_input(INPUT_POST, 'content'),
        ];

//        $errors = $this->validators->validateInfoUser($data);
//        if (!empty($errors)) {
//            $this->response->render('index', ['errorsAdd' => $errors]);
//        }else {
//            $res = $this->users->validationAddUser($data['login']);
//            if (!empty($res)){
//                $this->response->render('index', ['errorsAdd' => $res]);
//            }else {
        $author_id = (int) $author_id["id"];
        $this->articleDB->addArticle($data['title'], $data['content'], $author_id);
        $articles = $this->articleDB->getAllIdAndField('title');
        $this->response->render('articles', [
            'login' => $this->login,
            'articles' => $articles,
        ],'template_admin');
//            }
//        }
    }

    /**
     * delete Article
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function delArticle() : void
    {
        $id = filter_input(INPUT_POST, 'idDelArticle');
        if(is_numeric($id)) {
            $this->articleDB->delRow($id);
        }
        $article = $this->articleDB->getAllIdAndField('title');
        $this->response->render('articles', [
            'login' => $this->login,
            'articles' => $article,
        ],'template_admin');
    }

    /**
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function viewArticle() : void
    {
        $id_str = '';
        if (isset($_GET['id'])) {
            $id_str = filter_input(INPUT_GET, 'id');
            $id = (int)$id_str;
            if ($id > 0) {
                $article = $this->articleDB->getAllbyId($id);
                if ($article) {
                    $userDB = new \app\lib\User();
                    $user = $userDB->getAllbyId($article['author_id']);
                    $author = $user['login'];
                    $date = new DateTime($article['created_at'], new DateTimeZone('UTC'));
                    $date->setTimezone(new DateTimeZone('CEST'));
                    $article['created_at'] = $date->format('Y-m-d H:i:s');
                    $this->response->render('article', [
                        'article' => $article,
                        'author' => $author,
                    ], 'template_home');
                }else{
                    $articles = $this->articleDB->getAll();
                    $this->response->render('home', [
                        'articles' => $articles,
                    ],'template_home');
                }
            }
        }
    }


}