<?php ob_start(); ?>
<h1>Contact</h1>
	<br />
	<form method="POST" action="">
		<table>
			<tr>
				<td><label for="name">Nom</label></td>
				<td><input type="text" name="name" /></td>
			</tr>
			<tr>
				<td><label for="mail">Email</label></td>
				<td><input type="email" name="mail" /></td>
			</tr>
			<tr>
				<td><label for="subject">Sujet</label></td>
				<td><input type="text" name="subject" /></td>
			</tr>
			<tr>
				<td><label for="message">Message</label></td>
				<td><textarea name="message"></textarea></td>
			</tr>
		</table>
		<br />
		<input type="submit" name="send" value="Envoyer" />
	</form>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>