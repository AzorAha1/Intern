


<?php include('include/header.php');?>
  <!-- ======= Sidebar ======= -->
  <?php include('include/sidebar.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>View Application</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">View Application</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-12">
              <div class="card info-card sales-card">
               <table class="table table-striped table-bordered">
                <br>
                <center><h3>Applcation Details</h3></center>
                <br>
               
                <tr>
                <center><th><img src="../img/logo.jpg" class="rounded-circle" width="100" alt="profile"></th>
                    <td></td>
                    <th></th>
                    <td><img src="<?php echo $rowaccess['passport'];?>" class="rounded-circle" width="100" alt="profile"></td> </center> 
                </tr>
                              
                <tr>
                    <th width="20%">Full Name:</th>
                    <td><?php echo $rowaccess['name'];?></td>
                    <th width="20%">Gender:</th>
                    <td><?php echo $rowaccess['sex'];?></td>
                </tr>
                <tr>
                    <th width="20%">Date of Birth:</th>
                    <td><?php echo $rowaccess['dob'];?></td>
                </tr>
                <tr>
                    <th width="25%">Phone Number:</th>
                    <td><?php echo $rowaccess['phone'];?></td>
                </tr>
                <tr>
                    <th width="20%">Email:</th>
                    <td><?php echo $rowaccess['email'];?></td>
                </tr>
                <tr>
                    <th width="20%">State:</th>
                    <td><?php echo $rowaccess['state'];?></td>
                </tr>
                <tr>
                    <th width="20%">Local Gov:</th>
                    <td><?php echo $rowaccess['local_gov'];?></td>
                    <th width="20%">Address:</th>
                    <td><?php echo $rowaccess['address'];?></td>
                </tr>
                <tr>
                    <th width="20%">Qualification:</th>
                    <td><?php echo $rowaccess['qualification'];?></td>
                </tr>
                <tr>
                    <th width="30%">License Expiry Date:</th>
                    <td><?php echo $rowaccess['licence_exp'];?></td>
                </tr>
                <tr>
                    <th width="30%">Depatment:</th>
                    <td><?php echo $rowaccess['department'];?></td>
                </tr>
               </table>
               <center>
                <p><b><h3>Status</h3></b></p>
                </center>
               <table class="table table-striped table-bordered">
                <tr>
                    <th width="45%"></th>
                    <td><h1 style="color: green"><?php echo $rowaccess['status']; ?></h1></td>
                    <th  width="45%"></th>
                </tr>
               </table>
               </center>

               <a href="print.php" class="btn btn-primary">Print</a>
              </div>
            </div>

            </div>
          </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
<br>
  <!-- ======= Footer ======= -->
 <?php include('include/footer.php');?>