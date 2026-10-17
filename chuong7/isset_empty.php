<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="isset_empty.php" method="post">
        <label for="">Nhap : </label>
        <input type="text" name="a" id="">
        <input type="submit" name="" id="">

    </form>



</body>

</html>



<?php
// isset tra ve fales khi null hoac chua khai bao
//empty tra ve true khi : chua gui gu lieu , nhap"0" hoac nhap""
// $username = "HomieCode";

// echo isset($username) ."<br>";


// if( isset($username)){
//     echo "".$username.""."<br>";
// } else {
//     echo "No Name" ."<br>";
// }

// $a= false;

// if( isset($a)){
//     echo "true"."<br>";
// } else {
//     echo "false"."<br>";
// }

$a = $_POST["a"];
    echo "isset kiểm tra dữ liệu có tồn tại không. "."<br>";
    echo "empty kiểm tra dữ liệu có rỗng không. "."<br>";
    echo "$a"."<br>";
if( isset($a)){
    echo"isset true" ."<br>";
}else{
    echo"isset false" ."<br>";
}
if (empty($a)) {
    echo"empty true" ."<br>";
} else {
    echo"empty false" ."<br>";
}



?> -->


<form action="isset_empty.php" method="post">
    <label for="">Username</label>
    <input type="text" name="username" id=""><br>
    <label for="">Password</label>
    <input type="password" name="password" id=""><br>
    <input type="submit" name="Login" value="log in">
</form>

<?php


if (isset($_POST["Login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if( empty($username) || empty($password) ){
        echo "Vui long nhap tai khoan / mat khau"."<br>";
    }else{
        echo "Hello {$username}"."<br>";
    }
}

    // foreach($_POST as $key => $value){
    // echo "{$key} => {$value}"."<br>";
    // }

?>