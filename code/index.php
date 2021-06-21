<?php

require_once("controller/MovieController.php");
require_once("controller/UserController.php");
require_once("controller/ReservationController.php");

session_start();

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "movie" => function () {
        MovieController::index();
    },
    "movie/search" => function () {
        MovieController::search();
    },
    "movie/add" => function () {
        if ($_SESSION["user"]["username"] == "admin") {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                MovieController::add();
            } else {
                MovieController::showAddForm();
            }
        } else {
            ViewHelper::redirect(BASE_URL . "movie");
        }
    },
    "reservation" => function () {
        if (isset($_SESSION["user"])) {
            ReservationController::index();
        } else {
            ViewHelper::redirect(BASE_URL . "movie");
        }
    },
    "reservation/delete" => function () {
        ReservationController::delete();
    },
    "movie/reserve" => function () {
        if (isset($_SESSION["user"])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                MovieController::reserve();
                // ReservationController::add();
            } else {
                MovieController::showReservationForm();
            }
        } else {
            ViewHelper::redirect(BASE_URL . "info");
        }
    },
    "movie/edit" => function () {
        if ($_SESSION["user"]["username"] == "admin") {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                MovieController::edit();
            } else {
                MovieController::showEditForm();
            }
        } else {
            ViewHelper::redirect(BASE_URL . "movie");
        }
    },
    "movie/delete" => function () {
        MovieController::delete();
    },
    "user/login" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::login();
        } else {
            UserController::showLoginForm();
        }
    },
    "user/register" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::register();
        } else {
            UserController::showRegisterForm();
        }
    },
    "info" => function () {
        UserController::information();
    },
    "logout" => function () {
        session_destroy();
        ViewHelper::redirect(BASE_URL . "movie");
    },
    "" => function () {
        ViewHelper::redirect(BASE_URL . "movie");
    },
];

try {
    if (isset($urls[$path])) {
        $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    // ViewHelper::error404();
}
