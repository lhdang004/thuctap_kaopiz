<form action="hasing.php" method="post">
    <label for="">password : </label>
    <input type="text" name="password" id=""><br>
    <input type="submit">
</form>


<?php
$password = $_POST["password"];
$hash = password_hash($password, PASSWORD_DEFAULT);

echo"$hash" ."<br>";

if(password_verify("123", $hash)){
    echo "Mat khau dung";

}else{
    echo "Mat khau Sai";
}
?>