<?php
include './functions.php';

session_start();

$cols = 7;
$rows = 6;

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

// Definir el primer turno
if (!isset($_SESSION['turn'])) $_SESSION['turn'] = 'r';

if (isset($_GET['col'])) {
    $col = $_GET['col'];
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
        $_SESSION['board'][$col][$row] = getTurn();
    }
    // Comprobar si hay empate
    if (isFullGrid($_SESSION['board'])) header('location: index.php');

    $count = 0;

    // Horizontal winner
    for ($i = 5; $i >= 0; $i--) {
        if (!empty($_SESSION['board'][$col][$i])) {
            $auxI = $i + 1;
            if ($auxI < 6) if ($_SESSION['board'][$col][$auxI] == $_SESSION['board'][$col][$i]) $count++;
        }
    }

    if ($count == 3) echo "Ganador " . winner($count);
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
    <form action="" class="board">
        <?php for ($i = 0; $i < $cols; $i++) : ?>
            <div class="col">
                <?php for ($j = 0; $j < $rows; $j++) :
                        if ($j == 0) echo "<button type='submit' name='col' value='$i'>+</button>";
                        ?>
                    <div class="row <?php color($_SESSION['board'], $i, $j); ?>"></div>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </form>
</body>

</html>