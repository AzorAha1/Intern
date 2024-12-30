<?php include('include/header.php'); ?>
<?php
if (isset($_POST['btnupload'])) {
    // Get the form data
    $dept = $_POST['dept'];
    $email = $_SESSION['email']; // Assuming email is stored in session

    // Update query using PDO
    $sql = "UPDATE intern SET department = :dept WHERE email = :email";
    $stmt = $conn->prepare($sql);

    try {
        // Bind parameters and execute
        $stmt->bindParam(':dept', $dept, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

       
    } catch (PDOException $e) {
        // Handle errors
        $_SESSION['error'] = 'Error updating department: ' . $e->getMessage();
        header("Location: category.php");
    }
}
include('include/sidebar.php');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1> Departments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <?php      
            // Ensure the database connection is included and working
          

            // Check access permission
            if (isset($rowaccess['department']) && $rowaccess['department'] == '0') {
            ?>
            <div class="col-lg-8">

                <!-- Create and Manage Departments -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Select Category</h5>

                        <!-- Department Form -->
                        <form action="" method="post">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">DEPARTMENT: </span>
                            <select class="form-control" name="dept" id="basic-url" aria-describedby="basic-addon3" required>
                            <option value="">Select</option>
                            <?php                         

                            // Fetch departments from the database
                            $query = "SELECT department FROM departments ORDER BY department ASC";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            
                            // Generate the dropdown options
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['department'] . '">' . htmlspecialchars($row['department']) . '</option>';
                            }
                            ?>
                            </select>
                            <button class="btn btn-primary float-end" name="btnupload">Select</button>
                        </div>
                        </form>


                    </div>
                </div>
                <?php } else { ?>

                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Department Name</h5>
                            <p style="color: blue;"><?php echo htmlspecialchars($rowaccess['department']); ?></p>
                            <a href="passport.php">
                                <button class="btn btn-success float-end">Next 
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </a>
                        </div>
                    </div>

                </div>
                <?php } ?>
            </div>
        </div>
    </section>

</main><!-- End #main -->
<br>
<!-- ======= Footer ======= -->
<?php include('include/footer.php'); ?>
