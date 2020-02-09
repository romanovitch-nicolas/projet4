<?php ob_start(); ?>
<h1>Messagerie</h1>

<?php
$messageExist = $messages->rowCount();
if($messageExist) {
?>
<p>Derniers messages :</p>

<table>
	<tr>
		<th>Date et heure</th>
		<th>Nom</th>
		<th>Email</th>
		<th>Sujet</th>
		<th>Action</th>
	</tr>
	<?php
	while ($data = $messages->fetch())
	{
	?>
		<tr <?php if($data['message_read'] == 0) { echo 'class="bold"'; } ?>>
			<td><?= $data['message_date_fr'] ?></td>
			<td><?= $data['name'] ?></td>
			<td><?= $data['mail'] ?></td>
			<td><a href="index.php?action=message&amp;id=<?= $data['id'] ?>"><?= $data['subject'] ?></a></td>
			<td><a href="index.php?action=deleteMessage&amp;id=<?= $data['id'] ?>">Supprimer</a></td>
		</tr>
	<?php
	}
	$messages->closeCursor();
	?>
</table>
<?php

} else {
?>
<p><em>Pas de messages.</em></p>
<?php 
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?> 