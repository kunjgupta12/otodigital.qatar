<?php

// Include the database connection file
include('connection.php');

// Check the command sent from the frontend
$command = isset($_POST['get']) ? $_POST['get'] : "";

// Initialize the variable to hold the HTML options
$result1 = "";

// Switch based on the command
switch ($command) {
    case "brand":
        // Fetch all car brands from the database
        $statement = "SELECT makeTitle FROM mericar_make";
        $dt = mysqli_query($conn, $statement);
        
        // Generate HTML options for each brand
        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value='" . $result['makeTitle'] . "'>" . $result['makeTitle'] . "</option>";
        }
        break;

    case "model":
        // Fetch car models associated with the selected car brand
        $makeTitle = isset($_POST['makeTitle']) ? $_POST['makeTitle'] : "";
        if (!empty($makeTitle)) {
            // Fetch the brand ID based on the title
            $query = "SELECT makeid FROM mericar_make WHERE makeTitle = '$makeTitle'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $makeId = $row['makeid'];
            
            // Fetch models based on the brand ID
            $statement = "SELECT modelTitle FROM mericar_model WHERE makeid=" . $makeId;
            $dt = mysqli_query($conn, $statement);
            
            // Generate HTML options for each model
            while ($result = mysqli_fetch_array($dt)) {
                $result1 .= "<option value='" . $result['modelTitle'] . "'>" . $result['modelTitle'] . "</option>";
            }
        }
        break;
}

// Echo the generated HTML options
echo $result1;

// Close database connection
mysqli_close($conn);

// Exit script
exit();

?>
