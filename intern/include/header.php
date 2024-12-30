<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['regno']) || !isset($_SESSION['email'])) {
    header("Location: ../login"); // Redirect to login if not authenticated
    exit;
}

// Retrieve session variables
$regno = $_SESSION['regno'];
$email = $_SESSION['email'];

try {
    // Fetch user data using PDO
    $sql = "SELECT * FROM intern WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $rowaccess = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no data is found, handle it
    if (!$rowaccess) {
        echo "<script>alert('No record found for the given email.');</script>";
        header("Location: ../login");
        exit;
    }
} catch (PDOException $e) {
    // Handle database connection or query errors
    echo "Error: " . $e->getMessage();
    exit;
}

// Handle form submission for "problem" (if applicable)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['msg'])) {
    $msg = htmlspecialchars($_POST['msg'], ENT_QUOTES, 'UTF-8');
    $time = date('Y-m-d H:i:s'); // Use ISO format for database timestamps

    try {
        $sql = "INSERT INTO problem (msg, time, email) VALUES (:msg, :time, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':msg', $msg);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo '<script>alert("Message received successfully.");</script>';
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['error'] = 'Failed to send your message. Please try again.';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FMC BKD | Internship Portal</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../img/LOGO.jpg" rel="icon">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
    <style>
    .preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #029abc; /* Light transparent background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure it stays on top of all other content */
}

.loader {
    border: 16px solid #f3f3f3; /* Light grey border */
    border-top: 16px solid #007BFF; /* Blue top border */
    border-radius: 100%;
    width: 60px;
    height: 60px;
    animation: spin 2s linear infinite; /* Animation for rotation */
}

/* Keyframes for spinning effect */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
  </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #007f7f">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="../img/logo.jpg" alt="" style="border-radius: 5px;">
                <span class="d-none d-lg-block" style="color: white">FMCBKD</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn" style="color: white"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text" style="color: white"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            Describe Your Problem !!
                        </li>
                        <li>
                            <form action="" method="post" class="p-3">
                                <textarea name="msg" placeholder="Describe your problem..." class="form-control mb-2" rows="4"></textarea>
                                <button type="submit" class="btn btn-success float-end">
                                    <i class="bi bi-send"></i> Submit
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?php echo $rowaccess['passport'] ?? '../img/default-profile.png'; ?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2" style="color: white;">
                            <?php echo htmlspecialchars($rowaccess['name'] ?? 'Guest'); ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo htmlspecialchars($rowaccess['name'] ?? 'Guest'); ?></h6>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="application.php">
                                <i class="bi bi-person"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="setting.php">
                                <i class="bi bi-gear"></i> Account Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
</body>

</html>
