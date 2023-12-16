<?php include "../../page/layouts/master.php"?>
<title>Upgrade Account - Section</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="../../public/assets/css/upgrade-account.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../../page/layouts/user-header.php"?>
<div class="page" id="app">

        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            <h2 class="page-title"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="row row-cards">
                        <?php 
  if(isset($_SESSION['success']) || isset($_SESSION['error'])) {
    $alertClass = isset($_SESSION['success']) ? 'alert-success' : 'alert-danger';
    $iconClass = isset($_SESSION['success']) ? 'fas fa-check-circle' : 'fas fa-times-circle';
    $message = isset($_SESSION['success']) ? $_SESSION['success'] : $_SESSION['error'];
    $color = isset($_SESSION['success']) ? 'green' : 'red';
    unset($_SESSION['success']);
    unset($_SESSION['error']);
?>
    <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
        <i class='<?php echo $iconClass; ?>' style='font-size:14px; color: <?php echo $color; ?>'></i>
        <?php echo $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
                            <div class="col">
<form class="card" method="post" action="upgrade-process.php" enctype="multipart/form-data">
<?php
if (isset($_SESSION['user_id'])) {
    $loggedInUserId = $_SESSION['user_id'];

    // Your database connection code here, e.g., $conn = mysqli_connect(...);

    $sql = "SELECT * FROM `user` WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $loggedInUserId);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = mysqli_fetch_assoc($result)) {
?>

    <div class="card-header center">
        <h3 class="card-title text-green">Upgrade Account Form</h3>
    </div>
    <div class="card-body">
        <!-- Remove nested forms -->
        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <!-- Hidden inputs for user data -->
                    <input type="hidden" name="fname" value="<?php echo $row['user_firstname']; ?>">
                    <input type="hidden" name="lname" value="<?php echo $row['user_lastname']; ?>">
                    <input type="hidden" name="new_email" value="<?php echo $row['user_email']; ?>">
                    <!-- ... Other input elements ... -->
                    <div class="custom-select">
                        <select class="input-select" name="payment" id="payment-select" required>
                            <option value="" disabled selected>Select Payment Method &nbsp; (₱300.00)</option>
                            <option value="Gcash">Gcash</option>
                            <option value="Maya">Maya</option>
                        </select>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                      <!-- Payment Modal for Gcash -->
       <div id="myGcashModal" class="modal">
         <div class="modal-content">
            <span class="close">&times;</span>
            <img src="../../public/src/images/qr1.png" class="image">
        </div>
     </div>

        <!-- Payment Modal for Maya -->
        <div id="myMayaModal" class="modal">
           <div class="modal-content">
             <span class="close">&times;</span>
             <img src="../../public/src/images/maya-qr-code.jpg" class="image">
          </div>
     </div>

     <div class="container">
    <!-- Receipt upload -->
    <div class="receipt-upload-wrapper">
        <input name="receipt" type="file" class="receipt-upload-field" id="receipt-upload-field" accept="image/*">
        <label for="receipt-upload-field" class="receipt-upload-label">Upload Receipt</label>
    </div>
    <span id="file-name" class="file-name">No file chosen</span>
    <img id="img-preview" src="#" alt="Receipt">
</div>

                    <br>
                    <div class="wrapper">
    <!-- ID image upload -->
    <div class="id-upload-wrapper">
        <input name="id_image" type="file" class="id-upload-field" id="id-upload-field" accept="image/*">
        <label for="id-upload-field" class="id-upload-label">Upload Valid ID</label>
    </div>
    <span id="new-file-name" class="new-file-name">No file chosen</span>
    <img id="image-preview" src="#" alt="Valid ID">
</div>
<div class="privacy">
    <input type="checkbox" required> I agree the <a href="#" onclick="openModal()">Terms and Conditions - Policy</a>
</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
        <a href="home.php" class="btn btn-secondary d-sm-inline-block">Cancel</a>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    } // End of the while loop
    // Close your database connection here, e.g., mysqli_close($conn);
    $stmt->close();
    }
?>

