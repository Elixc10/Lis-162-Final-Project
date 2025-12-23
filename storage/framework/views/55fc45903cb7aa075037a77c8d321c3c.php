<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>Liberty NFT Marketplace - HTML CSS Template</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/templatemo-liberty-market.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/owl.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    

    <!--TemplateMo 577 Liberty Market

    https://templatemo.com/tm-577-liberty-market -->

   
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a class="logo">
                        <img src="assets/images/logo.png">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="http://127.0.0.1:8000/">Songs List</a></li>

                        <?php if(auth()->guard()->check()): ?>
                            <!-- These show ONLY when a user is LOGGED IN -->
                            <li>
                                <a href="<?php echo e(route('playlists.index')); ?>" :active="request()->routeIs('playlists.index')" wire:navigate>
                                    <?php echo e(__('Playlists')); ?>

                                </a>
                            </li>
                            <li><a href="<?php echo e(route('profile')); ?>" wire:navigate><?php echo e(__('Profile')); ?></a></li>
                            <li>
                                <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Log Out')); ?>

                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        <?php endif; ?>

                        <?php if(auth()->guard()->guest()): ?>
                            <!-- These show ONLY when a user is LOGGED OUT -->
                            <li><a href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a></li>
                            <li><a href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a></li>
                        <?php endif; ?>
                     </ul> 
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2022 <a href="#">Liberty</a> NFT Marketplace Co., Ltd. All rights reserved.
          &nbsp;&nbsp;
          Designed by <a title="HTML CSS Templates" rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
        </div>
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <script>
 // Function to hide the preloader
    function hidePreloader() {
        const preloader = document.getElementById('js-preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            preloader.style.visibility = 'hidden';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        }
    }

    // 1. Initial Page Load
    window.addEventListener('load', hidePreloader);

    // 2. Livewire Navigation Start (Show it)
    document.addEventListener('livewire:navigate', () => {
        const preloader = document.getElementById('js-preloader');
        if (preloader) {
            preloader.style.display = 'block';
            preloader.style.opacity = '1';
            preloader.style.visibility = 'visible';
        }
    });

    // 3. Livewire Navigation End (Hide it)
    document.addEventListener('livewire:navigated', hidePreloader);
  </script>



  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>

  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>

  </body>
</html><?php /**PATH C:\Users\Eli\cinco-app\resources\views/layouts/liberty.blade.php ENDPATH**/ ?>