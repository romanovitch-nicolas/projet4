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
    elseif (isset($_POST['sendPost'])) {
        if (!empty($_POST['postTitle']) && !empty($_POST['postContent'])) {
            $backend->addPost($_POST['postTitle'], $_POST['postContent']);
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