<!-- Modal content -->
<div id="myModal" class="modal">
<div class="modal-content">
    <p class="list-inline-item link-info">
        Terms and Conditions - Policy
    </p>

   <!-- terms and condition  Content here -->
   <div>
    <strong>1.	Introduction</strong><br><br>
    <small>Welcome to our website [Dogbreeder Website] (“we”,” us”,” or”,” our”). By accessing or using our website, you agree to comply with and be bound by the following terms and conditions. If you do not agree to these terms, please do not use our website.</small>
    <br><br>
    <strong>2.	Definition</strong><br>
    <small>
        <li><span>“Buyers”</span> refers to any person or entity purchasing a dog from our website.</li><br>
        <li><span>“Dog”</span> refers to any canine companion offered for breeding and sale on our website.</li><br>
        <li><span>“Website”</span> refers to [Dogbreeder Website]. That the main goal is to provides a convenient and transparent way for responsible breeders to connect with potential buyers and help them find the right puppy for their lifestyle and needs</li><br>
    </small>
    
    <strong><p>3.	Ordering Process</p></strong>
    <small>
        <li>To purchase a dog, buyers must follow the ordering process outlined on the website.</li><br>
        <li>Orders are subject to acceptance and availability.</li><br>
    </small>
    <strong><p>4. Pricing and Payment</p></strong>
    <small>
        <li>Prices for dogs are as listed on the website and are subject to change.</li><br>
        <li>Payment must be made through the provided payment methods.</li><br>
        <li>Provide the details or information that the website given during the payment system.</li><br>
    </small>
    <strong><p>5.	Shipping and Delivery</p></strong>
    <small>
        <li>All transactions should be done between seller and buyers.</li><br>
        <li>Delivery times are estimates and may vary.</li><br>
        <li>The admin has no responsibility between the buyer and seller.</li><br>
    </small>
    <strong><p>6.	Return and Refund Policy of the Payments </p></strong>
    <small>
        <li>Our return and refund policy since we sale dogs or puppies we will not provide any return payment method or dogs and puppies.</li><br>
        <li>Buyers are responsible for understanding and agreeing to this policy before purchasing.</li><br>
    </small>
    <strong><p>7.	Payment for Breeders Membership</p></strong>
    <small>
        <li>Please provide the clear and not blurring photo if you will upload to the information.</li><br>
        <li>If you will disappear to the membership because of the picture I`D not clear, the payment will not refundable.</li><br>
        <li>Buyers are encouraged to review this policy before making a purchase.</li><br>
    </small>
    <strong><p>8.	Breeders Responsibilityp</p></strong>
    <small>
        <li>Don`t post any pictures of the website doesn`t relate to the website.</li><br>
        <li>Breeder`s obligations to post a birthdate, price, complete address, contact number, supporting documents.</li><br>
        <li>Provide the information and guidance to prospective buyers about the breed.</li><br>
        <li>Offer support and advice to a new dog owner after the purchase.</li><br>
        <li>Provide honest and accurate information of description about the dogs, including their health, temperament and lineage.</li><br>
    </small>
    <strong><p>9.	Privacy Policy</p></strong>
    <small>
        <li>Our privacy policy outlines how we collect, use and protect customer information.</li><br>
        <li>By using our website, buyers agree to the terms of our privacy policy.</li><br>
    </small>
    <strong>10.	Disclaimer </strong><br>
    <small>We disclaim liability for any unforeseen circumstances, including but not limited to health issues after the sale.</small>
    <br><br>
    <strong><p>11.	Terms Updates</p></strong>
    <small>
        <li>We reserve the right to update these terms and conditions without notice.</li><br>
        <li>Changes will be effective immediately upon posting on the website.</li><br>  
    </small>

    <small>By using our website, your knowledge that you have read, understood, and agree to be bound by these terms and conditions.</small>
    <br><br>
    <small>If you have any questions or concerns, please contact us at <br><span class="contactlyn">[Contact # Smart: 09634482260/ lyn.jumawan143@gmail.com].</span></small>
    <br>

</div>


    <span class="close" onclick="closeModal()">Close</span>
</div>
</div>


    <?php include "../../page/layouts/footer.php"?>

<script>
//Function for receipt
document.getElementById('receipt-upload-field').addEventListener('change', function () {
    var fileInput = this;
    var imagePreview = document.getElementById('img-preview');
    var fileNameText = document.getElementById('file-name');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        var fileName = fileInput.files[0].name;
        var fileExtension = fileName.split('.').pop();
        var displayFileName = fileName.substring(0, 10);

        if (fileName.length > 7) {
            displayFileName += '...' + fileExtension;
        } else {
            displayFileName += '.' + fileExtension;
        }

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            fileNameText.textContent = displayFileName;
        };

        reader.readAsDataURL(fileInput.files[0]);
    } else {
        imagePreview.style.display = 'none';
        fileNameText.textContent = "No file chosen";
    }
});


// Function for ID image upload
document.getElementById('id-upload-field').addEventListener('change', function () {
    var fileInput = this;
    var imagePreview = document.getElementById('image-preview');
    var fileNameText = document.getElementById('new-file-name');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        var fileName = fileInput.files[0].name;
        var fileExtension = fileName.split('.').pop();
        var displayFileName = fileName.substring(0, 10);

        if (fileName.length > 7) {
            displayFileName += '...' + fileExtension;
        } else {
            displayFileName += '.' + fileExtension;
        }

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            fileNameText.textContent = displayFileName;
        };

        reader.readAsDataURL(fileInput.files[0]);
    } else {
        imagePreview.style.display = 'none';
        fileNameText.textContent = "No file chosen";
    }
});


/* Payment Modal */
const paymentSelect = document.getElementById("payment-select");
const gcashModal = document.getElementById("myGcashModal");
const mayaModal = document.getElementById("myMayaModal");
const closeBtns = document.querySelectorAll(".close");

// Function to display the modal
function displayModal(modal) {
    modal.style.display = "block";
}

// Function to close the modal
function closeModal(modal) {
    modal.style.display = "none";
}

// Event listener for the "Gcash" option
paymentSelect.addEventListener("change", function () {
    if (paymentSelect.value === "Gcash") {
        displayModal(gcashModal);
        closeModal(mayaModal); // Close the Maya modal if Gcash is selected
    }
});

// Event listener for the "Maya" option
paymentSelect.addEventListener("change", function () {
    if (paymentSelect.value === "Maya") {
        displayModal(mayaModal);
        closeModal(gcashModal); // Close the Gcash modal if Maya is selected
    }
});

// Attach event listeners to close buttons
closeBtns.forEach(function (closeBtn) {
    closeBtn.addEventListener("click", function () {
        closeModal(gcashModal);
        closeModal(mayaModal);
    });
});

function openModal() {
        document.getElementById('myModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    // Close the modal if the user clicks outside of it
    window.onclick = function (event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

</div>
</body>
</html>
