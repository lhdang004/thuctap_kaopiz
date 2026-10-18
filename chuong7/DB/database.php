<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "food-db";
$conn = "";


try{
    $conn = mysqli_connect($db_server, $db_user, $db_pass ,$db_name);
    echo"Da ket noi voi database";
} catch (mysqli_sql_exception) {
    echo "Khong ket noi duoc voi database";
}



?>