<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Reservation detail</title>


<?php include("view/menu-links.php"); ?>

<section id="main">

    <h1>Selected reservation: <?= $reservation["title"] ?> for <?= $reservation["name"] ?>, reserved by user: <?= $reservation["username"] ?></h1>
    <?php if ($_SESSION["user"]["username"] == $reservation["username"]) : ?>
        <div class="showing">
            <form action="<?= BASE_URL . "reservation/delete" ?>" method="post">
                <input type="hidden" name="id" value="<?= $reservation["id"] ?>" />
                <label><input type="hidden" name="delete_confirmation" title="Are you sure you want to delete this entry?" /></label>
                <button class="important">Delete record</button>
            </form>
        </div>
    <?php else : ?>
            <p>This is not ur reservation, you can't delete it.</p>
    <?php endif; ?>
</section>