<?php ob_start(); ?>
<h1>Gérer les commentaires</h1>

<p>Derniers commentaires :</p>

<table>
	<tr>
		<th>Date et heure</th>
		<th>Article</th>
		<th>Auteur</th>
		<th>Commentaire</th>
		<th>Action</th>
	</tr>
	<?php
	while ($data = $comments->fetch())
	{
	?>
		<tr>
			<td><?= $data['comment_date_fr'] ?></td>
			<td><a href="index.php?action=post&amp;id=<?= $data['tableposts_id'] ?>"><?= $data['tableposts_title'] ?></a></td>
			<td><?= htmlspecialchars_decode($data['author']) ?></td>
			<td><?= nl2br(htmlspecialchars($data['comment'])) ?></td>
			<td><?php if($data['report'] == 1) { ?>
					<a href="index.php?action=deleteCommentReport&amp;id=<?= $data['id'] ?>">Approuver</a> /
				<?php } ?>
				<a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>">Supprimer</a>
			</td>
		</tr>
	<?php
	}
	$comments->closeCursor();
	?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?> 