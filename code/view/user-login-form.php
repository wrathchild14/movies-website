<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<section id="main">
    <title>Login form</title>

    <h1>Please log in</h1>

    <?php include("view/menu-links.php"); ?>

    <?php if (!empty($errorMessage)) : ?>
        <p class="important"><?= $errorMessage ?></p>
    <?php endif; ?>

    <form action="<?= BASE_URL . "user/login" ?>" method="post">
        <p>
            <label>Username: <input type="text" name="username" autocomplete="off" required autofocus /></label><br />
            <label>Password: 
                <br></br>
                <input type="password" name="password" required /></label>
        </p>
        <p><button>Log-in</button></p>
    </form>
    
    <div class="showing-box-text">
    <a href="<?= BASE_URL . "user/register" ?>">Register</a>
    </div>
</section>