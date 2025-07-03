<?php 
$username="root";
$password="";
$server="localhost";
$database="gs_db";

$conn=mysqli_connect($server,$username,$password,$database);
session_start();
   //check connection //
    if(!$conn){
        die("connection faild.". mysqli_connect_error()) ;
    } else{
     //  echo "connection pass.";
    }
?>