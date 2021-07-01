<?php 
$this->title = 'Mon profil'; 
$user = $this->session->get('user');
?>

<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('update_password'); ?>
<div>
    <h2>Votre profil <?= $this->session->get('pseudo'); ?></h2>
    <p>Identifiant du compte : <?= $this->session->get('id') ?></p>
    <p>Type du compte : <?= $this->session->get('role') ?></p>
    <a href="../public/index.php?route=updatePassword">Modifier son mot de passe</a>
    <a href="../public/index.php?route=deleteAccount">Supprimer mon compte</a>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>