<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    $jobcardQuery = "SELECT c_id, g_id, totalPrice, dueamount FROM jobcard WHERE id = $id";
    $jobcardResult = mysqli_query($conn, $jobcardQuery);

    if ($jobcardResult && mysqli_num_rows($jobcardResult) > 0) {
        $jobcardData = mysqli_fetch_assoc($jobcardResult);
        $cus_id = $jobcardData['c_id'];
        $g_id = $jobcardData['g_id'];
        $totalPrice = $jobcardData['totalPrice'];
        $currentDue = $jobcardData['dueamount'];

        if ($action === 'markPaid') {
            $updateSql = "UPDATE jobcard SET status = 'C', dueamount = 0 WHERE id = $id";
            mysqli_query($conn, $updateSql);

            $insertSql = "INSERT INTO payment_history (c_id,jobcard_id, g_id, amount, status, payment_type, created_at) 
                          VALUES ($cus_id, '$id',$g_id, $currentDue, 'C', 'paid', NOW())";
            mysqli_query($conn, $insertSql);

            echo "Marked as fully paid.";
        }

        elseif ($action === 'partialPaid') {
            $amount = floatval($_POST['amount']);
            $newDue = $currentDue - $amount;
            if ($newDue <= 0) {
                $newDue = 0;
                $status = 'C';
            } else {
                $status = 'P';
            }

            $updateSql = "UPDATE jobcard SET dueamount = $newDue, status = '$status' WHERE id = $id";
            mysqli_query($conn, $updateSql);

            $insertSql = "INSERT INTO payment_history (c_id,jobcard_id ,g_id, amount, status, payment_type, created_at) 
                          VALUES ($cus_id,'$id', $g_id, $amount, '$status', 'partial', NOW())";
            mysqli_query($conn, $insertSql);

            if ($status === 'C') {
                echo "Partial payment of ₹$amount recorded. All dues cleared. Status updated to Complete.";
            } else {
                echo "Partial payment of ₹$amount recorded. Remaining due: ₹$newDue.";
            }
        }
        elseif ($action === 'updateDue') {
            $dueamount = floatval($_POST['dueamount']);
            $updateSql = "UPDATE jobcard SET dueamount = $dueamount WHERE id = $id";
            mysqli_query($conn, $updateSql);
            echo "Due amount updated successfully to ₹$dueamount.";
        }

    } else {
        echo "Invalid jobcard ID.";
    }
}
?>
