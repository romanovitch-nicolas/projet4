<?php ob_start(); ?>
<h1>Ecrire un article</h1>
<form method='POST' action='' enctype="multipart/form-data">
	<p>Titre :</p>
	<p><input type="text" name="postTitle" /></p>
	<p>Message :</p>
	<textarea name="postContent" id="post"></textarea><br />
	<p>Image :</p>
	<p><input type="file" name="postImage" />
	<p><input type="submit" name="sendPost" value="Enregistrer" /></p>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>