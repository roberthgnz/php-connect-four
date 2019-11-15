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

        if (!isset($_SESSION['board'])) {
            $_SESSION['board'] =  [
                0 => ['', '', '', '', '', ''],
                1 => ['', '', '', '', '', ''],
                2 => ['', '', '', '', '', ''],
                3 => ['', '', '', '', '', ''],
                4 => ['', '', '', '', '', ''],
                5 => ['', '', '', '', '', ''],
                6 => ['', '', '', '', '', '']
            ];
        }

        if (!isset($_SESSION['turn'])) $_SESSION['turn'] = 'red';

        function createBoard()
        {
            echo "<form class='board' method='post'>";
            for ($i = 0; $i < count($_SESSION['board']); $i++) {
                echo "<div class='col'>";
                for ($j = 0; $j < count($_SESSION['board'][$i]); $j++) {
                    $color = getColor($_SESSION['board'][$i][$j]);
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

        function isFullGrid()
        {
            $full = true;
            $i = 0;
            while ($i++ < count($_SESSION['board']) && $full) {
                for ($j = 0; $j < count($_SESSION['board'][$i]); $j++) {
                    if ($_SESSION['board'][$i][$j] === '') $full = false;
                }
            }
            return $full;
        }

        function winner($count)
        {
            if ($count > 2) {
                getTurn();
                header('location: win.php');
            }
        }

        if (isset($_SESSION['start']) || isset($_POST['submit'])) {

            if (!isset($_SESSION['start'])) $_SESSION['start'] = true;

            if (isset($_SESSION['board'])) createBoard($_SESSION['board']);

            function getLastPosition($arr)
            {
                // $i = 0;
                // $isLastItem = false;
                // while (count($_SESSION['board'][$key]) >= $i && !$isLastItem) {
                //     if ($_SESSION['board'][$key][$i] !== '') $isLastItem = true;
                //     $i--;
                // }
                // $i = ($i * -1);
                // return $i;
                $lastR = array_search('r', $arr);
                $lastY = array_search('y', $arr);
                $last = $lastR > $lastY ? $lastY : $lastR;
                return empty($last) ? count($arr) - 1 : $last;
            }

            $key = array_keys($_POST)[0];
            if (array_key_exists($key, $_SESSION['board'])) {
                if (isset($_SESSION['board']) && $_SESSION['board'][$key][0] === '') {

                    $lastPosition = getLastPosition($_SESSION['board'][$key]);

                    echo $lastPosition;

                    $_SESSION['board'][$key][$lastPosition] = getTurn();

                    createBoard($_SESSION['board']);

                    $count = 0;
                    $lastIsSame = false;

                    // Vertical winner
                    for ($i = 0; $i < count($_SESSION['board']); $i++) {
                        for ($j = 0; $j <  count($_SESSION['board'][$i]); $j++) {
                            if ($j > 0) if ($_SESSION['board'][$i][$j] == $_SESSION['board'][$i][$j - 1] && $_SESSION['board'][$i][$j] != "")   $count++;
                            else $count = 0;
                            winner($count);
                        };
                    }

                    // // Horizontal winner
                    for ($i = 0; $i < count($_SESSION['board']); $i++) {
                        for ($j = 0; $j <  count($_SESSION['board'][$i]); $j++) {
                            if ($j > 0 && $i < 6) if ($_SESSION['board'][$j][$i] == $_SESSION['board'][$j - 1][$i] && $_SESSION['board'][$j][$i] != "")   $count++;
                            else $count = 0;
                            winner($count);
                        };
                    }

                    // Check if it's draw
                    if (isFullGrid()) header('location: win.php');
                }
            }
        } else {
            header('location: index.php');
        }

        ?>

    </main>
</body>

</html>