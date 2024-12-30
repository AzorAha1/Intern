<?php
include('../dbconn.php');

$id = $_GET['id'];
$sql = "DELETE FROM `intern` WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    // Check if this is an AJAX request
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // Return JSON response for AJAX requests
        echo json_encode([
            'status' => 'success',
            'message' => 'Applicant deleted successfully'
        ]);
    } else {
        // Regular form submission - redirect
        header("location: app.php");
    }
    exit();
} else {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // Return JSON error for AJAX requests
        echo json_encode([
            'status' => 'error',
            'message' => 'Error deleting record'
        ]);
    } else {
        // Regular form submission - show alert
        echo "<script>alert('Error deleting record');</script>";
    }
}
?>