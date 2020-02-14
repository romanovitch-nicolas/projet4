<?php ob_start(); ?>

<section id="welcome">
    <img src="public/images/home.jpg" />
    <div class="homedescription">
        <p>Bienvenue sur mon blog !</p>
        <p>Venez découvrir mon dernier livre "<strong>Billet simple pour l'Alaska</strong>"</p><br />
        <a id="downbutton" class="button" href="#synopsis">Découvrir le livre</a><a class="button" href="index.php?action=listPosts">Lire le livre</a>
    </div>
</section>

<section id="synopsis">
<h2>Synopsis</h2>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius vestibulum urna ac accumsan. Curabitur viverra velit quis nunc porttitor, lacinia elementum orci hendrerit. Fusce posuere malesuada enim, et sagittis orci molestie in. Cras eleifend non sapien eu dignissim. Duis cursus erat quis dolor semper ultrices. Phasellus hendrerit ligula interdum, lacinia diam vitae, aliquam tellus. Fusce ullamcorper pretium neque, ac dignissim neque tempor at. Sed faucibus, augue ac tincidunt fermentum, tortor nisl lobortis risus, id posuere nisi velit a lorem. Nam quis nibh congue, consectetur nunc vitae, fermentum lectus. Donec malesuada ante augue, et elementum tellus fermentum vitae. Sed accumsan, purus at ultrices ullamcorper, lorem sapien luctus diam, finibus eleifend felis orci at eros. Curabitur sed ante erat. Proin sed augue nunc. Donec vitae nisi eget lacus commodo scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
</section>

<div class="column">
    <section id="author">
    <h2>A propos de l'auteur</h2>
    <img src="public/images/author.jpg" />

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius vestibulum urna ac accumsan. Curabitur viverra velit quis nunc porttitor, lacinia elementum orci hendrerit. Fusce posuere malesuada enim, et sagittis orci molestie in. Cras eleifend non sapien eu dignissim. Duis cursus erat quis dolor semper ultrices. Phasellus hendrerit ligula interdum, lacinia diam vitae, aliquam tellus.</p>
    <p>Fusce ullamcorper pretium neque, ac dignissim neque tempor at. Sed faucibus, augue ac tincidunt fermentum, tortor nisl lobortis risus, id posuere nisi velit a lorem. Nam quis nibh congue, consectetur nunc vitae, fermentum lectus. Donec malesuada ante augue, et elementum tellus fermentum vitae. Sed accumsan, purus at ultrices ullamcorper, lorem sapien luctus diam, finibus eleifend felis orci at eros. Curabitur sed ante erat. Proin sed augue nunc. Donec vitae nisi eget lacus commodo scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </section>

    <section id="lastpost">
        <h2>Dernière publication</h2>

        <?php if(!empty($post)) { ?>
            
        <div class="lastpost">
            <?php if (!empty($post['image_name'])) { ?>
                <img src="public/images/<?= $post['image_name'] ?>" />
            <?php } ?>

            <h3>
                <?= htmlspecialchars_decode($post['title']) ?>
            </h3>
            <p><?php 
                $postDescription = nl2br(strip_tags(htmlspecialchars_decode($post['content'])));
                echo substr($postDescription, 0, 170) . '...';
                ?></p>
            <br />
            <div>
                <p><a class="button" href="index.php?action=post&amp;id=<?= $post['id'] ?>">Lire la suite</a></p>
                <p><em>le <?= $post['creation_date_fr'] ?></em></p>
            </div>
        </div>

        <?php } else { ?>
            <p><em>Pas de publication.</em></p>
        <?php } ?>
</section>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>