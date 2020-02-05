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

    public function newPost($postTitle, $postContent, $imageUrl)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(title, content, image_url, creation_date) VALUES(?, ?, ?, NOW())');
        $affectedPost = $post->execute(array($postTitle, $postContent, $imageUrl));

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
        $posts = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, online FROM posts ORDER BY creation_date DESC');

        return $posts;
    }

    public function newMessage($messageName, $messageMail, $messageSubject, $messageContent)
    {
        $db = $this->dbConnect();
        $message = $db->prepare('INSERT INTO messages(name, mail, subject, content, message_date) VALUES(?, ?, ?, ?, NOW())');
        $affectedMessage = $message->execute(array($messageName, $messageMail, $messageSubject, $messageContent));

        return $affectedMessage;
    }

    public function getMessage($messageId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, name, mail, subject, content, DATE_FORMAT(message_date, \'%d/%m/%Y, %Hh%i\') AS message_date_fr FROM messages WHERE id = ?');
        $req->execute(array($messageId));
        $message = $req->fetch();

        return $message;
    }

    public function getAllMessages()
    {
        $db = $this->dbConnect();
        $messages = $db->query('SELECT id, name, mail, subject, content, DATE_FORMAT(message_date, \'%d/%m/%Y, %Hh%i\') AS message_date_fr FROM messages ORDER BY message_date DESC');

        return $messages;
    }

    public function setDeleteMessage($messageId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM messages WHERE id = ?');
        $affectedLines = $req->execute(array($messageId));

        return $deleteMessage;
    }

    public function setEditPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $affectedLines = $req->execute(array($_POST['postTitle'], $_POST['postContent']));

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

    public function setDeleteComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $affectedLines = $req->execute(array($commentId));

        return $affectedLines;
    }

    public function setDeleteReporting($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET report = 0 WHERE id = ?');
        $affectedLines = $comments->execute(array($commentId));

        return $affectedLines;
    }
}