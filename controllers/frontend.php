<?php
namespace Nicolas\Projet4\Controllers;
require_once('models/PostManager.php');
require_once('models/CommentManager.php');

class FrontendController
{
    public function listPosts()
    {
        $postManager = new \Nicolas\Projet4\Models\PostManager();
        $posts = $postManager->getPosts();

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

        $affectedLines = $commentManager->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
}