<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="">Nhap so lan in</label>
        <input type="number" name="in">
        <input type="submit">
    </form>
</body>

</html>

<?php

$in = $_POST["in"];
for ($i = 1; $i <= $in; $i++) {
    echo"tang {$i} <br>";
}
for ($i = $in; $i > 0; $i--) {
    echo"giam {$i} <br>";
}

?>