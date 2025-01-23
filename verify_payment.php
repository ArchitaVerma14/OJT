<?php
// Include Razorpay PHP SDK
require('razorpay-php/Razorpay.php');

use Razorpay\Api\Api;

$api_key = "YOUR_RAZORPAY_API_KEY";
$api_secret = "YOUR_RAZORPAY_API_SECRET";

// Get the payment details from the POST request
$data = json_decode(file_get_contents('php://input'), true);

$payment_id = $data['payment_id'];
$order_id = $data['order_id'];
$signature = $data['signature'];

$api = new Api($api_key, $api_secret);

try {
    // Verify payment signature
    $attributes = [
        'razorpay_order_id' => $order_id,
        'razorpay_payment_id' => $payment_id,
        'razorpay_signature' => $signature,
    ];

    $api->utility->verifyPaymentSignature($attributes);

    // Payment verified successfully
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Payment verification failed
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
