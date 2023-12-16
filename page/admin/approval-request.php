<?php include "../layouts/master.php"?>
<?php
   // Database Connection
   include ('../../page/router/config.php');
?>

<title>Pendings - Admin Section</title>
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
<?php include "../layouts/admin-header.php"?>
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

          <div class="page-pretitle">
          </div>
          <h2 class="page-title">
            Manage Pendings
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
  <div class="container">
    <table id="pendingsTable" class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Firstame</th>
          <th scope="col">Lastame</th>
          <th scope="col">Email Address</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `pending_approval`";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result); // Get the number of rows

        if ($rowCount == 0) {
          // No data in the table, display "No pending request" message
          echo '<tr><td colspan="5">No pending request</td></tr>';
        } else {
          while ($row = mysqli_fetch_assoc($result)) {

            $profileImagePath = $row['profile_image'];
            $profileImagePath = $row['id_image'];
            $profileImagePath = $row['receipt'];
        ?>
            <tr>
              <td><?php echo $row["id"] ?></td>
              <td><?php echo $row["fname"] ?></td>
              <td><?php echo $row["lname"] ?></td>
              <td><?php echo $row["email"] ?></td>
              <td>
                <a href="view-breeder.php?id=<?php echo $row['id']; ?>" title="View Profile" class="link-primary" style="font-size:15px; text-decoration:none;">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </a>&nbsp;&nbsp;
                <a href="approved-request.php?id=<?php echo $row["id"] ?>" title="Approve" class="link-success" style="font-size:16px; text-decoration:none;">
                  <i class="fa fa-check-circle"></i>
                </a>&nbsp;&nbsp;
                <a href="reject-request.php?id=<?php echo $row["id"] ?>" title="Reject" class="link-danger" style="font-size:16px; text-decoration:none;" onclick="showDeleteConfirmation(event, <?php echo $row['id']; ?>, '<?php echo $row['fname']; ?>', '<?php echo $row['lname']; ?>'); return false;">
                  <i class="fa fa-times-circle"></i>
                </a>
              </td>
            </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function showDeleteConfirmation(event, id, fname, lname) {
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
      // If the user confirms, redirect to the reject-breeder.php page
      window.location.href = 'reject-request.php?id=' + id;
    }
  });
}
</script>

</body>
</html>
