<?php


//On inclut le fichier dont on a besoin pour se connecter à la database
require '../src/DAO/DAO.php';
//Ajout le fichier Post.php
require '../src/DAO/PostDAO.php';

use App\src\DAO\PostDAO;

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
            //Nouvelle instance de Post
            $post = new PostDAO();
            $posts = $post->getPosts();

            while($post = $posts->fetch())
            {
                ?>
                <div>
                  <h2><a href="single.php?postId=<?= htmlspecialchars($post->id);?>"><?= htmlspecialchars($post->title);?></a></h2>
                  <p><?= htmlspecialchars($post->content);?></p>
                  <p><?= htmlspecialchars($post->author);?></p>
                  <p>Créé le : <?= htmlspecialchars($post->createdAt);?></p>
                </div>
                <br>
                <?php
            }
            $posts->closeCursor();
        ?>

    </div>
</body>
</html>