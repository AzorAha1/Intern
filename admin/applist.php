<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

<main id="main" class="main">
  <div class="pagetitle d-flex justify-content-between align-items-center">
    <h1>Paid Application</h1>
    <button id="send-all-documents-btn" class="btn btn-primary btn-lg">
      <i class="bi bi-envelope"></i> Send All Documents
    </button>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Paid Applications</h5>
            <!-- Flash message -->
            <div id="flash-message" style="display: none; padding: 10px; margin-bottom: 20px; color: green; background-color: #d4edda; border: 1px solid #c3e6cb;">
              Applicant Selected<br>
              Welcome to Skill Builder Academy!
            </div>

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
              <tbody id="applicant-list">
                <?php
                // SQL query to fetch interns who are PAID but NOT ADMITTED
                $sql = "SELECT * FROM intern WHERE status = 'PAID' AND admission = 'NOT SELECTED' ORDER BY created_date ASC";
                $result = $conn->query($sql);

                if ($result->rowCount() > 0) { // Use rowCount() to check for rows
                  $cnt = 1;
                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr id="applicant-<?php echo $row['id']; ?>">
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['sex']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td>
                      <?php if ($row['admission'] == 'SELECTED') { ?>
                        <button class="btn btn-danger cancel-btn" data-id="<?php echo $row['id']; ?>">Cancel</button>
                      <?php } else { ?>
                        <button class="btn btn-success select-btn" data-id="<?php echo $row['id']; ?>">Select</button>
                      <?php } ?>
                    </td>
                    <td>
                      <button class="btn btn-secondary"><a href="viewdoc.php?viewid=<?php echo htmlentities($row['id']); ?>" class="View details" title="View details" data-toggle="tooltip"><i class="bi bi-files" style="color: white"></i></a></button>
                      <button class="btn btn-primary"><a href="view-profile.php?viewid=<?php echo htmlentities($row['id']); ?>" class="View details" title="View details" data-toggle="tooltip"><i class="bi bi-eye" style="color: white"></i></a></button>
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

<!-- Additional styles for button placement -->
<style>
  .pagetitle {
    display: flex;
    justify-content: space-between; /* Space out title and button */
    align-items: center; /* Vertically center content */
  }

  /* Adjust margin for the button */
  .pagetitle button {
    margin-left: 20px; /* Optional: Space between the title and the button */
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    // Handle Select button click
    $('.select-btn').on('click', function () {
      var id = $(this).data('id');
      $.ajax({
        url: 'admn.php',
        type: 'GET',
        data: { uid: id },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.status === 'success') {
            // Show success flash message
            $('#flash-message').fadeIn();

            // Remove applicant from the table after confirmation
            $('#applicant-' + id).fadeOut();

            // Update the button to "Cancel"
            $('[data-id="' + id + '"]').replaceWith('<button class="btn btn-danger cancel-btn" data-id="' + id + '">Cancel</button>');
          }
        }
      });
    });

    // Handle Cancel button click
    $('.cancel-btn').on('click', function () {
      var id = $(this).data('id');
      $.ajax({
        url: 'admn.php',
        type: 'GET',
        data: { id: id },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.status === 'success') {
            // Show success flash message
            $('#flash-message').fadeIn();

            // Remove applicant from the table after confirmation
            $('#applicant-' + id).fadeOut();

            // Update the button to "Select"
            $('[data-id="' + id + '"]').replaceWith('<button class="btn btn-success select-btn" data-id="' + id + '">Select</button>');
          }
        }
      });
    });

    // Send All Documents Button functionality
   // In your existing applist.php script
   $('#send-all-documents-btn').on('click', function () {
    if (!confirm('Are you sure you want to send the interview notice to all eligible applicants?')) {
        return;
    }
    
    var button = $(this);
    button.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Sending...');

    $.ajax({
        url: 'sendDocumentToAll.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                alert(response.message);
                console.log('Detailed results:', response.results);
            } else {
                alert('Error: ' + (response.message || 'Unknown error occurred'));
                console.error('Error details:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', {xhr: xhr, status: status, error: error});
            let errorMsg = 'Request failed: ';
            try {
                const res = JSON.parse(xhr.responseText);
                errorMsg += res.message || error;
            } catch (e) {
                errorMsg += error;
            }
            alert(errorMsg);
        },
        complete: function() {
            button.prop('disabled', false).html('<i class="bi bi-envelope"></i> Send All Documents');
        }
    });
});
    // Hide flash message after 3 seconds
    setTimeout(function() {
      $('#flash-message').fadeOut();
    }, 3000);
  });
</script>
