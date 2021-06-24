<?php

namespace App\src\controller;


class BackController extends Controller
{
    
    public function addPost($post)
    {
        if(isset($post['submit'])) {
            $this->postDAO->addPost($post);
            header('Location: ../public/index.php');
        }
        return $this->view->render('add_post', [
            'post' => $post
        ]);
    }
}