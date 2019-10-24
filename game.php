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
            0 => ['', '', '', 'y', 'r', 'r'],
            1 => ['', '', '', '', '', ''],
            2 => ['', '', '', '', '', ''],
            3 => ['', '', '', 'y', '', ''],
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
                    $color = getColor($board[$i][$j]);
                    if ($j == 0) echo "<button type='submit' name='$i'>+</button>";
                    echo "<div class='row $color'></div>";
                }
                echo "</div>";
            }
            echo "</form>";
        }

        function getColor($color)
        {
            switch ($color) {
                case 'r':
                    return 'red';
                case 'y':
                    return 'yellow';
            }
        }

        if (isset($_SESSION['start']) || isset($_POST['submit'])) {
            if (!isset($_SESSION['start'])) $_SESSION['start'] = true;
            createBoard($board);


            $key = array_keys($_POST)[0];
            if (array_key_exists($key, $board)) {
                for ($i = 0; $i < count($board[$key]); $i++) {
                    echo $board[$key][$i];
                }
            }
        } else {
            header('location: index.php');
        }

        ?>

    </main>
</body>

</html>