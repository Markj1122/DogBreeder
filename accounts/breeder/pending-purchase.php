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

<?php 
          if(isset($_SESSION['success'])) 
          {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='fas fa-check-circle' style='font-size:14px;color:green'></i>
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
            Manage Orders
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container">
      <table id="customersTable" class="table table-hover text-center">
        <thead class="table-dark">
          <tr>  
            <th scope="col">Customer Fullname</th>
            <th scope="col">Address</th>
            <th scope="col">Status</th>
            <th scope="col">Pet Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $loggedInUser = $_SESSION['user_id'];
          $sql = "SELECT * FROM `purchase` INNER JOIN `user` ON user_id = purchase_customer_id
                                           INNER JOIN  `post_feed` ON post_feed_id = purchase_post_id WHERE purchase_breeder_id = $loggedInUser";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?php echo $row["user_firstname"]. " " . $row['user_lastname']; ?></td>
              <td><?php echo $row["user_address"] ?></td>
              <td><?php echo $row["purchase_status"] ?></td>
              <td><?php echo '<img src="data:image;base64,'.base64_encode($row['post_feed_pet_image']). '" alt="Pet Image" >'; ?></td>
              <td>
                <a href="#" title="View Customer" class="link-primary" style="font-size:15px; text-decoration:none;" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $row['purchase_id']; ?>">
                <i class="fa-solid fa-magnifying-glass"></i>
                </a>&nbsp;&nbsp;
                <?php 
                  if($row['purchase_status'] == 'Pending')
                  {
                ?>
                <a href="accept.php?id=<?php echo $row["purchase_id"] ?>" title="Accept" class="link-success" style="font-size:15px;">
                <i class="fa-solid fa-circle-check"></i>
                <?php 
                  }
                  if($row['purchase_status'] == 'Pending' || $row['purchase_status'] == 'Accepted')
                  {
                ?>
                </a>&nbsp;&nbsp;
                <a href="cancel.php?id=<?php echo $row["purchase_id"] ?>" title="Cancel" class="link-warning" style="font-size:15px;" onclick="showDeleteConfirmation(event, <?php echo $row['purchase_id']; ?>, '<?php echo $row['user_firstname']; ?>', '<?php echo $row['user_lastname']; ?>'); return false;">
                <i class="fa-solid fa-circle-xmark"></i>
                </a>
              </td>
                <?php
                  }
                ?>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewModal<?php echo $row['purchase_id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel" style="color:blue;">Customer's Information
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <!-- <div class="mb-3">
                      <label class="form-label-delivery">PURCHASE TYPE:</label>
                      <span class="text-label-delivery"><?php echo $row['delivery']; ?></span>
                    </div> -->
                    <div class="mb-3">
                      <!-- <label class="form-label-payment">MODE OF PAYMENT:</label>
                      <span class="text-label-payment"><?php echo $row['payment']; ?></span> -->
                    </div>
                    <div class="mb-3">
                      <label class="form-label-address">ADDRESS:</label>
                      <span class="text-label-address"><?php echo $row['user_address']; ?></span>
                    </div>
                    <h3 style="color: blue">Dog Information</h3>
                    <hr>
                    <div class="mb-3">
                      <label class="form-label-breed">BREED TYPE:</label>
                      <span class="text-label-breed"><?php echo $row['post_feed_breed_type']; ?></span>
                    </div>
                    <div class="mb-3">
                      <label class="form-label-price">PRICE:</label>
                      <span class="text-label-price"><?php echo $row['post_feed_price']; ?></span>
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
    $('#customersTable').DataTable();

    $('#searchInput').keyup(function() {
      $('#customersTable').DataTable().search($(this).val()).draw();
    });
  });

  function showDeleteConfirmation(event, id, fname, lname) {
  event.preventDefault(); // Prevent the default link behavior

  Swal.fire({
    title: 'Are you sure?',
    html: `You are about to cancel the purchase of <br> <b>${fname} ${lname}</b>`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.isConfirmed) {
      // If the user confirms, redirect to the delete.php page
      window.location.href = 'cancel.php?id=' + id;
    }
  });
}
</script>

</body>
</html>
