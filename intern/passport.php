<?php
include('include/header.php');

if (isset($_POST['btnupload'])) {
    // Check if the file is uploaded successfully
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        $upload_dir = "upload/";
        $location = $upload_dir . $file_name;

        // Move the file to the target directory
        if (move_uploaded_file($tmp_name, $location)) {
            // Prepare and execute the update query using PDO
            $sql = "UPDATE intern SET passport = :passport WHERE email = :email";
            $stmt = $conn->prepare($sql);

            try {
                $stmt->execute([
                    ':passport' => $location,
                    ':email' => $email, // Ensure $email is properly set
                ]);

                // Redirect on success
                echo "<script>window.location = 'passport.php';</script>";
            } catch (PDOException $e) {
                echo "Error updating passport: " . $e->getMessage();
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "Error uploading file: " . $_FILES['image']['error'];
    }
}

include('include/sidebar.php');
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Passport</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Passport</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
      <?php 
            if($rowaccess['passport'] == '0'){
      ?>
        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-10">
              <div class="card info-card sales-card">
                <br>
                <h2>Upload passport</h2>
                <form  method="post"  enctype="multipart/form-data">
                    <div class="input-group mb-3">
                    <input type="file" class="form-control" name="image" id="basic-url" aria-describedby="basic-addon3">
                    <button class="btn btn-primary float-end" name="btnupload"><i class="bi bi-upload"></i></button>
                    </div>               
                </form>
                <br>
              </div>
            </div><!-- End Sales Card -->
             
          </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->
        <?php }else{?>
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Passport</h5>
              <p style="color: blue;"><img src="<?php echo $rowaccess['passport'];?>" width="100" alt=""></p>
              <a href="details.php"><button class="btn btn-success float-end">Next <i class="bi bi-arrow-right"></i></button></a> </div>
          </div>

        </div>
        <?php }?>

      </div>
    </section>

  </main><!-- End #main -->
<br>
  <!-- ======= Footer ======= -->
 <?php include('include/footer.php');?>