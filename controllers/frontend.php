<?php
namespace Nicolas\Projet4\Controllers;
require_once('models/CommentManager.php');
require_once('models/MessageManager.php');
require_once('models/PostManager.php');

class FrontendController
{
    public function home()
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $post = $postManager->getLastPost();

        require('views/frontend/homeView.php');
    }

    public function listPosts()
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $posts = $postManager->getOnlinePosts();

        require('views/frontend/listPostsView.php');
    }

    public function post()
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        require('views/frontend/postView.php');
    }

    public function addComment($postId, $author, $comment)
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();

        $author = htmlspecialchars($author);
        $comment = htmlspecialchars($comment);
        $insertComment = $commentManager->insertComment($postId, $author, $comment);

        if ($insertComment === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }

    public function reportComment($commentId, $postId)
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();
        $report = $commentManager->setReporting($commentId);

        if ($report === false) {
            throw new \Exception('Impossible de signaler le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }

    public function addMessage($messageName, $messageMail, $messageSubject, $messageContent)
    {
        $messageManager = new \Nicolas\Projet4\Models\MessageManager();

        $messageName = htmlspecialchars($messageName);
        $messageMail = htmlspecialchars($messageMail);
        $messageSubject = htmlspecialchars($messageSubject);
        $messageContent = htmlspecialchars($messageContent);   
        $insertMessage = $messageManager->insertMessage($messageName, $messageMail, $messageSubject, $messageContent);

        $header="MIME-Version: 1.0\r\n";
        $header.='From:"Blog de Jean Forteroche"<noreply@n-romano.fr>'."\n";
        $header.='Content-Type: text/html; charset="utf-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
        $message='
        <html>
            <body>
                <p>Vous avez reçu un nouveau message sur <a href="http://localhost/projet4/index.php">votre blog</a> !</p>
                <br />
                <p>De : ' . $messageName . ' <em>(' . $messageMail . ')</em></p>
                <p>Sujet : ' . $messageSubject . '</p>
                <p>' . $messageContent . '</p>
                <br />
                <p><em>Ceci est un mail automatique, merci de ne pas répondre.</em></p>
            </body>
        </html>
        ';
        mail("nromanovitch@gmail.com", "Nouveau message !", $message, $header);

        if ($insertMessage === false) {
            throw new \Exception('Impossible d\'envoyer le message !');
        }
        else {
            echo 'Votre message à bien été envoyé.';
        }
    }
}