<?php
include('../dbconn.php');

// For Cancel admission
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Update status to 'NOT SELECTED'
    $stmt = $conn->prepare("UPDATE intern SET admission = 'NOT SELECTED' WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Return a response for AJAX
    echo json_encode(['status' => 'success', 'message' => 'Admission canceled']);
    exit;
}

// For admit user
if (isset($_GET['uid'])) {
    $uid = intval($_GET['uid']);

    // Update status to 'SELECTED'
    $stmt = $conn->prepare("UPDATE intern SET admission = 'SELECTED' WHERE id = :id");
    $stmt->bindParam(':id', $uid, PDO::PARAM_INT);
    $stmt->execute();

    // Return a response for AJAX
    echo json_encode(['status' => 'success', 'message' => 'User admitted']);
    exit;
}
?>