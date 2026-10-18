<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="post">
        <label for="">Username : </label>
        <input type="text" name="username" id=""><br>
        <label for="">Password : </label>
        <input type="password" name="password" id=""><br>
        <input type="submit" name="login" id="">
    </form>
</body>

</html>

<?php 
        echo $_SESSION["username"] ."<br>";
    echo $_SESSION["password"] ."<br>";

    if(isset($_POST["login"])){
       
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $_SESSION["username"] = $_POST["username"] ;
        $_SESSION["password"] = $_POST["password"] ;



        header("Location: home.php");
    }else{
        echo "Nhap tai khoan/mat khau";
    }

    }

?>