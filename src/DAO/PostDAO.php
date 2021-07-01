<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Post;

//Concernant les articles...
class PostDAO extends DAO

{
    /**
     * Convertir chaque champ de la table en propriété de notre objet Post
     * @param mixed $row
     * 
     * @return [type]
     */
    private function buildObject($row)
    {
        $post = new Post();
        $post->setId($row['id']);
        $post->setTitle($row['title']);
        $post->setContent($row['content']);
        $post->setAuthor($row['pseudo']);
        $post->setCreatedAt($row['createdAt']);
        return $post;
    }

    //Récupére tous les articles
    public function getPosts()
    {
        $sql = 'SELECT post.id, post.title, post.content, user.pseudo, post.createdAt FROM post 
                INNER JOIN user ON post.user_id = user.id ORDER BY post.id DESC';
        $result = $this->createQuery($sql);
        $posts = [];
        foreach ($result as $row){
            $postId = $row['id'];
            $posts[$postId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $posts;
    }

    //Récupére un article en fonction de l'id transmis
    public function getPost($postId)
    {
        $sql = 'SELECT post.id, post.title, post.content, user.pseudo, post.createdAt FROM post 
                INNER JOIN user ON post.user_id = user.id WHERE post.id = ?';
        $result = $this->createQuery($sql, [$postId]);
        $post = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($post);
    }

    //Ajout d'un post
    public function addPost(Parameter $post, $userId)
    {
        $sql = 'INSERT INTO post (title, content, createdAt, user_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $userId]);
    }

    public function editPost(Parameter $post, $postId, $userId)
    {
        $sql = 'UPDATE post SET title=:title, content=:content, author=:author WHERE id=:postId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'user_id' => $userId,
            'postId' => $postId
        ]);
    }

    public function deletePost($postId)
    {
        $sql = 'DELETE FROM comment WHERE post_id = ?';
        $this->createQuery($sql, [$postId]);
        $sql = 'DELETE FROM post WHERE id = ?';
        $this->createQuery($sql, [$postId]);
    }
}
