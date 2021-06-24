<?php

namespace App\src\controller;

use App\src\DAO\PostDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

/**
 * Gére ce qui est accessible à tout le monde
 */
class FrontController
{
    private $postDAO;
    private $commentDAO;

    public function __construct()
    {
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
    }

    /**
     * Gére l'affichage de la page d'accueil de notre site.
     */
    public function home()
    {
        $posts = $this->postDAO->getPosts();
        return $this->view->render(
            'home',
            [
                'posts' => $posts
            ]
        );
    }

    public function post($postId)
    {
        $post = $this->postDAO->getPost($postId);
        $comments = $this->commentDAO->getCommentsFromPost($postId);
        return $this->view->render('single', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}
