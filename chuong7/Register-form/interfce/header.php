<?php
if (isset($_POST["logout"])) {
    
    header("Location: login.php");

}


?>

<header>
    <strong>Website của tôi</strong>

    <form method="post" action="">
        <button type="submit" name="logout">Logout</button>
    </form>
    <br><br>

    <h1>Xin Chao {$name}</h1>

    <nav>
        <a href="home.php">home</a>
        <a href="about.php">about</a>
    </nav>
</header>