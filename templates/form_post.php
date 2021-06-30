<?php
/**
 * Si existance d'un article, alors on affiche ses données pré-remplies => modification
 * Sinon champs vide => insertion
 * Affichage des erreurs de validation des données sous les champs correspondants
 *
 * La route générée est :
 * Si données POST : edition donc editPost pour modification
 * Si pas de données POST : addPost pour ajout
 */

$route = isset($post) && $post->get('id') ? 'editPost&postId=' . $post->get('id') : 'addPost';
$submit = $route === 'addPost' ? 'Envoyer' : 'Mettre à jour';
$title = isset($post) ? htmlspecialchars($post->get('title')) : '';
$content = isset($post) ? htmlspecialchars($post->get('content')) : '';
$author = isset($post) ? htmlspecialchars($post->get('author')) : '';

?>
<form method="post" action="../public/index.php?route=<?= $route; ?>">
    <label for="title">Titre</label><br>
    <input type="text" id="title" name="title" value="<?= $title; ?>"><br>
    <?= isset($errors['title']) ? $errors['title'] : '' ?>

    <label for="content">Contenu</label><br>
    <textarea name="content" id="contenu" cols="30" rows="10"><?= $content; ?></textarea><br>
    <?= isset($errors['content']) ? $errors['content'] : '' ?>

    <label for="author">Auteur</label><br>
    <input type="text" id="author" name="author" value="<?= $author; ?>"><br><br>

    <input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>