<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Win</title>
</head>

<body>
    <?php
    session_start();
    echo "<h1>" . $_SESSION['turn'] . "'s win!</h1>";
    ?>
</body>

</html>