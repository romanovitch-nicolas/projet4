<?php
namespace Nicolas\Projet4\Controllers;
require_once('models/CommentManager.php');
require_once('models/MessageManager.php');
require_once('models/PostManager.php');
require_once('models/UserManager.php');

class BackendController
{
    public function connect()
    {
        $userManager = new \Nicolas\Projet4\Models\UserManager();

        $login = htmlspecialchars($_POST["login"]);
        $pass = htmlspecialchars($_POST["pass"]);
        if (!empty($login) AND !empty($pass)) {
            $userinfo = $userManager->getUserInfo($_POST['login']);
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

    public function disconnect()
    { 
        $_SESSION = array();
        session_destroy();
        setcookie('login', '');
        header("Location: index.php");
    }

    public function listPosts()
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $posts = $postManager->getAllPosts();

        require('views/backend/adminPostsView.php');
    }

    public function addPost($postTitle, $postContent)
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();

        $postTitle = htmlspecialchars($postTitle);
        $postContent = htmlspecialchars($postContent);
        $imageName =  $_FILES['postImage']['name'];
        move_uploaded_file($_FILES['postImage']['tmp_name'], 'public/images/' . basename($imageName));
        $affectedPost = $postManager->insertPost($postTitle, $postContent, $imageName);

        if ($affectedPost === false) {
            throw new Exception('Impossible d\'ajouter l\'article !');
        }
        else {
            header('Location: index.php?action=adminPosts');
        }
    }

    public function editPostView($postId) 
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();

        $post = $postManager->getPost($postId);

        require('views/backend/adminEditPostView.php');
    }

    public function editPost($postId) 
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $affectedLines = $postManager->setEditPost($postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de modifier ce chapitre !');
        }
        else {
           header('Location: index.php?action=post&id=' . $postId);
        }    
    }

    public function deletePost($postId)
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $affectedLines = $postManager->setDeletePost($postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer ce chapitre !');
        }
        else {
            header('Location: index.php?action=adminPosts');
        }    
    }

    public function onlinePost($postId) 
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $affectedLines = $postManager->setOnlinePost($postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de publier ce chapitre !');
        }
        else {
           header('Location: index.php?action=adminPosts');
        }    
    }

    public function offlinePost($postId) 
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $affectedLines = $postManager->setOfflinePost($postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de passer ce chapitre dans les brouillons !');
        }
        else {
           header('Location: index.php?action=adminPosts');
        }    
    }

    public function listComments()
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();

        $comments = $commentManager->getAllComments();

        require('views/backend/adminCommentsView.php');
    }

    public function deleteComment($commentId)
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();
        $affectedLines = $commentManager->setDeleteComment($commentId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer ce commentaire !');
        }
        else {
           header('Location: index.php?action=adminComments');
        }    
    }

    public function deleteCommentReport($commentId)
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();
        $affectedLines = $commentManager->setDeleteReporting($commentId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le signalement !');
        }
        else {
            header('Location: index.php?action=adminComments');
        }
    }

    public function listMessages()
    {
        $messageManager = new \Nicolas\Projet4\Models\MessageManager();
        $messages = $messageManager->getAllMessages();

        require('views/backend/adminMessagesView.php');
    }

    public function message()
    {
        $messageManager = new \Nicolas\Projet4\Models\MessageManager();

        $message = $messageManager->getMessage($_GET['id']);

        require('views/backend/messageView.php');
    }

    public function deleteMessage($messageId)
    {
        $messageManager = new \Nicolas\Projet4\Models\MessageManager();
        $affectedLines = $messageManager->setDeleteMessage($messageId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer ce message !');
        }
        else {
            header('Location: index.php?action=adminMessages');
        }    
    }
}