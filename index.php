<?php
session_start();
require_once('controllers/frontend.php');
require_once('controllers/backend.php');
$frontend = new \Nicolas\Projet4\Controllers\FrontendController();
$backend = new \Nicolas\Projet4\Controllers\BackendController();

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'listPosts':
                $frontend->listPosts();
            break;

            case 'post':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $frontend->post();
                }
                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            break;

            case 'addComment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            break;

            case 'report':
                if ((isset($_GET['post_id']) && $_GET['post_id'] > 0) && (isset($_GET['comment_id']) && $_GET['comment_id'] > 0)) {
                    $frontend->report($_GET['comment_id'], $_GET['post_id']);
                }
                else {
                    throw new Exception('Impossible de signaler le commentaire !');
                }
            break;

            case 'deleteReport':
                if ((isset($_GET['id']) && $_GET['id'] > 0)) {
                    $backend->deleteReport($_GET['id']);
                }
                else {
                    throw new Exception('Impossible de supprimer le signalement.');
                }
            break;

            case 'connexion':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    require('views/frontend/homeView.php');
                }
                else {
                    require('views/frontend/connectView.php');
                }
                break;

            case 'deconnexion':
                $backend->disconnect();
            break;

            case 'adminNewPost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    require('views/backend/adminNewPostView.php');
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'adminEditPost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->adminEditPost($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'editPost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->editPost($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'onlinePost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->onlinePost($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'offlinePost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->offlinePost($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'deletePost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->deletePost($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'adminComments':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    $backend->listComments();
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'adminPosts':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    $backend->listPosts();
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'adminMessages':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    $backend->listMessages();
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'message':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->message();
                    }
                    else {
                        throw new Exception('Aucun identifiant de message envoyé');
                    }
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'deleteMessage':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->deleteMessage($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de message envoyé');
                    }
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'deleteComment':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->deleteComment($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'contact':
                require('views/frontend/contactView.php');
            break;

            default:
                require('views/frontend/homeView.php');
            break;
        }
    }
    else {
        require('views/frontend/homeView.php');
    }

    if (isset($_POST['connexion'])) {
        $backend->connect();
    }

    elseif (isset($_POST['sendMessage'])) {
        if (!empty($_POST['messageName']) && !empty($_POST['messageMail']) && !empty($_POST['messageSubject']) && !empty($_POST['messageContent'])) {
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['messageMail'])) {
                $backend->addMessage($_POST['messageName'], $_POST['messageMail'], $_POST['messageSubject'], $_POST['messageContent']);
            }
            else {
                throw new Exception('Veuillez renseigner une adresse mail valide.');            
            }
        }
        else {
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
    }

    elseif (isset($_POST['sendPost'])) {
        if (!empty($_POST['postTitle']) && !empty($_POST['postContent'])) {
            if (isset($_FILES['postImage']) AND $_FILES['postImage']['error'] == 0) {
                if ($_FILES['postImage']['size'] <= 1000000) {
                    $infosfichier = pathinfo($_FILES['postImage']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $authorized_extensions = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($extension_upload, $authorized_extensions)) {
                        $backend->addPost($_POST['postTitle'], $_POST['postContent'], $_FILES['postImage']);
                    }
                    else {
                        throw new Exception('Extension de l\'image non valide. (Extensions autorisées : .jpg, .jpeg, .gif, .png)');                       
                    }
                }
                else {
                    throw new Exception('L\'image est trop volumineuse. (Taille maximale : 1 Mo)');                    
                }
            }
            else {
                throw new Exception('Echec lors de l\'envoi du fichier.');           
            }
        }
        else {
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
    }
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>