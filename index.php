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

        if ($_GET['msg']) {
            if ($_GET['msg'] == 'y') {
                echo "<h1>Yellow player wins!</h1>";
            }
            if ($_GET['msg'] == 'r') {
                echo "<h1>Red player wins!</h1>";
            }
        }

        if (isset($_SESSION['start'])) {
            header('location: game.php');
        } else {
            echo '<form class="start" action="game.php" method="post">
                    <input type="submit" name="submit" value="Start Game">
                  </form>';
        }
        ?>
    </main>
</body>

</html>