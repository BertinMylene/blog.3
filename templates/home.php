<?php $this->title = "Accueil"; ?>

<h1>Mon blog</h1>

<p>En construction</p>

<?= $this->session->show('add_post'); ?>
<?= $this->session->show('edit_post'); ?>
<?= $this->session->show('delete_post'); ?>
<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>
<?= $this->session->show('delete_comment'); ?>
<?= $this->session->show('register'); ?>
<br>
<a href="../public/index.php?route=register">Inscription</a>
<a href="../public/index.php?route=login">Connexion</a>
<a href="../public/index.php?route=addPost">Nouvel article</a>

<?php
foreach ($posts as $post)
{
    ?>
    <div>
        <h2><a href="../public/index.php?route=post&postId=
                <?= htmlspecialchars($post->getId());?>">
                <?= htmlspecialchars($post->getTitle());?>
            </a>
        </h2>
        <p><?= htmlspecialchars($post->getContent());?></p>
        <p><?= htmlspecialchars($post->getAuthor());?></p>
        <p>Créé le : <?= htmlspecialchars($post->getCreatedAt());?></p>
    </div>
    <br>
    <?php
}
?>