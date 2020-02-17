<?php $title = "Liste des chapitres" ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>

<?php
$postExist = $posts->rowCount();
if($postExist) {
?>

<section id="listposts">
<?php
    while ($data = $posts->fetch())
    {
    ?>
        <div>
            <h3>
                <?= htmlspecialchars_decode($data['title']) ?><br />
                <span class="date">le <?= $data['creation_date_fr'] ?></span>
            </h3>
                
            <p>
                <?php 
                $postDescription = nl2br(strip_tags(htmlspecialchars_decode($data['content'])));
                echo substr($postDescription, 0, 500) . '...';
                ?>
            </p>
            <p><a class="button" href="index.php?action=post&amp;id=<?= $data['id'] ?>">Voir le chapitre</a></p>
        </div>
    <?php
    }
    $posts->closeCursor();
    ?>
</section>

<?php
} else {
?>
    <p><em>Pas de chapitre disponible.</em></p>
<?php 
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>