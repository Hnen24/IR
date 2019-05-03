<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>IR Project</title>

    <!--
            Google Font
            ============================================= -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500i" rel="stylesheet">

    <!--
            CSS
            ============================================= -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="/css/linearicons.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">
    <link rel="stylesheet" href="/css/nice-select.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>

<!-- Start Header Area -->
<header id="header">
    <div class="container">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="/"><img src="/img/logo.png" alt="" title="" /></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="/">Home</a></li>
                    <li><a href="/upload">Upload</a></li>
                    <li><a href="/uploadAll">Upload All Files</a></li>
                    <li><a href="/delete">Delete All</a></li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header>
<!-- End Header Area -->


<!-- Start Banner Area -->
<section class="home-banner-area relative">
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-center">
            <div class="banner-content col-lg-8 col-md-12">
                <h1 class="wow fadeIn" data-wow-duration="4s">Welcome To Our Search Engine</h1>
                <p class="text-white">

                </p>

                <div class="input-wrap">
                    <form action="{{ route('search') }}" method="post" class="form-box d-flex justify-content-between">
                        {{ csrf_field() }}
                        <input type="text" placeholder="Search..." class="form-control" name="query">
                        <button type="submit" class="btn search-btn">Search</button>
                    </form>
                </div>
                <h4 class="text-white"></h4>

            </div>
        </div>
    </div>
    <div class="rocket-img">
        <img src="/img/rocket.png" alt="">
    </div>
</section>
<!-- End Banner Area -->



<!-- Start Courses Area -->
<section class="courses-area section-gap">
    <div class="container">
        @yield('content')
    </div>
</section>
<!-- End Courses Area -->


<!-- Start Footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="footer-bottom row align-items-center">
            <p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            <div class="col-lg-4 col-md-12 footer-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
                <a href="#"><i class="fa fa-behance"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->

<!-- ####################### Start Scroll to Top Area ####################### -->
<div id="back-top">
    <a title="Go to Top" href="#"></a>
</div>
<!-- ####################### End Scroll to Top Area ####################### -->

<script src="/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="/js/vendor/bootstrap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="/js/easing.min.js"></script>
<script src="/js/hoverIntent.js"></script>
<script src="/js/superfish.min.js"></script>
<script src="/js/jquery.ajaxchimp.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/owl-carousel-thumb.min.js"></script>
<script src="/js/jquery.sticky.js"></script>
<script src="/js/jquery.nice-select.min.js"></script>
<script src="/js/parallax.min.js"></script>
<script src="/js/waypoints.min.js"></script>
<script src="/js/wow.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>
<script src="/js/mail-script.js"></script>
<script src="/js/main.js"></script>
</body>

</html>