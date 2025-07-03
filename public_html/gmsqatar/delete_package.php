
<?php

require("connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // connect to the database
    // $conn = mysqli_connect('localhost', 'username', 'password', 'database_name');

    // Get the uid from the jobcard table
    $getidSql = "SELECT pid FROM servicepackage WHERE id = $id";
    $result = mysqli_query($conn, $getidSql);
    $row = mysqli_fetch_assoc($result);

    // Delete row with the corresponding ID from the 'jobcard' table
    $deletesql = "DELETE FROM servicepackage WHERE id = $id";
    mysqli_query($conn, $deletesql);

    
    // redirect back to the page where the row was deleted from
    
    echo '<script type="text/JavaScript">';  
    echo 'alert("Product Deleted Successfully");';
    echo 'window.location= "service-package.php";';
    echo '</script>';
    exit();
}
?>