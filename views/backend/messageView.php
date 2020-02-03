<?php ob_start(); ?>        
<h1>Messagerie</h1>
<a href="index.php?action=adminMessages">Retour à la liste des messages</a>
<a href="index.php?action=deleteMessage&amp;id=<?= $message['id'] ?>">Supprimer le message</a>

<div>
    <h3><?= $message['subject'] ?></h3>
    <p><?= 'De : ' . $message['name'] . ' <em>(' . $message['mail'] . ')</em>' ?></p>
    <p><?= $message['message_date_fr'] ?></p>
    <p><?= nl2br($message['content']) ?></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>