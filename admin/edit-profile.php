<?php  include('include/header.php');?>
<?php
 try {

  $eid=$_GET['editid'];
  // Prepare and execute the query
  $sql = "SELECT * FROM intern where id='$eid'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  // Fetch data as an associative array
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    
?>

<?php  include('include/sidebar.php');?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Edit Applicant Details</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Applicant</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  

    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">EDIT APPLICANT DETAILS</h5>

          <!-- Advanced Form Elements -->
          <form action="" method="post">                              
            <div class="input-group mb-3">
              <span class="input-group-text"  id="basic-addon3">FULLNAME: </span>
              <input type="text" name="txtfullname" value="<?php echo $row['name'];?>" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">SEX: </span>
             <select class="form-control" name="txtsex" id="basic-url" aria-describedby="basic-addon3" required="">
              <option value="<?php echo $row['sex'];?>"><?php echo $row['sex'];?></option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
             </select>
            </div>
            
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">PHONE NO: </span>
              <input type="NUMBER"  value="<?php echo $row['phone'];?>" name="txtphone" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">EMAIL: </span>
              <input type="email"  value="<?php echo $row['email'];?>" name="txtemail" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">STATE: </span>
              <input type="text"   value="<?php echo $row['state'];?>"name="txtstate" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"  id="basic-addon3">LOCAL GOV: </span>
              <input type="text"  value="<?php echo $row['local_gov'];?>" name="txtlga"class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"  id="basic-addon3">ADDRESS: </span>
              <input type="text"  value="<?php echo $row['address'];?>" name="txtaddress" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"  id="basic-addon3">QUALIFICTION: </span>
              <input type="text"  value="<?php echo $row['qualification'];?>" name="txtquaf" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
            </div>
             
            
            <button class="btn btn-primary float-end" name="btnedit"> Edit</button>
            </div>
            </div>
          </form> 
 
        </div>
      </div>

    </div>
  </div>
</section> <?php 
                
            } 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>


</main><!-- End #main -->
<?php  include('include/footer.php');?>