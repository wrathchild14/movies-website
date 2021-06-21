<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Add entry</title>


<?php include("view/menu-links.php"); ?>
<section id="main">
    <div class="showing-box-text">
        <h1>Add new movie</h1>
        <form action="<?= BASE_URL . "movie/add" ?>" method="post">
            <p><label>Title: <input type="text" name="title" value="<?= $movie["title"] ?>" />
                    <span class="important"><?= $errors["title"] ?></span></label>
            </p>
            <p>
                <label>Description: <br />
                    <textarea name="description" rows="10" cols="40"><?= $movie["description"] ?></textarea></label>
            </p>
            <p><button>Insert</button></p>
        </form>
    </div>
</section>