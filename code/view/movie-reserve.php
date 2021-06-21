<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Reserve movie</title>

<section id="main">

    <?php include("view/menu-links.php"); ?>

    <form action="<?= BASE_URL . "movie/reserve" ?>" method="post">
        <h1>Reserve movie <?= $movie["title"] ?> (<?= $movie["description"] ?>)</h1>
        <input type="hidden" name="id" value="<?= $movie["id"] ?>" />
        </p>
        <p><label><input type="hidden" name="title" value="<?= $movie["title"] ?>" />
                <span class="important"><?= $errors["title"] ?></span></label>
        </p>
        <p><label><input type="hidden" name="username" value="<?= $_SESSION["user"]["username"] ?>" />
                <span class="important"><?= $errors["username"] ?></span></label>
        </p>
        <p><label><input type="hidden" name="description" value="<?= $movie["description"] ?>" />
                <span class="important"><?= $errors["description"] ?></span></label>
        </p>
        <p><label>Your name: <input type="text" name="name" value="<?= $movie["name"] ?>" />
                <span class="important"><?= $errors["name"] ?></span></label>
        </p>
        <p><label>Seat: <input type="number" name="seat" value="<?= $movie["seat"] ?>" />
                <span class="important"><?= $errors["seat"] ?></span></label>
        </p>


        <p><button>Insert</button></p>

    </form>
</section>