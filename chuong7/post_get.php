<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <form action="index.php" method="post">
        <label for="username">username : </label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">password</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Log in"><br>
    </form> -->

    <form action="post_get.php" method="post">
        <label for="">quantity</label><br>
        <input type="number" name="quantity"><br>
        <label for="">foot</label><br>
        <select name="food" id="">
            <option value="pizza">pizza</option>
            <option value="burger">burger</option>
            <option value="chicken">chicken</option>
        </select><br>
        <input type="submit">

    </form>
</body>

</html>

<?php
//echo "{$_POST["username"]} <br>"; //lay cua phan co name = username
//echo "{$_POST["password"]} <br>";
$quantity = $_POST["quantity"];
$food = $_POST["food"];
$price = 5;
$total = null;
$total = $quantity * $price;


echo "You have order {$quantity} x {$food}<br>";
echo "Price : {$total} <br>";



?>