<?php ob_start(); ?>
<h1>Connexion</h1>
	<br />
	<form method="POST" action="">
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
				<td><label for="autoconnect">Connexion automatique</label></td>
				<td><input type="checkbox" name="autoconnect" /></td>
			</tr>
		</table>
		<br />
		<input type="submit" name="connexion" value="Se connecter" />
	</form>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>