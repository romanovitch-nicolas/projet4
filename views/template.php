<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog de Jean Forteroche</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
        <script src="https://cdn.tiny.cloud/1/cwe4o8zjsewx7soze93j3wl2ihp0pb8l09n9fqjy3czfgbu9/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
        <script>
            tinymce.init({
            selector: '#post',
            statusbar: false,
            toolbar: 'undo redo | copy cut paste | fontselect | fontsizeselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | superscript subscript',
            menubar: ''
        });
        </script>
    </head>
       
    <header>
        <nav>
            <ul>
            	<li><a href="index.php">Accueil</a></li>
            	<li><a href="index.php?action=listPosts">Liste des chapitres</a></li>
            	<li><a href="index.php?action=contact">Contact</a></li>
                <?php if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) { ?>
                    <li class="dropmenu"><a href="#">Espace Administrateur ▼</a>
                        <ul class="submenu">
                            <li><a href="index.php?action=adminNewPost">Écrire un article</a></li>
                            <li><a href="index.php?action=adminPosts">Gérer les articles</a></li>
                            <li><a href="index.php?action=adminComments">Gérer les commentaires</a></li>
                            <li><a href="index.php?action=adminMessages">Messagerie</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php?action=disconnect">Déconnexion</a></li>
            	<?php } else { ?>
                    <li><a href="index.php?action=connexion">Connexion</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <body>
        <?= $content ?>
    </body>
</html>