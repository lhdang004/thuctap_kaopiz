<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="function.php" method="post">
        <label for="">Ten : </label>
        <input type="text" name="name" id=""><br>
        <label for="">Nam Sinh : </label>
        <input type="number" name="year" id=""><br>
        <input type="submit" name="submit" id="">

    </form>
</body>

</html>


<?php



if (isset($_POST["submit"])) {
    
    if (isset($_POST["name"])) {
        if(isset($_POST["year"])){
        function happy_birthday1(){
        $name = $_POST["name"];
        $year = $_POST["year"];
            $age = 2026 - $year;
            echo "Happy birthday to {$name}" ."<br>";
            echo "Happy birthday dear you"."<br>";
            echo "Happy birthday to {$name}"."<br>";
            echo "Happy birthday dear you"."<br>";
            echo "You {$age}"."<br>";
            echo "you are born {$year} year"."<br><br>";  
            
            return ;
        }


        happy_birthday1();
        }else{
            echo "nhap nam sinh";
        }
    
    }else{
        echo"nhap ten";
    }

}

    // function happy_birthday2($name1 , $year1 ){
    //     $age = 2026 - $year1;
    //     echo "Happy birthday to {$name1}" ."<br>";
    //     echo "Happy birthday dear you"."<br>";
    //     echo "Happy birthday to {$name1}"."<br>";
    //     echo "Happy birthday dear you"."<br>";
    //     echo "You {$age}"."<br>";
    //     echo "you are born {$year1} year"."<br><br>";  
        
    //     return ;
    // }

    // happy_birthday2("Ledang" ,"2004" );
    // happy_birthday2("ManhTit" ,"2005" );
?>