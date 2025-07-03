<?php
// get_package_details.php
include 'connection.php';
$id = $_GET['id'];

$sql = "SELECT id, price, discount, hsncode, cgst, sgst, stock FROM service_packages WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);
