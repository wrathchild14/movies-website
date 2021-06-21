<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Cinema</title>

<?php include("view/menu-links.php"); ?>

<section id="main">
    <h2 class="showing">Welcome to Jovan's theatre!</h1>
        <h2 class="showing">Your reservations:</h1>
            <ul id="reservationTable">
                <?php foreach ($reservations as $reservation) : ?>
                    <li>
                        <!-- <p><?= $reservation["id"] ?>, <?= $reservation["name"] ?>, <?= $reservation["title"] ?>, <?= $reservation["seat"] ?></p> -->
                        <a href="<?= BASE_URL . "reservation?id=" . $reservation["id"] ?>">
                            <p>User "<?= $reservation["username"] ?>" has the ReservationID: <?= $reservation["id"] ?>. On the name "<?= $reservation["name"] ?>", for "<?= $reservation["title"] ?>", on seat <?= $reservation["seat"] ?></p>
                        </a>
                    </li>
                    <br></br>
                <?php endforeach; ?>
            </ul>
</section>