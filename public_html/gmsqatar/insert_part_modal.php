<?php

include 'connection.php';
header('Content-Type: application/json');

$g_id = $_SESSION['id'];

$Product = $_POST['Product'] ?? '';
$PartNumber = $_POST['PartNumber'] ?? '';
$Category = $_POST['Category'] ?? '';
$Location = $_POST['Location'] ?? '';
$CostPrice = $_POST['CostPrice'] ?? 0;
$SalePrice = $_POST['MRP'] ?? 0;
$HsnCode = $_POST['HsnCode'] ?? '';
$Stock = $_POST['Quantity'] ?? 0;
$cgst_percentage = $_POST['cgst_percentage'] ?? 0;
if (empty($Product) || empty($PartNumber)) {
    echo json_encode(['success' => false, 'message' => 'Required fields missing']);
    exit;
}

$sql = "INSERT INTO `inventory` (
            g_id, Product, PartNumber, HsnCode, Category, Location, 
            Stock, CostPrice, SalePrice, cgst_percentage
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "isssssdddd",
    $g_id,
    $Product,
    $PartNumber,
    $HsnCode,
    $Category,
    $Location,
    $Stock,
    $CostPrice,
    $SalePrice,
    $cgst_percentage,
   
);

if ($stmt->execute()) {
    $insertedId = $stmt->insert_id;
    echo json_encode([
        'success' => true,
        'message' => 'Part inserted successfully',
        'inserted_id' => $insertedId,
        'PartNumber' => $PartNumber,
        'SalePrice' => $SalePrice,
        'HsnCode' => $HsnCode,
        'cgst_percentage' => $cgst_percentage,
        
        'Product' => $Product
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
}

$stmt->close();
