<style>
  .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 50px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            height: 85vh;
            position: absolute;
            align-items: center;
            top: 10px;
            right: 27%;
            max-height: 82vh; 
            overflow-y: auto;
           
        }
        strong{
            margin-right: 360px;
        }
        small{
            margin-left: 15px;
        }
        small li{
            margin-left: 15px;
        }
        small li span{
            font-weight: bold;
        }
        small .contactlyn{
            color: green;
            font-weight: bold;
            margin-left: 15px;
        }
        small .contactlyn:hover{
            color: blue;
            font-weight: bold;
        }
        .close {
            background-color: #111; 
            font-size: 17px;
            font-weight: 300;
            padding: 7px 19px;
            border-radius: 5px;
            color: #ffff;
            background: #888;
            margin-top: 20px;
            margin-right: 90%;
              
        }

        .close:hover,
        .close:focus {
            background: #777;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }
</style>

<footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item link-info text-blue">
                 &copy; 2023-2024 - <a class="Dogbreeder" style="text-decoration: none;">Dogbreeder Website Project </a> | Created By:<span style="color: darkblue;"> CPC Student </span>
                  </li> <br>
                 <li class="list-inline-item link-info text-black" onclick="openModal()" style="cursor: pointer">  
                    Terms and Conditions - Privacy
                  </li>
                </ul>
              </div>
            </div>
  </div>
  
  <div id="myModal" class="modal">
<!-- Modal content -->
<div class="modal-content">
    <p class="list-inline-item link-info">
        Terms and Conditions - Policy
    </p>

   <!-- Terms and Condition Content here -->
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
        </footer>
        </div> 

        <script>
    // Functions to open and close the modal
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
  
    <!-- Libs JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
    <script src="../lib/jquery.js"></script>
    <script src="../lib/main.js"></script>