<?php $title = "Contact" ?>

<?php ob_start(); ?>
<div class="title"><h1>Contact</h1></div>

<?php if (isset($return) && $return === true) { echo '<p class="return"><i class="fas fa-check"></i> Votre message a bien été envoyé.</p>'; } ?>
<section id="contact">
	<?php if (isset($return) && $return !== true) { echo '<p class="return red"><i class="fas fa-exclamation-circle"></i> ' . $return . '</p>'; } ?>
	<form <?php if (isset($return) && $return === true) { echo 'class="invisible"'; } ?> method="POST" action="index.php?action=sendMessage">
		<table>
			<tr>
				<td><label for="messageName">Nom, Prénom</label></td>
				<td><input type="text" name="messageName" value ="<?php if (isset($_POST['messageName'])) { echo $_POST['messageName']; } ?>" required /></td>
			</tr>
			<tr>
				<td><label for="messageMail">Email</label></td>
				<td><input type="email" name="messageMail" value ="<?php if (isset($_POST['messageMail'])) { echo $_POST['messageMail']; } ?>" required /></td>
			</tr>
			<tr>
				<td><label for="messageSubject">Objet</label></td>
				<td><input type="text" name="messageSubject" value ="<?php if (isset($_POST['messageSubject'])) { echo $_POST['messageSubject']; } ?>" required /></td>
			</tr>
			<tr>
				<td><label for="messageContent">Message</label></td>
				<td><textarea name="messageContent" required><?php if (isset($_POST['messageContent'])) { echo $_POST['messageContent']; } ?></textarea></td>
			</tr>
		</table>
		<input type="submit" class="button" name="sendMessage" value="Envoyer" />
	</form>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>