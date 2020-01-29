<?php ob_start(); ?>
<h1>Gérer les articles</h1>
<p>Derniers articles :</p>

<table>
	<tr>
		<th>Date et heure</th>
		<th>Article</th>
		<th>Contenu</th>
		<th>Action</th>
	</tr>
	<?php
	while ($data = $posts->fetch())
	{
	?>
		<tr>
			<td><?= $data['creation_date_fr'] ?></td>
			<td><?= $data['title'] ?></td>
			<td><?php 
		        $postDescription = nl2br(strip_tags(htmlspecialchars_decode($data['content'])));
		        echo substr($postDescription, 0, 100) . '...';
	        	?></td>
			<td><a href="index.php?action=adminEditPost&amp;id=<?= $data['id'] ?>">Modifier</a> / <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>">Supprimer</a></td>
		</tr>
	<?php
	}
	$posts->closeCursor();
	?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?> 