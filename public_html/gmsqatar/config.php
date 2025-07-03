<?php 
$username="root";
$password="";
$server="localhost:3307";
$database="gms";

$conn=mysqli_connect($server,$username,$password,$database);
   //check connection //
    if(!$conn){
        die("connection faild.". mysqli_connect_error()) ;
    } else{
     //  echo "connection pass.";
    }
?>