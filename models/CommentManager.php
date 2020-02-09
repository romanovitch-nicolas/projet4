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
        $allComments = $db->query('SELECT posts.id AS tableposts_id, posts.title AS tableposts_title,
                                comments.id, comments.post_id, comments.author, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y, %Hh%i\') AS comment_date_fr, comments.report
                                FROM posts, comments
                                WHERE posts.id = comments.post_id
                                ORDER BY comments.report DESC, comment_date DESC');
        return $allComments;
    }

    public function insertComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $insertComment = $req->execute(array($postId, $author, $comment));

        return $insertComment;
    }

    public function setReporting($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET report = 1 WHERE id = ?');
        $report = $req->execute(array($commentId));

        return $report;
    }

    public function setDeleteReporting($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET report = 0 WHERE id = ?');
        $deleteReport = $req->execute(array($commentId));

        return $deleteReport;
    }

    public function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $deleteComment = $req->execute(array($commentId));

        return $deleteComment;
    }
}