<?php ob_start(); ?>
<h1>Messagerie</h1>

<?php
$messageExist = $messages->rowCount();
if($messageExist) {
?>

<section id="adminmessages">
	<table>
		<tr>
			<th>Date et heure</th>
			<th>Objet</th>
			<th>Auteur</th>
			<th>Email</th>
			<th>Action</th>
		</tr>
		<?php
		while ($data = $messages->fetch())
		{
		?>
			<tr>
				<td>
					<?php if($data['message_read'] == 0) { echo '<i class="fas fa-exclamation-circle" title="Message non lu"></i>'; } ?>
					<?= $data['message_date_fr'] ?></td>
				<td><a class="bold" href="index.php?action=message&amp;id=<?= $data['id'] ?>"><?= $data['subject'] ?></a></td>
				<td><?= $data['name'] ?></td>
				<td><?= $data['mail'] ?></td>
				<td><a href="index.php?action=deleteMessage&amp;id=<?= $data['id'] ?>" title="Supprimer" onclick="if(confirm('Supprimer définitivement ?')){return true;}else{return false;}"><i class="fas fa-trash"></i></a></td>
			</tr>
		<?php
		}
		$messages->closeCursor();
		?>
	</table>
</section>

<?php
} else {
?>
	<p><em>Pas de messages.</em></p>
<?php 
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?> 