<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['number']) || !isset($_SESSION['email'])) {
    header("Location: ../admin"); // Redirect to login if not authenticated
    exit;
}

$number = $_SESSION['number'];

// For Cancel admission
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Use PDO to update the status
    $stmt = $conn->prepare("UPDATE close SET status = 0 WHERE id = :id");
    $stmt->execute([':id' => $id]);

    header("location: close.php");
    exit;
}

// For admit user
if (isset($_GET['uid'])) {
    $uid = intval($_GET['uid']);

    // Use PDO to update the status
    $stmt = $conn->prepare("UPDATE close SET status = 1 WHERE id = :id");
    $stmt->execute([':id' => $uid]);

    header("location: close.php");
    exit;
}
?>
