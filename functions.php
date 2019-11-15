<?php

function color($board, $i, $j)
{
    if (!empty($board[$i][$j])) echo $board[$i][$j];
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
        header("location: index.php?msg=" . $_SESSION['turn']);
    }
}
