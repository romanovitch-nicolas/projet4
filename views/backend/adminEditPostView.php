<?php $title = "Modifier un chapitre" ?>

<?php ob_start(); ?>
<h1>Modifier un chapitre</h1>

<a class="button" href="index.php?action=listPosts">Retour à la liste des chapitres</a>
<a class="button" href="index.php?action=deletePost&amp;id=<?= $post['id'] ?>" onclick="if(confirm('Supprimer définitivement ?')){return true;}else{return false;}">Supprimer le chapitre</a>

<section id="editpost">
	<form method='post' action="index.php?action=editPost&amp;id=<?= $post['id'] ?>" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="postTitle">Titre</label></td>
				<td><input type="text" name="postTitle" value="<?= htmlspecialchars_decode($post['title']) ?>" /></td>
			</tr>
			<tr>
				<td><label for="postContent">Message</label></td>
				<td><textarea name="postContent" id="post"><?= htmlspecialchars_decode($post['content']) ?></textarea></td>
			</tr>
			<tr>
				<td><label>Image actuelle</label></td>
				<td><?php if (!empty($post['image_name'])) { ?>
						<img src="public/images/<?= $post['image_name'] ?>" />
					<?php } else { echo '<p class="date">Pas d\'image.</p>'; } ?></td>
			</tr>
			<tr>
				<td></td>
				<td><a id="editimagebutton" class="button" href="#"><?php if (!empty($post['image_name'])) {echo 'Modifier l\'image';} else {echo 'Ajouter une image' ;} ?></a>
					<?php if (!empty($post['image_name'])) { ?>
						<a class="button" href="index.php?action=deleteImage&amp;id=<?= $post['id'] ?>" onclick="if(confirm('Supprimer définitivement ?')){return true;}else{return false;}">Supprimer l'image</a>
					<?php } ?>
					<br />
					<input id="editimageinput" class="invisible" type="file" name="editImage" /></td>
			</tr>
		</table>
		
		<input type="submit" class="button" name="savePost" value="Enregistrer" />
	</form>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>