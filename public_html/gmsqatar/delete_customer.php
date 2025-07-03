
<?php

require("connection.php");

if (isset($_REQUEST['c_id'])) {

 // Sanitize and prepare
 $id = intval($_REQUEST['c_id']); // optional but safe
 $stmt = $conn->prepare("DELETE FROM `customer` WHERE `c_id` = ?");
 $stmt->bind_param("i", $id);
$stmt->execute();

//     // Redirect
    header("Location: allcustomers.php");
 }
?>