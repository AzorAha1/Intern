<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Admitted List</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Admitted List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Internship Application Records</h5>
          
          <table class="table datatable">
            <thead>
              <tr>
                <th><b>#</b></th>
                <th>Fullname</th>
                <th>Sex</th>
                <th>Phone No</th>
                <th>Email</th>                   
                <th>Department</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                // SQL query to fetch interns who are PAID but NOT ADMITTED
                $sql = "SELECT * FROM intern WHERE status = 'PAID' AND admission = 'SELECTED' ORDER BY created_date ASC";
                $result = $conn->query($sql);

                if ($result->rowCount() > 0) { // Use rowCount() to check for rows
                  $cnt = 1;
                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
              ?>
                <tr>
                  <td><?php echo $cnt; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['sex']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['department']; ?></td>
                  <td>
                  
                  <?php if ($row['admission'] == 'SELECTED') { ?>
                    <a class="btn btn-danger" href="admn.php?id=<?php echo $row['id']; ?>">Cancel</a>
                  <?php } else { ?>
                    <a href="admn.php?uid=<?php echo $row['id']; ?>">Admit</a>
                  <?php } ?> 
               </td>
               <td>
                 <button class="btn btn-primary"><a href="edit-profile.php?editid=<?php echo htmlentities($row['id']); ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="bi bi-list" style="color: white"></i></a></button>
                 <button class="btn btn-success"><a href="view-profile.php?viewid=<?php echo htmlentities($row['id']); ?>" class="View details" title="View details" data-toggle="tooltip"><i class="bi bi-eye" style="color: white"></i></a></button>
                </td>
                </tr>
              <?php 
                  $cnt++;
                  }
                } else {
                  echo "<tr><td colspan='7'>No PAID interns awaiting admission</td></tr>";
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
