<?php
require("connection.php");

$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT 
    j.*, 
    cl.g_name, 
    cl.g_mob, 
    cl.g_address, 
    av.*, 
    c.*
FROM 
    jobcard j
JOIN 
    call_login cl ON j.g_id = cl.g_id
JOIN 
    all_vehicle av ON j.v_id = av.v_id
JOIN 
    customer c ON av.c_id = c.c_id
WHERE 
    j.id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $message = 'عزيزي/عزيزتي ' . $row['cus_name'] . '،

هذا ' . $row['g_name'] . '، نود تذكيركم بأن الوقت قد حان لخدمة الصيانة الدورية لسيارتكم ' . $row['carbrand'] . ' ' . $row['carmodel'] . '.
فريقنا من الفنيين المعتمدين جاهز للتعامل مع جميع متطلبات الخدمة التي قد تحتاجها سيارتكم.
نحن نحرص على تقديم أفضل خدمة لجميع عملائنا ونريد التأكد من أن سيارتكم ' . $row['carbrand'] . ' ' . $row['carmodel'] . '، رقم المركبة ' . $row['registration'] . '، في أفضل حالة ممكنة.

مع أطيب التحيات،
' . $row['g_name'] . '
الجوال: ' . $row['g_mob'] . '
العنوان: ' . $row['g_address'] . '.';

    $whatsappNumber = '91' . preg_replace('/[^0-9]/', '', $row['cus_mob']); // sanitize number
    $encodedMessage = urlencode($message);
    $whatsappUrl = "https://api.whatsapp.com/send?phone=$whatsappNumber&text=$encodedMessage";

    // Open WhatsApp in new tab and redirect back
    echo '<script type="text/javascript">';
    echo 'window.open("' . $whatsappUrl . '", "_blank");';
    echo 'alert("يتم الفتح...");';
    echo 'window.location = "ShowJobCard.php";';
    echo '</script>';
} else {
    echo '<script>alert("لم يتم العثور على سجل."); window.location = "ShowJobCard.php";</script>';
}

mysqli_close($conn);
?>
