<!-- CSS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/assets/css/homepage.css">
    <link rel="icon" type="image/x-icon" href=""> 

  </head>
  <body class="theme-dark">

<header class="navbar navbar-expand-md navbar-light d-print-none mb-4">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> 
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
             <a href="index.php">
               <img style="width: 60px;" src="./public/src/images/logo.png">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
             <div class="nav-item btn">
                <a href="./components/login/index.php" class="nav-link d-flex lh-1 text-reset p-0">
                   Sign In
               </a>
         </div>
       </div>  
          <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
              <ul class="navbar-nav"> 
                <li class="nav-item">
                  <a class="nav-link" href="./post-feed.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-2-heart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 9h8"></path>
                        <path d="M8 13h3.5"></path>
                        <path d="M10.5 19.5l-1.5 -1.5h-3a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4"></path>
                        <path d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z"></path>
                  </svg>
                  </span>
                    <span class="nav-link-title">
                      Posts
                    </span>
                    </a>
                </li>   
                <li class="nav-item">
                  <a class="nav-link" href="reviews.php">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-star" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path d="M8 9h8"></path>
                       <path d="M8 13h4.5"></path>
                       <path d="M10.325 19.605l-2.325 1.395v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5"></path>
                       <path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z"></path>
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Reviews
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./chat-app/index.php">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 9h8"></path>
                        <path d="M8 13h6"></path>
                        <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path>
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Chat App
                    </span>
                  </a>
                </li> 
                <li class="nav-item tag-dropdown">
                  <a class="nav-link dropdown show dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-paw" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M14.7 13.5c-1.1 -2 -1.441 -2.5 -2.7 -2.5c-1.259 0 -1.736 .755 -2.836 2.747c-.942 1.703 -2.846 1.845 -3.321 3.291c-.097 .265 -.145 .677 -.143 .962c0 1.176 .787 2 1.8 2c1.259 0 3 -1 4.5 -1s3.241 1 4.5 1c1.013 0 1.8 -.823 1.8 -2c0 -.285 -.049 -.697 -.146 -.962c-.475 -1.451 -2.512 -1.835 -3.454 -3.538z"></path>
                      <path d="M20.188 8.082a1.039 1.039 0 0 0 -.406 -.082h-.015c-.735 .012 -1.56 .75 -1.993 1.866c-.519 1.335 -.28 2.7 .538 3.052c.129 .055 .267 .082 .406 .082c.739 0 1.575 -.742 2.011 -1.866c.516 -1.335 .273 -2.7 -.54 -3.052z"></path>
                      <path d="M9.474 9c.055 0 .109 0 .163 -.011c.944 -.128 1.533 -1.346 1.32 -2.722c-.203 -1.297 -1.047 -2.267 -1.932 -2.267c-.055 0 -.109 0 -.163 .011c-.944 .128 -1.533 1.346 -1.32 2.722c.204 1.293 1.048 2.267 1.933 2.267z"></path>
                      <path d="M16.456 6.733c.214 -1.376 -.375 -2.594 -1.32 -2.722a1.164 1.164 0 0 0 -.162 -.011c-.885 0 -1.728 .97 -1.93 2.267c-.214 1.376 .375 2.594 1.32 2.722c.054 .007 .108 .011 .162 .011c.885 0 1.73 -.974 1.93 -2.267z"></path>
                      <path d="M5.69 12.918c.816 -.352 1.054 -1.719 .536 -3.052c-.436 -1.124 -1.271 -1.866 -2.009 -1.866c-.14 0 -.277 .027 -.407 .082c-.816 .352 -1.054 1.719 -.536 3.052c.436 1.124 1.271 1.866 2.009 1.866c.14 0 .277 -.027 .407 -.082z"></path>
                      </svg>  
                    </span>
                    <span class="nav-link-title">
                      Breeds
                    </span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="./selected-breed.php?breed=Rottweiler">Rottweiler</a>
                      <a class="dropdown-item" href="./selected-breed.php?breed=Shih+Tzu">Shih Tzu</a>
                      <a class="dropdown-item" href="./selected-breed.php?breed=Pomeranian">Pomeranian</a>
                      <a class="dropdown-item" href="./selected-breed.php?breed=Golden+Retriever">Golden Retriever</a>
                      <a class="dropdown-item" href="./selected-breed.php?breed=Labrador">Labrador</a>
                  </div>
               </div>
               </li>
              </ul>
              </div>
              <form action="./search-post.php" method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-4 search-bar"  role="search">
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
