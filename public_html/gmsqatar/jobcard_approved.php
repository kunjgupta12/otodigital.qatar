<?php
require("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    // Additional code for processing the approval

    // Collect checked services
    $checkedServices = isset($_POST['services']) ? $_POST['services'] : [];

    // Additional processing or database updates for approval...
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT j.*, cl.g_name FROM jobcard j
        JOIN call_login cl ON j.g_id = cl.g_id
        WHERE j.id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
    // Send email
    $to = $row['g_email']; 
    $subject = 'Job Card Approval';
    $message = 'The following services have been approved: ' . implode(', ', $checkedServices);

    // Use additional headers as needed
    $headers = 'From: jobcardapprove@merigarage.com';

    // Send the email
    mail($to, $subject, $message, $headers);

    echo '<script type="text/JavaScript">';  
    echo 'alert("Service Reminder Has Been Successfully Sent");';
    echo 'window.location= "ShowJobCard.php";';
    echo '</script>';
    }
}
?>