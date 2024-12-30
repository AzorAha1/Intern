<?php include('include/header.php'); ?>  
<?php include('include/sidebar.php'); ?>  

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Admin Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    // Assuming your PDO connection is stored in $conn
    try {
        // Query to count total applicants
        $query = "SELECT COUNT(*) as count FROM intern";
        $stmt = $conn->query($query);
        $row_no_users = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Query to count successful applicants
        $query = "SELECT COUNT(*) as count FROM intern WHERE status='PAID'";
        $stmt = $conn->query($query);
        $row_users = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Query to count pending applicants
        $query = "SELECT COUNT(*) as count FROM intern WHERE name='0'";
        $stmt = $conn->query($query);
        $row_name = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Query to count unpaid applicants
        $query = "SELECT COUNT(*) as count FROM intern WHERE status='UNPAID'";
        $stmt = $conn->query($query);
        $row_unpaid = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <section class="section dashboard">
        <div class="row">
            <!-- Total Applicants Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body" style="background-color: green">
                        <h5 class="card-title" style="color: white">NUMBER |<span style="color: white"> APPLICANT</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h2 style="color: white"><?php echo $row_no_users; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Successful Applicants Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body" style="background-color: blue">
                        <h5 class="card-title" style="color: white">NUMBER |<span style="color: white"> SUCCESSFUL APPLICANT</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-5">
                                <h6 style="color: white"><?php echo $row_users; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Applicants Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">NUMBER |<span> PENDING APPLICANT</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-5">
                                <h6><?php echo $row_name; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unpaid Applicants Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body" style="background-color: red">
                        <h5 class="card-title" style="color: white">NUMBER |<span style="color: white"> APPLICANT NOT PAID</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-5">
                                <h6 style="color: white"><?php echo $row_unpaid; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Message Card -->
            <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title"><span></span></h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <marquee behavior="reverse" direction="">
                                    <h3 style="color: green">Welcome To Internship Portal <?php echo date('Y'); ?></h3>
                                </marquee>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End News & Updates -->
    </section>
</main><!-- End #main -->

<br>

<!-- ======= Footer ======= -->
<?php include('include/footer.php'); ?>
