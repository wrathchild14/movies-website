<?php

require_once("model/MovieDB.php");
require_once("model/ReservationDB.php");
require_once("ViewHelper.php");

class MovieController {

    public static function index() {
        if (isset($_GET["id"])) {
            ViewHelper::render("view/movie-detail.php", ["movie" => MovieDB::get($_GET["id"])]);
        } else {
            ViewHelper::render("view/movie-list.php", ["movies" => MovieDB::getAll()]);
        }
    }

    public static function search() {
        if (isset($_GET["query"])) {
            $query = $_GET["query"];
            $hits = MovieDB::search($query);
        } else {
            $query = "";
            $hits = [];
        }

        ViewHelper::render("view/movie-search.php", ["hits" => $hits, "query" => $query]);
    }

    // Function can be called without providing arguments. In such case,
    // $data and $errors paramateres are initialized as empty arrays
    public static function showAddForm($data = [], $errors = []) {
        // If $data is an empty array, let's set some default values
        if (empty($data)) {
            $data = [
                "title" => "",
                "image" => "",
                "description" => "",
            ];
        }

        // If $errors array is empty, let's make it contain the same keys as
        // $data array, but with empty values
        if (empty($errors)) {
            foreach ($data as $key => $value) {
                $errors[$key] = "";
            }
        }

        $vars = ["movie" => $data, "errors" => $errors];
        ViewHelper::render("view/movie-add.php", $vars);
    }

    public static function add() {
        $rules = [
            "title" => [
                // Only letters, dots, spaces and dashes are allowed
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ 0-9():a-zA-ZšđčćžŠĐČĆŽ\.\-]+$/"]
            ],
            // we convert HTML special characters
            // "title" => FILTER_SANITIZE_SPECIAL_CHARS,
            "description" => FILTER_SANITIZE_SPECIAL_CHARS
            // "year" => [
            //     // The year can only be between 1500 and 2020
            //     "filter" => FILTER_VALIDATE_INT,
            //     "options" => ["min_range" => 1500, "max_range" => 2020]
            // ],
            // "price" => [
            //     // We provide a custom function that verifies the data. 
            //     // If the data is not OK, we return false, otherwise we return the data
            //     "filter" => FILTER_CALLBACK,
            //     "options" => function ($value) { return (is_numeric($value) && $value >= 0) ? floatval($value) : false; }
            // ],
            // "quantity" => [
            //     // The minimum quantity should be at least 10
            //     "filter" => FILTER_VALIDATE_INT,
            //     "options" => ["min_range" => 10]
            // ]
        ];
        // Apply filter to all POST variables; from here onwards we never
        // access $_POST directly, but use the $data array
        $data = filter_input_array(INPUT_POST, $rules);

        // $errors["author"] = $data["author"] === false ? "Provide the name of the author: only letters, dots, dashes and spaces are allowed." : "";
        $errors["title"] = empty($data["title"]) ? "Provide the movie title." : "";
        $errors["description"] = empty($data["description"]) ? "Provide the movie description." : "";
        // $errors["year"] = $data["year"] === false ? "Year should be between 1500 and 2020." : "";
        // $errors["price"] = $data["price"] === false ? "Price should be non-negative." : "";
        // $errors["quantity"] = $data["quantity"] === false ? "Quantity should be at least 10." : "";

        // Is there an error?
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }

        if ($isDataValid) {
            MovieDB::insert($data["title"], "", $data["description"]); // no image
            ViewHelper::redirect(BASE_URL . "movie");
        } else {
            self::showAddForm($data, $errors);
        }
    }

    public static function showEditForm($data = [], $errors = []) {
        if (empty($data)) {
            $data = MovieDB::get($_GET["id"]);
        }

        if (empty($errors)) {
            foreach ($data as $key => $value) {
                $errors[$key] = "";
            }
        }
        
        ViewHelper::render("view/movie-edit.php", ["movie" => $data, "errors" => $errors]);
    }
    
    public static function showReservationForm($data = [], $errors = []) {
        if (empty($data)) {
            $data = MovieDB::get($_GET["id"]);
        }

        if (empty($errors)) {
            foreach ($data as $key => $value) {
                $errors[$key] = "";
            }
        }
        
        ViewHelper::render("view/movie-reserve.php", ["movie" => $data, "errors" => $errors]);
    }

    public static function reserve() {

        $rules = [
            "name" => [
                // Only letters, dots, spaces and dashes are allowed
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-ZšđčćžŠĐČĆŽ\.\-]+$/"]
            ],
            "seat" => [
                // The year can only be between 1500 and 2020
                "filter" => FILTER_VALIDATE_INT,
                "options" => ["min_range" => 1, "max_range" => 25]
            ]
        ];
        // Apply filter to all POST variables; from here onwards we never
        // access $_POST directly, but use the $data array
        $data = filter_input_array(INPUT_POST, $rules);

        // $errors["author"] = $data["author"] === false ? "Provide the name of the author: only letters, dots, dashes and spaces are allowed." : "";
        $errors["name"] = empty($data["name"]) ? "Provide correct name." : "";
        $errors["seat"] = empty($data["seat"]) ? "Provide the movie seat (from 1 to 25)." : "";
        // $errors["year"] = $data["year"] === false ? "Year should be between 1500 and 2020." : "";
        // $errors["price"] = $data["price"] === false ? "Price should be non-negative." : "";
        // $errors["quantity"] = $data["quantity"] === false ? "Quantity should be at least 10." : "";

        // Is there an error?
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }
        
        // TODO: Implement server-side validation, similar to the one for adding books
        // $isDataValid = true;
        $data = $_POST;
        
        if ($isDataValid) {
            ReservationDB::insert($data["name"], $data["title"], $data["seat"], $data["username"]);
            // ViewHelper::redirect(BASE_URL . "book?id=" . $data["id"]);
            ViewHelper::redirect(BASE_URL . "reservation");
        } else {
            self::showReservationForm($data, $errors);
        }
    }


    public static function edit() {
        // TODO: Implement server-side validation, similar to the one for adding books
        $isDataValid = true;
        $data = $_POST;
        
        if ($isDataValid) {
            MovieDB::update($data["id"], $data["title"], $data["image"] ,$data["description"]);
            ViewHelper::redirect(BASE_URL . "movie?id=" . $data["id"]);
        } else {
            self::showEditForm($data, $errors);
        }
    }

    public static function delete() {
        $rules = [
            "id" => [
                "filter" => FILTER_VALIDATE_INT,
                "options" => ["min_range" => 1]
            ],
            "delete_confirmation" => [
                "filter" => FILTER_VALIDATE_BOOLEAN
            ]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        $errors["id"] = $data["id"] === null ? "Cannot delete without a valid ID." : "";
        $errors["delete_confirmation"] = $data["delete_confirmation"] === null ? "Forgot to check the delete box?" : "";

        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }

        if ($isDataValid) {
            MovieDB::delete($data["id"]);
            $url = BASE_URL . "movie";
        } else {
            if ($data["id"] !== null) {
                $url = BASE_URL . "movie/edit?id=" . $data["id"];
            } else {
                $url = BASE_URL . "movie";
            }
        }

        ViewHelper::redirect($url);
    }
}