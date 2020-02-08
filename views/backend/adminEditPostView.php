<?php ob_start(); ?>
<h1>Modifier un article</h1>
<a href="index.php?action=listPosts">Retour à la liste des chapitres</a>
<a href="index.php?action=deletePost&amp;id=<?= $post['id'] ?>">Supprimer l'article</a>
<form method='post' action="index.php?action=editPost&amp;id=<?= $post['id'] ?>" enctype="multipart/form-data">
	<p>Titre :</p>
	<p><input type="text" name="postTitle" value="<?= htmlspecialchars_decode($post['title']) ?>" /></p>
	<p>Message :</p>
	<textarea name="postContent" id="post"><?= htmlspecialchars_decode($post['content']) ?></textarea><br />
	<p>Image actuelle :</p>
	<?php if (!empty($post['image_name'])) { ?>
		<img src="public/images/<?= $post['image_name'] ?>" />
		<a href="index.php?action=deleteImage&amp;id=<?= $post['id'] ?>">Supprimer l'image</a>
	<?php } else { echo '<p><em>Pas d\'image.</em></p>'; } ?>
	<p><input type="file" name="editImage" />
	<p><input type="submit" name="savePost" value="Enregistrer" /></p>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>