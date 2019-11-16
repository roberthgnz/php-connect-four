<?php

function color($board, $i, $j)
{
    if (!empty($board[$i][$j])) echo $board[$i][$j];
    else echo "e";
}

function getTurn()
{
    if ($_SESSION['turn'] === 'r') {
        $_SESSION['turn'] = 'y';
        return 'r';
    }
    if ($_SESSION['turn'] === 'y') {
        $_SESSION['turn'] = 'r';
        return 'y';
    }
}

function isFullGrid($board)
{
    $full = true;
    $i = 0;
    while ($i < count($board) && $full) {
        if (count($board[$i]) < 6) $full = false;
        $i++;
    }
    return $full;
}

function winner($count)
{
    if ($count === 3) {
        getTurn();
        $_SESSION['win'] = true;
        header("location: index.php?msg=" . $_SESSION['turn']);
    }
}


function getHorizontalWinner($cols, $row)
{
    $auxArr = [];
    $count = 0;

    for ($i = 0; $i < $cols; $i++) {
        if (!empty($_SESSION['board'][$i][$row])) $auxArr[] = $_SESSION['board'][$i][$row];
        else $auxArr[] = ' ';
    }

    for ($i = 0; $i < count($auxArr); $i++) {
        $auxI = $i + 1;
        if ($auxI < 6) {
            if ($auxArr[$i] === $auxArr[$auxI] && $auxArr[$i] !== ' ') $count++;
        }
    }

    winner($count);
}

function getVerticalWinner($rows, $col)
{
    $count = 0;
    for ($i = 5; $i >= 0; $i--) {
        if (!empty($_SESSION['board'][$col][$i])) {
            $auxI = $i + 1;
            if ($auxI < $rows) if ($_SESSION['board'][$col][$auxI] == $_SESSION['board'][$col][$i]) $count++;
        }
    }
    winner($count);
}
