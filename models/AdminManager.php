<?php
namespace Nicolas\Projet4\Models;
require_once("Manager.php");

class AdminManager extends Manager
{
    public function getUserInfo($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE login = ?');
        $req->execute(array($login));
        $userinfo = $req->fetch();

        return $userinfo;
    }

    public function newPost($postTitle, $postContent)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $affectedPost = $post->execute(array($postTitle, $postContent));

        return $affectedPost;
    }

    public function getReportedComments()
    {
        $db = $this->dbConnect();
        $reportedComments = $db->query('SELECT posts.id AS tableposts_id, posts.title AS tableposts_title,
                                comments.id, comments.post_id, comments.author, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y, %Hh%i\') AS comment_date_fr
                                FROM posts, comments
                                WHERE posts.id = comments.post_id AND comments.report = 1
                                ORDER BY comment_date
                                DESC');
        return $reportedComments;
    }

    public function getAllComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT posts.id AS tableposts_id, posts.title AS tableposts_title,
                                comments.id, comments.post_id, comments.author, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y, %Hh%i\') AS comment_date_fr
                                FROM posts, comments
                                WHERE posts.id = comments.post_id
                                ORDER BY comment_date
                                DESC');
        return $comments;
    }

    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $posts = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY creation_date DESC');

        return $posts;
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

    public function setDeleteComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $affectedLines = $req->execute(array($commentId));
        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le commentaire !');
        }
        else {
            return $affectedLines;
        }
    }

        public function setDeleteReporting($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET report = 0 WHERE id = ?');
        $affectedLines = $comments->execute(array($commentId));

        return $affectedLines;
    }
}