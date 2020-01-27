<?php ob_start(); ?>
<h1>Modifier un article</h1>
<a href="index.php?action=listPosts">Retour à la liste des chapitres</a>
<a href="index.php?action=deletePost&amp;id=<?= $post['id'] ?>">Supprimer l'article</a>
<form method='post' action="index.php?action=editPost&amp;id=<?= $post['id'] ?>">
	<p>Titre :</p>
	<p><input type="text" name="postTitle" value="<?= htmlspecialchars_decode($post['title']) ?>" /></p>
	<p>Message :</p>
	<textarea name="postContent" id="post"><?= htmlspecialchars_decode($post['content']) ?></textarea><br />
	<p><input type="submit" name="savePost" value="Enregistrer" /></p>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>