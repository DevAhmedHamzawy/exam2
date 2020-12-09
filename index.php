<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 

        session_start();
        if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }
        $token = $_SESSION['token'];

    ?>

    <form action="init.php" method="post">
        <input type="hidden" name="token" value="<?php echo $token ?>" />
        <input type="email" name="email" id="email" placeholder="email">
        <input type="submit" value="submit">
    </form>
</body>
</html>