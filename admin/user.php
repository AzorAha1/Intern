<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Add Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Users</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<?php 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password']; // 'fmcbkd' is pre-filled and readonly
    $role = $_POST['role'];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL query with placeholders for binding parameters
    $sql = "INSERT INTO admin (name, number, email, password, role) 
            VALUES (:name, :number, :email, :password, :role)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password); // Insert hashed password
    $stmt->bindParam(':role', $role);

    // Execute the query
    if ($stmt->execute()) {
      echo 'User added successfully!';
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add User</h5>
          
          <!-- Form to Add User -->
          <form action="" method="POST">
            
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
              <label for="number" class="form-label">Phone Number</label>
              <input type="text" class="form-control" id="number" name="number" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" value="fmcbkd" readonly>
            </div>

            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-control" id="role" name="role" required>
                <option value="Administrator">Administrator</option>
                <option value="User">User</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Add User</button>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->

<?php include('include/footer.php'); ?>    
