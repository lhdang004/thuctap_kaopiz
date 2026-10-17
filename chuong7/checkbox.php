<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="checkbox.php" method="post">
        <input type="checkbox" name="food[]" value="pizza" id="">pizza<br>
        <input type="checkbox" name="food[]" value="buger" id="">buger<br>
        <input type="checkbox" name="food[]" value="chicken" id="">chicken<br>
        <input type="checkbox" name="food[]" value="pho" id="">pho<br>
        <input type="submit" name="submit" value="submit" id="">


    </form>
</body>

</html>




<?php

if (isset($_POST["submit"])) {

    $food = null;
    if (isset($_POST["food"])) {
        $foods = $_POST["food"];
        foreach ($foods as $food) {
            echo "$foods" . "<br>";
        }
    }
    else{
        echo "chon mon an <br>";
    }
}



?>