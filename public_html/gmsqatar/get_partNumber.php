<?php
session_start();
include 'connection.php';

header('Content-Type: application/json');

$search = trim($_GET['term'] ?? '');
$g_id = $_SESSION['id'];

$data = [];

if ($search !== '') {
    $sql = "SELECT * FROM inventory WHERE g_id = ? AND PartNumber LIKE ? LIMIT 20";
    $stmt = $conn->prepare($sql);
    $like = "%$search%";
    $stmt->bind_param("is", $g_id, $like);
    $stmt->execute();
    $result = $stmt->get_result();

    $foundExact = false;

    while ($row = $result->fetch_assoc()) {
        // if (strcasecmp($row['PartNumber'], $search) == 0) {
        //     $foundExact = true;
        // }

        $data[] = [
            "id" => $row['Product'],
            "text" => $row['PartNumber'],
            "part_id" => $row['id'],
            "sale_price" => (float)$row['SalePrice'],
            "part_number" => $row['PartNumber'],
            "hsn_code" => $row['HsnCode'],
            "cgst_percentage" => (float)$row['cgst_percentage'],
            
            "is_new" => false
        ];
    }

    // if (!$foundExact) {
    //     $data[] = [
    //         "id" => "__new__" . $search,
    //         "text" => " Add new part number: " . $search,
    //         "term" => $search,
    //         "is_new" => true
    //     ];
    // }
}

echo json_encode(['results' => $data]);
?>
