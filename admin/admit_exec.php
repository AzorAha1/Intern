<?php
include('../dbconn.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status'];
    
    $stmt = $conn->prepare("UPDATE intern SET status = :status WHERE id = :id");
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => $status === 'PAID' ? 'Applicant payment confirmed' : 'Payment status updated to unpaid'
        ]);
    } else {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Failed to update status'
        ]);
    }
    exit;
}
?>