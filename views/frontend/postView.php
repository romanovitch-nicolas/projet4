<?php $title = htmlspecialchars_decode($post['title']) ?>

<?php ob_start(); ?>        
<h1><?= $post['title'] ?></h1>

<section id="postcontent">
    <div><a class="button" href="blog">Retour à la liste des chapitres</a>
    <?php if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) { ?>
        <a class="button" href="modifier-un-chapitre-<?= $post['id'] ?>">Modifier le chapitre</a>
    <?php } ?>
    </div>

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

    <a id="newcommentbutton" class="button" href="#">Ajouter un commentaire</a>
    <div class="<?php if (!isset($return)) { echo "invisible"; } ?>">
        <?php if (isset($return)) { echo '<p class="return red"><i class="fas fa-exclamation-circle"></i> ' . $return . '</p>'; } ?>
        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <label for="form_commentauthor">Nom, Prénom</label><br />
                <input type="text" id="form_commentauthor" name="author" value ="<?php if (isset($_POST['author'])) { echo $_POST['author']; } ?>" required />
            </div>
            <div>
                <label for="form_commentcontent">Commentaire</label><br />
                <textarea id="form_commentcontent" name="comment" required><?php if (isset($_POST['comment'])) { echo $_POST['comment']; } ?></textarea>
            </div>
            <div>
                <input type="submit" class="button" name="addComment" value="Envoyer" />
            </div>
        </form>
    </div>

    <?php
    $commentExist = $comments->rowCount();
    if($commentExist) {
    ?>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
        <div id="comment">
        <p><strong><?= $comment['author'] ?></strong><span class="date"> le <?= $comment['comment_date_fr'] ?><a href="index.php?action=reportComment&amp;comment_id=<?= $comment['id'] ?>&amp;post_id=<?= $comment['post_id'] ?>" title="Signaler ce commentaire" onclick="if(confirm('Signaler ce commentaire ?')){return true;}else{return false;}"><i class="fas fa-exclamation-circle"></i></a></span>
        </p>
        <?php if($comment['report'] == 0) { ?> 
            <p><?= nl2br($comment['comment']) ?></p></div>
        <?php }
        else {
            echo '<p><em>Ce commentaire a été signalé</em></p></div>'; }
    }
    $comments->closeCursor();
    ?>

    <?php
    } else { echo '<p><em>Soyez le premier à poster un commentaire sur ce chapitre !</em></p>'; }
    ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>