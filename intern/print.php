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
  <script>
    // Automatically print and redirect
    window.onload = function () {
        window.print(); // Trigger print dialog
        setTimeout(function () {
            window.location.href = "application.php"; // Redirect after printing
        }, 1000); // Delay to ensure printing dialog is handled
    };
  </script>
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
                <img src="<?php echo $rowaccess['passport']; ?>" class="rounded-circle right-image" alt="Profile">
              </div>
              <br>
              <table class="table">
                 <tr><th></th></tr>
             </table>
              <center>
                <h3>Internship Application Details</h3>
              </center>
              <br>
              <?php foreach ($transactions as $transaction): ?>
              <i><b>REF: </b> <?php echo $transaction['reference']; ?></i>
              <?php endforeach; ?>
              <table class="table">
                 <tr><th></th></tr>
             </table>
              <table class="table table-striped table-bordered">
                <tr>
                  <th width="20%">Full Name:</th>
                  <td><?php echo $rowaccess['name']; ?></td>
                  <th width="20%">Gender:</th>
                  <td><?php echo $rowaccess['sex']; ?></td>
                </tr>
                <tr>
                  <th width="20%">Date of Birth:</th>
                  <td><?php echo $rowaccess['dob']; ?></td>
                </tr>
                <tr>
                  <th width="20%">Email:</th>
                  <td><?php echo $rowaccess['email']; ?></td>
                </tr>
                <tr>
                  <th width="25%">Phone Number:</th>
                  <td><?php echo $rowaccess['phone']; ?></td>
                </tr>
                <tr>
                  <th width="20%">State:</th>
                  <td><?php echo $rowaccess['state']; ?></td>
                </tr>
                <tr>
                  <th width="20%">Local Gov:</th>
                  <td><?php echo $rowaccess['local_gov']; ?></td>
                  <th width="20%">Address:</th>
                  <td><?php echo $rowaccess['address']; ?></td>
                </tr>
                <tr>
                  <th width="20%">Qualification:</th>
                  <td><?php echo $rowaccess['qualification']; ?></td>
                </tr>
                <tr>
                  <th width="30%">License Expiry Date:</th>
                  <td><?php echo $rowaccess['licence_exp']; ?></td>
                </tr>
                <tr>
                  <th width="30%">Department:</th>
                  <td><?php echo $rowaccess['department']; ?></td>
                </tr>
              </table>
              <table class="table">
                 <tr><th></th></tr>
             </table>
              <center>
                <p><b><h3>Status</h3></b></p>
              </center>
              <table class="table">
                 <tr><th></th></tr>
             </table>
              <table class="table table-striped table-bordered">
                <?php foreach ($transactions as $transaction): ?>
                  <tr>
                    <th>Amount:</th>
                    <td>N<?php echo $transaction['amount']; ?></td>
                    <th><?php echo $transaction['status']; ?></th>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <th width="45%"></th>
                  <td><h1 style="color: green"><?php echo $rowaccess['status']; ?></h1></td>
                  <th width="45%"></th>
                </tr>
              </table>
              <table class="table">
                 <tr><th></th></tr>
             </table>
            </div>
          </div>
        </div>
      </div><!-- End News & Updates -->
    </div>
  </section>
</body>
</html>