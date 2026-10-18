<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="post">
        <label for="">Username : </label><br>
        <input type="text" name="username" id=""><br>
        <label for="">Password : </label><br>
        <input type="password" name="password" id=""><br>
        <input type="submit" name="submit" id="">
    </form>
</body>

</html>

<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        include("database.php");
        echo "<br><br>";



        $sql = "INSERT INTO users (user, password)
            VALUES ('$username','$hash' )";


        try {
            mysqli_query($conn, $sql);
            echo "Da dang ky";
        } catch (mysqli_sql_exception) {
            echo "Khong the dang ky";

        }
        ;

        mysqli_close($conn);

    } else {
        echo "Vui long nhap tai khoan , mat khau";
    }
}
?>





<?php
include("database.php");

        echo "<br><br>";
$sql = "SELECT * FROM users WHERE user = 'dang' ";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows ($result) > 0) {
    $row = mysqli_fetch_array($result);
    echo $row["id"] . "<br>";
    echo $row["user"] ."<br>";
    echo $row["password"] ."<br>";
    echo $row["reg_date"] ."<br>";

}else{
    echo "Khong co tai khoan.";
}



$sql = "SELECT * FROM users";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array(($result))){
        echo $row["id"] . "<br>";
        echo $row["user"] ."<br>";
        echo $row["password"] ."<br>";
    };

}

mysqli_close($conn);



?>