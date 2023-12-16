<!-- CSS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="../../public/assets/css/homepage.css">
<link rel="stylesheet" href="../../public/assets/css/admin-header.css">
<link rel="icon" type="image/x-icon" href=""> 
    
  </head>
  <body class="theme-dark">

<header class="navbar navbar-expand-md navbar-light d-print-none mb-4">
        <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> 
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
             <a href="../admin/home.php">
               <img style="width: 60px;" src="../../public/src/images/logo.png">
            </a>
        </h1>

<?php
$con = mysqli_connect("localhost","root","","dogbreeder_db");

$result1 = mysqli_query($con,"SELECT * FROM pending_approval");
$result2 = mysqli_query($con,"SELECT * FROM subscriptions");
$count_breeders = mysqli_num_rows($result1);
$count_subscription = mysqli_num_rows($result2);
?>

<?php
include ('../../page/router/config.php');
$sql = "SELECT * FROM `admin`";

$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
  $profileImagePath = $row['profile_image'];

  echo "<div class='navbar-nav flex-row order-md-last'>";
  echo "<div class='nav-item dropdown'>";
  echo "<a href='#' class='nav-link d-flex lh-1 text-reset p-0' data-bs-toggle='dropdown' aria-label='Open user menu'>";
  echo "<img src='" . $profileImagePath . "' width='35' height='35' alt='Profile Image' class='rounded-image'>";
  echo "<div class='d-none header-text d-xl-block ps-2'>";
  echo "<div><span>Hi, <b style='color:blue;'>" . $row['fname'] . "</b></span></div>";
  echo " <div class='mt-1 small text-muted'>Administrator</div>";
  
  // Check if there is data in either subscribers or pending_approval table
  if ($count_breeders > 0 || $count_subscription > 0) {
    // Display the user count in the count-notifications div
    echo "<div class='count-notifications'>" . ($total_count = $count_breeders + $count_subscription) . "</div>";
  }

  echo "</div>";
  echo "</a>";
}
?>

        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <details id="myDropdown" class="dropdown-list">
  <summary style="position:relative; left:13px;">Notifications</summary>
  <a href="../../page/admin/subscriptions.php" class="dropdown-item">&nbsp;Breeders
    <?php 
      if ($count_subscription > 0) {
        echo "<div class='count-subscription'>" . $count_subscription . "</div>";
      }
    ?>
  </a>
  <a href="../../page/admin/approval-request.php" class="dropdown-item">&nbsp;Pending Accounts
    <?php 
      if ($count_breeders > 0) {
        echo "<div class='count-pending'>" . $count_breeders . "</div>";
      }
    ?>
  </a>
</details>

                       <a href="../../page/admin/edit-account.php" class="dropdown-item"><i class="fa-solid fa-user"></i>&nbsp; Accounts</a>
                       <a href="../admin/change-password.php" class="dropdown-item"><i class="fa-solid fa-gear"></i>&nbsp; Settings</a>
                       <a href="../../components/login/logout.php" class="dropdown-item"><i class="fa-solid fa-power-off"></i>&nbsp; Logout</a>
                  </div>
              </div>
        </div>
          
          <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
              <ul class="navbar-nav"> 
              <li class="nav-item">
                  <a class="nav-link" href="../admin/dashboard.php">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M9 3h-4a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2z" stroke-width="0" fill="currentColor"></path>
                      <path d="M9 13h-4a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2z" stroke-width="0" fill="currentColor"></path>
                      <path d="M19 13h-4a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2z" stroke-width="0" fill="currentColor"></path>
                      <path d="M17 3a1 1 0 0 1 .993 .883l.007 .117v2h2a1 1 0 0 1 .117 1.993l-.117 .007h-2v2a1 1 0 0 1 -1.993 .117l-.007 -.117v-2h-2a1 1 0 0 1 -.117 -1.993l.117 -.007h2v-2a1 1 0 0 1 1 -1z" stroke-width="0" fill="currentColor"></path>
                     </svg>    
                    </span>
                    <span class="nav-link-title">
                      Dashboards
                    </span>
                  </a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link" href="../admin/user-list.php">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                       <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                       <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                       <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                       <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                       <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                     </svg>
                  </span>
                    <span class="nav-link-title">
                      Users
                    </span>
                    </a>
                </li>   
                <li class="nav-item">
                  <a class="nav-link" href="../admin/breeder-list.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                       <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                       <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                       <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Breeders
                    </span>
                  </a>
                </li> 
              </ul>
            </div>
            <form action="../admin/search-post.php" method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-4 search-bar"  role="search">
                <input type="search" class="form-control" name="search" id="searchInput" placeholder="Search..." aria-label="Search">
             <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                 <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                 <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                 <path d="M21 21l-6 -6"></path>
             </svg>
         </form>
          </div>
        </div>
        
   </header>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const dropdown = document.getElementById('myDropdown');

dropdown.addEventListener('mouseover', function() {
  this.open = true;
});

dropdown.addEventListener('mouseout', function() {
  this.open = false;
});

$(document).ready(function() {
    var countBreeders = <?php echo $count_breeders; ?>;
    var countBreederDiv = $('.count-breeder');

    if (countBreeders > 0) {
        countBreederDiv.removeClass('hidden');
    } else {
        countBreederDiv.addClass('hidden');
    }
});

new bootstrap.Collapse(document.getElementById('navbar-menu'));

</script>

