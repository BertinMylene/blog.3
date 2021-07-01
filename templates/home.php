<?php $this->title = "Accueil"; ?>

<h1>Mon blog</h1>

<p>En construction</p>

<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>
<?= $this->session->show('delete_comment'); ?>
<?= $this->session->show('register'); ?>
<?= $this->session->show('login'); ?>
<?= $this->session->show('logout'); ?>
<?= $this->session->show('delete_account'); ?>
<br>

<?php
//Menu dynamique si l'utilisateur est connecté
if ($this->session->get('pseudo')) :
    ?>
    <p>Bienvenue sur votre espace <?= ucfirst(htmlspecialchars($this->session->get('pseudo')))?></p>
    <a href="../public/index.php?route=logout">Déconnexion</a>
    <a href="../public/index.php?route=profile">Profil</a>
    <?php if($this->session->get('role') === 'admin') :?>
    <a href="../public/index.php?route=administration">Administration</a>
    <?php endif;?>
<?php
else:
    ?>
    <a href="../public/index.php?route=register">Inscription</a>
    <a href="../public/index.php?route=login">Connexion</a>
<?php
endif;
?>

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
        <p><?= nl2br(htmlspecialchars($post->getContent())); ?></p>
        <p><?= htmlspecialchars($post->getAuthor());?></p>
        <p>Créé le : <?= htmlspecialchars($post->getCreatedAt());?></p>
    </div>
    <br>
    <?php
}
?>