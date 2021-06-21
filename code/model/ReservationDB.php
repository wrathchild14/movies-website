<?php

require_once "DBInit.php";

class ReservationDB {

    public static function getForIds($ids) {
        $db = DBInit::getInstance();

        $id_placeholders = implode(",", array_fill(0, count($ids), "?"));

        $statement = $db->prepare("SELECT id, name, title, seat
            FROM reservation WHERE id IN (" . $id_placeholders . ")");
        $statement->execute($ids);

        return $statement->fetchAll();
    }

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, name, title, seat, username 
            FROM reservation");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, name, title, seat, username
            FROM reservation WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $reservation = $statement->fetch();

        if ($reservation != null) {
            return $reservation;
        } else {
            throw new InvalidArgumentException("No record with id $id");
        }
    }

    public static function insert($name, $title, $seat, $username) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO reservation (name, title, seat, username) 
            VALUES (:name, :title, :seat, :username)");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":title", $title);
        $statement->bindParam(":seat", $seat);
        $statement->bindParam(":username", $username);
        $statement->execute();
    }

    public static function update($id, $name, $title, $seat) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE reservation SET name = :name, title = :title, 
            seat = :seat 
            WHERE id = :id");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":title", $title);
        $statement->bindParam(":seat", $seat);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function delete($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM reservation WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }    

    public static function search($query) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, name, title, seat  
            FROM reservation WHERE MATCH (name, title, seat) AGAINST (:query IN BOOLEAN MODE)");
        $statement->bindValue(":query", $query);
        $statement->execute();

        return $statement->fetchAll();
    }    
}
