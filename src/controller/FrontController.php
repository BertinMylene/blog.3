<?php

namespace App\src\controller;

use App\config\Parameter;


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

    public function addComment(Parameter $post, $postId)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Comment');
            if(!$errors) {
                $this->commentDAO->addComment($post, $postId);
                $this->session->set('add_comment', 'Le nouveau commentaire a bien été ajouté');
                header('Location: ../public/index.php');
            }
            $article = $this->postDAO->getPost($postId);
            $comments = $this->commentDAO->getCommentsFromPost($postId);
            return $this->view->render('single', [
                'article' => $article,
                'comments' => $comments,
                'post' => $post,
                'errors' => $errors
            ]);
        }
    }

    public function flagComment($commentId)
    {
        $this->commentDAO->flagComment($commentId);
        $this->session->set('flag_comment', 'Le commentaire a bien été signalé');
        header('Location: ../public/index.php');
    }
}
