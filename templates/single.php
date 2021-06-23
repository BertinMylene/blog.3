<?php

use App\src\DAO\PostDAO;
use App\src\DAO\CommentDAO;

//On inclut le fichier dont on a besoin pour se connecter à la database
require '../src/DAO/DAO.php';
//Ajout le fichier Post.php
require '../src/DAO/PostDAO.php';
//Ajout le fichier Comment.php
require '../src/DAO/CommentDAO.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Mon blog</title>
</head>

<body>
<div>
    <h1>Mon blog</h1>
    <p>En construction</p>

    <?php
        $post = new PostDAO();
        $posts = $post->getPost($_GET['postId']);
        $post = $posts->fetch()
    ?>

    <div>
        <h2><?= htmlspecialchars($post->title);?></h2>
        <p><?= htmlspecialchars($post->content);?></p>
        <p><?= htmlspecialchars($post->author);?></p>
        <p>Créé le : <?= htmlspecialchars($post->createdAt);?></p>
    </div>
    <br>

    <?php
    $posts->closeCursor();
    ?>

    <a href="home.php">Retour à l'accueil</a>

    <div id="comments" class="text-left" style="margin-left: 50px">
        <h3>Commentaires</h3>
        <?php
        $comment = new CommentDAO();
        $comments = $comment->getCommentsFromPost($_GET['postId']);
        while($comment = $comments->fetch())
        {
            ?>
            <h4><?= htmlspecialchars($comment->pseudo);?></h4>
            <p><?= htmlspecialchars($comment->content);?></p>
            <p>Posté le <?= htmlspecialchars($comment->createdAt);?></p>
            <?php
        }
        $comments->closeCursor();
        ?>
    </div>
    
</div>
</body>
</html>