<?php
session_start();
require_once('controllers/frontend.php');
require_once('controllers/backend.php');
$frontend = new \Nicolas\Projet4\Controllers\FrontendController();
$backend = new \Nicolas\Projet4\Controllers\BackendController();

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'connexion':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    $frontend->home();
                }
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'connect':
                if (!isset($_SESSION['login']) OR !isset($_COOKIE['login'])) {
                    if (isset($_POST["login"])) {
                        $backend->connect();
                    }
                    else {
                        require('views/frontend/connectView.php');
                    }
                }
                else {
                    $frontend->home();
                }
            break;

            case 'disconnect':
                $backend->disconnect();
            break;

            case 'listPosts':
                $frontend->listPosts();
            break;

            case 'post':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $frontend->post();
                }
                else {
                    throw new \Exception('Aucun identifiant de billet envoyé');
                }
            break;

            case 'adminPosts':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    $backend->listPosts();
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'adminNewPost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    require('views/backend/adminNewPostView.php');
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'addPost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_POST['postTitle'])) {
                        $backend->addPost($_POST['postTitle'], $_POST['postContent']);
                    }
                    else {
                        require('views/backend/adminNewPostView.php');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté.");
                }
            break;

            case 'adminEditPost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->editPostView($_GET['id']);
                    }
                    else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'editPost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (isset($_POST['postTitle'])) {
                            $backend->editPost($_GET['id']);
                        }
                        else {
                            $backend->editPostView($_GET['id']);
                        }
                    }
                    else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'deletePost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->deleteImage($_GET['id']);
                        $backend->deletePost($_GET['id']);
                    }
                    else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'deleteImage':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->deleteImage($_GET['id']);
                    }
                    else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'onlinePost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->onlinePost($_GET['id']);
                    }
                    else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'offlinePost':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->offlinePost($_GET['id']);
                    }
                    else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'addComment':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (isset($_POST['author'])) {
                        $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                    else {
                        $frontend->post();
                    }
                }
                else {
                    throw new \Exception('Aucun identifiant de billet envoyé');
                }
            break;

            case 'reportComment':
                if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                    if(isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                        $frontend->reportComment($_GET['comment_id'], $_GET['post_id']);
                    }
                    else {
                        throw new \Exception('Aucun identifiant de commentaire envoyé');
                    }
                }
                else {
                    throw new \Exception('Aucun identifiant de billet envoyé');
                }
            break;

            case 'adminComments':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    $backend->listComments();
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'deleteComment':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->deleteComment($_GET['id']);
                    }
                    else {
                        throw new \Exception('Aucun identifiant de commentaire envoyé');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'deleteCommentReport':
                if ((isset($_GET['id']) && $_GET['id'] > 0)) {
                    $backend->deleteCommentReport($_GET['id']);
                }
                else {
                    throw new \Exception('Aucun identifiant de commentaire envoyé');
                }
            break;

            case 'sendMessage':
                if (isset($_POST['messageName'])) {
                    $frontend->addMessage($_POST['messageName'], $_POST['messageMail'], $_POST['messageSubject'], $_POST['messageContent']);
                }
                else {
                    require('views/frontend/contactView.php');
                }
            break;

            case 'adminMessages':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    $backend->listMessages();
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'message':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->message();
                    }
                    else {
                        throw new \Exception('Aucun identifiant de message envoyé');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'deleteMessage':
                if (isset($_SESSION['login']) OR isset($_COOKIE['login'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend->deleteMessage($_GET['id']);
                    }
                    else {
                        throw new \Exception('Aucun identifiant de message envoyé');
                    }
                }
                else {
                    throw new \Exception("Vous n'êtes pas connecté."); 
                }
            break;

            case 'contact':
                require('views/frontend/contactView.php');
            break;

            default:
                $frontend->home();
            break;
        }
    }
    else {
        $frontend->home();
    }
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>