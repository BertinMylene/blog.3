<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
    public function addPost(Parameter $post)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Post');
            if(!$errors) {
                $this->postDAO->addPost($post);
                $this->session->set('add_post', 'Le nouvel article a bien été ajouté');
                header('Location: ../public/index.php');
            }
            return $this->view->render('add_post', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        return $this->view->render('add_post');
    }


    public function editPost(Parameter $post, $postId)
    {
        $article = $this->postDAO->getPost($postId);
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Post');
            if(!$errors) {
                $this->postDAO->editPost($post, $postId);
                $this->session->set('edit_post', 'L\' article a bien été modifié');
                header('Location: ../public/index.php');
            }
            return $this->view->render('edit_post', [
                'post' => $post,
                'errors' => $errors
            ]);

        }
        //Edition d'un article, données brutes de la base
        $post->set('id', $article->getId());
        $post->set('title', $article->getTitle());
        $post->set('content', $article->getContent());
        $post->set('author', $article->getAuthor());

        return $this->view->render('edit_post', [
            'post' => $post
        ]);
    }

    public function deletePost($postId)
    {
        $this->postDAO->deletePost($postId);
        $this->session->set('delete_post', 'L\' article a bien été supprimé');
        header('Location: ../public/index.php');
    }

    public function deleteComment($commentId)
    {
        $this->commentDAO->deleteComment($commentId);
        $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
        header('Location: ../public/index.php');
    }
}