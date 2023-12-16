<?php include "../layouts/master.php"; ?>
<?php
   // Database Connection
   include ('../../page/router/config.php');
?>

<title>Subscriptions - Admin Section</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="icon" href="../../public/src/images/logo.png">
<style>
  .table {
    border-collapse: collapse;
    width: 100%;
  }

  .table th,
  .table td,
  .table-responsive {
    border: 1px solid #000;
    padding: 8px;
  }

  .table th {
    text-align: left;
  }

  /* Blur background */
  .modal-backdrop.show {
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
  }
</style>
<?php include "../layouts/admin-header.php"; ?>
<div class="page" id="app">
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <?php 
            if(isset($_SESSION['status']) || isset($_SESSION['success'])) 
            {
              $alertClass = isset($_SESSION['status']) ? 'alert-warning' : 'alert-success';
              $iconClass = isset($_SESSION['status']) ? 'fas fa-trash' : 'fas fa-check-circle';
              $message = isset($_SESSION['status']) ? $_SESSION['status'] : $_SESSION['success'];
              $iconColor = isset($_SESSION['status']) ? 'red' : 'green';

              unset($_SESSION['status']);
              unset($_SESSION['success']);
          ?>
          <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
              <i class='<?php echo $iconClass; ?>' style='font-size:14px;color:<?php echo $iconColor; ?>'></i>
              <?php echo $message; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>  
          <?php
            }
          ?>
          <div class="page-pretitle"></div>
          <h2 class="page-title">
            Manage Subscriptions
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container">
      <table class="table table-hover text-center">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
$sql = "SELECT * FROM `subscriptions`";
$result = mysqli_query($conn, $sql);

if ($result) {
  if (mysqli_num_rows($result) == 0) {
    // No data in the table, display "No pending request" message
    echo '<tr><td colspan="5">No pending subscriptions</td></tr>';
  } else {
    while ($row = mysqli_fetch_assoc($result)) {
?>
      <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["fname"]; ?></td>
        <td><?php echo $row["lname"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td>
          <a href="view-subscription.php?id=<?php echo $row['id']; ?>" title="View Profile" class="link-primary" style="font-size:15px; text-decoration:none;">
            <i class="fa-solid fa-magnifying-glass"></i>
          </a>&nbsp;&nbsp;
          <a href="approved-subscription.php?id=<?php echo $row["id"]; ?>" title="Approve" class="link-success" style="font-size:16px; text-decoration:none;">
            <i class="fa fa-check-circle"></i>
          </a>&nbsp;&nbsp;
          <a href="reject-subscription.php?id=<?php echo $row["id"]; ?>" title="Reject" class="link-danger" style="font-size:16px; text-decoration:none;" onclick="showDeleteConfirmation(event, <?php echo $row['id']; ?>, '<?php echo $row['fname']; ?>', '<?php echo $row['lname']; ?>'); return false;">
            <i class="fa fa-times-circle"></i>
          </a>
        </td>
      </tr>
<?php
    }
  }
} 
?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function showDeleteConfirmation(event, postId, fname, lname) {
    event.preventDefault(); // Prevent the default link behavior

    Swal.fire({
      title: 'Are you sure?',
      html: `You are about to reject <b>${fname} ${lname}</b>`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // If the user confirms, redirect to the reject-subscriber.php page
        window.location.href = 'reject-subscriber.php?id=' + postId;
      }
    });
  }
</script>

</body>
</html>
