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
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();

        $author = htmlspecialchars($author);
        $comment = htmlspecialchars($comment);

        if (!empty($author) && !empty($comment)) {
            $nameLength = strlen($author);
            if($nameLength <= 255) {
                $insertComment = $commentManager->insertComment($postId, $author, $comment);
                if ($insertComment === false) {
                    throw new \Exception('Impossible d\'ajouter le commentaire.');
                }
                else {
                    header('Location: modifier-un-chapitre-' . $postId);
                }
            }
            else {
                $return = "Votre nom ne doit pas dépasser 255 caractères.";
            }
        }
        else {
            $return = "Tous les champs ne sont pas remplis.";
        }
        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
        require("views/frontend/postView.php");
    }

    public function reportComment($commentId, $postId)
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();
        $report = $commentManager->setReporting($commentId);

        if ($report === false) {
            throw new \Exception('Impossible de signaler le commentaire.');
        }
        else {
            header('Location: modifier-un-chapitre-' . $postId);
        }
    }

    public function addMessage($messageName, $messageMail, $messageSubject, $messageContent)
    {
        $messageManager = new \Nicolas\Projet4\Models\MessageManager();

        $messageName = htmlspecialchars($messageName);
        $messageMail = htmlspecialchars($messageMail);
        $messageSubject = htmlspecialchars($messageSubject);
        $messageContent = htmlspecialchars($messageContent);

        if (!empty($messageName) && !empty($messageMail) && !empty($messageSubject) && !empty($messageContent)) {
            $nameLength = strlen($messageName);
            $mailLength = strlen($messageMail);
            $subjectLength = strlen($messageSubject);
            if($nameLength <= 255) {
                if($mailLength <= 255) {
                    if($subjectLength <= 255) {
                        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $messageMail)) {
                            $insertMessage = $messageManager->insertMessage($messageName, $messageMail, $messageSubject, $messageContent);
                            if ($insertMessage === false) {
                                throw new \Exception('Impossible d\'envoyer le message.');
                            }
                            else {
                                $header="MIME-Version: 1.0\r\n";
                                $header.='From:"Blog de Jean Forteroche"<noreply@n-romano.fr>'."\n";
                                $header.='Content-Type: text/html; charset="utf-8"'."\n";
                                $header.='Content-Transfer-Encoding: 8bit';
                                $message='
                                <html>
                                    <body>
                                        <p>Vous avez reçu un nouveau message sur <a href="www.projet4.n-romano.fr">votre blog</a> !</p>
                                        <br />
                                        <p>De : ' . $messageName . ' <em>(' . $messageMail . ')</em></p>
                                        <p>Objet : ' . $messageSubject . '</p>
                                        <p>' . $messageContent . '</p>
                                        <br />
                                        <p><em>Ceci est un mail automatique, merci de ne pas répondre.</em></p>
                                    </body>
                                </html>
                                ';
                                mail("nromanovitch@gmail.com", "Nouveau message !", $message, $header);

                                $return = true;
                            }
                        }
                        else {
                            $return = 'Veuillez renseigner une adresse mail valide.';
                        }
                    }
                    else {
                        $return = 'Le sujet ne doit pas dépasser 255 caractères.';
                    }
                }
                else {
                    $return = 'Votre email ne doit pas dépasser 255 caractères.';
                }
            }
            else {
                $return = 'Votre nom ne doit pas dépasser 255 caractères.';
            }
        }
        else {
            $return = 'Tous les champs ne sont pas remplis.';
        }
        require("views/frontend/contactView.php");
    }
}