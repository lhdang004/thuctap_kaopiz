<?php
include("../database.php");
 
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
    <form action="login.php" method="post">
        <label for="">Username</label>
        <input type="text" name="username" id=""><br>
        <label for="">Password</label>
        <input type="password" name="password" id=""><br>
        <input type="submit" name="submit" id="">
        <button type="submit" name="register">register</button>
    </form>
</body>

</html>


<?php
if(isset($_POST["register"])){
    header("Location: register.php");
}
if(isset($_POST["submit"])){

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $check = false;

        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
        if($row["username"] == $username && password_verify($password , $row["password"]))    {
            $_SESSION["name"] = $row["username"];
            header("Location: home.php");
            $check = true;
        }
        }
        if (!$check) {
            echo"Sai tai khoan , Mat khau";
        }


    }else{
        echo"Vui long nhap tai khoan , mat khau";
    }

}


?>