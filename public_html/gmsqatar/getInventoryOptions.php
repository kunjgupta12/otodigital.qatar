<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
header("Content-Type: text/html; charset=utf-8");

session_start(); // uncomment if not active already
include 'connection.php';

$g_id = $_SESSION['id'];
$sql = "SELECT * FROM inventory WHERE g_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $g_id);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_assoc()) {
    echo '<option value="' . htmlspecialchars($row['Product']) . '" 
        data-part-id="' . $row['id'] . '" 
        data-sale-price="' . $row['SalePrice'] . '" 
        data-part-number="' . $row['PartNumber'] . '" 
        data-hsn-code="' . $row['HsnCode'] . '" 
        data-cgst="' . $row['cgst_percentage'] . '" 
        data-sgst="' . $row['sgst_percentage'] . '">' . 
        htmlspecialchars($row['Product']) . '</option>';
}
?>
