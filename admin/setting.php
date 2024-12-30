<?php
include('include/header.php');

// Check if the user is logged in
if (!isset($_SESSION['number']) || !isset($_SESSION['email'])) {
    header("Location: ../admin"); // Redirect if not logged in
    exit;
}

$email = $_SESSION['email']; // Get the email from session
$number = $_SESSION['number']; // Get the number (admin identifier)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $new_name = $_POST['new_name']; // New name
    $new_number = $_POST['new_number']; // New number

    // Validate input
    if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } else {
        try {
            // Check if the old password matches
            $sql = "SELECT password FROM admin WHERE number = :number"; // Assuming 'number' identifies the admin
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':number', $number, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($old_password, $user['password'])) {
                // Update the password if the old one is correct
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update query for name, number, and password
                $update_sql = "UPDATE admin SET name = :new_name, number = :new_number, password = :password WHERE number = :number";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bindParam(':new_name', $new_name, PDO::PARAM_STR);
                $update_stmt->bindParam(':new_number', $new_number, PDO::PARAM_STR);
                $update_stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                $update_stmt->bindParam(':number', $number, PDO::PARAM_STR);

                if ($update_stmt->execute()) {
                    $_SESSION['number'] = $new_number; // Update session to reflect the new number
                    $success = "Profile updated successfully.";
                } else {
                    $error = "Failed to update the profile. Please try again.";
                }
            } else {
                $error = "Old password is incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}

include('include/sidebar.php');
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Change Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Change Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Your Profile</h5>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>

                        <!-- Change Profile Form -->
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" class="form-control" id="old_password" name="old_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_name" class="form-label">New Name</label>
                                <input type="text" class="form-control" id="new_name" name="new_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_number" class="form-label">New Number</label>
                                <input type="text" class="form-control" id="new_number" name="new_number" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form><!-- End Change Profile Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php include('include/footer.php'); ?>
