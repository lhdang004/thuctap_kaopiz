<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="">Input your hours</label>
        <input type="number" name="hours"><br>
        <label for="">Input your rate</label>
        <input type="number" name="rate"><br>
        <input type="submit">
    </form>
</body>

</html>

<?php

// $age = $_POST["age"];

// echo"{$age}<br>";
// if ($age >= 18) {
//     echo "You may enter website";
// }
// elseif($age ==0){
//     echo "You were just born ?? are u kidding me?";
// } elseif ($age <= 0) {
//     echo "That was'n a vailidate";
// } elseif ($age >= 100) {
//     echo "too old";
// }
// else{
//     echo "You must be 18+ enter";
// }
// $adult = $_POST["adult"]; 


// if ($adult) {
//     echo"you may enter website";
// }
// else{
//     echo "you must be adult enter";
// }

$hours = $_POST["hours"];
$rate = $_POST["rate"];
$money = null;
if ($hours <= 0) {
    $money = 0;
    echo "khong co luong {$money}";
}
elseif ($hours <= 40) {
    $money = $hours * $rate;
    echo "gio lam {$hours} <=40 , luong \${$money} ";
}
else{
    $money = ($rate * 40) + ($rate *($hours - 40) * 1.5);
    echo "gio lam {$hours} > 40, luong\${$money} ";
}


?>