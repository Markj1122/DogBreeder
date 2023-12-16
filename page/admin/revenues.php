<?php include "../layouts/master.php"; ?>
<?php
   // Database Connection
   include ('../../page/router/config.php');
?>

  <title>Revenues - Section</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../../public/assets/css/view-user.css">
  <link rel="icon" href="../../public/src/images/logo.png">

  <style>
    .modal-content {
        max-width: 320px;
        max-height: 40vh;
        position: relative;
        top: 160px;
        left: 30%;
    }
    .card {
        width: 50%;
        position: relative;
        left: 30%;
    }
    .breeders,
    .subscription,
    .tax {
        font-size: 1.1rem;
        color: #000fff;
    }
    .total {
        font-size: 1.3rem;
        font-weight: bolder;
        padding: 7px 5px;
        background: #ccc;
        color: #000fff;
    }
    h2 {
        text-align: center;
    }
    .modal-footer {
        padding: 8px 15px;
        color: #ffff;
    }
    .card-footer a {
        padding: 8px 10px;
        background: #222;
        border-radius: 5px;
    }
  </style>

<?php include "../layouts/admin-header.php"; ?>
<div class="page" id="app">

<div class="container mt-5">
<?php 
    if(isset($_SESSION['success'])) 
    {
    ?>
        <div class="alert alert-success alert-dismissible fade show" style="width: 555px; position: relative; left: 30%;" role="alert">
            <i class='fas fa-check-circle' style='font-size:14px;color:green'></i>
              <?php echo $_SESSION['success']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
        <?php

        unset($_SESSION['success']);

        }
    ?>
    <div class="card">
        <div class="card-body">
            <h2>Dog Breeder Revenues</h2><br>
            <i style="text-decoration: underline">Overview</i>
<?php

$con = mysqli_connect("localhost","root","","dogbreeder_db");

$result = mysqli_query($con,"SELECT * FROM breeders");
$count_breeders = mysqli_num_rows($result);

?> 
        <div class="breeders">
                Number of Breeders:
                <span class="text-black"><?php echo "$count_breeders" ?></span>
            </div>
            <?php
  // Calculate Total Revenue
  $revenueSql = "SELECT SUM(revenue) AS total_revenue FROM `revenues`";
  $revenueResult = mysqli_query($conn, $revenueSql);

  if ($revenueResult) {
    $revenueRow = mysqli_fetch_assoc($revenueResult);
    $total_revenue = $revenueRow['total_revenue'];
  } else {
    $total_revenue = 0;
  }

  // Calculate Total Tax
  $taxSql = "SELECT SUM(tax) AS total_tax FROM `revenues`";
  $taxResult = mysqli_query($conn, $taxSql);

  if ($taxResult) {
    $taxRow = mysqli_fetch_assoc($taxResult);
    $total_tax = $taxRow['total_tax'];
  } else {
    $total_tax = 0;
  }

  // Calculate Total Revenues by subtracting Total Tax from Total Revenue
  $total_revenues = $total_revenue - $total_tax;
?>

<div class="subscription">
    Total Subscriptions: <span class="text-black">₱<?php echo $total_revenue; ?></span>
</div>
<div class="tax">
    Taxes: <span class="text-black">₱<?php echo $total_tax; ?></span>
</div><br>
<div class="total">
    Total Revenues: <span class="text-black">₱<?php echo $total_revenues; ?>.00</span>
</div>

        </div>
        <div class="card-footer">
           <a href="#" style="text-decoration: none" onclick="openAddRevenueModal()">
              Add Revenue <i class="fas fa-circle-plus"></i>
           </a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addRevenueModal" tabindex="-1" role="dialog" aria-labelledby="addRevenueModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateRevenueModalLabel">Add Revenue</h5>
      </div>
      <div class="modal-body">
      <form action="revenue-process.php" method="POST">
    <div class="form-group">
        <input type="number" class="form-control" name="revenue" placeholder="Revenue Amount" required>
    </div><br>
    <div class="form-group">
        <input type="number" class="form-control" name="tax" placeholder="Input Tax (10% of the revenue)">
    </div>
    <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-success" name="add_revenue" style="border: none">Add</button>
        <button type="button" class="btn btn-secondary" onclick="closeModal()" style="border: none">Close</button>
    </div>
</form>

      </div>
    </div>
  </div>
</div>

  </div>

<script>
    function openAddRevenueModal() {
    $('#addRevenueModal').modal('show');
  }

  function closeModal() {
    $('#addRevenueModal').modal('hide');
  }
</script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
