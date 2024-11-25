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
    public function changeArticles(): void
    {
        $articles = $this->articleDB->getAllIdAndField('title');
        $this->response->render('articles', [
            'login' => $this->login,
            'articles' => $articles,
            'modeEdit' => 'add',
        ], 'template_admin');
    }

    /**
     * add Article
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function addArticle(): void
    {
        $mode = false;
        if (isset($_GET['modeEdit'])) {
            $mode = (bool)filter_input(INPUT_GET, 'modeEdit');
        }
        $article_id = 0;
        if (isset($_GET['article_id'])) {
            $article_id = (int)filter_input(INPUT_GET, 'article_id');
        }
        $data = [
            'title' => filter_input(INPUT_POST, 'title'),
            'content' => filter_input(INPUT_POST, 'content'),
        ];
        $errors = ($data['title'] === '') || ($data['content'] === '');
        if ($errors === true) {
            if ($mode !== 'edit'){
                $mode = 'check';
            }
            $articles = $this->articleDB->getAllIdAndField('title');
            $this->response->render('articles', [
                'login' => $this->login,
                'articles' => $articles,
                'modeEdit' => $mode,
                'errorsAdd' => ERROR_ADD,
            ], 'template_admin');
        } else {
            if (!$mode) {
                $userDB = new \app\lib\User();
                $author_id = $userDB->getIdUser($this->login);
                $author_id = (int)$author_id["id"];
                $this->articleDB->addArticle($data['title'], $data['content'], $author_id);
            } else {
                $this->articleDB->editArticle($article_id, $data['title'], $data['content']);
            }
            $articles = $this->articleDB->getAllIdAndField('title');
            $this->response->render('articles', [
                'login' => $this->login,
                'articles' => $articles,
                'modeEdit' => 'add',
            ], 'template_admin');
        }
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
        $articles = $this->articleDB->getAllIdAndField('title');
        $this->response->render('articles', [
            'login' => $this->login,
            'articles' => $articles,
            'modeEdit' => 'add',
        ],'template_admin');
    }

    /**
     * edit article parameters
     * @return void
     * @throws \Couchbase\QueryErrorException
     */
    public function editArticle() : void
    {
        $id = (int)filter_input(INPUT_POST, 'idEditArticle');
        if(is_numeric($id)) {
            $article = $this->articleDB->getArticle($id);
            $articles = $this->articleDB->getAllIdAndField('title');
            if ($article) {
                $this->response->render('articles', [
                    'login' => $this->login,
                    'articles' => $articles,
                    'article' => $article,
                    'modeEdit' => 'edit',
                ],'template_admin');
            }else{
                $this->response->render('articles', [
                    'login' => $this->login,
                    'articles' => $articles,
                    'modeEdit' => 'add',
                ],'template_admin');
            }
        }
    }


    /**
     * view article parameters
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
                $article = $this->articleDB->getArticle($id);
                if ($article) {
                    $date = new DateTime($article['created_at'], new DateTimeZone('UTC'));
                    $date->setTimezone(new DateTimeZone('CEST'));
                    $article['created_at'] = $date->format('Y-m-d H:i:s');
                    $this->response->render('article', [
                        'article' => $article,
                        'author' => $article['author'],
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