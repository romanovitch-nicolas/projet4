<?php
namespace Nicolas\Projet4\Controllers;
require_once('models/CommentManager.php');
require_once('models/MessageManager.php');
require_once('models/PostManager.php');
require_once('models/UserManager.php');

class BackendController
{   
    // Connexion
    public function connect()
    {
        $userManager = new \Nicolas\Projet4\Models\UserManager();

        $login = htmlspecialchars($_POST["login"]);
        $pass = htmlspecialchars($_POST["pass"]);
        
        if (!empty($login) AND !empty($pass)) {
            $userinfo = $userManager->getUserInfo($login);
            $passverif = password_verify($pass, $userinfo['pass']);
            if ($passverif) {
                session_start();
                $_SESSION['login'] = $login;
                    if(isset($_POST['autoconnect']))
                    {
                        setcookie('login', $login, time() + 365*24*3600, null, null, false, true);
                    }
                header('Location: gestion-des-chapitres');
            }
            else {
                $return = 'Mauvais identifiant ou mot de passe.';
            }
        }
        else {
            $return = 'Tous les champs ne sont pas remplis.';
        }

        require('views/frontend/connectView.php');
    }

    // Déconnexion
    public function disconnect()
    { 
        $_SESSION = array();
        session_destroy();
        setcookie('login', '');
        header("Location: accueil");
    }

    // Affichage de la liste de tous les chapitres dans l'admin
    public function listPosts()
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $posts = $postManager->getAllPosts();

