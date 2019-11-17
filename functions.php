<?php

function color($board, $i, $j)
{
    if (!empty($board[$i][$j])) echo $board[$i][$j];
    else echo "e";
}


// Agregar clase 'new' para hacer la animación
function isNew($board, $i, $j, $r, $c)
{
    if (!empty($board[$i][$j])) {
        if ($i == $c && $j == $r) echo " new";
    }
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
        session_destroy();
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

function getDiagonalWinner($col, $row)
{
    $auxArr = [];
    $countTR = 0;
    $countTL = 0;

    for ($i = 0; $i < 7; $i++) {
        for ($j = 0; $j < 6; $j++) {
            if (!empty($_SESSION['board'][$i][$j])) {
                $auxArr[$i][$j] = $_SESSION['board'][$i][$j];
            } else $auxArr[$i][$j] = ' ';
        }
    }

    $i = 0;
    while ($i < 4) {
        $auxColTR = $col + $i;
        $auxColTL = $col - $i;
        $auxRow = $row + $i;
        // Top - right
        if (($auxColTR + 1) < 7 && ($auxRow + 1) < 6) {
            if ($auxArr[$auxColTR][$auxRow] == $auxArr[$auxColTR + 1][$auxRow + 1]) $countTR++;
        }
        // Top - left
        if (($auxColTL - 1) > -1 && ($auxRow + 1) < 6) {
            if ($auxArr[$auxColTL][$auxRow] == $auxArr[$auxColTL - 1][$auxRow + 1]) $countTL++;
        }
        $i++;
    }
    winner($countTR);
    winner($countTL);
}
