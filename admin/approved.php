<?php 
include('include/header.php'); 
include('include/sidebar.php');

// Fetch the admitted interns
$sql = "SELECT * FROM intern WHERE admission = 'SLECETED' ORDER BY created_date ASC"; 
$result = $conn->query($sql);

// Handle Delete functionality
if (isset($_GET['delete'])) {
    $intern_id = $_GET['delete']; // Get the intern ID from the URL

    // Prepare SQL query to delete the intern record
    $sql = "DELETE FROM intern WHERE id = :id";
    $stmt = $conn->prepare($sql);

    try {
        // Execute delete query
        $stmt->execute([':id' => $intern_id]);
        header("Location: application_list.php"); // Redirect back to the list page
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error deleting intern: ' . $e->getMessage();
    }
}

?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Application List</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Application List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <!-- <div class="row">
    <div class="col-lg-12">
      <div class="card mt-5">
        <div class="card-body">
          <form action="" method="post" class="mt-5">
            <div class="input-group mb-3">
              <input type="date" class="form-control" name="filter_date">
              <button class="btn btn-primary" type="submit" name="filter">Filter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> -->

  <div class="row">
    <div class="col-lg-12">
      <div class="card mt-5">
        <div class="card-body">
          <h5 class="card-title">Admitted Interns</h5>
          
          <!-- Display any session errors -->
          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?php
              echo $_SESSION['error'];
              unset($_SESSION['error']);
              ?>
            </div>
          <?php endif; ?>

          <!-- Interns List -->
          <table class="table table-striped datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Reg Number</th>
                <th>Date of Admission</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->rowCount() > 0) {
                  $cnt = 1;
                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['regno']); ?></td>
                <td><?php echo htmlspecialchars($row['created_date']); ?></td>
                <td>
                  <a href="application_list.php?delete=<?php echo $row['id']; ?>" 
                     onclick="return confirm('Are you sure you want to delete this intern?');"
                     class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <?php
                  $cnt++;
                  }
              } else {
                  echo "<tr><td colspan='5'>No admitted interns found.</td></tr>";
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

<?php include('include/footer.php'); ?>
