<?php ob_start(); ?>        
<h1>Billet simple pour l'Alaska</h1>
<a href="index.php?action=listPosts">Retour à la liste des chapitres</a>
<?php if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) { ?>
    <a href="index.php?action=adminEditPost&amp;id=<?= $post['id'] ?>">Modifier l'article</a>
<?php } ?>

<div>
    <h3>
        <?= htmlspecialchars_decode($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    <?php if (!empty($post['image_name'])) { ?>
        <img src="public/images/<?= $post['image_name'] ?>" />
    <?php } ?>
    <p>
        <?= nl2br(htmlspecialchars_decode($post['content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> (<a href="index.php?action=reportComment&amp;comment_id=<?= $comment['id'] ?>&amp;post_id=<?= $comment['post_id'] ?>">Signaler</a>)</p>
    <?php if($comment['report'] == 0) { ?> 
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <?php }
    else {
        echo '<p><em>Ce commentaire a été signalé</em></p>'; }
}
$comments->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>