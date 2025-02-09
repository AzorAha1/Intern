<?php
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Configure error logging
ini_set('display_errors', 1); // Temporarily enable for debugging
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/email_errors.log');

// Fix the path to vendor directory
require dirname(__DIR__) . '/vendor/autoload.php';
include '../dbconn.php';

header('Content-Type: application/json');

try {
    // Validate PDF existence first
    $documentPath = __DIR__ . '/NoticeofInterview.pdf';
    if (!file_exists($documentPath)) {
        throw new Exception("PDF file not found at: $documentPath");
    }

    // Test database connection
    if (!isset($conn)) {
        throw new Exception("Database connection failed");
    }

    // Get recipients
    $stmt = $conn->query("SELECT email, name FROM intern WHERE status = 'PAID' AND admission = 'NOT SELECTED'");
    if (!$stmt) {
        throw new Exception("Database query failed");
    }
    
    if ($stmt->rowCount() === 0) {
        throw new Exception('No eligible recipients found');
    }
    
    $recipients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $mail = new PHPMailer(true);
    
    // Debug mode for testing
    $mail->SMTPDebug = 2; // Enable verbose debug output
    $mail->Debugoutput = function($str, $level) {
        error_log("PHPMailer: $level: $str\n");
    };

    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mainform8@gmail.com';
    $mail->Password = 'lvzkreuewwfauyng'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('mainform8@gmail.com', 'Federal Medical Center BKD Jigawa');
    $mail->addAttachment($documentPath, 'NoticeofInterview.pdf');

    $successCount = 0;
    $failedEmails = [];

    foreach ($recipients as $recipient) {
        try {
            $mail->clearAddresses();
            $mail->addAddress($recipient['email']);
            $mail->Subject = 'Your Internship Interview Notice';
            
            // Email content
            $mail->isHTML(true);
            $mail->Body = "
                <html>
                <body>
                    <h2>Interview Notice - Skill Builder Academy</h2>
                    <p>Dear {$recipient['name']},</p>
                    <p>Thank you for your application to the Skill Builder Academy internship program. 
                    Please find attached your interview notice with important details about your upcoming interview.</p>
                    <p>Best regards,<br>Skill Builder Academy Team</p>
                </body>
                </html>";
            
            $mail->send();
            $successCount++;
        } catch (Exception $e) {
            $failedEmails[] = [
                'email' => $recipient['email'],
                'error' => $e->getMessage()
            ];
        }
    }

    // Clean output buffer
    ob_end_clean();

    echo json_encode([
        'status' => 'success',
        'message' => "Sent successfully to $successCount recipients. " . 
                    (count($failedEmails) ? count($failedEmails) . " failed." : ""),
        'details' => [
            'success_count' => $successCount,
            'failed' => $failedEmails
        ]
    ]);

} catch (Exception $e) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}

exit();