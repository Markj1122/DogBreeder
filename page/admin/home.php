<?php include "../layouts/master.php"?>
<title>Admin - Homepage</title>
    <link href="../../public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/assets/css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="icon" href="../../public/src/images/logo.png">
    <link rel="stylesheet" href="../../public/assets/slider/ism/my-slider.css"/>
     
    <style>
      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>
    <?php include "../layouts/admin-header.php"?>

<div class="page" id="app">
    
<div class="ism-slider" data-transition_type="zoom" data-play_type="loop" data-interval="3000" id="my-slider">
        <ol>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider_1.jpg">
            <div class="ism-caption ism-caption-0" style="font-style: italic;">" Dogs Never Lie About LOVE "</div>
          </li>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider_2.jpg">
            <div class="ism-caption ism-caption-0" style="font-style: italic;">“ Dogs do speak, but only to those who know how to listen ”</div>
          </li>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider_3.jpg">
            <div class="ism-caption ism-caption-0" style="font-style: italic;">“ Dogs are not our whole life, but they make our lives whole ”</div>
          </li>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider-4.jpg">
            <div class="ism-caption ism-caption-0" style="font-style: italic;">“ Keep calm and pet a dog ” </div>
          </li>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider-5.jpg">
            <div class="ism-caption ism-caption-0" style="font-style: italic;">“ Every dog must have his day ”</div>
          </li>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider-6.png">
            <div class="ism-caption ism-caption-0" style="font-style: italic;">“ Money can buy you a fine dog, but only love can make him wag his tail ” </div>
          </li>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider-7.jpeg">  
            <div class="ism-caption ism-caption-0" style="font-style: italic;">“ As wonderful as dogs can be, they are <br>famous for missing the point ”</div>
          </li>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider-8.jpg">
            <div class="ism-caption ism-caption-0" style="font-style: italic;">“ Dogs never bite me. Just Humans ”</div>
          </li>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider-9.jpg">
            <div class="ism-caption ism-caption-0" style="font-style: italic;">“ Live. Laugh. Bark. ” </div>
          </li>
          <li>
            <img src="../../public/assets/slider/ism/image/slides/img-slider_10.jpg">
            <div class="ism-caption ism-caption-0" style="font-style: italic;">“ Happiness is a warm puppy ” </div>
          </li>
        </ol>
      </div>
 
<!--------Slider end Ni--------------->


     <main class="p-2">
       <h1 class="mx-4">Featured</h1>

         <div class="row my-2">

          <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary">Puppies</strong>
                <h3 class="mb-0">Featured Post</h3>
                <div class="mb-1 text-body-secondary">Nov 12</div>
                <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                <a href="dog-type.php?type=puppy" class="stretched-link">View More...</a>
              </div>
              <div class="col-lg-5 col-12 d-lg-block">
                <img class="bd-placeholder-img w-100" width="200" height="250" src="../../public/src/images/featured-puppy.png">
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success">Adults</strong>
                <h3 class="mb-0">Featured Dogs</h3>
                <div class="mb-1 text-body-secondary">Nov 11</div>
                <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                <a href="dog-type.php?type=adult" class="stretched-link">View More...</a>
              </div>
              <div class="col-lg-5 col-12 d-lg-block">
                <img class="bd-placeholder-img w-100" width="200" height="250" src="../../public/src/images/featured-dog.jpg">
              </div>
            </div>
          </div>
     </div>
     </main>



<div class="container">
  <footer class="py-5">
    <div class="row">
      <div class="col-6 col-md-2 mb-3">
        <h5>Useful Links</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
          <li class="nav-item mb-2"><a href="login" class="nav-link p-0 text-body-secondary">Login</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
        </ul>
      </div>

      <div class="col-md-5 offset-md-1 mb-3">
        <form>
          <h5>Subscribe to our newsletter</h5>
          <p>Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
            <button class="btn btn-primary" type="button">Subscribe</button>
          </div>
        </form>
      </div>
    </div>

  </footer>
</div>

</div>
  
<script src="../../public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="../../public/assets/js/ism-2.2.min.js"></script>
      <?php include "../layouts/footer.php"?>
</body>
</html>