        require('views/backend/adminPostsView.php');
    }

    // Ajout d'un nouveau chapitre
    public function addPost($postTitle, $postContent)
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();

        $postTitle = htmlspecialchars($postTitle);
        $postContent = htmlspecialchars($postContent);

        if (!empty($_POST['postTitle']) && !empty($_POST['postContent'])) {
            $titleLength = strlen($_POST['postTitle']);
            if($titleLength <= 255) {
                if ($_FILES['postImage']['name']) {
                    if ($_FILES['postImage']['size'] <= 2000000) {
                        $fileInfo = pathinfo($_FILES['postImage']['name']);
                        $extension_upload = $fileInfo['extension'];
                        $authorized_extensions = array('jpg', 'jpeg', 'gif', 'png');
                        if (in_array($extension_upload, $authorized_extensions)) {
                            $insertPost = $postManager->insertPost($postTitle, $postContent);
                            $fileInfo = pathinfo($_FILES['postImage']['name']);
                            $imageName = 'post_' . $insertPost . '.' . $fileInfo['extension'];
                            move_uploaded_file($_FILES['postImage']['tmp_name'], 'public/images/' . basename($imageName));
                            $image = $postManager->insertImage($insertPost, $imageName);
                            if ($insertPost === false) {
                                throw new \Exception('Impossible d\'ajouter l\'article.');
                            }
                            elseif ($image === false) {
                                throw new \Exception('Impossible d\'ajouter l\'image.');
                            }
                            else {
                                header('Location: gestion-des-chapitres');
                            }
                        }
                        else {
                            $return = 'Extension de l\'image non valide. (Extensions autorisées : .jpg, .jpeg, .gif, .png)';                       
                        }
                    }
                    else {
                        $return = 'L\'image est trop volumineuse. (Taille maximale : 2 Mo)';                    
                    }
                }
                else {
                    $insertPost = $postManager->insertPost($postTitle, $postContent);
                    if ($insertPost === false) {
                        throw new \Exception('Impossible d\'ajouter l\'article.');
                    }
                    else {
                        header('Location: gestion-des-chapitres');
                    }
                }
            }
            else {
                $return = "Le titre ne doit pas dépasser 255 caractères.";
            }
        }
        else {
            $return = 'Tous les champs ne sont pas remplis.';
        }

        require('views/backend/adminNewPostView.php');
    }

    // Affichage de la page d'édition d'un chapitre
    public function editPostView($postId) 
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();

        $post = $postManager->getPost($postId);

        require('views/backend/adminEditPostView.php');
    }

    // Edition d'un chapitre
    public function editPost($postId) 
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();

        $postTitle = htmlspecialchars($_POST['postTitle']);
        $postContent = htmlspecialchars($_POST['postContent']);

        if (!empty($_POST['postTitle']) && !empty($_POST['postContent'])) {
            $titleLength = strlen($_POST['postTitle']);
            if($titleLength <= 255) {
                if ($_FILES['editImage']['name']) {
                    if ($_FILES['editImage']['size'] <= 2000000) {
                        $fileInfo = pathinfo($_FILES['editImage']['name']);
                        $extension_upload = $fileInfo['extension'];
                        $authorized_extensions = array('jpg', 'jpeg', 'gif', 'png');
                        if (in_array($extension_upload, $authorized_extensions)) {
                            $editPost = $postManager->setEditPost($postId, $postTitle, $postContent);
                            $fileInfo = pathinfo($_FILES['editImage']['name']);
                            $imageName = 'post_' . $postId . '.' . $fileInfo['extension'];
                            move_uploaded_file($_FILES['editImage']['tmp_name'], 'public/images/' . basename($imageName));
                            $image = $postManager->insertImage($postId, $imageName);
                            if ($editPost === false) {
                                throw new Exception('Impossible de modifier le chapitre.');
                            }
                            elseif ($image === false) {
                                throw new Exception('Impossible de modifier l\'image.');
                            }
                            else {
                               header('Location: gestion-des-chapitres');
                            }   
                        }
                        else {
                            $return = 'Extension de l\'image non valide. (Extensions autorisées : .jpg, .jpeg, .gif, .png)';                       
                        }
                    }
                    else {
                        $return = 'L\'image est trop volumineuse. (Taille maximale : 2 Mo)';                    
                    }
                }
                else {
                    $editPost = $postManager->setEditPost($postId, $postTitle, $postContent);
                    if ($editPost === false) {
                        throw new Exception('Impossible de modifier le chapitre.');
                    }
                    else {
                       header('Location: gestion-des-chapitres');
                    }  
                }
            }
            else {
                $return = "Le titre ne doit pas dépasser 255 caractères.";
            }
        }
        else {
            $return = "Tous les champs ne sont pas remplis.";   
        }
        
        $post = $postManager->getPost($_GET['id']);
        require('views/backend/adminEditPostView.php');  
    }

    // Suppression d'un chapitre
    public function deletePost($postId)
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $deletePost = $postManager->deletePost($postId);

        if ($deletePost === false) {
            throw new \Exception('Impossible de supprimer ce chapitre.');
        }
        else {
            header('Location: gestion-des-chapitres');
        }    
    }

    // Suppression de l'image d'un chapitre
    public function deleteImage($postId)
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $post = $postManager->getPost($postId);
        if (!empty($post['image_name'])) {
            unlink('public/images/' . $post['image_name']);
            $deleteImage = $postManager->setDeleteImage($postId);
        }

        if ($deleteImage === false) {
            throw new \Exception('Impossible de supprimer l\'image.');
        }
        else {
            header('Location: modifier-un-chapitre-' . $postId);
        }
    }

    // Rendre un article public
    public function onlinePost($postId) 
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $onlinePost = $postManager->setOnlinePost($postId);

        if ($onlinePost === false) {
            throw new \Exception('Impossible de publier ce chapitre.');
        }
        else {
           header('Location: gestion-des-chapitres');
        }    
    }

    // Rendre un article privé
    public function offlinePost($postId) 
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $offlinePost = $postManager->setOfflinePost($postId);

        if ($offlinePost === false) {
            throw new \Exception('Impossible de passer ce chapitre dans les brouillons.');
        }
        else {
           header('Location: gestion-des-chapitres');
        }    
    }

    // Affichage de la liste de tous les commentaires dans l'admin
    public function listComments()
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();

        $comments = $commentManager->getAllComments();

        require('views/backend/adminCommentsView.php');
    }

    // Suppression d'un commentaire
    public function deleteComment($commentId)
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();
        $deleteComment = $commentManager->deleteComment($commentId);

        if ($deleteComment === false) {
            throw new \Exception('Impossible de supprimer ce commentaire.');
        }
        else {
           header('Location: gestion-des-commentaires');
        }    
    }

    // Approbation d'un commentaire signalé
    public function deleteCommentReport($commentId)
    {
        $commentManager = new \Nicolas\Projet4\Models\CommentManager();
        $deleteReport = $commentManager->setDeleteReporting($commentId);

        if ($deleteReport === false) {
            throw new \Exception('Impossible de supprimer le signalement.');
        }
        else {
            header('Location: gestion-des-commentaires');
        }
    }

    // Affichage de la liste des messages privés dans l'admin
    public function listMessages()
    {
        $messageManager = new \Nicolas\Projet4\Models\MessageManager();
        $messages = $messageManager->getAllMessages();

        require('views/backend/adminMessagesView.php');
    }

    // Affichage d'un message privé
    public function message()
    {
        $messageManager = new \Nicolas\Projet4\Models\MessageManager();

        $message = $messageManager->getMessage($_GET['id']);
        $readMessage = $messageManager->setReadMessage($_GET['id']);

        require('views/backend/messageView.php');
    }

    // Suppression d'un message privé
    public function deleteMessage($messageId)
    {
        $messageManager = new \Nicolas\Projet4\Models\MessageManager();
        $deleteMessage = $messageManager->deleteMessage($messageId);

        if ($deleteMessage === false) {
            throw new \Exception('Impossible de supprimer ce message.');
        }
        else {
            header('Location: messagerie');
        }    
    }
}