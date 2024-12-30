<?php include('include/header.php'); ?>
<!-- ======= Sidebar ======= -->
<?php include('include/sidebar.php'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1> Status</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active"> Status</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <?php if ($rowaccess['admission'] == 'NOT SELECTED') { ?>
                        <p><?php echo $rowaccess['admission']; ?></p>
                    <?php } else { ?>
                        <p>Congratulations on being offered admission to the Federal Medical Centre Birninkudu Internship programme.</p>
                        <form action="letter.php" method="get" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary">Print Invitation Letter</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
<br>

<!-- ======= Footer ======= -->
<?php include('include/footer.php'); ?>
