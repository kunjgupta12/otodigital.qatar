<?php 
$username="u560525193_garageadmin";
$password="Mer!garage2024";
$server="localhost";
$database="u560525193_GarageAdmin";

// $username="u560525193_stage_db";
// $password="p6O]680vbJ8";
// $server="localhost";
// $database="u560525193_stage_db";

date_default_timezone_set("Asia/Kolkata");

$conn=mysqli_connect($server,$username,$password,$database);
session_start();
   //check connection //
    if(!$conn){
        die("connection faild.". mysqli_connect_error()) ;
    } else{
     //  echo "connection pass.";
    }
?>
