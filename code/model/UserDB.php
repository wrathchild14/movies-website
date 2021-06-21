<?php

require_once "DBInit.php";

class UserDB {

    // Returns true if a valid combination of a username and a password are provided.
    public static function validLoginAttempt($username, $password) {
        $dbh = DBInit::getInstance();

        // !!! NEVER CONSTRUCT SQL QUERIES THIS WAY !!!
        // INSTEAD, ALWAYS USE PREPARED STATEMENTS AND BIND PARAMETERS!
        
        $query = "SELECT COUNT(id) FROM user WHERE username = :username AND password = :pass";
        $stmt = $dbh->prepare($query);
        $stmt -> bindParam(":username", $username);
        $stmt -> bindParam(":pass", $password);
        $stmt -> execute();

        return $stmt->fetchColumn(0) == 1;
    }

    public static function insert($username, $password, $role) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO user (username, password, role) 
            VALUES (:username, :password, :role)");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":role", $role);
        $statement->execute();
    }

    public static function get($username) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, username, password, role 
            FROM user WHERE username = :username");
        $statement->bindParam(":username", $username, PDO::PARAM_INT);
        $statement->execute();

        $user = $statement->fetch();

        if ($user != null) {
            return $user;
        } else {
            throw new InvalidArgumentException("No record with id $username");
        }
    }
}
