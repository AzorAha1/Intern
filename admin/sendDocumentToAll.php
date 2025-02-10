<?php
declare(strict_types=1);
ob_start();
header('Content-Type: application/json');

// Remove time limit entirely
set_time_limit(0); // Unlimited execution time
ignore_user_abort(true); // Continue processing even if connection closes

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    require dirname(__DIR__) . '/vendor/autoload.php';
    require '../dbconn.php';

    // Validate PDF file
    $documentPath = __DIR__ . '/NoticeofInterview.pdf';
    if (!file_exists($documentPath)) {
        throw new Exception("Interview notice PDF not found in admin directory");
    }

    // Get ALL eligible recipients
    $stmt = $conn->query("SELECT email, name FROM intern 
                         WHERE status = 'PAID' AND admission = 'NOT SELECTED'
                         ORDER BY created_date ASC");

    $recipients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($recipients)) {
        throw new Exception("No eligible applicants found");
    }

    // Configure PHPMailer with persistent connection
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mainform8@gmail.com';
    $mail->Password = 'lvzkreuewwfauyng';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPKeepAlive = true; // Maintain connection
    $mail->setFrom('mainform8@gmail.com', 'Federal Medical Center');
    $mail->addAttachment($documentPath);
    $mail->isHTML(true);

    $results = [
        'total' => count($recipients),
        'success' => 0,
        'failed' => [],
        'processed' => 0
    ];

    foreach ($recipients as $recipient) {
        try {
            $mail->clearAddresses();
            $mail->addAddress($recipient['email'], $recipient['name']);
            $mail->Subject = 'Internship Interview Notice';
            $mail->Body = sprintf(
                '<h2>Interview Notice</h2>
                <p>Dear %s,</p>
                <p>Your interview details are attached.</p>
                <p>Best regards,<br>FMC Team</p>',
                htmlspecialchars($recipient['name'])
            );
            
            $mail->send();
            $results['success']++;
        } catch (Exception $e) {
            $results['failed'][] = [
                'email' => $recipient['email'],
                'error' => $e->getMessage()
            ];
        }
        
        $results['processed']++;
        
        // Flush output buffer periodically
        if ($results['processed'] % 10 === 0) {
            ob_flush();
            flush();
        }
    }

    // Cleanup
    $mail->smtpClose();
    ob_end_clean();
    
    echo json_encode([
        'status' => 'success',
        'message' => "Processed all {$results['total']} emails",
        'results' => $results
    ]);

} catch (Exception $e) {
    if (isset($mail)) $mail->smtpClose();
    ob_end_clean();
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'file' => basename($e->getFile()),
        'line' => $e->getLine()
    ]);
    exit();
}