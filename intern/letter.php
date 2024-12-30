<?php
include('../dbconn.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['regno']) || !isset($_SESSION['email'])) {
    header("Location: ../login"); // Redirect to login if not authenticated
    exit;
}

$regno = $_SESSION['regno']; // Retrieve registration number from session
$email = $_SESSION['email']; // Retrieve email from session

try {
    // Fetch user data using PDO
    $sql = "SELECT * FROM intern WHERE email = :email";
    $stmt = $conn->prepare($sql); // Prepare the statement
    $stmt->bindParam(':email', $email, PDO::PARAM_STR); // Bind the email parameter
    $stmt->execute(); // Execute the statement
    $rowaccess = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch data as an associative array

    if (!$rowaccess) {
        echo "No user found with this email.";
        exit;
    }

    // Fetch transactions for the user
    $reg = $rowaccess['regno'];
    $query = "SELECT * FROM transactions WHERE regno = :regno";
    $transStmt = $conn->prepare($query);
    $transStmt->bindParam(':regno', $reg, PDO::PARAM_STR);
    $transStmt->execute();
    $transactions = $transStmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all transactions

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); // Display error if the query fails
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>FMC BKD | INTERNSHIP PORTAL</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="../img/LOGO.jpg" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
    * {
      font-family: 'Times New Roman', Times, serif;
    }
    .header-container {
      position: relative;
      text-align: center;
      margin-bottom: 20px;
    }
    .header-container img {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }
    .header-container .left-image {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
    }
    .header-container .right-image {
      position: absolute;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
    }
    .header-container h1 {
      font-size: 24px;
      font-weight: bold;
      display: inline-block;
      margin: 0;
    }
  </style>
  <!-- <script>
    // Automatically print and redirect
    window.onload = function () {
        window.print(); // Trigger print dialog
        setTimeout(function () {
            window.location.href = "application.php"; // Redirect after printing
        }, 1000); // Delay to ensure printing dialog is handled
    };
  </script> -->
</head>

<body>
  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-12">
            <div class="card info-card sales-card">

              <div class="header-container">
                <br><br>
                <!-- Left image -->
                <img src="../img/logo.jpg" class="rounded-circle left-image" alt="Logo">

                <!-- Center text -->
                <h1>FEDERAL MEDICAL CENTRE BIRNIN KUDU<br>BIRNIN KUDU JIGAWA STATE</h1>

                <!-- Right image --> 
              </div>
             
              <br>

              <?php echo $rowaccess['regno'];?>
              <table class="table">
                 <tr><th></th></tr>
             </table>
             
             <b><?php echo $rowaccess['name'];?>,</b> 
             <?php echo $rowaccess['local_gov'];?>,<br>
             <?php echo $rowaccess['state'];?>
              <br>
              <br>
              <center> <h2><b>INTERNSHIP PLACEMENT INTERVIEW</b></h2></center>
             
              <p style="font-size: 20px">I am directed to in invite you to to the internship placement interview scheduled to hold as follows:</p>
              &emsp;<p style="font-size: 20px"><b>Date:</b>   <?php 
            $sql = "SELECT * FROM close ORDER BY id ASC";
            $result = $conn->query($sql);
            $cnt = 1;
            
            while ($row1 = $result->fetch(PDO::FETCH_ASSOC)) { 
              echo $row1['date'];
            }
          ?> </p>
              <p style="font-size: 20px"><b>Time:</b> 9:00AM.</p>
              <p style="font-size: 20px"><b>Venue:</b> School
               of Midwifery Block, Federal Medical Cntre Birnin Kudu Kigawa State.</p>
              <table class="table">
                 <tr><th></th></tr>
             </table>
             <p style="font-size: 20px;"><b>Thanks.</b></p>
             <p><b><i>Signed</i></b></p>
             <p style="font-size: 20px"><b>Garba Abdussalam</b></p>
             <p style="font-size: 20px; padding-top: -30px"><b>For Head of Clinical / Training</b></p>
               
            </div>
          </div>
        </div>
      </div><!-- End News & Updates -->
    </div>
  </section>
</body>
</html>