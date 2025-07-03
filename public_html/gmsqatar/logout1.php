<?php 
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['cart']);
    header("Location: mechanic_login.php");
    $_SESSION['msg5'] = "Logout Successfully!!";
    
?>