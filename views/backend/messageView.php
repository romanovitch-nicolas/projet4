<?php $title = "Message privé" ?>

<?php ob_start(); ?>        
<h1>Messagerie</h1>

<a class="button" href="index.php?action=adminMessages">Retour à la liste des messages</a>
<a class="button" href="index.php?action=deleteMessage&amp;id=<?= $message['id'] ?>" onclick="if(confirm('Supprimer définitivement ?')){return true;}else{return false;}">Supprimer le message</a>

<section id="message">
	<h3><?= $message['subject'] ?></h3>
	<p class="date"><?= $message['name'] . ' <em>(' . $message['mail'] . ')</em>' ?></p>
	<p class="date"><?= $message['message_date_fr'] ?></p><br />
	<p><?= nl2br($message['content']) ?></p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>