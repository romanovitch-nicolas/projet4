<?php $title = htmlspecialchars_decode($post['title']) ?>

<?php ob_start(); ?>        
<h1>Billet simple pour l'Alaska</h1>

<section id="postcontent">
    <a class="button" href="index.php?action=listPosts">Retour à la liste des chapitres</a>
    <?php if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) { ?>
        <a class="button" href="index.php?action=adminEditPost&amp;id=<?= $post['id'] ?>">Modifier le chapitre</a>
    <?php } ?>

    <?php if (!empty($post['image_name'])) { ?>
        <div>
            <img src="public/images/<?= $post['image_name'] ?>" />
        </div>
    <?php } ?>
    <h3>
        <?= htmlspecialchars_decode($post['title']) ?>
        <span class="date">le <?= $post['creation_date_fr'] ?></span>
    </h3>
    <p>
        <?= nl2br(htmlspecialchars_decode($post['content'])) ?>
    </p>
</section>

<section id="postcomments">
    <h2>Commentaires</h2>

    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="form_commentauthor">Nom, Prénom</label><br />
            <input type="text" id="form_commentauthor" name="author" />
        </div>
        <div>
            <label for="form_commentcontent">Commentaire</label><br />
            <textarea id="form_commentcontent" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" class="button" name="addComment" value="Envoyer" />
        </div>
    </form>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
        <div id="comment">
        <p><strong><?= $comment['author'] ?></strong><span class="date"> le <?= $comment['comment_date_fr'] ?></span>
        <a href="index.php?action=reportComment&amp;comment_id=<?= $comment['id'] ?>&amp;post_id=<?= $comment['post_id'] ?>" title="Signaler ce commentaire"><i class="fas fa-exclamation-circle"></i></a></p>
        <?php if($comment['report'] == 0) { ?> 
            <p><?= nl2br($comment['comment']) ?></p></div>
        <?php }
        else {
            echo '<p><em>Ce commentaire a été signalé</em></p></div>'; }
    }
    $comments->closeCursor();
    ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>