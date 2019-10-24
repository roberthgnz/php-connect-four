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

        if (!isset($_SESSION['turn'])) $_SESSION['turn'] = 'red';

        $board = [
            0 => ['', '', '', '', '', ''],
            1 => ['', '', '', '', '', ''],
            2 => ['', '', '', '', '', ''],
            3 => ['', '', '', '', '', ''],
            4 => ['', '', '', '', '', ''],
            5 => ['', '', '', '', '', ''],
            6 => ['', '', '', '', '', '']
        ];

        if (!isset($_SESSION['board'])) $_SESSION['board'] = $board;

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

        function getTurn()
        {
            if ($_SESSION['turn'] === 'red') {
                $_SESSION['turn'] = 'yellow';
                return 'r';
            }
            if ($_SESSION['turn'] === 'yellow') {
                $_SESSION['turn'] = 'red';
                return 'y';
            }
        }

        if (isset($_SESSION['start']) || isset($_POST['submit'])) {
            if (!isset($_SESSION['start'])) $_SESSION['start'] = true;


            if (!isset($_SESSION['turn'])) $_SESSION['turn'] = 'red';

            if (isset($_SESSION['board'])) createBoard($_SESSION['board']);
            else  createBoard($board);

            function getLastPosition($key, $board)
            {
                $i = 0;
                $isLastItem = false;
                while ($i < count($board[$key]) && !$isLastItem) {
                    $i++;
                    if ($board[$key][$i] !== '') $isLastItem = true;
                }
                return --$i;
            }

            $key = array_keys($_POST)[0];
            if (array_key_exists($key, $board)) {
                if (isset($_SESSION['board']) && $_SESSION['board'][$key][0] === '') {
                    $lastPosition = getLastPosition($key, $_SESSION['board']);
                    $_SESSION['board'][$key][$lastPosition] = getTurn();
                    createBoard($_SESSION['board']);
                }
            }
        } else {
            header('location: index.php');
        }

        ?>

    </main>
</body>

</html>