<?php

namespace App\src\controller;


class FrontController extends Controller
{
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
