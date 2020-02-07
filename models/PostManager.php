<?php
namespace Nicolas\Projet4\Models;
require_once("Manager.php");

class PostManager extends Manager
{
    public function getOnlinePosts()
    {
        $db = $this->dbConnect();
        $posts = $db->query('SELECT id, title, content, image_url, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE online = 1 ORDER BY creation_date');

        return $posts;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, image_url, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function getLastPost()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, image_url, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE online = 1 ORDER BY creation_date DESC LIMIT 0, 1');
        $post = $req->fetch();

        return $post;
    }

    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $posts = $db->query('SELECT id, title, content, image_url, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, online FROM posts ORDER BY creation_date DESC');

        return $posts;
    }

    public function insertPost($postTitle, $postContent, $imageName)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(title, content, image_url, creation_date) VALUES(?, ?, ?, NOW())');
        $affectedPost = $post->execute(array($postTitle, $postContent, $imageName));

        return $affectedPost;
    }

    public function setEditPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $affectedLines = $req->execute(array($_POST['postTitle'], $_POST['postContent'], $postId));

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