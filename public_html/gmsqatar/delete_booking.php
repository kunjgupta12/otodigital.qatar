
<?php

require("connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // connect to the database
    // $conn = mysqli_connect('localhost', 'username', 'password', 'database_name');

    // Delete row with the corresponding ID from the 'jobcard' table
    $deletesql = "DELETE FROM g_booking WHERE id = $id";
    mysqli_query($conn, $deletesql);

    // redirect back to the page where the row was deleted from
    header('Location: dashboard.php');
    exit();
}
?>