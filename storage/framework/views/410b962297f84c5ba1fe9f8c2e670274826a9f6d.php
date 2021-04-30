<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="">

		<!-- CSS here -->
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/owl.carousel.min.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/flaticon.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/slicknav.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.min.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/magnific-popup.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/fontawesome-all.min.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/themify-icons.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/slick.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/nice-select.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
            <script src=<?php echo e(asset('admin/assets/js/core/jquery.min.js')); ?>></script>
              <style>
                .header-bottom .header-right .shopping-card::before{
                    content: "";
                }
                /* .header-bottom .header-right .favorit-items::before{
                    content: "<?php echo e(auth()->user()->unreadNotifications->count()); ?>";
                } */
            </style>
   </head>
   
   <body>
       
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                
               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="index.html"><img src="<?php echo e(asset('assets/img/logo/logo.png')); ?>" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     
                                            <li><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
                                            <li><a href="<?php echo e(route('dashboard')); ?>">Categori</a></li>
                                            <li><a href="<?php echo e(route('user.transaction.history')); ?>">History</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                    
                                    
                                    <li>
                                        <div class="favorit-items">
                                            <a href="<?php echo e(route('notify')); ?>"><i class="fas fa-shopping-basket"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-card">
                                        <a href="<?php echo e(route('user.carts')); ?>"><i class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                        $user = Auth::user();
                                    ?>
                                   <li>
                                        <div class="user"> 
                                            <a href="cart.html"><img style="width:50px; height:50px;" class="image_user" src="<?php echo e(asset('image_user/'.$user->profile_image)); ?>" alt=""></a>
                                        </div>
                                    </li>
                                    <li>
                                    <div class="user">
                                            <a href="<?php echo e(route('logout')); ?>"><i class="fas fa-power-off"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>

    <main>
<?php echo $__env->yieldContent('component'); ?>
 </main>
   <footer>

       <!-- Footer Start-->
       <div class="footer-area footer-padding">
           <div class="container">
               <div class="row d-flex justify-content-between">
                   <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                      <div class="single-footer-caption mb-50">
                        <div class="single-footer-caption mb-30">
                             <!-- logo -->
                            <div class="footer-logo">
                                <a href="index.html"><img src="<?php echo e(asset('assets/img/logo/logo2_footer.png')); ?>" alt=""></a>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
                               </div>
                            </div>
                        </div>
                      </div>
                   </div>
                   <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                       <div class="single-footer-caption mb-50">
                           <div class="footer-tittle">
                               <h4>Quick Links</h4>
                               <ul>
                                   <li><a href="#">About</a></li>
                                   <li><a href="#"> Offers & Discounts</a></li>
                                   <li><a href="#"> Get Coupon</a></li>
                                   <li><a href="#">  Contact Us</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                       <div class="single-footer-caption mb-50">
                           <div class="footer-tittle">
                               <h4>New Products</h4>
                               <ul>
                                   <li><a href="#">Woman Cloth</a></li>
                                   <li><a href="#">Fashion Accessories</a></li>
                                   <li><a href="#"> Man Accessories</a></li>
                                   <li><a href="#"> Rubber made Toys</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                       <div class="single-footer-caption mb-50">
                           <div class="footer-tittle">
                               <h4>Support</h4>
                               <ul>
                                <li><a href="#">Frequently Asked Questions</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Report a Payment Issue</a></li>
                            </ul>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- Footer bottom -->
               <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-7">
                    <div class="footer-copy-right">
                                        </div>
                </div>
                 <div class="col-xl-5 col-lg-5 col-md-5">
                    <div class="footer-copy-right f-right">
                        <!-- social -->
                        <div class="footer-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-behance"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>
            </div>
           </div>
       </div>
       <!-- Footer End-->

   </footer>
   
	<!-- JS here -->
        
        <!-- All JS Custom Plugins Link Here here -->
         
        <script src="<?php echo e(asset('assets/js/vendor/modernizr-3.5.0.min.js')); ?>"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="<?php echo e(asset('assets/js/vendor/jquery-1.12.4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="<?php echo e(asset('assets/js/jquery.slicknav.min.js')); ?>"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="<?php echo e(asset('assets/js/owl.carousel.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/slick.min.js')); ?>"></script>

		<!-- One Page, Animated-HeadLin -->
        <script src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/js/animated.headline.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/jquery.magnific-popup.js')); ?>"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="<?php echo e(asset('assets/js/jquery.scrollUp.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/jquery.nice-select.min.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/js/jquery.sticky.js')); ?>"></script>
        
        <!-- contact js -->
        <script src="<?php echo e(asset('assets/js/contact.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/jquery.form.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/jquery.validate.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/mail-script.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/jquery.ajaxchimp.min.js')); ?>"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="<?php echo e(asset('assets/js/plugins.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
        <?php echo $__env->yieldContent('js'); ?>
    </body>
</html><?php /**PATH C:\xamp\htdocs\pratikumPrognet\resources\views/user/app.blade.php ENDPATH**/ ?>