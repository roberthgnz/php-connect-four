<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connect 4</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>


    <main class="main">
        <?php
        session_start();

        if (isset($_SESSION['start'])) {
            header('location: game.php');
        } else {
            echo '<form action="game.php" method="post">
                    <input type="submit" name="submit" value="Start Game">
                  </form>';
        }

        ?>

    </main>
</body>

</html>