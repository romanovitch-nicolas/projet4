<?php ob_start(); ?>
<h1>Gérer les commentaires</h1>
<p>Commentaires signalés :</p>

<table>
	<tr>
		<th>Date et heure</th>
		<th>Article</th>
		<th>Auteur</th>
		<th>Commentaire</th>
		<th>Action</th>
	</tr>
	<?php
	while ($data = $reportedComments->fetch())
	{
	?>
		<tr>
			<td><?= $data['comment_date_fr'] ?></td>
			<td><?= $data['tableposts_title'] ?></td>
			<td><?= htmlspecialchars_decode($data['author']) ?></td>
			<td><?= nl2br(htmlspecialchars($data['comment'])) ?></td>
			<td><a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>">Supprimer</a></td>
		</tr>
	<?php
	}
	$reportedComments->closeCursor();
	?>
</table>

<br />
<br />
<br />
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
			<td><?= $data['tableposts_title'] ?></td>
			<td><?= htmlspecialchars_decode($data['author']) ?></td>
			<td><?= nl2br(htmlspecialchars($data['comment'])) ?></td>
			<td><a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>">Supprimer</a></td>
		</tr>
	<?php
	}
	$comments->closeCursor();
	?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?> 