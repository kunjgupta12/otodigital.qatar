<!-- <?php
session_start();
include 'connection.php';
header('Content-Type: application/json');

$g_id = $_SESSION['id'];
$partNumber = trim($_POST['part_number'] ?? '');

if ($partNumber === '') {
    echo json_encode(['success' => false, 'message' => 'Invalid part number']);
    exit();
}
 $insertSQL = "INSERT INTO inventory (g_id, Product, SalePrice, PartNumber, HsnCode, cgst_percentage,Category,Location ,Stock,CostPrice) VALUES (?, '', 0, ?, '', 0,'','',0,0)";
  $stmt = $conn->prepare($insertSQL);

$stmt->bind_param("is", $g_id, $partNumber);

if ($stmt->execute()) {
    $insertedId = $stmt->insert_id;
    echo json_encode([
        'success' => true,
        'part' => [
            'part_id' => $insertedId,
            'product' => '',
            'part_number' => $partNumber,
            'sale_price' => 0,
            'hsn_code' => '',
            'cgst_percentage' => 0,
            
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Insert failed']);
}
$stmt->close();
?> -->
