<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch the user's email from the session
$email = $_SESSION['user_email'];

// Database connection
$conn = new mysqli("localhost", "root", "", "intern");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the user's admission status based on the email
$sql = "SELECT * FROM intern WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $admission_status = $user['admission']; // Assuming this field exists in the 'intern' table
} else {
    $admission_status = "No admission status available.";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Status</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <div class="header-container">
            <h1>FMCBKD Internship</h1>
            <p>Check your Admission Status</p>
        </div>
    </header>

    <div class="status-container">
        <h2>Your Admission Status</h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Reg Number:</strong> <?php echo htmlspecialchars($user['regno']); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($admission_status); ?></p>
    </div>
 
</body>
</html>
