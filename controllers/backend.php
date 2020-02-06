<?php
namespace Nicolas\Projet4\Controllers;
require_once('models/AdminManager.php');
require_once('models/PostManager.php');

class BackendController
{
    public function disconnect()
    { 
        $_SESSION = array();
        session_destroy();
        setcookie('login', '');
        header("Location: index.php");
    }

    public function connect()
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();

        $login = htmlspecialchars($_POST["login"]);
        $pass = htmlspecialchars($_POST["pass"]);
        if (!empty($login) AND !empty($pass)) {
            $userinfo = $adminManager->getUserInfo($_POST['login']);
            $passverif = password_verify($pass, $userinfo['pass']);
            if ($passverif) {
                session_start();
                $_SESSION['login'] = $login;
                    if(isset($_POST['autoconnect']))
                    {
                        setcookie('login', $login, time() + 365*24*3600, null, null, false, true);
                    }
                header('Location: index.php?action=adminPosts');
            }
            else {
                throw new Exception('Mauvais identifiant ou mot de passe !');
            }
        }
        else {
            throw new Exception('Tous les champs doivent être complétés !');
        }
    }

    public function addPost($postTitle, $postContent, $imageUrl)
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();

        $postTitle = htmlspecialchars($postTitle);
        $postContent = htmlspecialchars($postContent);
        $imageUrl =  $_FILES['postImage']['name'];
        move_uploaded_file($_FILES['postImage']['tmp_name'], 'public/images/' . basename($imageUrl));
        $affectedPost = $adminManager->newPost($postTitle, $postContent, $imageUrl);

        if ($affectedPost === false) {
            throw new Exception('Impossible d\'ajouter l\'article !');
        }
        else {
            header('Location: index.php?action=adminPosts');
        }
    }

    public function listComments()
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();

        $comments = $adminManager->getAllComments();

        require('views/backend/adminCommentsView.php');
    }

    public function listPosts()
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();
        $posts = $adminManager->getAllPosts();

        require('views/backend/adminPostsView.php');
    }

    public function addMessage($messageName, $messageMail, $messageSubject, $messageContent)
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();

        $messageName = htmlspecialchars($messageName);
        $messageMail = htmlspecialchars($messageMail);
        $messageSubject = htmlspecialchars($messageSubject);
        $messageContent = htmlspecialchars($messageContent);
        $affectedMessage = $adminManager->newMessage($messageName, $messageMail, $messageSubject, $messageContent);

        if ($affectedMessage === false) {
            throw new Exception('Impossible d\'envoyer le message !');
        }
        else {
            echo 'Votre message à bien été envoyé.';
        }
    }

    public function message()
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();

        $message = $adminManager->getMessage($_GET['id']);

        require('views/backend/messageView.php');
    }

    public function deleteMessage($messageId)
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();
        $affectedLines = $adminManager->setDeleteMessage($messageId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer ce message !');
        }
        else {
            header('Location: index.php?action=adminMessages');
        }    
    }

    public function listMessages()
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();
        $messages = $adminManager->getAllMessages();

        require('views/backend/adminMessagesView.php');
    }

    public function adminEditPost($postId) 
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();

        $post = $postManager->getPost($postId);

        require('views/backend/adminEditPostView.php');
    }

    public function editPost($postId) 
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();
        $affectedLines = $adminManager->setEditPost($postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de modifier ce chapitre !');
        }
        else {
           header('Location: index.php?action=post&id=' . $postId);
        }    
    }

    public function deletePost($postId)
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();
        $affectedLines = $adminManager->setDeletePost($postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer ce chapitre !');
        }
        else {
            header('Location: index.php?action=adminPosts');
        }    
    }

    public function onlinePost($postId) 
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();
        $affectedLines = $adminManager->setOnlinePost($postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de publier ce chapitre !');
        }
        else {
           header('Location: index.php?action=adminPosts');
        }    
    }

    public function offlinePost($postId) 
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();
        $affectedLines = $adminManager->setOfflinePost($postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de passer ce chapitre dans les brouillons !');
        }
        else {
           header('Location: index.php?action=adminPosts');
        }    
    }

    public function deleteComment($commentId)
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();
        $affectedLines = $adminManager->setDeleteComment($commentId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer ce commentaire !');
        }
        else {
           header('Location: index.php?action=adminComments');
        }    
    }

    public function deleteReport($commentId)
    {
        $adminManager = new \Nicolas\Projet4\Models\AdminManager();
        $affectedLines = $adminManager->setDeleteReporting($commentId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le signalement !');
        }
        else {
            header('Location: index.php?action=adminComments');
        }
    }
}