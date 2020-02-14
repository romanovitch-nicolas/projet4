<?php ob_start(); ?>
<h1>Gérer les commentaires</h1>

<?php
$commentExist = $comments->rowCount();
if($commentExist) {
?>

<section id="admincomments">
	<table>
		<tr>
			<th>Date et heure</th>
			<th>Chapitre</th>
			<th>Auteur</th>
			<th>Commentaire</th>
			<th>Action</th>
		</tr>
		<?php
		while ($data = $comments->fetch())
		{
		?>
			<tr>
				<td class="date">
					<?php if($data['report'] == 1) { echo '<i class="fas fa-exclamation-circle" title="Commentaire signalé"></i>'; } ?>
					<?= $data['comment_date_fr'] ?>
					</td>
				<td><a class="bold" href="index.php?action=post&amp;id=<?= $data['tableposts_id'] ?>"><?= $data['tableposts_title'] ?></a></td>
				<td><?= htmlspecialchars_decode($data['author']) ?></td>
				<td><?= nl2br(htmlspecialchars($data['comment'])) ?></td>
				<td><?php if($data['report'] == 1) { ?>
						<a href="index.php?action=deleteCommentReport&amp;id=<?= $data['id'] ?>" title="Approuver"><i class="fas fa-check"></i></a>
					<?php } ?>
					<a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" title="Supprimer" onclick="if(confirm('Supprimer définitivement ?')){return true;}else{return false;}"><i class="fas fa-trash"></i></a>
				</td>
			</tr>
		<?php
		}
		$comments->closeCursor();
		?>
	</table>
</section>

<?php
} else {
?>
	<p><em>Pas de commentaires.</em></p>
<?php 
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?> 