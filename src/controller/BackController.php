<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
    public function administration()
    {
        $posts = $this->postDAO->getPosts();
        return $this->view->render('administration', [
            'posts' => $posts
        ]);
    }
    
    public function addPost(Parameter $post)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Post');
            if(!$errors) {
                $this->postDAO->addPost($post, $this->session->get('id'));
                $this->session->set('add_post', 'Le nouvel article a bien été ajouté');
                header('Location: ../public/index.php?route=administration');
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
                $this->postDAO->editPost($post, $postId, $this->session->get('id'));
                $this->session->set('edit_post', 'L\' article a bien été modifié');
                header('Location: ../public/index.php?route=administration');
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
        header('Location: ../public/index.php?route=administration');
    }

    public function deleteComment($commentId)
    {
        $this->commentDAO->deleteComment($commentId);
        $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
        header('Location: ../public/index.php');
    }

    public function profile()
    {
        return $this->view->render('profile');
    }

    public function updatePassword(Parameter $post)
    {
        if($post->get('submit')) {
            $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
            $this->session->set('update_password', 'Le mot de passe a été mis à jour');
            header('Location: ../public/index.php?route=profile');
        }
        header('Location: ../public/index.php?route=profile');
    }

    public function logout()
    {
        $this->logoutOrDelete('logout');
    }

    public function deleteAccount()
    {
        $this->userDAO->deleteAccount($this->session->get('pseudo'));
        $this->logoutOrDelete('delete_account');
    }

    private function logoutOrDelete($param)
    {
        $this->session->stop();
        $this->session->start();
        if($param === 'logout') {
            $this->session->set($param, 'À bientôt');
        } else {
            $this->session->set($param, 'Votre compte a bien été supprimé');
        }
        header('Location: ../public/index.php');
    }


}