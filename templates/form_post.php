<?php
$route = isset($post) && $post->getId() ? 'editPost&postId='.$post->getId() : 'addPost';
$submit = $route === 'addPost' ? 'Envoyer' : 'Mettre à jour';
$title = isset($post) && $post->getTitle() ? htmlspecialchars($post->getTitle()) : '';
$content = isset($post) && $post->getContent() ? htmlspecialchars($post->getContent()) : '';
$author = isset($post) && $post->getAuthor() ? htmlspecialchars($post->getAuthor()) : '';
?>

<form method="post" action="../public/index.php?route=<?= $route; ?>">
    <label for="title">Titre</label><br>
    <input type="text" id="title" name="title" value="<?= $title; ?>"><br>
    <label for="content">Contenu</label><br>
    <textarea id="content" name="content"><?= $content; ?></textarea><br>
    <label for="author">Auteur</label><br>
    <input type="text" id="author" name="author" value="<?= $author; ?>"><br>
    <input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>