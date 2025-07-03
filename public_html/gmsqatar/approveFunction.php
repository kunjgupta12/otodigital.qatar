<?php

require "connection.php";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approvalButton'])) {
    // Get the jobcard id from POST data
    $jobcard_id = $_POST['id'];

    // Fetch the UID associated with the jobcard id
    $uid_query = "SELECT uid FROM `jobcard` WHERE id = $jobcard_id";
    $uid_result = mysqli_query($conn, $uid_query);
    $uid_row = mysqli_fetch_assoc($uid_result);
    $uid = $uid_row['uid'];

    // Retrieve checked services
    $checked_services = isset($_POST['services']) ? $_POST['services'] : [];

    // Delete unchecked services from jobcode_service_items
    if (!empty($checked_services)) {
        $checked_service_ids = implode(",", array_map('intval', $checked_services)); // Ensure all IDs are integers
        $delete_query = "DELETE FROM jobcode_service_items WHERE uid = $uid AND id NOT IN ($checked_service_ids)";
        mysqli_query($conn, $delete_query);
    }
    
    $update_query = "UPDATE jobcard SET work_status = 2 WHERE id = $jobcard_id";
    mysqli_query($conn, $update_query);
    
    echo '<script type="text/JavaScript">';  
    echo 'alert("Thank you for your approval! We will work as per your requirement.");';
    echo 'window.location= "../index.php";';
    echo '</script>';
    exit();
}
?>
