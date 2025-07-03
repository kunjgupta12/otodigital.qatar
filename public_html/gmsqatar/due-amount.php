<?php
// get_dueamount.php
include 'connection.php'; // adjust this to your DB connection file

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("SELECT dueamount FROM jobcard WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($dueamount);
    if ($stmt->fetch()) {
        echo $dueamount;
    } else {
        echo "0";
    }
    $stmt->close();
}
?>
