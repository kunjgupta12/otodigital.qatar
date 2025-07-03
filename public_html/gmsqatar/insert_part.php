<!-- <?php
session_start();
include 'connection.php';

header('Content-Type: application/json');

$g_id = $_SESSION['id'];
$partName = trim($_POST['part_name'] ?? '');

if ($partName === '') {
    echo json_encode(['success' => false, 'message' => 'Invalid part name']);
    exit();
}
   $insertSQL = "INSERT INTO inventory (g_id, Product, SalePrice, PartNumber, HsnCode, cgst_percentage,Category,Location ,Stock,CostPrice) VALUES (?, ?, 0, '', '', 0,'','',0,0)";
  $stmt = $conn->prepare($insertSQL);
$stmt->bind_param("is", $g_id, $partName);
$success = $stmt->execute();

if ($success) {
    $part_id = $stmt->insert_id;

    echo json_encode([
        'success' => true,
        'part' => [
            'part_id' => $part_id,
            'product' => $partName,
            'sale_price' => 0,
            'part_number' => '',
            'hsn_code' => '',
            'cgst_percentage' => 0,
           
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'DB insert failed']);
}

$stmt->close();
?> -->
