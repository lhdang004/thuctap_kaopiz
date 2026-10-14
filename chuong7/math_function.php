<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="math_function.php" method="post">
        <label for="">x :</label>
        <input type="text" name="x" id=""><br>
        <label for="">y :</label>
        <input type="text" name="y" id=""><br>
        <input type="submit" name="" id="" value="total">
    </form>
</body>

</html>

<?php 

$x = $_POST["x"];
$y = $_POST["y"];
$total = null;

// $total = abs($x); //gia tri tuyet doi
// $total = round($x); // lam tron
// $total = floor($x); // lam tron xuong
// $total = ceil($x); // lam tron len
// $total = pow($x, $y); // x ^y
$total = sqrt($x);// can bac 2

echo "{$x}<br>";
echo "{$y}<br>";
echo " {$total} ";
?>