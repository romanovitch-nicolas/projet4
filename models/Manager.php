<?php
namespace Nicolas\Projet4\Models;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        return $db;
    }
}