<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="">Grade</label>
        <input type="float" name="grade">
        <input type="submit">
    </form>
</body>

</html>

<?php

$grade = $_POST["grade"];
if($grade >= 0 && $grade <= 10){
    $grade = $_POST["grade"];
    echo"Diem cua ban : {$grade}";
    echo"<br>";

    $xeploai = null;
    if ($grade >= 0 && $grade < 4) {
        $xeploai = "F" ;
    } 
        elseif ($grade >= 4 && $grade < 5) {
        $xeploai = "D";
    } 
        elseif ($grade >= 5 && $grade < 6.5) {
        $xeploai = "C";
    }
        elseif ($grade >= 6.5 && $grade < 8) {
        $xeploai = "B";
    }
        else{
        $xeploai = "A";
    }
            echo"<br>";

            echo " Diem : {$grade} ";
            echo"<br>";
            echo"Xep loai {$xeploai}";
echo "<br>";
    switch ($xeploai) { // switch (a){ case (b)} : so sanh b voi a xem giong nhau khong thi thuc hien lenh o case do
    case "A":
        echo "Diem A";
        break; // dung break de khong chay dung case duoi khi bang case 1
    case "B":
        echo "Diem B";
        break;
    case "C":
        echo "Diem C";
        break;
    case "D":
        echo "Diem D";
        break;
    case "F":
        echo "Diem F";
        break;
    default:
        echo "Fail";
        break;
    }


}
else{
    $grade = null;
    echo"Nhap lai diem";
    echo"$grade";
}


?>