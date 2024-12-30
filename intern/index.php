


  <?php include('include/header.php');?>
  <!-- ======= Sidebar ======= -->
  <?php include('include/sidebar.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                    
                </div>

                <div class="card-body">
                  <h5 class="card-title">NOTICE |<span> INSTRUCTIONS</span></h5>

                  <div class="d-flex align-items-center">
                     
                    <div class="ps-3">
                     <ol>
                      <l>Make Sure to insert correct Details because no any correction after submission</li>
                                          
                     </ol>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body" style="background-color: green">
                  <h5 class="card-title" style="color: white"> DATE |<span style="color: white"> TODAY</span></h5>

                  <div class="d-flex align-items-center" >
                     
                    <div class="ps-5" style="background-color: ">
                      <h6 style="color: white"><?php echo date('d/m/Y')?></h6>
                     
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
            <div class="col-xxl-4 col-md-12">
              
            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

               
                <div class="card-body">
                  <h5 class="card-title"> <span></span></h5>

                  <div class="d-flex align-items-center">
                     
                    <div class="ps-3">
                      <marquee behavior="reverse" direction=""><h3 style="color: green">Welcome To FMCBKD Internship Portal <?php echo date('Y')?></h3></marquee>
                    </div>
                  </div>

                </div>
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