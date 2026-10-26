<?php

session_start();
if (isset($_SESSION["name"])) {
    echo "Xin chào, " . ($_SESSION["name"]);
}
if (isset($_POST["logout"])) {
    
    header("Location: login.php");

    session_destroy();
    session_unset();

}

?>

<header>
    <strong>Website của tôi</strong>

    <form method="post" action="">
        <button type="submit" name="logout">Logout</button>
    </form>
    <br><br>



    <nav>
        <a href="home.php">home</a>
        <a href="about.php">about</a>
    </nav>
</header>