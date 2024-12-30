<?php 
ob_start();
include('include/header.php'); 
include('include/sidebar.php');

// Handle form submission for adding a department
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
    $department = trim($_POST['txtdept']);
    $current_date = date('Y-m-d H:i:s'); // Get current date and time

    if (!empty($department)) {
        // Prepare the SQL query to insert the department
        $sql = "INSERT INTO departments (department, date_created) VALUES (:department, :date_created)";
        $stmt = $conn->prepare($sql);

        try {
            // Execute the query with parameter binding
            $stmt->execute([':department' => $department, ':date_created' => $current_date]);
            // Redirect after successful insertion
            header("Location: dept.php");
            exit;
        } catch (PDOException $e) {
            // Handle any database errors
            $_SESSION['error'] = 'Error inserting department: ' . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = 'Department name cannot be empty.';
    }
}

// Handle department deletion
if (isset($_GET['delete'])) {
    $department_id = $_GET['delete']; // Get department ID from the URL

    // Prepare SQL query to delete the department
    $sql = "DELETE FROM departments WHERE id = :id";
    $stmt = $conn->prepare($sql);

    try {
        // Execute the query to delete the department
        $stmt->execute([':id' => $department_id]);
        header("Location: dept.php"); // Redirect back to the department page
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error deleting department: ' . $e->getMessage();
    }
}

?>

<main id="main" class="main">

<!-- Page title and breadcrumb -->
<div class="pagetitle">
  <h1>Department</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Department</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <!-- Department Input Form -->
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <br>
          <h2>Enter Department</h2>

          <!-- Display any session errors -->
          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?php
              echo $_SESSION['error'];
              unset($_SESSION['error']); // Clear the error message after displaying
              ?>
            </div>
          <?php endif; ?>

          <!-- Form for adding a new department -->
          <form action="" method="post">
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">DEPARTMENT:</span>
              <input type="text" name="txtdept" class="form-control" required>
              <button class="btn btn-primary float-end" name="send">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Department List -->
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Department List</h5>
          <table class="table table-striped datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Department Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
            // Fetch departments from the database
            $sql = "SELECT * FROM departments ORDER BY department ASC";
            $result = $conn->query($sql);

            if ($result->rowCount() > 0) {
                $cnt = 1; // Counter for department listing
                // Loop through the results and display department names
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
              <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo htmlspecialchars($row['department']); ?></td>
                <td>
                  <!-- Delete button -->
                  <a href="dept.php?delete=<?php echo $row['id']; ?>" 
                     onclick="return confirm('Are you sure you want to delete this department?');"
                     class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
            <?php
                $cnt++; // Increment counter
                }
            } else {
                echo "<tr><td colspan='3'>No departments found.</td></tr>";
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->

<?php 
ob_end_flush(); // Flush output buffer
?>

<!-- Footer and include custom JS (should be at the bottom) -->
<?php include('include/footer.php'); ?>

<!-- Custom Footer JS (e.g., handle sidebar toggle, etc.) -->
<script>
  // Example JS for sidebar toggle
  document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapse');
        });
    }
  });
</script>
