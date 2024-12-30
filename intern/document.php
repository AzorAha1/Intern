<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Upload Documents</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Document</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Upload Documents</h5>

            <!-- Modal for success message -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Upload Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Your file has been uploaded successfully!
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Upload Form for CV -->
             <?php if($rowaccess['cv'] == 0) {?>
            <form id="cv_form" action="" method="post" enctype="multipart/form-data">
              <h6>Upload your CV (PDF or DOC only)</h6>
              <div class="input-group mb-3">
                <input type="file" name="cv" class="form-control" accept=".pdf, .doc, .docx" required>
                <button class="btn btn-primary" name="upload_cv" type="submit">Upload</button>
              </div>
            </form>
                <?php } else{?>
                  
                  <table class="table table-striped">
                    <tr>
                      <th>Curriculum Vitae</th>
                      <td><button class="btn btn-success float-end">Uploaded</button></td>
                    </tr>
                 </table>
                  <?php }?>
                  <?php if($rowaccess['license'] == 0) {?>
            <!-- Upload Form for License -->
            <form id="license_form" action="" method="post" enctype="multipart/form-data">
              <h6>Upload your License (Image)</h6>
              <div class="input-group mb-3">
                <input type="file" name="license" class="form-control" accept="image/*" required>
                <button class="btn btn-primary" name="upload_license" type="submit">Upload</button>
              </div>
            </form>
            <?php } else{?>
                  
                  <table class="table table-striped">
                    <tr>
                      <th>License</th>
                      <td><button class="btn btn-success float-end">Uploaded</button></td>
                    </tr>
                 </table>
                  <?php }?>
                  <?php if($rowaccess['bsc'] == 0) {?>
            <!-- Upload Form for BSc Certificate -->
            <form id="bsc_form" action="" method="post" enctype="multipart/form-data">
              <h6>Upload your BSc Certificate (Image)</h6>
              <div class="input-group mb-3">
                <input type="file" name="bsc" class="form-control" accept="image/*" required>
                <button class="btn btn-primary" name="upload_bsc" type="submit">Upload</button>
              </div>
            </form>
            <?php } else{?>
                  
                  <table class="table table-striped">
                    <tr>
                      <th>Bsc Certificate</th>
                      <td><button class="btn btn-success float-end">Uploaded</button></td>
                    </tr>
                 </table>
                  <?php }?>
                  <?php if($rowaccess['ssce'] == 0) {?>
            <!-- Upload Form for SSCE Certificate -->
            <form id="ssce_form" action="" method="post" enctype="multipart/form-data">
              <h6>Upload your SSCE Certificate (Image)</h6>
              <div class="input-group mb-3">
                <input type="file" name="ssce" class="form-control" accept="image/*" required>
                <button class="btn btn-primary" name="upload_ssce" type="submit">Upload</button>
              </div>
            </form>
            <?php } else{?>
                  
                  <table class="table table-striped">
                    <tr>
                      <th>SSCE Certificate</th>
                      <td><button class="btn btn-success float-end">Uploaded</button></td>
                    </tr>
                 </table>
                  <?php }?>
                  <?php if($rowaccess['lga'] == 0) {?>
            <!-- Upload Form for LGA Origin -->
            <form id="lga_form" action="" method="post" enctype="multipart/form-data">
              <h6>Upload your LGA Origin (Image)</h6>
              <div class="input-group mb-3">
                <input type="file" name="lga" class="form-control" accept="image/*" required>
                <button class="btn btn-primary" name="upload_lga" type="submit">Upload</button>
              </div>
            </form>
            <?php } else{?>
                  
                  <table class="table table-striped">
                    <tr>
                      <th>LGA Origin</th>
                      <td><button class="btn btn-success float-end">Uploaded</button></td>
                    </tr>
                 </table>
                  <?php }?>
                  <?php if($rowaccess['birth_cert'] == 0) {?>
            <!-- Upload Form for Birth Certificate -->
              <form id="birth_cert_form" action="" method="post" enctype="multipart/form-data">
                <h6>Upload your Birth Certificate (Image)</h6>
                <div class="input-group mb-3">
                  <input type="file" name="birth_cert" class="form-control" accept="image/*" required>
                  <button class="btn btn-primary" name="upload_birth_cert" type="submit">Upload</button>
                </div>
              </form>
            <?php } else{?>
                  
                  <table class="table table-striped">
                    <tr>
                      <th>Birth Certificate</th>
                      <td><button class="btn btn-success float-end">Uploaded</button></td>
                    </tr>
                    <tr>
                    <th></th>
                    <td><a href="application.php" class="btn btn-primary float-end">Next <i class="bi bi-arrow-right"></i></a></td>
                    </tr>
                 </table>
                  <?php }?>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->
<br>
<?php include('include/footer.php'); ?>

<?php
 
function handleFileUpload($fieldName, $email, $dbColumn) {
    global $conn;

    if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = time() . "_" . basename($_FILES[$fieldName]['name']);
        $targetFilePath = $uploadDir . $fileName;

        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $validFileTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($fileType), $validFileTypes)) {
            echo '<div class="alert alert-danger">Invalid file type for ' . $fieldName . '.</div>';
            return false;
        }

        if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetFilePath)) {
            $query = "UPDATE intern SET $dbColumn = :filePath WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':filePath', $targetFilePath);
            $stmt->bindValue(':email', $email);

            if ($stmt->execute()) {
                echo '<script>
                        var myModal = new bootstrap.Modal(document.getElementById("successModal"));
                        myModal.show();
                      </script>';
                return true;
            } else {
                echo '<div class="alert alert-danger">Database update failed for ' . $fieldName . '.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Failed to upload file for ' . $fieldName . '.</div>';
        }
    } else {
        echo '<div class="alert alert-warning">No file uploaded for ' . $fieldName . '.</div>';
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email']; // Assuming a session variable for email
    if (isset($_POST['upload_cv'])) handleFileUpload('cv', $email, 'cv');
    if (isset($_POST['upload_license'])) handleFileUpload('license', $email, 'license');
    if (isset($_POST['upload_bsc'])) handleFileUpload('bsc', $email, 'bsc');
    if (isset($_POST['upload_ssce'])) handleFileUpload('ssce', $email, 'ssce');
    if (isset($_POST['upload_lga'])) handleFileUpload('lga', $email, 'lga');
    if (isset($_POST['upload_birth_cert'])) handleFileUpload('birth_cert', $email, 'birth_cert');
}
?>
