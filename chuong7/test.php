<?php // valiable and data type ( bien va kieu du lieu)
    //string: chuoi
    $name = "Homie Kong";
    $food = "pizza";
    $email = "homie@gmail.com";

     //int : so tu hien
    $age = 21;
    $user = 2;
    $quantity = 4;

    //float : so nguyen
$gpa = 2.5;
$price = 4.4;
$tax_rate = 5.1;

//boolen: true / false
//true : echo ra 1
//false : echo k in ra
$employ = true;
$online1 = false;
$online2 = true;
$for_sale = true;

$total = null;

    echo $name;
    echo "<br>";
    echo"Hello {$name}<br>";
    echo "You like {$food}<br>";
    echo "Your email is {$email}<br>";

    echo "you are {$age} year old";
    echo "<br>";
    echo "There are {$user} online";
    echo "<br>";
    echo "You would like to buy {$quantity} item";
    
    echo "<br>";

    echo "your gpa {$gpa} <br>";
echo "Your {$food} is price \${$price} <br> ";
echo "The sale tax rate is: {$tax_rate}%<br>";

echo "Online1 status : {$online1} <br>";
echo "Online2 status : {$online2} <br>";


echo "You have order {$quantity} x {$food} <br>";
$total = $quantity * $price;
echo "Total : \${$total} <br>";
$tax = $total * ($tax_rate / 100);
echo "Your tax is : {$tax}";
echo "";
echo "<br>";
?>

<?php //arithmetic ( phep tinh so)
$x = 7;
$y = 2;
echo "x : {$x}<br>";
echo "y : {$y}<br>";
$z = null;

$z = $x + $y;

echo "plus (+) : {$z}<br>";

$z = $x - $y;
echo "subtrat (-) : {$z} <br>";

$z = $x * $y;
echo "Mutipcaltion (*) : {$z}<br>";

$z = $x / $y;
echo "Division (/) : {$z}<br>";

$z = $x ** $y;//lũy thừa

echo "luy thua (/) : {$z}<br>";

$z = $x % $y;// chia lay phan du
echo "chia lay phan du (/) : {$z}<br>";
echo "";
echo "<br>";
?>

<?php 
 $counter = 0;
 //$counter++;
 //$counter--;
 $counter-=3;
 echo "counter  : {$counter} ";
?>


