<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Open / Close</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Open / Close</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <br>
          
          <?php 
            $sql = "SELECT * FROM close ORDER BY id ASC";
            $result = $conn->query($sql);
            $cnt = 1;
            
            while ($row1 = $result->fetch(PDO::FETCH_ASSOC)) { 
          ?>
          <table>
            <tr>
              <td>
                <?php if (($row1['status']) == 1) { ?>
                  <a href="open.php?id=<?php echo $row1['id']; ?>" style="color: red">
                    <Button class="btn btn-danger">CLOSE</Button>
                    <h3 style="color: green">OPENED</h3>
                  </a>
                <?php } else { ?>
                  <a href="open.php?uid=<?php echo $row1['id']; ?>">
                    <Button class="btn btn-success">OPEN</Button>
                    <h3 style="color: red">CLOSED</h3>
                  </a>
                <?php } ?>
              </td>
            </tr>
          </table>
          <?php } ?>

          <br>
        
        <!-- Form to submit date -->
        <form action="" method="post">
          <label for="">Date of interview</label>
          <input type="date" name="date" class="form-control" required>
          <br>
          <input class="btn btn-primary" type="submit" value="Submit">
        </form>
        </div>
      

        <?php
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['date'])) {
          $submittedDate = $_POST['date'];

          // Prepare and execute the update query
          $sqlUpdate = "UPDATE close SET date = :date WHERE id = 1";
          $stmt = $conn->prepare($sqlUpdate);
          $stmt->bindParam(':date', $submittedDate);
          $stmt->execute();

          echo "<p>Date updated successfully for ID 1.</p>";
        }
        ?>
        
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->

<?php include('include/footer.php'); ?> 
