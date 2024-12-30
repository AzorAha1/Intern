<?php
include '../dbconn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'payment_successful') {
    $reference = $_GET['reference']; // Get the reference from Paystack callback

    // Verify Payment with Paystack API
    $secret_key = 'sk_test_5e25bd425b9e8c7d7ecb0b68a7002aeda588430c'; // Replace with your Paystack secret key
    $url = "https://api.paystack.co/transaction/verify/$reference";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $secret_key"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if ($result && $result['status'] && $result['data']['status'] === 'success') {
        // Payment verified successfully
        $regno = $_SESSION['regno']; // Get registration number from session
        $tx_ref = $result['data']['reference']; // Transaction reference
        $amount = $result['data']['amount'] / 100; // Amount in NGN (Paystack returns amount in kobo)

        try {
            // Update student status to 'PAID'
            $stmt = $conn->prepare("UPDATE intern SET status = 'PAID' WHERE regno = ?");
            $stmt->execute([$regno]);

            // Log the transaction in the database
            $stmt = $conn->prepare("INSERT INTO transactions (regno, reference, amount, status) VALUES (?, ?, ?, 'successful')");
            $stmt->execute([$regno, $tx_ref, $amount]);

            // Redirect to the dashboard after successful payment
            header('Location: ../intern');
            exit();
        } catch (Exception $e) {
            echo "An error occurred while processing your payment. Please contact support.";
        }
    } else {
        // Handle payment verification failure
        echo "Payment verification failed. Please contact support.";
    }
} else {
    // If accessed directly without valid GET parameters
    header('Location: payment.php');
    exit();
}
?>
