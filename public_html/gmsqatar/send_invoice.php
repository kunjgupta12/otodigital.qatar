<?php
// Path to wkhtmltopdf executable
$wkhtmltopdfPath = __DIR__ . '/lib/wkhtmltopdf';

// Get the ID from the URL parameter
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Check if ID is provided
if ($id !== null) {
    // URL of the HTML page you want to convert (dynamic based on the ID)
    $htmlPageUrl = "http://localhost/Admin/GarageAdmin/invoice.php?id=$id";

    // Path to the generated PDF file
    $pdfFilePath = __DIR__ . "/pdf/file$id.pdf";

    // Execute wkhtmltopdf command
    $command = "$wkhtmltopdfPath $htmlPageUrl $pdfFilePath";
    shell_exec($command);

    // Read the PDF file content
    $pdfContent = file_get_contents($pdfFilePath);

    // Base64 encode the PDF content
    $pdfContentBase64 = base64_encode($pdfContent);

    // Define the attachment headers
    $attachmentHeaders = "Content-Type: application/pdf;\r\n";
    $attachmentHeaders .= " name=\"invoice_$id.pdf\"\r\n";
    $attachmentHeaders .= "Content-Disposition: attachment;\r\n";
    $attachmentHeaders .= " filename=\"invoice_$id.pdf\"\r\n";
    $attachmentHeaders .= "Content-Transfer-Encoding: base64\r\n\r\n";

    // Define recipient email address and subject
    $to = 'recipient@example.com';
    $subject = 'Invoice for ID ' . $id;


    // Combine the message and attachment headers with the PDF content
    $fullMessage = "--boundary\r\n";
    $fullMessage .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
    $fullMessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $fullMessage .= "Your email message here for invoice ID $id.\r\n\r\n";  // Include your email message
    $fullMessage .= "--boundary\r\n";
    $fullMessage .= $attachmentHeaders . $pdfContentBase64 . "\r\n\r\n";
    $fullMessage .= "--boundary--";

    // Define additional headers for the mail function
    $headers = "From: invoice@merigarage.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

    // Send the email with attachment
    mail($to, $subject, $fullMessage, $headers);

    // ... rest of the code ...
} else {
    echo "Error: ID parameter not provided.";
}
?>
