<?php
require('adminFunction.php');
/////////////////signup admin////////////////////////
sleep(2);
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $pw=md5($_POST['pw']);
    
    $sql = "INSERT INTO `admin`(`name`,`mobile`,`email`,`pw`) 
    VALUES ('$name','$mobile','$email','$pw')";
    if (mysqli_query($conn, $sql)) {
        header("Location:register.php");
    }





?>