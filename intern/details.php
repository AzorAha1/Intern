<?php
ob_start(); // Start output buffering

include('include/header.php');

if (isset($_POST["btncontinue"])) {
    $fullname = $_POST['txtfullname'];
    $sex = $_POST['txtsex'];
    $dob = $_POST['txtdob'];
    $phone = $_POST['txtphone'];
    $state = $_POST['txtstate'];
    $lga = $_POST['txtlga'];
    $address = $_POST['txtaddress'];
    $exp = $_POST['txtexp'];
    $quaf = $_POST['txtquaf'];

    // Use a prepared statement to execute the query
    $sql = "UPDATE intern 
            SET name = :name, sex = :sex, dob = :dob, phone = :phone, state = :state, 
                local_gov = :lga, address = :address, licence_exp = :licence_exp, qualification = :qualification 
            WHERE email = :email";
    
    $stmt = $conn->prepare($sql);

    try {
        // Bind the parameters and execute
        $stmt->execute([
            ':name' => $fullname,
            ':sex' => $sex,
            ':dob' => $dob,
            ':phone' => $phone,
            ':state' => $state,
            ':lga' => $lga,
            ':address' => $address,
            ':licence_exp' => $exp,
            ':qualification' => $quaf,
            ':email' => $email // Make sure $email is set and valid
        ]);

        // Redirect on success
        header("Location: details.php");
        exit;
    } catch (PDOException $e) {
        // Log or display the error
        echo "Error: " . $e->getMessage();
    }
}

include('include/sidebar.php');
?>
 
  <!-- ======= Sidebar ======= -->
  <?php include('include/sidebar.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

<section class="section">
      <div class="row">
        <?php
          if($rowaccess['name'] == '0'){
        ?><div class="col-lg-12">
          <div class="card">
    <div class="card-body">
      <h5 class="card-title">ENTER YOUR PERSONAL DETAILS</h5>
      <!-- Advanced Form Elements -->
      <form action="" method="post">                              
        <div class="input-group mb-3">
          <span class="input-group-text"  id="basic-addon3">FULLNAME: </span>
          <input type="text" name="txtfullname" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3">SEX: </span>
         <select class="form-control" name="txtsex" id="basic-url" aria-describedby="basic-addon3" required="">
          <option value="">Select</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
         </select>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3">D.O.B: </span>
          <input type="date" class="form-control" name="txtdob" id="basic-url" aria-describedby="basic-addon3" required="">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3">PHONE NO: </span>
          <input type="NUMBER" name="txtphone" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3">STATE: </span>
          <input type="text" name="txtstate" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text"  id="basic-addon3">LOCAL GOV: </span>
          <input type="text" name="txtlga"class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text"  id="basic-addon3">ADDRESS: </span>
          <input type="text" name="txtaddress" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text"  id="basic-addon3">LICENECE EXP: </span>
          <input type="date" name="txtexp" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text"  id="basic-addon3">QUALIFICTION: </span>
          <input type="text"   name="txtquaf" class="form-control" id="basic-url" aria-describedby="basic-addon3" required="">
        </div>
        <button class="btn btn-primary float-end" name="btncontinue"> Submit</button>
        </div>
        </div>
      </form> 
    </div>
  </div>
</div>

</a>


              <?php }else{?>
        <div class="col-lg-12">   
        
   <div class="card">
     <div class="card-body">
       <h5 class="card-title">VIEW DETAILS</h5>
       <!-- General Form Elements -->
       <form>
         
          <table table-striped>
           <tr>
           <img src="<?php echo $rowaccess['passport'];?>" style="float: right" width="100" alt="">
             
           </tr>
           <br>
           <br><br>
           <br><br>
           
             <tr>
               <th>Full Name: </th>
               <td> <?php echo $rowaccess['name'];?></td>
             </tr>
             <tr>
               <th>Sex: </th>
               <td> <?php echo $rowaccess['sex'];?></td>
             </tr>
             <tr>
               <th>Email: </th>
               <td> <?php echo $rowaccess['email'];?></td>
             </tr>
             <tr>
               <th>Phone: </th>
               <td> <?php echo $rowaccess['phone'];?></td>
             </tr>
             <tr>
               <th>State: </th>
               <td> <?php echo $rowaccess['state'];?></td>
             </tr>
             <tr>
               <th>L G A: </th>
               <td> <?php echo $rowaccess['local_gov'];?></td>
             </tr>
             <tr>
               <th>Address: </th>
               <td> <?php echo $rowaccess['address'];?></td>
             </tr>
             <tr>
               <th> Licence exp: </th>
               <td> <?php echo $rowaccess['licence_exp'];?></td>
             </tr>
             <tr>
               <th>Qualification: </th>
               <td> <?php echo $rowaccess['qualification'];?></td>
             </tr>                    
          </table>
          <br><br>
          <a href="tables-data.php"><button class="btn btn-success float-end"><a href="document.php" style="color: white">Next <i class="bi bi-arrow-right"></i></a></button></a>
       </form><!-- End General Form Elements -->
     </div>
   </div>
 </div>        
        <?php }?>
      </div>
    </section>

  </main><!-- End #main -->
<br>
  <!-- ======= Footer ======= -->
 <?php include('include/footer.php');?>
 <?php
ob_end_flush(); // End output buffering
?>