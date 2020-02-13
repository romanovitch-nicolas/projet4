<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog de Jean Forteroche</title>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Courier+Prime&display=swap" rel="stylesheet">
        <link href="public/css/style.css" rel="stylesheet" /> 
        <script src="https://kit.fontawesome.com/45b095f08c.js" crossorigin="anonymous"></script>
        <script src="https://cdn.tiny.cloud/1/cwe4o8zjsewx7soze93j3wl2ihp0pb8l09n9fqjy3czfgbu9/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
        <script>
            tinymce.init({
            force_br_newlines : true,
            force_p_newlines : false,
            forced_root_block : '',
            content_css: ['https://fonts.googleapis.com/css?family=Indie+Flower&display=swap',
             'https://fonts.googleapis.com/css?family=Courier+Prime&display=swap',
             'public/css/style.css'],
            selector: '#post',
            statusbar: false,
            toolbar: 'undo redo | copy cut paste | fontselect | fontsizeselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | superscript subscript',
            menubar: '',
            font_formats: "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier Prime=Courier Prime, courier new, courier;" + "Georgia=georgia,palatino;" +  "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Indie Flower=Indie Flower, cursive;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;"
            });
        </script>
    </head>
       
    <header>
        <p class="logo"><a href="index.php">Jean <strong>Forteroche</strong></a></p>
        <nav>
            <ul><div>
            	<li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
            	<li><a href="index.php?action=listPosts">Liste des chapitres</a></li>
            	<li><a href="index.php?action=contact">Contact</a></li></div>
                <?php if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) { ?>
                    <div><li class="dropmenu"><a href="#">Espace Administrateur ▼</a>
                        <ul class="submenu">
                            <li><a href="index.php?action=adminNewPost">Écrire un chapitre</a></li>
                            <li><a href="index.php?action=adminPosts">Gérer les chapitres</a></li>
                            <li><a href="index.php?action=adminComments">Gérer les commentaires</a></li>
                            <li><a href="index.php?action=adminMessages">Messagerie</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php?action=disconnect">Déconnexion <i class="fas fa-sign-out-alt"></i></a></li>
            	<?php } else { ?>
                    <li><a href="index.php?action=connexion">Connexion <i class="fas fa-sign-in-alt"></i></a></li></div>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <body>
        <?= $content ?>
    </body>

    <footer>
        <p>Blog de Jean Forteroche | Mentions légales</p>
        <p><i class="fab fa-2x fa-facebook-square"></i><i class="fab fa-2x fa-twitter-square"></i><i class="fab fa-2x fa-instagram-square"></i></p>
    </footer>
</html>