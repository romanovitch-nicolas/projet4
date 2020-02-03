<?php ob_start(); ?>
<h1>Messagerie</h1>
<p>Derniers messages :</p>

<table>
	<tr>
		<th>Date</th>
		<th>Nom</th>
		<th>Email</th>
		<th>Sujet</th>
		<th>Extrait</th>
		<th>Action</th>
	</tr>
	<?php
	while ($data = $messages->fetch())
	{
	?>
		<tr>
			<td><?= $data['message_date_fr'] ?></td>
			<td><?= $data['name'] ?></td>
			<td><?= $data['mail'] ?></td>
			<td><a href="index.php?action=message&amp;id=<?= $data['id'] ?>"><?= $data['subject'] ?></a></td>
			<td><?php 
		        $messageDescription = nl2br(strip_tags(htmlspecialchars_decode($data['content'])));
		        echo substr($messageDescription, 0, 100) . '...';
	        	?></td>
			<td><a href="index.php?action=deleteMessage&amp;id=<?= $data['id'] ?>">Supprimer</a></td>
		</tr>
	<?php
	}
	$messages->closeCursor();
	?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?> 