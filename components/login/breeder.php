<?php include "../../page/layouts/master.php"?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../public/assets/css/breeder.css">
    <link rel="icon" href="../../public/src/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php 
    if(isset($_SESSION['success'])) 
      {
    ?>
      <div class="success" role="alert">
     <?php echo $_SESSION['success']; ?>
   </div>  
  <?php
    unset($_SESSION['success']);
  }
?>  
<div class="loginBox">
    <img  class="user" src="../../public/src/images/logo.png">
    <h2>Create Breeder Account</h2>
    <form action="breeder-process.php" method="post" id="registrationForm" onsubmit="return validateForm()" enctype="multipart/form-data">
    <div class="input-container">
           <input type="text" name="fname" id="fname" placeholder="Firstname">
           <input type="text" name="lname" id="lname" placeholder="Lastname">
        </div>
        <input type="email" name="email" id="email" placeholder="Email Address">
        <input type="password" name="password" id="password" placeholder="Password">
            <input type="hidden" name="user_type" value="Breeder">
            <select class="input-select" name="payment" id="payment-select">
                <option value="">Select Payment Method</option>
                <option value="Gcash">Gcash</option>
                <option value="Maya">Maya</option>
            </select>

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
<div class="file-group">
    <div class="profile-upload-wrapper">
        <label for="profile-upload" class="profile-upload-label"><i class="fa-solid fa-upload"></i> Choose a Profile</label>
        <input type="file" id="profile-upload" name="profile_image" accept="image/*" style="display: none;">
        <div id="image-preview-1">
            <img src="#" id="profile-image" alt="Profile Preview">
        </div>
        <span id="file-name-1" class="file-name-1">No file chosen</span>
    </div>
    <div class="id-upload-wrapper">
        <label for="id-upload" class="id-upload-label"><i class="fa-solid fa-upload"></i> Upload Valid ID</label>
        <input type="file" id="id-upload" name="id_image" accept="image/*" style="display: none;">
        <div id="image-preview-2">
            <img src="#" id="id-image" alt="ID Preview">
        </div>
        <span id="file-name-2" class="file-name-2">No file chosen</span>
    </div>
    <div class="receipt-upload-wrapper">
        <label for="receipt-upload" class="receipt-upload-label"><i class="fa-solid fa-upload"></i> Upload Receipt</label>
        <input type="file" id="receipt-upload" name="receipt" accept="image/*" style="display: none;">
        <div id="image-preview-3">
            <img src="#" id="receipt-image" alt="Receipt Preview">
        </div>
        <span id="file-name-3" class="file-name-3">No file chosen</span>
    </div>
    
</div>
<div class="privacy">
    <input type="checkbox" required><span class="ime">I agree</span><a class="agree" style= "color:darkblue" href="#" onclick="openModal()"> the Terms and Conditions - Policy</a>
</div>
<input type="submit" name="sign-up" value="Sign Up">
        <span class="txt-btn">
            <a href="index.php">Already have an account</a>
        </span>
        
    </form>
</div>

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

<?php 
    if(isset($_SESSION['error'])) 
      {
    ?>
      <div class="error" role="alert">
     <?php echo $_SESSION['error']; ?>
   </div>  
  <?php
    unset($_SESSION['error']);
  }
?>

<script src="../../public/assets/js/switch-text.js"></script>

<script>
// Function for profile
document.getElementById('profile-upload').addEventListener('change', function () {
    var fileInput = this;
    var imagePreview = document.getElementById('profile-image');
    var fileNameText = document.getElementById('file-name-1');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        var fileName = fileInput.files[0].name;
        var fileExtension = fileName.split('.').pop();
        var displayFileName = fileName.substring(0, 5);

        if (fileName.length > 7) {
            displayFileName += '...' + fileExtension;
        } else {
            displayFileName += '.' + fileExtension;
        }

        reader.onload = function (e) {
            imagePreview.src = e.target.result; // Set the src attribute of the <img> tag to the selected image
            imagePreview.style.display = 'block';
            fileNameText.textContent = displayFileName;
        };

        reader.readAsDataURL(fileInput.files[0]);
    } else {
        imagePreview.style.display = 'none';
        fileNameText.textContent = "No file chosen";
    }
});

// Function for valid ID
document.getElementById('id-upload').addEventListener('change', function () {
    var fileInput = this;
    var imagePreview = document.getElementById('id-image');
    var fileNameText = document.getElementById('file-name-2');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        var fileName = fileInput.files[0].name;
        var fileExtension = fileName.split('.').pop();
        var displayFileName = fileName.substring(0, 5);

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

// Function for receipt
document.getElementById('receipt-upload').addEventListener('change', function () {
    var fileInput = this;
    var imagePreview = document.getElementById('receipt-image');
    var fileNameText = document.getElementById('file-name-3');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        var fileName = fileInput.files[0].name;
        var fileExtension = fileName.split('.').pop();
        var displayFileName = fileName.substring(0, 5);

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

// Event listener for the "Gcash" option
paymentSelect.addEventListener("change", function () {
    if (paymentSelect.value === "Gcash") {
        displayModal(gcashModal);
    } else {
        gcashModal.style.display = "none"; // Hide the Gcash modal if another option is selected
    }
});

// Event listener for the "Maya" option
paymentSelect.addEventListener("change", function () {
    if (paymentSelect.value === "Maya") {
        displayModal(mayaModal);
    } else {
        mayaModal.style.display = "none"; // Hide the Maya modal if another option is selected
    }
});

// Event listener to close the modals
closeBtns.forEach(function (closeBtn) {
    closeBtn.addEventListener("click", function () {
        gcashModal.style.display = "none";
        mayaModal.style.display = "none";
    });
});

// Close the modals if the user clicks outside of them
window.addEventListener("click", function (e) {
    if (e.target === gcashModal || e.target === mayaModal) {
        gcashModal.style.display = "none";
        mayaModal.style.display = "none";
    }
});

</script>

</body>
</html>
