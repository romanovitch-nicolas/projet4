<?php $title = "Contact" ?>

<?php ob_start(); ?>
<h1>Contact</h1>

<section id="contact">
	<form method="POST" action="index.php?action=sendMessage">
		<table>
			<tr>
				<td><label for="messageName">Nom, Prénom</label></td>
				<td><input type="text" name="messageName" /></td>
			</tr>
			<tr>
				<td><label for="messageMail">Email</label></td>
				<td><input type="email" name="messageMail" /></td>
			</tr>
			<tr>
				<td><label for="messageSubject">Sujet</label></td>
				<td><input type="text" name="messageSubject" /></td>
			</tr>
			<tr>
				<td><label for="messageContent">Message</label></td>
				<td><textarea name="messageContent"></textarea></td>
			</tr>
		</table>
		<input type="submit" class="button" name="sendMessage" value="Envoyer" />
	</form>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>