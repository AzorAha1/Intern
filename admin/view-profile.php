<?php
include('include/header.php');
include('include/sidebar.php');

try {
    $eid = $_GET['viewid'];
    // Prepare and execute the query
    $sql = "SELECT * FROM intern WHERE id=:eid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch data as an associative array
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>View Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">View Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="../intern/<?php echo $row['passport']; ?>" alt="Profile" class="rounded-circle">
                        <h2><?php echo $row['name']; ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>             
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['name']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Sex</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['sex']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone Number</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['phone']; ?></div>
                                </div>   
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['email']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['dob']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">State of Origin</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['state']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Local Gov</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['local_gov']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['address']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Department</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['department']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Qualification</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $row['qualification']; ?></div>
                                </div>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="pass.php?viewid=<?php echo $eid; ?>" method="post">                    
                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button name="btnchange" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
include('include/footer.php');
?>
