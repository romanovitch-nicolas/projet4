<?php ob_start(); ?>
<h1>Ecrire un article</h1>
<form method='POST' action=''>
	<p>Titre :</p>
	<p><input type="text" name="postTitle" /></p>
	<p>Message :</p>
	<textarea name="postContent" id="post"></textarea><br />
	<p><input type="submit" name="sendPost" value="Publier" /></p>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>