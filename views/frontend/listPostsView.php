<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p>Derniers chapitres publiés :</p>

<?php
while ($data = $posts->fetch())
{
?>
<div>
    <h3>
        <?= htmlspecialchars_decode($data['title']) ?>
        <em>le <?= $data['creation_date_fr'] ?></em>
    </h3>
        
    <p>
        <?php 
        $postDescription = nl2br(strip_tags(htmlspecialchars_decode($data['content'])));
        echo substr($postDescription, 0, 200) . '...';
        ?>
    </p>
    <p><em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Voir le chapitre</a></em></p>
</div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>