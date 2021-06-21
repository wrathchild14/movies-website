<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>movie search</title>

<h1>movie search</h1>

<?php include("view/menu-links.php"); ?>

<form action="<?= BASE_URL . "movie/search" ?>" method="get">
    <label for="query">Search movies (maybe by genre):</label>
    <input type="text" name="query" id="query" value="<?= $query ?>" />
    <button>Search</button>
</form>


<ul id="moviesList" class="cs-hidden">
    <?php foreach ($hits as $movie) : ?>
        <li>
            <a href="<?= BASE_URL . "movie?id=" . $movie["id"] ?>">
                <div class="showing-box">
                    <div class="showing-img">
                        <img src="<?= IMAGES_URL . $movie["image"] ?>" />
                    </div>

                    <div class="showing-box-text">
                        <strong><?= $movie["title"] ?></strong>
                        <p><?= $movie["description"] ?></p>
                    </div>
                </div>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
