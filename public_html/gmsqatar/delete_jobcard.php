
<?php

require("connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // connect to the database
    // $conn = mysqli_connect('localhost', 'username', 'password', 'database_name');

    // Get the uid from the jobcard table
    $getUidSql = "SELECT uid FROM jobcard WHERE id = $id";
    $result = mysqli_query($conn, $getUidSql);
    $row = mysqli_fetch_assoc($result);
    $uid = $row['uid'];

    // Delete row with the corresponding ID from the 'jobcard' table
    $deletesql = "DELETE FROM jobcard WHERE id = $id";
    mysqli_query($conn, $deletesql);

    // Delete rows with the same uid from the 'jobcode_service_items' table
    $deleteServiceItemsSql = "DELETE FROM jobcode_service_items WHERE uid = $uid";
    mysqli_query($conn, $deleteServiceItemsSql);

    echo '<script type="text/JavaScript">';  
    echo 'alert("Jobcard Deleted Successfully");';
    echo 'window.location= "ShowJobCard.php";';
    echo '</script>';
    
    // redirect back to the page where the row was deleted from
    // header('Location: ShowJobCard.php');
    exit();
}
?>