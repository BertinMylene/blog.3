<?php
//On inclut le fichier dont on a besoin (ici à la racine de notre site) pour se connecter à la database
require 'Database.php';
//Ne pas oublier d'ajouter le fichier Post.php
require 'Post.php';
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
            $post = new Post();
            $posts = $post->getPosts();

            while($post = $posts->fetch())
            {
                ?>
                <div>
                    <h2><a href="single.php?postId=<?= htmlspecialchars($post['id']);?>"><?= htmlspecialchars($post['title']);?></a></h2>
                    <p><?= htmlspecialchars($post['content']);?></p>
                    <p><?= htmlspecialchars($post['author']);?></p>
                    <p>Créé le : <?= htmlspecialchars($post['createdAt']);?></p>
                </div>
                <br>
                <?php
            }
            $posts->closeCursor();
        ?>

    </div>
</body>
</html>