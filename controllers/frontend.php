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

        $affectedLines = $commentManager->insertComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }

    public function reportComment($commentId, $postId)
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();
        $affectedLines = $commentManager->setReporting($commentId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de signaler le commentaire !');
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
        $affectedMessage = $messageManager->insertMessage($messageName, $messageMail, $messageSubject, $messageContent);

        if ($affectedMessage === false) {
            throw new Exception('Impossible d\'envoyer le message !');
        }
        else {
            echo 'Votre message à bien été envoyé.';
        }
    }
}