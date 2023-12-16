<?php include "../../page/layouts/master.php"?>
<title>Post Feed - Section</title>
<link rel="stylesheet" href="../../public/assets/css/view-modal.css">
<link href="../../public/assets/css/headers.css" rel="stylesheet">
<link href="../../public/assets/css/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../../page/layouts/breeder-header-1.php"?>


<div class="page-pretitle">
          <h2 class="page-title justify-content-center">
            Track My Purchase
          </h2>
        </div>
            <form action="tracked.php" method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-4 track" role="search">
                <input type="search" class="form-control" name="search" id="searchInput" placeholder="Enter your Tracking Number (TN)" aria-label="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </form>

    <div class="container">
<?php
include ('../../page/router/config.php');

if (isset($_GET['search'])) {
    $searchQuery = trim($_GET['search']);

    // Use = for exact match
    $sql = "SELECT * FROM customers WHERE tracking_number = ?";
    
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $searchParam = $searchQuery; // No need for wildcards for exact match
    if (!$stmt->bind_param("s", $searchParam)) {
        die("Bind failed: " . $stmt->error);
    }
    
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Display the table header outside the loop
        ?>
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

        while ($row = $result->fetch_assoc()) {
            $firstName = $row['fname'];
            $lastName = $row['lname'];
            $contact = $row['contact'];
            $status = $row['status'];
            ?>
            <tr>
                <td><?php echo $firstName . " " . $lastName; ?></td>
                <td><?php echo $contact; ?></td>
                <td><strong><?php echo $status; ?></strong></td>
                <td>
                    <a href="#" title="View Customer" class="link-primary" style="font-size:15px; text-decoration:none;" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $row['id']; ?>">
                        <i class="fa-solid fa-magnifying-glass"></i>
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
                    <div class="mb-2">
                      <label class="form-label-delivery">PURCHASE TYPE:</label>
                      <span class="text-label-delivery"><?php echo $row['delivery']; ?></span>
                    </div>
                    <div class="mb-2">
                      <label class="form-label-payment">MODE OF PAYMENT:</label>
                      <span class="text-label-payment"><?php echo $row['payment']; ?></span>
                    </div>
                    <div class="mb-2">
                      <label class="form-label-address">ADDRESS:</label>
                      <span class="text-label-address"><?php echo $row['address']; ?></span>
                    </div>
                    <h3 style="color: blue">Dog Information</h3>
                    <hr>
                    <div class="mb-2">
                      <label class="form-label-breed">BREED TYPE:</label>
                      <span class="text-label-breed"><?php echo $row['breed_type']; ?></span>
                    </div>
                    <div class="mb-2">
                      <label class="form-label-type">DOG TYPE:</label>
                      <span class="text-label-type"><?php echo $row['dog_type']; ?></span>
                    </div>
                    <div class="mb-2">
                      <label class="form-label-price">PRICE:</label>
                      <span class="text-label-price"><?php echo $row['price']; ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
        }
        // Close the table tags
        ?>
        </tbody>
        </table>
        <?php
    } else {
        echo "<h2 style='text-align:center; position:relative; font-weight:400; top:140px; color: red;'>No purchase results were found.</h2>";
    }
    
    $stmt->close();
}

$conn->close();
?>
</div>




<script src="../../public/assets/js/post.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
