<?php
namespace Nicolas\Projet4\Models;
require_once("Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr, report FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function getAllComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT posts.id AS tableposts_id, posts.title AS tableposts_title,
                                comments.id, comments.post_id, comments.author, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y, %Hh%i\') AS comment_date_fr, comments.report
                                FROM posts, comments
                                WHERE posts.id = comments.post_id
                                ORDER BY comments.report DESC, comment_date DESC');
        return $comments;
    }

    public function insertComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function setReporting($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET report = 1 WHERE id = ?');
        $affectedLines = $comments->execute(array($commentId));

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