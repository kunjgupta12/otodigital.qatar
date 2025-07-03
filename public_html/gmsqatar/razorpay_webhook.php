<?php

// Your Razorpay webhook secret key
$razorpayWebhookSecret = 'your_razorpay_webhook_secret_key';

// Connection to your MySQL database
$servername = "your_database_server";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "your_database_name";

// Retrieve the request's body and verify the signature
$body = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'];

try {
    // Use the Razorpay utility method to verify the webhook signature
    $success = \Razorpay\Api\Utility\Signature::verify($body, $signature, $razorpayWebhookSecret);

    if (!$success) {
        throw new \Exception('Invalid webhook signature');
    }

    // Parse the JSON payload
    $event = json_decode($body, true);

    // Check if it's a payment success event
    if ($event['event'] === 'payment.captured') {
        // Extract relevant information from the event
        $paymentId = $event['payload']['payment']['entity']['id'];
        $customerId = $event['payload']['payment']['entity']['customer_id'];

        // Extract phone number from the SQL table (Assuming you have a 'call_login' table)
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            throw new \Exception('Connection failed: ' . $conn->connect_error);
        }

        // Modify the SQL query based on your table structure
        $sql = "SELECT phone_number, trial_end_date FROM call_login WHERE customer_id = '$customerId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $phoneNumber = $row['phone_number'];
            $currentTrialEndDate = $row['trial_end_date'];

            // Extend the trial end date as needed (e.g., add 30 days)
            $newTrialEndDate = date('Y-m-d', strtotime($currentTrialEndDate . ' + 30 days'));

            // Update the trial end date in the SQL table
            $updateSql = "UPDATE call_login SET trial_end_date = '$newTrialEndDate' WHERE phone_number = '$phoneNumber'";
            $conn->query($updateSql);

            // Log the event (for debugging purposes)
            file_put_contents('webhook.log', 'Payment success: ' . $paymentId . ' for customer ' . $customerId . '. Trial end date extended for phone number ' . $phoneNumber . PHP_EOL, FILE_APPEND);
        }

        $conn->close();
    }
} catch (\Exception $e) {
    // Handle verification or processing errors
    http_response_code(400);
    echo 'Webhook Error: ' . $e->getMessage();
}
?>
