<?php ob_start(); ?>
<h1>Accueil</h1>
<p>Bonjour à tous !</p>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>