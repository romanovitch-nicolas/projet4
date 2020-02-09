<?php
namespace Nicolas\Projet4\Models;
require_once("Manager.php");

class MessageManager extends Manager
{
    public function getAllMessages()
    {
        $db = $this->dbConnect();
        $messages = $db->query('SELECT id, name, mail, subject, content, DATE_FORMAT(message_date, \'%d/%m/%Y, %Hh%i\') AS message_date_fr, message_read FROM messages ORDER BY message_date DESC');

        return $messages;
    }
	
	public function getMessage($messageId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, name, mail, subject, content, DATE_FORMAT(message_date, \'%d/%m/%Y, %Hh%i\') AS message_date_fr FROM messages WHERE id = ?');
        $req->execute(array($messageId));
        $message = $req->fetch();

        return $message;
    }

    public function setReadMessage($messageId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE messages SET message_read = 1 WHERE id = ?');
        $readMessage = $req->execute(array($messageId));

        return $readMessage;
    }

    public function insertMessage($messageName, $messageMail, $messageSubject, $messageContent)
    {
        $db = $this->dbConnect();
        $message = $db->prepare('INSERT INTO messages(name, mail, subject, content, message_date) VALUES(?, ?, ?, ?, NOW())');
        $affectedMessage = $message->execute(array($messageName, $messageMail, $messageSubject, $messageContent));

        return $affectedMessage;
    }

    public function setDeleteMessage($messageId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM messages WHERE id = ?');
        $affectedLines = $req->execute(array($messageId));

        return $deleteMessage;
    }
}