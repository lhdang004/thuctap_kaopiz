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
    <h1>This is home page</h1>
    <form action="home.php" method="post">
        <input type="submit" name="logout" value="logout" id="">
    </form>
    <style>
    :root {
        display: flex;
        justify-content: center;
    }
    </style>
</body>

</html>
<?php

    echo $_SESSION["username"] ."<br>";
    echo $_SESSION["password"] ."<br>";

if(isset($_POST["logout"])){
    //session_destroy();

    // $_SESSION["username"] = null;
    // $_SESSION["password"] = null;

    header("Location: index.php");
}

?>