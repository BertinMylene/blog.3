<?php
namespace App\src\DAO;

//Concernant les articles...
class PostDAO extends DAO

{
    //Récupére tous les articles
    public function getPosts()
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM post ORDER BY id DESC';
        return $this->createQuery($sql);
    }

    //Récupére un article en fonction de l'id transmis
    public function getPost($postId)
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM post WHERE id = ?';
        return $this->createQuery($sql, [$postId]);
    }
}