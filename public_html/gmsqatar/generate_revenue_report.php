<?php
require("connection.php");
require_once("vendor/autoload.php");
session_start();

$g_id = $_SESSION['id'];
$g_id = mysqli_real_escape_string($conn, $g_id);

// Get date range
$start = $_GET['start'] ?? date('Y-m');
$end = $_GET['end'] ?? date('Y-m');

// Helper
function getValue($conn, $query) {
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);
    return $row ? ($row['total'] ?? 0) : 0;
}
$totalRevenue = getValue($conn, "
    SELECT SUM(amount) AS total 
    FROM payment_history 
    WHERE g_id = '$g_id' AND status = 'P' AND LEFT(created_at, 7) BETWEEN '$start' AND '$end'
");
$totalDue = getValue($conn, "SELECT SUM(dueamount) AS total FROM jobcard WHERE g_id = '$g_id' AND LEFT(created_at, 7) BETWEEN '$start' AND '$end'");

$numJobs = getValue($conn, "SELECT COUNT(*) AS total FROM jobcard WHERE g_id = '$g_id' AND LEFT(created_at, 7) BETWEEN '$start' AND '$end'");
$completedJobs = getValue($conn, "SELECT COUNT(*) AS total FROM jobcard WHERE g_id = '$g_id' AND status = 'Completed' AND LEFT(created_at, 7) BETWEEN '$start' AND '$end'");
$runningJobs = getValue($conn, "SELECT COUNT(*) AS total FROM jobcard WHERE g_id = '$g_id' AND status != 'Completed' AND LEFT(created_at, 7) BETWEEN '$start' AND '$end'");

// Fetch Paid Bills
$paidResult = mysqli_query($conn, "
    SELECT 
        j.job_card_no, 
        j.invoice_no, 
        c.cus_name, 
        c.cus_mob,
        p.created_at,
        SUM(p.amount) AS amount
    FROM payment_history p
    JOIN jobcard j ON p.jobcard_id = j.id
    JOIN customer c ON p.c_id = c.c_id
    WHERE 
        p.g_id = '$g_id' 
        AND p.status = 'P'
        AND LEFT(p.created_at, 7) BETWEEN '$start' AND '$end'
    GROUP BY j.job_card_no, j.invoice_no, c.cus_name, c.cus_mob, p.created_at
");



// Fetch Due Amounts
$dueResult = mysqli_query($conn, "
    SELECT j.job_card_no, j.invoice_no, j.dueamount, c.cus_name, c.cus_mob
    FROM jobcard j
    JOIN customer c ON j.c_id = c.c_id
    WHERE j.g_id = '$g_id' AND j.dueamount > 0 AND LEFT(j.created_at, 7) BETWEEN '$start' AND '$end'
");

// Start PDF
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle("Revenue Report");

$html = '
<h2 style="text-align:center;">REVENUE REPORT</h2>
<p><strong>PERIOD:</strong> ' . $start . ' TO ' . $end . '</p>

<h3>Details of Paid Bills</h3>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
<tr>
  <th>S. No</th>
  <th>Customer Name</th>
  <th>Customer Contact</th>
  <th>Invoice No</th>
  <th>Job Card No</th>
 
  <th>Date</th> <th>Amount</th>
</tr>';
$i = 1;
$totalPaid = 0;
while ($row = mysqli_fetch_assoc($paidResult)) {
    $html .= '<tr>
      <td>' . $i++ . '</td>
      <td>' . htmlspecialchars($row['cus_name']) . '</td>
      <td>' . htmlspecialchars($row['cus_mob']) . '</td>
      <td>' . $row['invoice_no'] . '</td>
      <td>' . $row['job_card_no'] . '</td>
     
      <td>' . date('d-m-Y', strtotime($row['created_at'])) . '</td>
       <td>' . number_format($row['amount'], 2) . '</td>
    </tr>';
    $totalPaid += $row['amount'];
}


$html .= '<tr><td colspan="6" align="right"><strong>Total:</strong></td><td><strong>' . number_format($totalPaid, 2) . '</strong></td></tr>';
$html .= '</table><br><br>';

$html .= '<h3>Details of Due Amount</h3>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
<tr>
  <th>S. No</th>
  <th>Customer Name</th>
  <th>Customer Contact</th>
  <th>Invoice No</th>
  <th>Job Card No</th>
  <th>Amount</th>
</tr>';

$i = 1;
$totalDueAmt = 0;
while ($row = mysqli_fetch_assoc($dueResult)) {
    $html .= '<tr>
      <td>' . $i++ . '</td>
      <td>' . htmlspecialchars($row['cus_name']) . '</td>
      <td>' . htmlspecialchars($row['cus_mob']) . '</td>
      <td>' . $row['invoice_no'] . '</td>
      <td>' . $row['job_card_no'] . '</td>
      <td>' . number_format($row['dueamount'], 2) . '</td>
    </tr>';
    $totalDueAmt += $row['dueamount'];
}
$html .= '<tr><td colspan="5" align="right"><strong>Total:</strong></td><td><strong>' . number_format($totalDueAmt, 2) . '</strong></td></tr>';
$html .= '</table><br><br>';

$html .= '
<h3>KEY METRICS</h3>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
<tr><td>No. of Job Cards</td><td>' . $numJobs . '</td></tr>
<tr><td>No. of Completed Job Cards</td><td>' . $completedJobs . '</td></tr>
<tr><td>No. of Running Job Cards</td><td>' . $runningJobs . '</td></tr>
<tr><td>Total Revenue</td><td>' . number_format($totalRevenue, 2) . '</td></tr>
<tr><td>Total Outstanding</td><td>' . number_format($totalDue, 2) . '</td></tr>
<tr><td>Period</td><td>' . $start . ' to ' . $end . '</td></tr>
</table>';

$mpdf->WriteHTML($html);
$mpdf->Output("Revenue_Report_" . date('Ymd') . ".pdf", "I");
?>
