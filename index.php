<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connect Four</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>


<main class="container">
    <?php
    session_start();

    function createTable()
    {
        echo "<div class='table'>";
        $x = 7;
        $y = 6;
        for ($i = 0; $i < $x; $i++) {
            echo "<div class='col'>";
            for ($j = 0; $j < $y; $j++) {
                if ($j == 0) echo "<button>+</button>";
                echo "<div class='row'></div>";
            }
            echo "</div>";
        }
        echo "</div>";
    }

    // Start new game
    if (isset($_REQUEST["submit"]) || isset($_SESSION['table'])) {
        createTable();
    } else {
        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                <input type="submit" name="submit" value="Start Game">
              </form>';
    }

    ?>

</main>
</body>
</html>