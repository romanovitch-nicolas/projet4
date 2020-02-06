<?php ob_start(); ?>
<h1>Gérer les articles</h1>

<p>Derniers articles :</p>

<table>
	<tr>
		<th>Date</th>
		<th>Image</th>
		<th>Article</th>
		<th>Extrait</th>
		<th>Action</th>
	</tr>
	<?php
	while ($data = $posts->fetch())
	{
	?>
		<tr>
			<td><?= $data['creation_date_fr'] ?></td>
			<td><img src="public/images/<?= $data['image_url'] ?>" /></td>
			<td><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= $data['title'] ?></a></td>
			<td><?php 
		        $postDescription = nl2br(strip_tags(htmlspecialchars_decode($data['content'])));
		        echo substr($postDescription, 0, 100) . '...';
	        	?></td>
			<td>
			<a href="index.php?action=adminEditPost&amp;id=<?= $data['id'] ?>">Modifier</a> / <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>">Supprimer</a> / 
			<?php if($data['online'] == 0) { ?>
				<a href="index.php?action=onlinePost&amp;id=<?= $data['id'] ?>">Rendre visible</a>
			<?php } else { ?>
				<a href="index.php?action=offlinePost&amp;id=<?= $data['id'] ?>">Rendre invisible</a>
			<?php } ?>
			</td>
		</tr>
	<?php
	}
	$posts->closeCursor();
	?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?> 