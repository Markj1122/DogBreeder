<?php include "../../page/layouts/master.php"?>
<?php
   // Database Connection
   include ('../../page/router/config.php');
?>

<title>Customers - Section</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="../../public/assets/css/view-modal.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../../page/layouts/breeder-header.php"?>
<div class="page" id="app">
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
        <?php 
          if(isset($_SESSION['success'])) 
          {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class='fas fa-trash' style='font-size:14px;color:red'></i>
              <?php echo $_SESSION['success']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>  

            <?php

            unset($_SESSION['success']);

          }
          ?>
          <div class="page-pretitle">
          </div>
          <h2 class="page-title">
            Manage Customer(s)
          </h2>
          <button id="refresh-button" onclick="refreshPage()"><i class="fa-solid fa-rotate"></i></button>
            <div id="loader" class="hidden"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container">
      <table id="customersTable" class="table table-hover text-center">
        <thead class="table-dark">
          <tr>  
            <th scope="col">Fullname</th>
            <th scope="col">Contact</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $loggedInAccount = $_SESSION['user_id'];
         $sql = "SELECT * FROM `purchase` INNER JOIN `user` on user_id = purchase_customer_id  WHERE `purchase_breeder_id` = $loggedInAccount GROUP BY purchase_customer_id";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?php echo $row["user_firstname"]. " " . $row['user_lastname']; ?></td>
              <td><?php echo $row["user_contact"] ?></td>
              <td><i><b><?php echo $row["user_status"] ?></b></i></td>
              <td>
                <a href="#" title="View Customer" class="link-primary" style="font-size:15px; text-decoration:none;" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $row['purchase_id']; ?>">
                <i class="fa-solid fa-magnifying-glass"></i>
                </a>&nbsp;&nbsp;
                <a href="#" title="Update Status" class="link-warning" style="font-size: 15px;" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['purchase_id']; ?>">
                <i class="fa-solid fa-pen-to-square"></i>
                </a>&nbsp;&nbsp;
                <a href="delete-customer.php?id=<?php echo $row["purchase_id"] ?>" title="Cancel" class="link-danger" style="font-size:15px;" onclick="showDeleteConfirmation(event, <?php echo $row['purchase_id']; ?>, '<?php echo $row['user_firstname']; ?>', '<?php echo $row['user_lastname']; ?>'); return false;">
                <i class="fa-solid fa-trash"></i>
                </a>
              </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel" style="color:blue;">Customer's Information
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label-delivery">PURCHASE TYPE:</label>
                      <span class="text-label-delivery"><?php echo $row['delivery']; ?></span>
                    </div>
                    <div class="mb-3">
                      <label class="form-label-payment">MODE OF PAYMENT:</label>
                      <span class="text-label-payment"><?php echo $row['payment']; ?></span>
                    </div>
                    <div class="mb-3">
                      <label class="form-label-address">ADDRESS:</label>
                      <span class="text-label-address"><?php echo $row['address']; ?></span>
                    </div>
                    <h3 style="color: blue">Dog Information</h3>
                    <hr>
                    <div class="mb-3">
                      <label class="form-label-breed">BREED TYPE:</label>
                      <span class="text-label-breed"><?php echo $row['breed_type']; ?></span>
                    </div>
                    <div class="mb-3">
                      <label class="form-label-type">DOG TYPE:</label>
                      <span class="text-label-type"><?php echo $row['dog_type']; ?></span>
                    </div>
                    <div class="mb-3">
                      <label class="form-label-price">PRICE:</label>
                      <span class="text-label-price"><?php echo $row['price']; ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End View Modal -->

             <!-- UPdate status Modal -->
             <div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="max-width:340px; height:32vh;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="updateodalLabel" style="color:orangered;">Update Status
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <form action="update-status.php" method="POST">
    <div class="mb-3">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input class="text-label" name="status" value="<?php echo $row['status']; ?>">
    </div>
    <button type="submit" name="submit" class="btn-update">Update</button>
</form>

                  </div>
                </div>
              </div>
            </div>
            <!-- End Update status Modal -->
            
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
    $('#customersTable').DataTable();

    $('#searchInput').keyup(function() {
      $('#customersTable').DataTable().search($(this).val()).draw();
    });
  });

  function showDeleteConfirmation(event, id, fname, lname) {
  event.preventDefault(); // Prevent the default link behavior

  Swal.fire({
    title: 'Are you sure?',
    html: `You are about to delete <b>${fname} ${lname}</b>'s data.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.isConfirmed) {
      // If the user confirms, redirect to the delete.php page
      window.location.href = 'delete-customer.php?id=' + id;
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
        window.location.href = "customers.php";
    }, 1500); // Change the delay time as needed
}

 // Get the modal and buttons
 var modal = document.getElementById("myModal");
    var openModalBtn = document.getElementById("openModalBtn");
    var closeModalBtn = document.getElementById("closeModalBtn");

    // Show the modal when the button is clicked
    openModalBtn.onclick = function() {
        modal.style.display = "block";
    }

    // Close the modal when the close button or anywhere outside the modal is clicked
    closeModalBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
