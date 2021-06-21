<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Edit entry</title>

<h1>Edit movie</h1>

<?php include("view/menu-links.php"); ?>

<form action="<?= BASE_URL . "movie/edit" ?>" method="post">
    <input type="hidden" name="id" value="<?= $movie["id"] ?>"  />
    <input type="hidden" name="image" value="<?= $movie["image"] ?>"  />
    <p><label>Title: <input type="text" name="title" value="<?= $movie["title"] ?>" />
        <span class="important"><?= $errors["title"] ?></span></label>
    </p>
    <p><label>Description: <br />
        <textarea name="description" rows="10" cols="40"><?= $movie["description"] ?></textarea></label>
    </p>
    <p><button>Update</button></p>
</form>

<form action="<?= BASE_URL . "movie/delete" ?>" method="post">
    <input type="hidden" name="id" value="<?= $movie["id"] ?>"  />
    <label>Delete? <input type="checkbox" name="delete_confirmation" title="Are you sure you want to delete this entry?" /></label>
    <button class="important">Delete record</button>
</form>
