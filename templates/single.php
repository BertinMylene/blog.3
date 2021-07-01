<?php $this->title = "Article"; ?>

<h1>Mon blog</h1>
<p>En construction</p>

<?= $this->session->show('add_post'); ?>
<?= $this->session->show('edit_post'); ?>
<?= $this->session->show('delete_post'); ?>
<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>
<?= $this->session->show('delete_comment'); ?>

<div>
    <h2><?= htmlspecialchars($post->getTitle()); ?></h2>
    <p><?= htmlspecialchars($post->getContent()); ?></p>
    <p><?= htmlspecialchars($post->getAuthor()); ?></p>
    <p>Créé le : <?= htmlspecialchars($post->getCreatedAt()); ?></p>
</div>
<div class="actions">
    <a href="../public/index.php?route=editPost&postId=<?= $post->getId(); ?>">Modifier</a>
    <a href="../public/index.php?route=deletePost&postId=<?= $post->getId(); ?>">Supprimer</a>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>

<div id="comments" class="text-left" style="margin-left: 50px">

    <h3>Ajouter un commentaire</h3>
    <?php include 'form_comment.php'; ?>

    <h3>Commentaires</h3>
    <?php
    foreach ($comments as $comment) {
    ?>
        <h4><?= htmlspecialchars($comment->getPseudo());?></h4>
        <p><?= htmlspecialchars($comment->getContent());?></p>
        <p>Posté le <?= htmlspecialchars($comment->getCreatedAt());?></p>
        <?php
        if($comment->isFlag()) {
            ?>
            <p>Ce commentaire a déjà été signalé</p>
            <?php
        } else {
            ?>
            <p><a href="../public/index.php?route=flagComment&commentId=<?= $comment->getId(); ?>">
                Signaler le commentaire</a>
            </p>
            <?php
        }
        ?>
        <p><a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">
        Supprimer le commentaire</a>
        </p>
        <br>
    <?php
    }
    ?>
</div>
</body>

</html>