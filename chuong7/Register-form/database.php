<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "users-db";
    $conn = "";

try{
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    echo "Connect Database";
}catch(mysqli_sql_exception){
    echo "Can't connect database";
}

?>