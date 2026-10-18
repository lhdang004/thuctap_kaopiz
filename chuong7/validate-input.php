<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="validate-input.php" method="post">
        <label for="">Username</label><br>
        <input type="text" name="username" id=""><br>
        <label for="">age</label><br>
        <input type="text" name="age" id=""><br>
        <label for="">email</label><br>
        <input type="text" name="email" id=""><br>
        <input type="submit" name="Login" value="log in">
    </form>
</body>

</html>

<?php
if (isset($_POST["Login"])) {
$username = filter_input(INPUT_POST,"username"
                , FILTER_SANITIZE_STRING);
    $age = filter_input(
        INPUT_POST,"age"
        ,FILTER_VALIDATE_INT);
    // $email = filter_input(
    //     INPUT_POST,
    //     "email"
    //     ,
    //     FILTER_SANITIZE_EMAIL
    // );    
    $email= filter_input(
    INPUT_POST , "email",
    FILTER_VALIDATE_EMAIL);

    


    
//filter_input(): Lấy và lọc dữ liệu đầu vào.
// INPUT_POST: Lấy dữ liệu gửi bằng phương thức POST.
// "username": Tên trường trong form HTML.
// FILTER_SANITIZE_STRING: Bộ lọc cũ, đã bị loại bỏ từ PHP 8.1.
    echo "Hello : {$username}" ."<br>";
    if(empty($age)){
        echo"Tuoi khong hop  ly"."<br>";

    }else{
        echo"Tuoi cua ban la $age"."<br>";
    }
    if(empty($email)){
        echo"email khong hop  ly"."<br>";

    }else{
        echo"Email cua ban la $email"."<br>";
    }

}


?>