<?php
namespace Nicolas\Projet4\Models;
require_once("Manager.php");

class PostManager extends Manager
{
    // Récupération des chapitres publiés
    public function getOnlinePosts()
    {
        $db = $this->dbConnect();
        $onlinePosts = $db->query('SELECT id, title, content, image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE online = 1 ORDER BY creation_date');

        return $onlinePosts;
    }

    // Récupération d'un chapitre
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    // Récupération du dernier chapitre
    public function getLastPost()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE online = 1 ORDER BY creation_date DESC LIMIT 0, 1');
        $lastPost = $req->fetch();

        return $lastPost;
    }

    // Récupération de tous les chapitres
    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $posts = $db->query('SELECT id, title, content, image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, online FROM posts ORDER BY creation_date DESC');

        return $posts;
    }

    // Ajout d'un chapitre
    public function insertPost($postTitle, $postContent)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, image_name, creation_date) VALUES(?, ?, ?, NOW())');
        $insertPost = $req->execute(array($postTitle, $postContent, ''));
        $lastId = $db->lastInsertId();

        return $lastId;
    }

    // Ajout d'une image
    public function insertImage($postId, $imageName)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET image_name = ? WHERE id = ?');
        $insertImage = $req->execute(array($imageName, $postId));

        return $insertImage;
    }

    // Edition d'un chapitre
    public function setEditPost($postId, $postTitle, $postContent)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $editPost = $req->execute(array($postTitle, $postContent, $postId));

        return $editPost;
    }

    // Suppression d'un chapitre
    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $deletePost = $req->execute(array($postId));

        if ($deletePost === false) {
            throw new Exception('Impossible de supprimer le chapitre !');
        }
        else {
            $reqTwo = $db->prepare('DELETE FROM comments WHERE post_id = ?');
            $deleteComments = $reqTwo->execute(array($postId));
            
            return $deleteComments;
        }
    }

    // Suppression d'une image
    public function setDeleteImage($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET image_name = "" WHERE id = ?');
        $deleteImage = $req->execute(array($postId));

        return $deleteImage;
    }

    // Rendre un article public
    public function setOnlinePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET online = 1 WHERE id = ?');
        $onlinePost = $req->execute(array($postId));

        return $onlinePost;
    }

    // Rendre un article privé
    public function setOfflinePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET online = 0 WHERE id = ?');
        $offlinePost = $req->execute(array($postId));

        return $offlinePost;
    }
}