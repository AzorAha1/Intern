<?php
session_start();
include('../dbconn.php');

// Check if form is submitted
if (isset($_POST['btnchange'])) {
    // Get the new and re-entered passwords
    $newPassword = $_POST['newpassword'];
    $reNewPassword = $_POST['renewpassword'];

    // Ensure the passwords match
    if ($newPassword !== $reNewPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit;
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Get the user's ID from the GET request
    $userId = $_GET['viewid']; // Or use session to get the current user ID if applicable

    try {
        // Prepare the update query
        $sql = "UPDATE intern SET password = :password WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Display success message with redirect
        echo "<script>
                alert('Password updated successfully!');
                window.location.href = 'view-profile.php?viewid=" . $userId . "';
              </script>";
        exit;

    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
