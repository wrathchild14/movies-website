<?php

require_once "DBInit.php";

class MovieDB {

    public static function getForIds($ids) {
        $db = DBInit::getInstance();

        $id_placeholders = implode(",", array_fill(0, count($ids), "?"));

        $statement = $db->prepare("SELECT id, title, image, description
            FROM movie WHERE id IN (" . $id_placeholders . ")");
        $statement->execute($ids);

        return $statement->fetchAll();
    }

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, title, image, description 
            FROM movie");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, title, image, description 
            FROM movie WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $book = $statement->fetch();

        if ($book != null) {
            return $book;
        } else {
            throw new InvalidArgumentException("No record with id $id");
        }
    }

    public static function insert($title, $image, $description) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO movie (title, image, description) 
            VALUES (:title, :image, :description)");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":image", $image);
        $statement->bindParam(":description", $description);
        $statement->execute();
    }

    public static function update($id, $title, $image, $description) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE movie SET title = :title, image = :image, 
            description = :description 
            WHERE id = :id");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":image", $image);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function delete($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM movie WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }    

    public static function search($query) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, title, image, description  
            FROM movie WHERE MATCH (title, image, description) AGAINST (:query IN BOOLEAN MODE)");
        $statement->bindValue(":query", $query);
        $statement->execute();

        return $statement->fetchAll();
    }    
}
