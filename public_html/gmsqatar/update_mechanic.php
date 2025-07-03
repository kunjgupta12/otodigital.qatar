<?php
// Require the connection file which establishes a database connection
require("connection.php");

// Check if jobId and mechanicId are set in the POST request
if(isset($_POST['jobId']) && isset($_POST['mechanicId'])) {
    // Sanitize input data to prevent SQL injection
    $jobId = mysqli_real_escape_string($conn, $_POST['jobId']);
    $mechanicId = mysqli_real_escape_string($conn, $_POST['mechanicId']);

    // Update the m_id column in the jobcard table for the specified job ID
    $sql = "UPDATE jobcard SET m_id = '$mechanicId' WHERE uid = '$jobId'";
    
    // Execute the SQL query
    if(mysqli_query($conn, $sql)) {
        // If the update was successful, return success message
        echo "Mechanic assigned to job successfully!";
    } else {
        // If an error occurred, return error message
        echo "Error assigning mechanic to job: " . mysqli_error($conn);
    }
} else {
    // If jobId or mechanicId is not set, return error message
    echo "Error: jobId or mechanicId not set!";
}
?>
