<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="radio-btn.php" method="post">
        <input type="radio" name="card" value="visa" id="">
        visa<br>
        <input type="radio" name="card" value="ngan-hang" id="">
        ngan-hang<br>
        <input type="radio" name="card" value="ca-nhan" id="">
        ca-nhan<br>
        <input type="submit" name="confirm" value="confirm" id="">
    </form>

</body>

</html>

<?php
if (isset($_POST["confirm"])) {

    $card = null;
    if (isset($_POST["card"])) {
        $card = $_POST["card"];
        // echo"$card" ."<br>";
    }
        switch ($card) {
        case "visa":
            echo "Da chon the visa";
            break;
        case "ngan-hang":
            echo "Da chon the ngan hang";
            break;
        case "ca-nhan":
            echo "Da chon the ca nhan";
            break;
        default:
            echo "hay chon the";
        }
    }
    





?>