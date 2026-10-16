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
        <input type="submit"><br>
        <button name="stop">stop</button>
        <button name="cong">cong</button>
    </form>
</body>

</html>

<?php

// $in = $_POST["in"];
// while ($in < 10) {
//     $in++;
//     echo"lan {$in}<br>";

// }


// $second = 0;
// $running = true;
// if(isset($_POST["stop"])){
//     while ($running) {
//     echo"{$second}<br>";
//     $second++;
//     sleep(1);
//     if(isset($_POST[""])){
//         $running = false;
//     }

// }
// }


$so = 0;

if (isset($_POST["cong"])) {
    $so++;
    echo"so lan {$so}";
} else {
    echo "bamcong";
}



?>