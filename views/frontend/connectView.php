<?php ob_start(); ?>
<h1>Connexion</h1>

<section id="connect">
	<form method="POST" action="index.php?action=connect">
		<table>
			<tr>
				<td><label for="login">Login</label></td>
				<td><input type="text" name="login" /></td>
			</tr>
			<tr>
				<td><label for="pass">Mot de passe</label></td>
				<td><input type="password" name="pass" /></td>
			</tr>
			<tr>
				<td><label for="autoconnect">Rester connecté</label></td>
				<td><input type="checkbox" name="autoconnect" /></td>
			</tr>
		</table>
		<br />
		<input type="submit" class="button" name="connexion" value="Se connecter" />
	</form>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>