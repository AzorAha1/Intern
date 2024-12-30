<?php
session_start();
include '../dbconn.php';  // Ensure this file initializes $conn as a PDO object

if ($conn === null) {
    die("Database connection not established.");
}

$sql = "SELECT status FROM close";  // Get status from close table
$result = $conn->query($sql);

// Step 3: Check if the query returned any results
if ($result->rowCount() > 0) {
    // Output data of each row
    while ($rown = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($rown['status'] == 0) {
            // Redirect to 404.php if the portal is closed
            header('Location: 404.php');
            exit;
        }
    }
} else {
    echo "No records found";
    exit;
}

$current_year = date('y'); // Get current year, e.g., '24' for 2024
$reg_prefix = "FMC/BKD/ADM/"; // Registration prefix

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $sql = "SELECT * FROM intern WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (count($result) > 0) {
            $error = "Email already exists!";
        } else {
            // Generate the new registration number
            $sql = "SELECT regno FROM intern WHERE regno LIKE ? ORDER BY regno DESC LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, "$reg_prefix$current_year/%", PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();

            if ($result) {
                // Get the last registration number and increment it
                $last_regno = $result['regno'];
                $last_increment = (int) substr($last_regno, -3);
                $new_increment = str_pad($last_increment + 1, 3, '0', STR_PAD_LEFT);
            } else {
                // If no previous records, start from 001
                $new_increment = '001';
            }

            // Generate the new registration number
            $regno = $reg_prefix . $current_year . '/' . $new_increment;

            // Insert new user into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Secure password hashing
            $sql = "INSERT INTO intern (regno, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $regno, PDO::PARAM_STR);
            $stmt->bindValue(2, $email, PDO::PARAM_STR);
            $stmt->bindValue(3, $hashed_password, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Save registration number in session and redirect
                $_SESSION['email'] = $email;
                $_SESSION['regno'] = $regno;
                header("Location: index.php");
                exit;
            } else {
                $error = "Error creating account. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FMC BKD | Signup</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="left-container">
            <div class="signup-container">
                <center>
                    <?php if (isset($error)): ?>
                        <div class="error" style="background-color: #ff3232b3; color: white; border-radius: 10px; padding: 10px">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                </center>
                <div class="signup-form">
                    <h2><b>CREATE ACCOUNT</b></h2>

                    <form action="signup.php" method="POST" class="login-form-content">
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <button type="submit">Create Account</button>
                    </form>

                    <div class="login-link">
                        <p>Already have an account? <a href="index.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="image-container"></div>
    </div>
</body>
</html>