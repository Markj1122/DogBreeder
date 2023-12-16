<?php include "../layouts/master.php"?>
  <title>Dashboard</title>
  <link rel="icon" href="../../public/src/images/logo.png">
<?php include "../layouts/admin-header.php"?>
<div class="page" id="app">
    
      <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Dashboard 
                </h2>
              </div>
              <div class="page-pretitle">
                <u>Statistics</u>
              </div>
            </div>
          </div>
        </div> 
        <div class="page-body">
          <div class="container-xl">
            <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-success text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-share" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M8 9h8"></path>
                               <path d="M8 13h6"></path>
                               <path d="M13 18l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6"></path>
                               <path d="M16 22l5 -5"></path>
                               <path d="M21 21.5v-4.5h-4.5"></path>
                              </svg>
                            </span>
                          </div> 
<?php

$con = mysqli_connect("localhost","root","","dogbreeder_db");

$result = mysqli_query($con,"SELECT * FROM post_feed");

$count_post = mysqli_num_rows($result);

?>
    <div class="col" onclick="location.href=`post-feed.php`">
                            <div class="font-weight-medium">
                              <?php echo "$count_post" ?> 
                              <br> Posts
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
$con = mysqli_connect("localhost", "root", "", "dogbreeder_db");

// Modify your SQL query to count unique breed types
$sql = "SELECT COUNT(DISTINCT breed_type) AS total_count FROM post_feed";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);
$totalCount = $row['total_count'];

// Close the database connection
mysqli_close($con);
?>

<div class="col-sm-6 col-lg-3">
    <div class="card card-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="bg-primary text-white avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dog" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M11 5h2"></path>
                            <path d="M19 12c-.667 5.333 -2.333 8 -5 8h-4c-2.667 0 -4.333 -2.667 -5 -8"></path>
                            <path d="M11 16c0 .667 .333 1 1 1s1 -.333 1 -1h-2z"></path>
                            <path d="M12 18v2"></path>
                            <path d="M10 11v.01"></path>
                            <path d="M14 11v.01"></path>
                            <path d="M5 4l6 .97l-6.238 6.688a1.021 1.021 0 0 1 -1.41 .111a.953 .953 0 0 1 -.327 -.954l1.975 -6.815z"></path>
                            <path d="M19 4l-6 .97l6.238 6.688c.358 .408 .989 .458 1.41 .111a.953 .953 0 0 0 .327 -.954l-1.975 -6.815z"></path>
                        </svg>
                    </span>
                </div>
                <div class="col" onclick="location.href=`post-feed.php`">
                    <div class="font-weight-medium">
                        <?php echo "$totalCount Breeds"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-danger text-white avatar">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                  <path d="M6 21v-2a4 4 0 0 1 4 -4h3"></path>
                                  <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                  <path d="M19 21v1m0 -8v1"></path>
                                </svg>
                            </span>
                          </div>
<?php

$con = mysqli_connect("localhost","root","","dogbreeder_db");

$result = mysqli_query($con,"SELECT * FROM breeders");
$count_subscription = mysqli_num_rows($result);

?>                        
                          <div class="col" onclick="location.href=`#`">
                            <div class="font-weight-medium">
                              <?php echo "$count_subscription" ?> 
                              <br> Breeder Payments
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-success text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hourglass-low" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M6.5 17h11"></path>
                               <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z"></path>
                               <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z"></path>
                               </svg>
                            </span>
                          </div> 
<?php

$con = mysqli_connect("localhost","root","","dogbreeder_db");

$result = mysqli_query($con,"SELECT * FROM pending_approval");
$count_pendings = mysqli_num_rows($result);

?>
                          <div class="col" onclick="location.href=`#`">
                            <div class="font-weight-medium">
                            <?php
                                $total_count = $count_pendings;
                                echo $total_count;
                               ?>
                              <br> Pendings
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-secondary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                              </svg>
                            </span>
                          </div>
<?php

$con = mysqli_connect("localhost","root","","dogbreeder_db");

$result = mysqli_query($con,"SELECT * FROM `admin`");
$count_admin = mysqli_num_rows($result);

?>
                          <div class="col" onclick="location.href=`#`">
                            <div class="font-weight-medium">
                              <?php echo "$count_admin" ?>
                              <br> Admin
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-secondary text-white avatar">
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
                          </div>
<?php

$con = mysqli_connect("localhost","root","","dogbreeder_db");

$result = mysqli_query($con,"SELECT * FROM users");
$count_users = mysqli_num_rows($result);

?>                        
                          <div class="col" onclick="location.href=`#`">
                            <div class="font-weight-medium">
                              <?php echo "$count_users" ?> 
                              <br> Users
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-secondary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                               <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                               <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                               <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                             </svg>
                          </span>
                        </div>
<?php

$con = mysqli_connect("localhost","root","","dogbreeder_db");

$result = mysqli_query($con,"SELECT * FROM breeders");
$count_breeders = mysqli_num_rows($result);

?>                        
                          <div class="col" onclick="location.href=`#`">
                            <div class="font-weight-medium">
                              <?php echo "$count_breeders" ?> 
                              <br> Breeders
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-warning text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
   <path d="M12 3v3m0 12v3"></path>
</svg>
                          </span>
                        </div>
<?php

$con = mysqli_connect("localhost","root","","dogbreeder_db");

$result = mysqli_query($con,"SELECT * FROM breeders");
$count_breeders = mysqli_num_rows($result);

?>                        
                          <div class="col" onclick="location.href=`revenues.php`">
                            <div class="font-weight-medium">
                            ₱
                              <?php echo "$count_breeders" ?> 
                              <br> Revenues
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      <?php include "../layouts/footer.php"?>
</body>
</html>