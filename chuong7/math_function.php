
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
        <label for="">z :</label>
        <input type="text" name="z" id=""><br>
        <label for="">t :</label>
        <input type="text" name="t" id=""><br>
        <input type="submit" name="" id="" value="total">
    </form>




</body>

</html> -->

<?php 

// $x = $_POST["x"];
// $y = $_POST["y"];
// $z = $_POST["z"];
// $t = $_POST["t"];
// $total = null;

// $total = abs($x); //gia tri tuyet doi
// $total = round($x); // lam tron
// $total = floor($x); // lam tron xuong
// $total = ceil($x); // lam tron len
// $total = pow($x, $y); // x ^y
//$total = sqrt($x);// can bac 2
//$total = max($x, $y ,$z ,$t); //tim so max
//$total = min($x, $y ,$z ,$t);
//$total = pi(); // so pi
//$total = rand(1,10);// ham lay so ngau nhien


// echo "x : {$x}<br>";
// echo "y : {$y}<br>";
// echo "z : {$z}<br>";
// echo "t : {$t}<br>";
// echo "total :  {$total} ";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="math_function.php" method="post">
        <h1>Bai tap : nguoi dung nhap ban kinh , tinh chu vu va the tich</h1>
        <label for="">Nhập bán kính</label>
        <input type="number" name="r">
        <input type="submit"><br>

    </form>
    <a href="post_get.php" target="_blank">post</a><br>
</body>

</html>

<?php 
$r = $_POST["r"];
$C = null;
$S = null;
$V = null;
$pi = pi();

$C = 2 * $r * $pi;
$S = pow($r, 2) * $pi;
$V = 4 /3 * pow($r, 3) * $pi;

echo"Bán kính {$r}<br>";
echo "Chu Vi {$C}<br>";
echo "Diện tích {$S}<br>";
echo "Thể Tích {$V}<br>";

?>