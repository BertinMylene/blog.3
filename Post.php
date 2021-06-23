<?php

//Concernant les articles...
class Post
{
    //Récupére tous les articles
    public function getPosts()
    {
        $db = new Database();
        $connection = $db->getConnection();

        $result = $connection->query('SELECT id, title, content, author, createdAt FROM post ORDER BY id DESC');
        return $result;
    }

    //Récupére un article en fonction de l'id transmis
    public function getPost($postId)
    {
        $db = new Database();
        $connection = $db->getConnection();

        $result = $connection->prepare('SELECT id, title, content, author, createdAt FROM post WHERE id = ?');
        $result->execute([
            $postId
        ]);
        return $result;
    }










}