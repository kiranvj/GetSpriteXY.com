<?php 
ob_start();
error_reporting(0);
require_once("generic-functions.php");
$ip=$_SERVER['REMOTE_ADDR'];

$env = "prod"; //local or prod

if($env == "local") {
    $db = "spritexy";
    $user = "root";
    $password = "";
} else {
    $db = "";
    $user = "";
    $password = "";
}

if ($_POST) {
    
    $isSpriteCreated = isset($_POST["isSpriteCreated"]) && $_POST["isSpriteCreated"] != "" ? htmlentities($_POST["isSpriteCreated"], ENT_QUOTES) : false;
    
    $con = mysql_connect('localhost', $user, $password);
    if (!$con) {
       die('An error occured ERR:1');
    } else {
        mysql_select_db($db,$con) or die("Ooopss.... An error occured. ERR:2");
        $item = $isSpriteCreated == "true" ? "css_generate" : "sprite_upload"; 
        
        $query = "UPDATE stat SET counter = counter + 1 WHERE item = '$item'";
        $result = mysql_query($query,$con);
        if($result) {
            echo("{\"e\":\"0\"}");
        } else {
            echo("{\"e\":\"1\"}");
        }            
    }    
}
else {
   echo("I sincerely appreciate your efforts... but M3SS w1t|-| 7he b3s7 |)13 |ik3 7h3 r3s7");
   notifyAdminViaMail("$ip - HACK ATTEMPT", "hack attempt");
}
?>