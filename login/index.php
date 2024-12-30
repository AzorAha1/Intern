<?php
session_start();
include '../dbconn.php'; // Ensure this file initializes $conn as a PDO object

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists in the database
    $sql = "SELECT * FROM intern WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Check payment status
            if ($user['status'] === 'PAID') {
                $_SESSION['email'] = $user['email'];
                $_SESSION['regno'] = $user['regno'];
                header("Location: ../intern"); // Redirect to dashboard if PAID
                exit;
            } else {
                $_SESSION['email'] = $user['email'];
                $_SESSION['regno'] = $user['regno'];
                header("Location: payment.php"); // Redirect to payment if not PAID
                exit;
            }
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "No account found with this email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FMC BKD | Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="left-container">
            <div class="login-container">
                <center>
                    <?php if (isset($error)): ?>
                        <div class="error" style="background-color: #ff3232b3; color: white; border-radius: 10px; padding: 10px">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                </center>
                <div class="login-form">
                    <h2><b>LOGIN</b></h2>

                    <form id="adminLoginForm" action="" class="login-form-content" method="POST">
                        <input type="hidden" name="role" value="admin-user">
                        
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="adminEmail" name="email" placeholder="Email" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="adminPassword" name="password" placeholder="Password" autocomplete="off" required>
                                <i class="fas fa-eye" id="togglePassword" onclick="togglePassword()"></i>
                            </div>
                        </div>

                        <button type="submit" name="intern">LOGIN <i class="fa fa-arrow-right"></i></button>
                    </form>

                    <!-- Link to the signup page -->
                    <div class="signup-link">
                        <p>Don't have an account? <a href="signup.php">Create one</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="image-container"></div>
    </div>

    <script>
        // Function to toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById('adminPassword');
            const toggleIcon = document.getElementById('togglePassword');

            // Toggle password visibility
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
