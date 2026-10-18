<?php
   include("../database.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="register.php" method="post">
        <label for="">Name</label>
        <input type="text" name="name" id=""><br>
        <label for="">Username</label>
        <input type="text" name="username" id=""><br>
        <label for="">Password</label>
        <input type="password" name="password" id=""><br>
        <input type="submit" name="submit" id="">
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>

<?php

if(isset($_POST["login"])){
    header("Location: login.php");
}
if (isset($_POST["submit"])) {
    if (
        !empty($_POST["name"]) &&
        !empty($_POST["username"]) &&
        !empty($_POST["password"])
    ) {
        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $hash = password_hash($password, PASSWORD_DEFAULT);

      
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);

        $exists = false;

        while ($row = mysqli_fetch_array($result)) {
            if ($row["username"] == $username) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            echo "Tai khoan da ton tai";
        } else {
            $sql = "INSERT INTO users (name, username, password)
                    VALUES ('$name', '$username', '$hash')";

            mysqli_query($conn, $sql);
            echo "Dang ky thanh cong";
        }
    } else {
        echo "Vui long nhap ten, tai khoan, mat khau";
    }

    mysqli_close($conn);
}

?>