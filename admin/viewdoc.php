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
        <h1>View Documents</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">View Documents</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    
    <section class="section profile">
        <div class="row">
            

            <div class="col-xl-10">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->  
                         <p></p>
                         <p> <?php echo $row['name'];?></p>  
                         <p> <?php echo $row['regno'];?></p>                   
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>CV</th>
                                <td ><a href="../intern/<?php echo $row['cv'];?>">View CV</a></td>
                            </tr>
                            <tr>
                                <th>Licence</th>
                                <td ><a href="../intern/<?php echo $row['license'];?>">View Licence</a></td>
                            </tr>
                            <tr>
                                <th>BSC Certificate</th>
                                <td ><a href="../intern/<?php echo $row['bsc'];?>">View Bsc Certificate</a></td>
                            </tr>
                            <tr>
                                <th>SSCE Certificate</th>
                                <td ><a href="../intern/<?php echo $row['ssce'];?>">View SSCE Certificate</a></td>
                            </tr>
                            <tr>
                                <th>Local Gov. Origin </th>
                                <td ><a href="../intern/<?php echo $row['lga'];?>">View Local government Origin</a></td>
                            </tr>
                            <tr>
                                <th>Birth Certificate</th>
                                <td ><a href="../intern/<?php echo $row['birth_cert'];?>">View Birth Certificate</a></td>
                            </tr>
                        </table>                   
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
