<?php
session_start();
require("connection.php");
function selectinventory($conn)
{
    $g_id = $_SESSION['id'];
    $searchTerm = $_GET['term'] ?? '';

    $sql = "SELECT * FROM inventory WHERE g_id = ? AND Product LIKE ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(['error' => $conn->error]);
        exit();
    }

    $like = "%" . $searchTerm . "%";
    $stmt->bind_param("is", $g_id, $like);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "id" => $row['Product'],
            "label" => $row['Product'],
            "value" => $row['Product'],
            "part_id" => $row['id'],
            "sale_price" => $row['SalePrice'],
            "part_number" => $row['PartNumber'],
            "hsn_code" => $row['HsnCode'],
            "cgst" => $row['cgst_percentage'],
            "sgst" => $row['sgst_percentage']
        ];
    }

    echo json_encode($data);
    exit();
}

selectinventory($conn);
?>