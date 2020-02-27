<?php
namespace Nicolas\Projet4\Models;
require_once("Manager.php");

class UserManager extends Manager
{
	// Récupération des informations de l'utilisateur
    public function getUserInfo($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE login = ?');
        $req->execute(array($login));
        $userinfo = $req->fetch();

        return $userinfo;
    }
}