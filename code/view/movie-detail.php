<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Movie detail</title>


<?php include("view/menu-links.php"); ?>

<section id="main">

    <h1>Selected movie: <?= $movie["title"] ?></h1>

    <ul id="moviesList" class="cs-hidden">
        <li>
            <div class="showing-box">
                <div class="showing-img">
                    <img src="<?= IMAGES_URL . $movie["image"] ?>" />
                </div>

                <div class="showing-box-text">
                    <strong><?= $movie["title"] ?></strong>
                    <p><?= $movie["description"] ?></p>
                </div>
            </div>
        </li>
    </ul>

    <div class="showing">
        <p>[ <a href="<?= BASE_URL . "movie/edit?id=" . $_GET["id"] ?>">Edit</a> |
            <a href="<?= BASE_URL . "movie/reserve?id=" . $_GET["id"] ?>"> Reserve </a>
            ]
        </p>
    </div>
</section>