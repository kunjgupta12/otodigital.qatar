<?php
require("connection.php");

$id = mysqli_real_escape_string($conn, $_GET['id']);
// $sql = "SELECT j.*, cl.g_name, cl.g_mob, cl.g_address, av.*, c.* FROM jobcard j JOIN call_login cl ON j.g_id = cl.g_id JOIN all_vehicle av ON j.v_id = av.v_id JOIN customer c ON av.c_id = c.c_id WHERE j.id = ?";
$sql = "SELECT j.*, cl.g_name, cl.g_mob, cl.g_address, av.*, c.*, j.id AS jobcard_id FROM jobcard j JOIN call_login cl ON j.g_id = cl.g_id JOIN all_vehicle av ON j.v_id = av.v_id JOIN customer c ON av.c_id = c.c_id WHERE j.id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
  $to = $row['cus_email'];
  $subject = 'Job Card Approval - ' . $row['carbrand'] . ' ' . $row['carmodel'] . ' (' . $row['registration'] . ')';

  $message = 'Dear ' . $row['cus_name'] . ',

  We hope this message finds you well. This is ' . $row['g_name'] . ', reaching out to inform you about the pending job card for your ' . $row['carbrand'] . ' ' . $row['carmodel'] . ' with 
  registration number: ' . $row['registration'] . '.

  We kindly request your approval for the service. To review the details and approve the job card, please click on the following link:
  ' . 'https://merigarage.com/GarageAdmin/jobcard_approvel.php?id=' . $row['jobcard_id'] . '

  Our team is dedicated to providing the best service, and your approval will ensure a timely and efficient process.

  Thank you for choosing ' . $row['g_name'] . '. If you have any questions or concerns, feel free to contact us.

  Best regards,
  ' . $row['g_name'] . ',
  Mobile: ' . $row['g_mob'] . ',
  Address: ' . $row['g_address'] . '.';

  $headers = 'From: jobcardapprovel@merigarage.com' . "\r\n" .
             'Content-Type: text/plain; charset=utf-8' . "\r\n";

  mail($to, $subject, $message, $headers);
}

mysqli_close($conn);

echo '<script type="text/JavaScript">';  
echo 'alert("Jobcard Approvel Has Been Successfully Sent");';
echo 'window.location= "ShowJobCard.php";';
echo '</script>';
?>
