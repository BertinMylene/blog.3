<?php $this->title = "Accueil"; ?>

<h1>Mon blog</h1>

<p>En construction</p>

<?= $this->session->show('add_post'); ?>
<?= $this->session->show('edit_post'); ?>
<?= $this->session->show('delete_post'); ?>
<?= $this->session->show('add_comment'); ?>

<br>
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