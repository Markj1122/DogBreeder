<?php include "../../page/layouts/master.php"?>
<?php
   // Database Connection
   include ('../../page/router/config.php');
?>

<title>Purchase - Section</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="../../public/assets/css/view-modal.css">
<link rel="icon" href="../../public/src/images/logo.png">
<?php include "../../page/layouts/user-header.php"?>
<div class="page" id="app">
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <div class="page-pretitle">
          <h2 class="page-title justify-content-center">
            Track My Purchase
          </h2>
        </div>
            <form action="tracked.php" method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-4 track" role="search">
                <input type="search" class="form-control" name="search" id="searchInput" placeholder="Enter your Tracking Number (TN)" aria-label="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
    const searchInput = document.getElementById('searchInput');
    const searchIcon = document.querySelector('.icon-tabler-search');

    searchInput.addEventListener('focus', () => {
        searchIcon.style.display = 'none';
    });

    searchInput.addEventListener('blur', () => {
        searchIcon.style.display = 'inline-block';
    });

</script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

</body>
</html>

