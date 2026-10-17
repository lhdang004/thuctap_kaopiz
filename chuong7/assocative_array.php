<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="assocative_array.php" method="post">
        <label for="">Your capital</label>
        <select name="country" id="country">
            <option name="USA">USA</option>
            <option name="Japan">Japan</option>
            <option name="China">China</option>
            <option name="Korea">Korea</option>
        </select>
        <input type="submit" name="" id="">
    </form>
</body>

</html>


<?php //mang ket hop
$ten = "dang";
$ho = "LE hai";
echo "{$ten} ";
$capitals = array("USA" => "Wasington D.C",
                "Japan" => "Tokyo", 
                "China" => "BacKinh", 
                "Korea" => "Seul");

$capital = $capitals[$_POST["country"]];

    echo "{$capital}";

// echo("{$capitals["USA"]}<br>"); // goi bien key => in ra value
//     // $capitals["USA"] = "Las Vegas";// doi value cuar key
//    $capitals["ThaiLan"] = "bangkoch";// tao key => value moi
//     // // array_pop($capitals); // xoa cuoi chuoi
//     // array_shift($capitals); // xoa dau chuoi
//     // $capitals = array_reverse($capitals); // dao chuoi
//     echo count($capitals) ."<br>";
//     // $capitals = array_flip($capitals); // lat key => value
     
//     foreach( $capitals as $key => $value ){
//             echo("{$key} => {$value} <br>");

//     }

//     // $keys = array_keys($capitals);
//     // foreach( $keys as $key ){
//     //     echo("{$key} <br>"); 
        
//     //     };
//     // $values = array_values($capitals);
//     // foreach( $values as $value ){
//     //     echo("{$value} <br>"); 
        
//     //     };

?>


<?php
$ten = "dang";
echo "le hai" . "{$ten}" ;


?>