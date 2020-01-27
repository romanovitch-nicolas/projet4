<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog de Jean Forteroche</title>
        <link href="style.css" rel="stylesheet" /> 
        <script src="https://cdn.tiny.cloud/1/cwe4o8zjsewx7soze93j3wl2ihp0pb8l09n9fqjy3czfgbu9/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
        <script>
            tinymce.init({
            selector: '#post'
        });
  </script>
    </head>
       
    <header>
    	<a href="index.php">Accueil</a>
    	<a href="index.php?action=listPosts">Liste des chapitres</a>
    	<a href="index.php?action=contact">Contact</a>
        <?php if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) { ?>
            <a href="index.php?action=deconnexion">Déconnexion</a><br />
            <a href="index.php?action=adminNewPost">Écrire un article</a>
            <a href="index.php?action=adminComments">Gérer les commentaires</a>
    	<?php } else { ?>
            <a href="index.php?action=connexion">Connexion</a>
        <?php } ?>
    </header>

    <body>
        <?= $content ?>
    </body>
</html>