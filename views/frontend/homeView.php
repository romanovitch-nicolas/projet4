<?php ob_start(); ?>
<h1>Accueil</h1>

<h2>Synopsis</h2>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius vestibulum urna ac accumsan. Curabitur viverra velit quis nunc porttitor, lacinia elementum orci hendrerit. Fusce posuere malesuada enim, et sagittis orci molestie in. Cras eleifend non sapien eu dignissim. Duis cursus erat quis dolor semper ultrices. Phasellus hendrerit ligula interdum, lacinia diam vitae, aliquam tellus. Fusce ullamcorper pretium neque, ac dignissim neque tempor at. Sed faucibus, augue ac tincidunt fermentum, tortor nisl lobortis risus, id posuere nisi velit a lorem. Nam quis nibh congue, consectetur nunc vitae, fermentum lectus. Donec malesuada ante augue, et elementum tellus fermentum vitae. Sed accumsan, purus at ultrices ullamcorper, lorem sapien luctus diam, finibus eleifend felis orci at eros. Curabitur sed ante erat. Proin sed augue nunc. Donec vitae nisi eget lacus commodo scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

<p>Aenean varius augue ut leo porttitor, a ultrices erat tincidunt. In varius fringilla est non eleifend. Nulla facilisi. Aenean et tortor sit amet ipsum tincidunt bibendum non ac libero. Phasellus faucibus ut tellus pharetra dignissim. Sed accumsan pellentesque arcu, vitae semper tortor ultricies in. Nunc interdum tortor et urna placerat, a ultricies est fermentum. Pellentesque ac venenatis neque, vitae tristique purus. Phasellus egestas nisi in tincidunt malesuada. Aliquam nec sodales sem. Vestibulum condimentum tortor ut sapien placerat aliquet. Morbi vitae facilisis nunc. Etiam lectus libero, elementum eu metus vitae, maximus rutrum massa. Suspendisse vitae est ut nulla condimentum auctor. Vestibulum laoreet, velit a tristique volutpat, erat lorem tempus metus, ac pharetra augue urna ac quam.</p>

<h2>A propos de l'auteur</h2>

<p>Pellentesque viverra arcu nunc, vel consequat nibh convallis et. Aliquam dapibus dolor eget sapien consequat facilisis ut at odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean sagittis fringilla arcu, sit amet ullamcorper enim vehicula quis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas velit arcu, commodo vel lorem non, faucibus facilisis est. Curabitur iaculis erat nec turpis accumsan bibendum efficitur vitae risus. Curabitur sed risus dolor. Aenean dolor nibh, ornare et odio auctor, euismod ultricies erat. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

<p>Pellentesque elit felis, interdum non fringilla in, dictum quis dolor. Aenean mauris elit, molestie euismod tempor at, tempor laoreet elit. Sed vel facilisis felis. Aenean laoreet vehicula tortor in aliquet. Maecenas sed diam dictum, eleifend eros sit amet, dignissim metus. Nam cursus quam ac mauris dignissim faucibus. Nam scelerisque placerat ultrices. Cras rutrum in elit mattis bibendum.</p>

<h2>Dernier chapitre :</h2>

<div>
    <h3>
        <?= htmlspecialchars_decode($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    <?php if (!empty($post['image_name'])) { ?>
        <img src="public/images/<?= $post['image_name'] ?>" />
    <?php } ?>
    <p>
        <?php 
        $postDescription = nl2br(strip_tags(htmlspecialchars_decode($post['content'])));
        echo substr($postDescription, 0, 200) . '...';
        ?>
    </p>
    <p><em><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Lire la suite</a></em></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>