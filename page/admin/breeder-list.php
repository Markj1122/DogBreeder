<?php include "../layouts/master.php"?>
<?php
   // Database Connection
   include ('../../page/router/config.php');
?>

<title>Breeders - Section</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="../../public/assets/css/view-breeder.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../layouts/admin-header.php"?>
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
            Manage Breeders
          </h2>
          <button id="refresh-button" onclick="refreshPage()"><i class="fa-solid fa-rotate"></i></button>
            <div id="loader" class="hidden"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container">
      <table id="breedersTable" class="table table-hover text-center">
        <thead class="table-dark">
          <tr>  
            <th scope="col">ID</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email Address</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `breeders`";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?php echo $row["breeder_id"] ?></td>
              <td><?php echo $row["fname"] ?></td>
              <td><?php echo $row["lname"] ?></td>
              <td><?php echo $row["email"] ?></td>
              <td>
                <a href="#" title="View Photos" class="link-primary" style="font-size:15px; text-decoration:none;" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $row['breeder_id']; ?>">
                <i class="fa-solid fa-magnifying-glass"></i>
                </a>&nbsp;&nbsp;
                <a href="delete-breeder.php?breeder_id=<?php echo $row["breeder_id"] ?>" title="Delete Breeder" class="link-danger" style="font-size:15px; text-decoration:none;" onclick="showDeleteConfirmation(event, <?php echo $row['breeder_id']; ?>, '<?php echo $row['fname']; ?>', '<?php echo $row['lname']; ?>'); return false;">
                <i class="fa-solid fa-trash"></i>
                </a>
              </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewModal<?php echo $row['breeder_id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Photos for <span style="color:blue;"><?php echo $row["fname"]. " " . $row["lname"];?></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label-profile">Profile Image</label>
                      <img src="<?php echo $row['profile_image']; ?>" alt="Profile Image" class="profile-image">
                    </div>
                    <div class="mb-3">
                      <label class="form-label-id">ID Picture</label>
                      <img src="<?php echo $row['id_image']; ?>" alt="ID Image" class="id-image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End View Modal -->
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function() {
    $('#breedersTable').DataTable();

    $('#searchInput').keyup(function() {
      $('#breedersTable').DataTable().search($(this).val()).draw();
    });
  });

  function showDeleteConfirmation(event, breederId, fname, lname) {
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
      // If the breeder confirms, redirect to the delete-breeder.php page
      window.location.href = 'delete-breeder.php?breeder_id=' + breederId;
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
    }, 1500); // Change the delay time as needed
}

</script>

</body>
</html>
