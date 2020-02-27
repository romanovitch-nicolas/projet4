<?php
namespace Nicolas\Projet4\Models;
require_once("Manager.php");

class MessageManager extends Manager
{
    // Récupération de tous les messages
    public function getAllMessages()
    {
        $db = $this->dbConnect();
        $messages = $db->query('SELECT id, name, mail, subject, content, DATE_FORMAT(message_date, \'%d/%m/%Y, %Hh%i\') AS message_date_fr, message_read FROM messages ORDER BY message_date DESC');

        return $messages;
    }
	
    // Récupération d'un message
	public function getMessage($messageId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, name, mail, subject, content, DATE_FORMAT(message_date, \'%d/%m/%Y, %Hh%i\') AS message_date_fr FROM messages WHERE id = ?');
        $req->execute(array($messageId));
        $message = $req->fetch();

        return $message;
    }

    // Passage d'un message en "lu"
    public function setReadMessage($messageId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE messages SET message_read = 1 WHERE id = ?');
        $readMessage = $req->execute(array($messageId));

        return $readMessage;
    }

    // Ajout d'un message
    public function insertMessage($messageName, $messageMail, $messageSubject, $messageContent)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO messages(name, mail, subject, content, message_date) VALUES(?, ?, ?, ?, NOW())');
        $insertMessage = $req->execute(array($messageName, $messageMail, $messageSubject, $messageContent));

        return $insertMessage;
    }

    // Suppression d'un message
    public function deleteMessage($messageId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM messages WHERE id = ?');
        $deleteMessage = $req->execute(array($messageId));

        return $deleteMessage;
    }
}