<?php ob_start(); ?>
<h1>Ecrire un article</h1>

<section id="newpost">
	<form method="POST" action="index.php?action=addPost" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="postTitle">Titre</label></td>
				<td><input type="text" name="postTitle" /></td>
			</tr>
			<tr>
				<td><label for="postContent">Message</label></td>
				<td><textarea name="postContent" id="post"></textarea></td>
			</tr>
			<tr>
				<td><label for="postImage" title="Taille maximale : 2 Mo. | Formats d'image acceptés : .jpg, .jpeg, .png, .gif.">Image*</label></td>
				<td><input type="file" name="postImage" /></td>
			</tr>
		</table>
		<input type="submit" class="button" name="sendPost" value="Enregistrer" />
	</form>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>