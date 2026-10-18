<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="">Username : </label>
        <input type="text" name="username" id=""><br>
        <input type="submit">
    </form>
</body>

</html>

<?php
/*
foreach ($_SERVER as $key => $value) {
    echo "{$key}"."{$value}"."<br>";

} 
*/
?>