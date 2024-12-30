<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['number']) || !isset($_SESSION['email'])) {
    header("Location: ../admin"); // Redirect to login if not authenticated
    exit;
}

$number = $_SESSION['number']; // Retrieve registration number from session
$email = $_SESSION['email']; // Retrieve email from session

try {
    // Fetch user data using PDO
    $sql = "SELECT * FROM admin WHERE number = :number";
    $stmt = $conn->prepare($sql); // Prepare the statement
    $stmt->bindParam(':number', $number); // Bind the email parameter
    $stmt->execute(); // Execute the statement
    $rowaccess = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch data as an associative array

    
    // Uncomment this section if you plan to handle form submissions for "problem"
    /*
    if (isset($_POST["msg"])) {
        $msg = htmlspecialchars($_POST['msg'], ENT_QUOTES, 'UTF-8'); // Escape message input
        $time = date('d/m/Y - h:i:s');
        
        $sql = "INSERT INTO problem (msg, time, email) VALUES (:msg, :time, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':msg', $msg);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            $_SESSION['email'] = $email;
            echo '<script>alert("Received Successfully");</script>';
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = 'Try Again, Not Sent';
        }
    }
    */
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); // Display error if the query fails
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title > FMC BKD | INTERNSHIP POTAL</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="../img/LOGO.jpg" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-color: black">
  <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="../img/logo.jpg" alt="" width="" style="color: white; border-radius: 5px">
        <span class="d-none d-lg-block" style="color: white">FMCBKD</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn" style="color: white"></i>
    </div><!-- End Logo -->

    <div class="search-bar" >
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto" >
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

       
 

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle=" ">
            <i class="bi bi-chat-left-text" style="color: white"></i>
             
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              Describe Your Problem !!
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
                             
                <div>
                 <form action="" method="post">                                        
                      <textarea name="msg" id="" placeholder="Describe Your Problem if Any....."cols="50" rows="5" class="form-control"></textarea>
                      <input type="text" class="form-control" name="email" value="" hidden>
                      <button class="btn btn-success float-end"><i class="bi bi-send " name="msg"></i></button>
                 </form>
                   
                </div>
               
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>            

            
          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../img/contact.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2" style="color: white;"><?php echo $rowaccess['name'];?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $rowaccess['role'];?></h6>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="setting.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

             

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->