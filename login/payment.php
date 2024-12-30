<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['regno']) || !isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirect to login if not authenticated
    exit;
}

$regno = $_SESSION['regno']; // Retrieve registration number from session
$email = $_SESSION['email']; // Retrieve email from session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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
        <h2>Payment</h2>
        <p>Follow The image to pay the Fees.</p>
        <form action="https://login.remita.net/remita/onepage/OAGFCRF/biller.spa" target="_blank">
            <!-- Remita's payment endpoint -->
            <img src="../img/ictunitskillbuilderpayment.png" width="100%" alt="Payment Image">
            <button type="submit">Pay Now</button>
            <a  href="next.php">Continue</a>
            
        </form>
       
    </div>
</body>
</html>
