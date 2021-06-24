<?php

namespace App\src\controller;

use App\src\DAO\PostDAO;
use App\src\DAO\CommentDAO;

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
    }

    /**
     * Gére l'affichage de la page d'accueil de notre site.
     */
    public function home()
    {
        $posts = $this->postDAO->getPosts();
        require '../templates/home.php';
    }

    public function post($postId)
    {
        $posts = $this->postDAO->getPosts($postId);
        $comments = $this->commentDAO->getCommentsFromPost($postId);
        require '../templates/single.php';
    }
}
