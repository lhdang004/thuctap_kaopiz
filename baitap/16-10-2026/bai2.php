<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="bai2.php" method="post">
        <table>
            <tr>
                <td>
                    <label for="">ID</label>
                </td>
                <td> <input type="text" name="id" id=""><br></td>


            </tr>
            <tr>
                <td> <label for="">Password</label>
                <td><input type="password" name="password" id=""><br></td>
            </tr>
        </table>
        <input type="submit" name="" id=""></td>
    </form>
</body>

</html>


<?php
$id = $_POST["id"];
$password = $_POST["password"];

echo"{$id}<br>";
echo"$password";



?>