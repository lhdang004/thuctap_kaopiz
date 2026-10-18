<?php
setcookie("fav-food", "Banh-mi", time() - 0 , "/");
setcookie("fav-drink", "Stinh", time() + (86400 * 2), "/");
setcookie("fav-dessert", "Chan-ga-nuong", time() + (86400 * 3), "/");


/*
foreach($_COOKIE as $key => $value){
    echo "{$key} = {$value}<br>";
}
  */
if(isset($_COOKIE["fav-food"])){
    echo "Your favorite food : {$_COOKIE["fav-food"]}";

} else {
    echo "I don't know your favorite food";
}
?>