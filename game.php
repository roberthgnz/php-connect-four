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


    <main class="container">
        <?php
        session_start();

        $board = [
            0 => ['', '', '', '', '', ''],
            1 => ['', '', '', '', '', ''],
            2 => ['', '', '', '', '', ''],
            3 => ['', '', '', '', '', ''],
            4 => ['', '', '', '', '', ''],
            5 => ['', '', '', '', '', ''],
            6 => ['', '', '', '', '', '']
        ];

        function createBoard($board)
        {
            echo "<form class='board' method='post'>";
            for ($i = 0; $i < count($board); $i++) {
                echo "<div class='col'>";
                for ($j = 0; $j < count($board[$i]); $j++) {
                    if ($j == 0) echo "<button type='submit' name='$i'>+</button>";
                    echo "<div class='row'></div>";
                }
                echo "</div>";
            }
            echo "</form>";
        }

        if (isset($_SESSION['board']) || isset($_POST['submit'])) {
            if (!isset($_SESSION['board'])) $_SESSION['board'] = true;
            createBoard($board);
        }
        ?>

    </main>
</body>

</html>