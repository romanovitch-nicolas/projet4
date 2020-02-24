<?php $title = "Ecrire un chapitre" ?>

<?php ob_start(); ?>
<h1>Ecrire un chapitre</h1>

<section id="newpost">
	<?php if (isset($return)) { echo '<p class="return red"><i class="fas fa-exclamation-circle"></i> ' . $return . '</p>'; } ?>
	<form method="POST" action="index.php?action=addPost" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="postTitle">Titre</label></td>
				<td><input type="text" name="postTitle" value="<?php if (isset($_POST['postTitle'])) { echo $_POST['postTitle']; } ?>" placeholder="Titre" required /></td>
			</tr>
			<tr>
				<td><label for="postContent">Texte</label></td>
				<td><textarea name="postContent" id="post" ><?php if (isset($_POST['postContent'])) { echo $_POST['postContent']; } ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><a id="newimagebutton" class="button" href="#">Ajouter une image</a>
					<div class="invisible">
						<input type="file" name="postImage" />
						<p class="date">(Taille maximale : 2 Mo. | Formats d'image acceptés : .jpg, .jpeg, .png, .gif.)<p>
					</div>
				</td>
			</tr>
		</table>
		<input type="submit" class="button" name="sendPost" value="Enregistrer" />
	</form>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>