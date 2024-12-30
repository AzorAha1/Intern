<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['regno']) || !isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirect to login if not authenticated
    exit;
}

$regno = $_SESSION['regno']; // Retrieve registration number from session
$email = $_SESSION['email']; // Retrieve email from session

// Database connection (update with your credentials)
$conn = new mysqli('localhost', 'root', '', 'intern');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch receipt status for the user
$stmt = $conn->prepare("SELECT receipt FROM intern WHERE regno = ?");
$stmt->bind_param("s", $regno);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$receiptStatus = $row['receipt'] ?? 0; // Default to 0 if no row is found

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';

        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = basename($_FILES['receipt']['name']);
        $uploadFile = $uploadDir . $fileName;

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $fileType = $_FILES['receipt']['type'];

        if (!in_array($fileType, $allowedTypes)) {
            echo "<p style='color: red;'>Invalid file type. Only JPG, PNG, and PDF files are allowed.</p>";
        } elseif (move_uploaded_file($_FILES['receipt']['tmp_name'], $uploadFile)) {
            // Update the receipt column
            $stmt = $conn->prepare("UPDATE intern SET receipt = ? WHERE regno = ?");
            $stmt->bind_param("ss", $fileName, $regno);

            if ($stmt->execute()) {
                echo "<p style='color: green;'>Receipt uploaded successfully. Waiting for approval.</p>";
                $receiptStatus = $fileName; // Update status for the current session
            } else {
                echo "<p style='color: red;'>Database update failed: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p style='color: red;'>Failed to upload file. Please try again.</p>";
        }
    } else {
        echo "<p style='color: red;'>No file uploaded or an error occurred during the upload.</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Receipt</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            max-width: 70%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            background-color: #f4f4f9;
            text-align: center;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        p {
            font-size: 1rem;
            margin-bottom: 20px;
            color: #555;
        }
        input[type="file"] {
            margin-bottom: 20px;
        }
        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
        button:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($receiptStatus == 0): ?>
            <h2>Upload Receipt</h2>
            <p>Upload your payment receipt to proceed.</p>      
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="receipt" required>
                <button type="submit">Submit</button>        
            </form>
        <?php else: ?>
            <h2>Waiting for Approval</h2>
            <p>Your receipt has been submitted and is under review. Please come back and check after 24 hours.</p>
        <?php endif; ?>
    </div>
</body>
</html>
