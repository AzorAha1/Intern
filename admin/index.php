<?php
session_start();
include '../dbconn.php'; // Ensure this file initializes $conn as a PDO object

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $number = $_POST['number'];
    $password = $_POST['password'];

    // Check if number exists in the database
    $sql = "SELECT * FROM admin WHERE number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $number, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Check payment status
            if ($user['role'] === 'Administrator') {
                $_SESSION['number'] = $user['number'];
                $_SESSION['email'] = $user['email'];
                header("Location: dashboard.php"); // Redirect to dashboard if PAID
                exit;
            } else {
                $_SESSION['number'] = $user['number'];
                $_SESSION['email'] = $user['email'];
                header("Location: index.php"); // Redirect to payment if not PAID
                exit;
            }
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "No account found with this number!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FMC BKD | Admin Login</title>
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
                    <h2><b>ADMIN LOGIN</b></h2>

                    <form id="adminLoginForm" action="" class="login-form-content" method="POST">
                        <input type="hidden" name="role" value="admin-user">
                        
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="adminnumber" name="number" placeholder="Number" autocomplete="off" required>
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
