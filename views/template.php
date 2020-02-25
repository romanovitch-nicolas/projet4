<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="icon" href="public/images/favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Courier+Prime&display=swap" rel="stylesheet">
        <link href="public/css/style.css" rel="stylesheet" /> 
        <title><?= $title . " - Billet simple pour l'Alaska" ?></title>
        <meta name="description" content="« Billet simple pour l'Alaska », le dernier livre de Jean Forteroche, est disponible en ligne gratuitement et en intégralité. Venez le découvrir !" />
        <meta property="og:title" content="Jean Forteroche - Billet simple pour l'Alaska" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="www.projet4.n-romano.fr" />
        <meta property="og:image" content="https://nsm09.casimages.com/img/2020/02/14//20021405550325240716645995.jpg" />
        <meta property="og:description" content="« Billet simple pour l'Alaska », le dernier livre de Jean Forteroche, est disponible en ligne gratuitement et en intégralité. Venez le découvrir !" />
    </head>
       
    <header>
        <p class="logo"><a href="accueil">Jean <strong>Forteroche</strong></a></p>
        <nav>
            <ul><div>
            	<li><a href="accueil"><i class="fas fa-home"></i> Accueil</a></li>
            	<li><a href="blog">Liste des chapitres</a></li>
            	<li><a href="contact">Contact</a></li></div>
                <?php if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) { ?>
                    <div><li class="dropmenu"><span>Espace Administrateur ▼</span>
                        <ul class="submenu invisible">
                            <li><a href="gestion-des-chapitres">Gérer les chapitres</a></li>
                            <li><a href="gestion-des-commentaires">Gérer les commentaires</a></li>
                            <li><a href="messagerie">Messagerie</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php?action=disconnect">Déconnexion <i class="fas fa-sign-out-alt"></i></a></li>
            	<?php } else { ?>
                    <li><a href="connexion">Connexion <i class="fas fa-sign-in-alt"></i></a></li></div>
                <?php } ?>
            </ul>
        </nav>
        <i id="burger" class="fas fa-bars fa-2x"></i>
    </header>

    <body>
        <?= $content ?>        
    </body>

    <footer>
        <p>Billet simple pour l'Alaska | Mentions légales</p>
        <p><i class="fab fa-2x fa-facebook-square"></i><i class="fab fa-2x fa-twitter-square"></i><i class="fab fa-2x fa-instagram-square"></i></p>
    </footer>

    <script src="https://kit.fontawesome.com/45b095f08c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/cwe4o8zjsewx7soze93j3wl2ihp0pb8l09n9fqjy3czfgbu9/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
    <script src="public/js/app.js"></script>
</html>