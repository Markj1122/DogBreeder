<?php include "../layouts/master.php"; ?>
<?php
   // Database Connection
   include ('../../page/router/config.php');
?>

  <title>Users - Section</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../../public/assets/css/view-user.css">
  <link rel="icon" href="../../public/src/images/logo.png">

<?php include "../layouts/admin-header.php"; ?>
<div class="page" id="app">
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <?php 
          if(isset($_SESSION['status'])) 
          {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <i class='fas fa-trash' style='font-size:14px;color:red'></i>
              <?php echo $_SESSION['status']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['status']);
          }
          ?>
          <div class="page-pretitle">
          </div>
          <h2 class="page-title">
            Manage Users
          </h2>
          <button id="refresh-button" onclick="refreshPage()"><i class="fa-solid fa-rotate"></i></button>
            <div id="loader" class="hidden"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container">
      <table id="usersTable" class="table table-hover text-center">
        <thead class="table-dark">
          <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `users`";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?php echo $row["user_id"] ?></td>
              <td><?php echo $row["fname"] ?></td>
              <td><?php echo $row["lname"] ?></td>
              <td><?php echo $row["email"] ?></td>
              <td>
                <a href="#" title="View Profile" class="link-primary" style="font-size:15px; text-decoration:none; background:transparent;" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $row['user_id']; ?>">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </a>&nbsp;&nbsp;
                <a href="#" title="Restrict User" class="link-dark" style="font-size:15px; text-decoration:none; background:transparent;" data-bs-toggle="modal" data-bs-target="#restrictionModal">
                  <i class="fa-solid fa-clock"></i>
                </a>&nbsp;&nbsp;
                <a href="delete-user.php?user_id=<?php echo $row["user_id"] ?>" title="Delete User" class="link-danger" style="font-size:15px; text-decoration:none; background:transparent;" onclick="showDeleteConfirmation(event, <?php echo $row['user_id']; ?>, '<?php echo $row['fname']; ?>', '<?php echo $row['lname']; ?>'); return false;">
                  <i class="fa-solid fa-trash"></i> 
                </a>
              </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewModal<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Profile for <span style="color: blue;"><?php echo $row['fname']. " " . $row['lname']; ?></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <img src="<?php echo $row['profile_image']; ?>" alt="Profile Image" class="image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End View Modal -->

          <!-- Restriction Modal -->
            <div class="modal fade" id="restrictionModal" tabindex="-1" aria-labelledby="restrictionModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="height:67vh">
                  <div class="modal-header">
                    <h5 class="modal-title" id="restrictionModalLabel">Restriction for <span style="color:orangered;"><?php echo $row["fname"]. " " . $row["lname"]; ?></span></h5>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label for="end_date" class="form-label">End Date:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label for="reason" class="form-label">Reason of Restriction:</label>
                        <textarea id="reason" class="form-control" rows="3" required></textarea>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>&nbsp;
                        <span class="btn btn-secondary" id="closeModalButton">Close</span>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Restriction Modal -->
        <?php
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function() {
      $('#usersTable').DataTable();

      $('#searchInput').keyup(function() {
        $('#usersTable').DataTable().search($(this).val()).draw();
      });
    });

// Add an event listener to the "Close" button
document.getElementById('closeModalButton').addEventListener('click', function () {
    // Use Bootstrap's modal hide method to close the modal
    $('#restrictionModal').modal('hide');
  });

function showDeleteConfirmation(event, userId, fname, lname) {
  event.preventDefault(); // Prevent the default link behavior

  Swal.fire({
    title: 'Are you sure?',
    html: `You are about to delete <b>${fname} ${lname}</b>`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.isConfirmed) {
      // If the user confirms, redirect to the delete-user.php page
      window.location.href = 'delete-user.php?user_id=' + userId;
    }
  });
}

//Loader animation
function refreshPage() {
    // Hide the refresh button and show the loader
    document.getElementById("refresh-button").style.display = "none";
    document.getElementById("loader").style.display = "block";

    // Simulate a delay for demonstration purposes (you can replace this with actual data loading)
    setTimeout(function() {
        // Restore the refresh button and hide the loader after some time
        document.getElementById("refresh-button").style.display = "block";
        document.getElementById("loader").style.display = "none";

        // Redirect to the desired location (e.g., index.php)
        window.location.href = "user-list.php";
    }, 1500); // Change the delay time as needed
}

</script>
