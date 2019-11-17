<?php
include './functions.php';

session_start();

$cols = 7;
$rows = 6;
global $r;
global $c;

// Crear la sesión si aún no existe
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = [
        0 => [],
        1 => [],
        2 => [],
        3 => [],
        4 => [],
        5 => [],
        6 => [],
    ];
}

if (isset($_POST['start']))  $_SESSION['start'] = true;

// Definir el primer turno
if (!isset($_SESSION['turn'])) $_SESSION['turn'] = 'r';

if (isset($_GET['col'])) {
    $col = $_GET['col'];
    $c = $col;
    $length = count($_SESSION['board'][$col]);
    // Comprobar que no se pasa el límite de las filas
    if ($length < $rows) {
        /* Agregar items al array de atras hacia delante
        ** o sea, empenzado en el índice 5. $row = 5 - $length
        ** 5 - 0 = 5
        ** 5 - 1 = 4
        ** 5 - 2 = 3
        ** etc
        */
        $row = 5 - $length;
        $r = $row;
        $_SESSION['board'][$col][$row] = getTurn();

        // Horizontal winner
        getHorizontalWinner($cols, $row);

        // Vertical winner
        getVerticalWinner($rows, $col);

        // Diagonal winner
        getDiagonalWinner($col, $row);

        // Comprobar si hay empate
        if (isFullGrid($_SESSION['board'])) {
            session_destroy();
            header('location: index.php?msg=' . 'e');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php if (isset($_SESSION['start'])) { ?>
        <form action="" class="board">
            <?php for ($i = 0; $i < $cols; $i++) : ?>
                <div class="col">
                    <?php for ($j = 0; $j < $rows; $j++) :
                                if ($j == 0) echo "<button type='submit' name='col' value='$i'>+</button>";
                                ?>
                        <div class="row <?php color($_SESSION['board'], $i, $j);
                                                    isNew($_SESSION['board'], $i, $j, $r, $c); ?>"><span></span></div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </form>
    <?php } else {
        session_destroy();
        header('location: index.php');
    } ?>
    <script src="assets/js/index.js"></script>
</body>

</html>