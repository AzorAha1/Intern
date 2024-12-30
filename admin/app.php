<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

<style>
.flash-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

.flash-message {
    padding: 15px 25px;
    margin-bottom: 10px;
    border-radius: 4px;
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-20px); }
    100% { opacity: 1; transform: translateY(0); }
}
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>NewApplication </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">New Application</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Internship Application Records (UNPAID)</h5>
                        
                        <table class="table table-striped datatable">
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
                            <tbody id="applicationTable">
                                <?php 
                                $sql = "SELECT * FROM intern WHERE status = 'UNPAID' ORDER BY created_date ASC";
                                $result = $conn->query($sql);

                                if ($result->rowCount() > 0) {
                                    $cnt = 1;
                                    while($row = $result->fetch(PDO::FETCH_ASSOC)) { 
                                ?>
                                <tr id="applicant-<?php echo $row['id']; ?>" data-receipt="<?php echo $row['receipt']; ?>">
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['sex']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['department']; ?></td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="changeStatus(<?php echo $row['id']; ?>, 'PAID')">Paid</a> / 
                                        <a href="../login/uploads/<?php echo $row['receipt']; ?>" class="View receipt" title="View receipt" data-toggle="tooltip">Receipt</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteApplicant(<?php echo $row['id']; ?>)">
                                            <i class="bi bi-trash" style="color: white"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php 
                                    $cnt++;
                                    } 
                                } else {
                                    echo "<tr><td colspan='8'>No unpaid records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
function changeStatus(id, status) {
    fetch(`admit_exec.php?id=${id}&status=${status}&uid=${id}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (status === 'PAID') {
                let row = document.getElementById('applicant-' + id);
                row.remove();
                updateRowNumbers();
                showFlashMessage('Applicant payment confirmed');
            }
        } else {
            showFlashMessage('Error updating status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showFlashMessage('Error updating status');
    });
}

function deleteApplicant(id) {
    if (confirm('Are you sure you want to delete this applicant?')) {
        fetch(`delete-user.php?id=${id}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                let row = document.getElementById('applicant-' + id);
                row.remove();
                updateRowNumbers();
                showFlashMessage('Applicant deleted successfully');
            } else {
                showFlashMessage('Error deleting applicant');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showFlashMessage('Error deleting applicant');
        });
    }
}

function showFlashMessage(message) {
    let flashContainer = document.querySelector('.flash-container');
    if (!flashContainer) {
        flashContainer = document.createElement('div');
        flashContainer.className = 'flash-container';
        document.body.appendChild(flashContainer);
    }

    const flashMessage = document.createElement('div');
    flashMessage.className = 'flash-message alert alert-success';
    flashMessage.innerHTML = message;
    flashContainer.appendChild(flashMessage);

    setTimeout(() => {
        flashMessage.remove();
        if (!flashContainer.hasChildNodes()) {
            flashContainer.remove();
        }
    }, 3000);
}

function updateRowNumbers() {
    const rows = document.querySelectorAll('#applicationTable tr');
    rows.forEach((row, index) => {
        const numberCell = row.querySelector('td:first-child');
        if (numberCell) {
            numberCell.textContent = index + 1;
        }
    });
}
</script>

<?php include('include/footer.php'); ?>