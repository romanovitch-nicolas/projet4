<?php
namespace Nicolas\Projet4\Models;
require_once("Manager.php");

class PostManager extends Manager
{
    public function getOnlinePosts()
    {
        $db = $this->dbConnect();
        $posts = $db->query('SELECT id, title, content, image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE online = 1 ORDER BY creation_date');

        return $posts;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function getLastPost()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE online = 1 ORDER BY creation_date DESC LIMIT 0, 1');
        $post = $req->fetch();

        return $post;
    }

    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $posts = $db->query('SELECT id, title, content, image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, online FROM posts ORDER BY creation_date DESC');

        return $posts;
    }

    public function insertPost($postTitle, $postContent)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(title, content, image_name, creation_date) VALUES(?, ?, ?, NOW())');
        $affectedPost = $post->execute(array($postTitle, $postContent, ''));
        $lastId = $db->lastInsertId();

        return $lastId;
    }

    public function insertImage($postId, $imageName)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET image_name = ? WHERE id = ?');
        $image = $req->execute(array($imageName, $postId));

        return $image;
    }

    public function setEditPost($postId, $postTitle, $postContent)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $affectedLines = $req->execute(array($postTitle, $postContent, $postId));

        return $affectedLines;
    }

    public function setDeletePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $req->execute(array($postId));

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le chapitre !');
        }
        else {
            $deleteComments = $db->prepare('DELETE FROM comments WHERE post_id = ?');
            $deleteComments->execute(array($postId));
            
            return $deleteComments;
        }
    }

    public function setDeleteImage($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET image_name = "" WHERE id = ?');
        $deleteImage = $req->execute(array($postId));

        return $deleteImage;
    }

    public function setOnlinePost($postId)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('UPDATE posts SET online = 1 WHERE id = ?');
        $affectedLines = $posts->execute(array($postId));

        return $affectedLines;
    }

    public function setOfflinePost($postId)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('UPDATE posts SET online = 0 WHERE id = ?');
        $affectedLines = $posts->execute(array($postId));

        return $affectedLines;
    }
}