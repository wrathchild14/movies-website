<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Cinema</title>



<?php include("view/menu-links.php"); ?>
<section id="main">
    <h1 class="showing">Welcome to Jovan's theatre!</h1>
    <h1 class="showing">Movies showing today:</h1>

    <ul id="moviesList" class="cs-hidden">
        <?php foreach ($movies as $movie) : ?>
            <li>
                <a href="<?= BASE_URL . "movie?id=" . $movie["id"] ?>">
                    <div class="showing-box">
                        <div class="showing-img">
                            <img src="../static/images/<?= $movie["image"] ?>" />
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
</section>