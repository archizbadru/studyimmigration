
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>animate.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>flaticon.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>odometer.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>jquery.animatedheadline.css">
    <link rel="stylesheet" href="<?= base_url('assets_web1/css/')?>main.css">

    <link rel="shortcut icon" href="<?= base_url('assets_web1/css/')?>favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Archiz</title>

<style>
    .tab-menu1 a {
    background-image: -webkit-linear-gradient(169deg, #5560ff 17%, #aa52a1 63%, #ff4343 100%);
    padding: 10px 30px;
    font-weight: 600;
    border-radius: 25px;
    display: inline-block;
    color: white;
}
</style>
</head>

<body>
    <!-- ==========Preloader========== -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ==========Preloader========== -->
    <!-- ==========Overlay========== -->
    <div class="overlay"></div>
    <a href="#0" class="scrollToTop">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- ==========Overlay========== -->

    <!-- ==========Header-Section========== -->
    <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="index.html">
                       <img src="<?= base_url('assets_web1/images/')?>ukuni.png" style="width: 60px;height: 45px;">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="<?= base_url('website/home/university')?>" class="active">Home</a>
                       
                    </li>
                     <li>
                        <a href="#services">Services</a>
                       
                    </li>
    
          
                    <li>
                        <a href="#aboutus">About US</a>
                       
                    </li>
                     <li>
                        <a href="#sponsers">Sponsers</a>
                    </li>
                     <li>
                        <a href="#testimonials">Testimonials</a>
                    </li>
           
                    <li>
                        <a href="#contact">contact</a>
                    </li>
                   

                    <li class="header-button pr-0">
                        <a href="<?= base_url('website/home/signup_university')?>">Sign up</a>
                    </li>

                </ul>
                <div class="header-bar d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>
    <!-- ==========Header-Section========== -->

    <!-- ==========Banner-Section========== -->
    <section class="banner-section">
        <div class="banner-bg bg_img bg-fixed"  data-background="<?= base_url('assets_web1/images/banner/')?>banner01.jpg" style=" background-image: url(&quot;<?= base_url('assets_web1/images/banner/')?>banner01.jpg&quot;);">
            
        </div>
        <div class="container">
            <div class="banner-content">
                <h1 class="title  cd-headline clip" style="font-size: 60px;"><span class="d-block">book your</span> meetings for 
                    <span class="color-theme cd-words-wrapper p-0 m-0">
                        <b class="is-visible">University</b>
                        <b>Courses</b>
                        
                    </span>
                </h1>
                <p>Safe, secure, reliable.Your ticket to live entertainment!</p>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Ticket-Search========== -->
  <section class="apps-seciton padding-top pt-lg-0" style="display: none;">
        <div class="container">
            <div class="apps-wrapper bg-six padding-top padding-bottom">
                <div class="bg_img apps-bg" data-background="<?= base_url('assets_web1/images/')?>apps01.png" style="background-image: url(&quot;<?= base_url('assets_web1/images/')?>apps01.png&quot;);"></div>
                <div class="section-header-3">
                    <span class="cate">Sign Up</span>
                    <h2 class="title"></h2>
                </div>
                <div class="row">
                    <div class="col-lg-7 offset-lg-5">
                        <div class="content">
                            <h5 class="title">MAKE LIFE EASIER</h5>
                            <p>
                                We have the right services, the know-how and the expertise to make your meetings 
                                simple, easy and painless.
                            </p>
                            <ul class="app-button tab-menu1">
                                  <li class="">
                                  <a href="<?= base_url('')?>">Signup as User</a>
                                  </li>
                                  <li class="">
                                  <a href="<?= base_url('')?>">Signup as Univercity</a>
                                  </li>
                            </ul>
                        </div>
                        <div class="counter--area">
                            <div class="counter-item">
                                <div class="d-flex justify-content-center align-items-center mb-10">
                                    <h4 class="odometer title" data-odometer-final="50"></h4>
                                    <h4 class="title">M+</h4>
                                </div>
                                <p class="info">User</p>
                            </div>
                            <div class="counter-item">
                                <div class="d-flex justify-content-center align-items-center mb-10">
                                    <h4 class="odometer title" data-odometer-final="15"></h4>
                                    <h4 class="title">M+</h4>
                                </div>
                                <p class="info">Univercity</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>   
    <!-- ==========Ticket-Search========== -->

    <!-- ==========Movie-Section========== -->
    <section class="movie-section padding-top padding-bottom" id="services">
        <div class="container">
            <div class="tab">
            <div class="section-header-2">
                    <div class="left">
                        <h2 class="title">Univercity</h2>
                        <p></p>
                    </div>
                    <ul class="tab-menu">
                        <li class="active">
                            Chat 
                        </li>
                        <li>
                            Video Confrencing
                        </li>
                       
                    </ul>
                </div>
                <div class="tab-area mb-30-none">
                    <div class="tab-item active">
                        <div class="owl-carousel owl-theme tab-slider">
                            <div class="item">
                                <div class="movie-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>un.jpg" alt="movie" style="height: 300px;">
                                        </a>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">BHU</a>
                                        </h5>
                                     <ul class="movie-rating-percent">
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>tomato.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>cake.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                            </div>
                            <div class="item">
                                <div class="movie-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>un1.jpg" alt="movie" style="height: 300px;">
                                        </a>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">DU</a>
                                        </h5>
                                    <ul class="movie-rating-percent">
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>tomato.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>cake.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                            </div>
                            <div class="item">
                                <div class="movie-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>un2.jpg" alt="movie" style="height: 300px;">
                                        </a>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">JNU</a>
                                        </h5>
                                     <ul class="movie-rating-percent">
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>tomato.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>cake.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                            </div>
                            <div class="item">
                                <div class="movie-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>un.jpg" alt="movie" style="height: 300px;">
                                        </a>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">BHU</a>
                                        </h5>
                                       <ul class="movie-rating-percent">
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>tomato.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>cake.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="tab-item">
                        <div class="owl-carousel owl-theme tab-slider">
                            <div class="item">
                                <div class="movie-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>un.jpg" alt="movie" style="height: 300px;">
                                        </a>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">DU</a>
                                        </h5>
                                        <ul class="movie-rating-percent">
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>tomato.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                    <img src="<?= base_url('assets_web1/images/')?>cake.png" alt="movie">
                                                </div>
                                                <span class="content">88%</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
      
                </div>
            </div>
        </div>
 
    <!-- ==========Movie-Section========== -->

    <!-- ==========Event-Section========== -->
   <br>
        <div class="container">
            <div class="tab">
                <div class="section-header-2">
                    <div class="left">
                        <h2 class="title">Courses</h2>
                        <p></p>
                    </div>
                    <ul class="tab-menu">
                        <li class="active">
                        Chat
                        </li>
                        <li>
                            Video Confrencing
                        </li>
                     
                    </ul>
                </div>
                <div class="tab-area mb-30-none">
                    <div class="tab-item active">
                        <div class="owl-carousel owl-theme tab-slider">
                            <div class="item">
                                <div class="event-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>event01.jpg" alt="event" style="height: 300px;">
                                        </a>
                                        <div class="event-date">
                                            <h6 class="date-title">28</h6>
                                            <span>Dec</span>
                                        </div>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">Digital Economy Conference 2020</a>
                                        </h5>
                                        <div class="movie-rating-percent">
                                            <span>327 Montague Street</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="event-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>cr.jpg" alt="event" style="height: 300px;">
                                        </a>
                                        <div class="event-date">
                                            <h6 class="date-title">28</h6>
                                            <span>Dec</span>
                                        </div>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">web design conference 2020</a>
                                        </h5>
                                        <div class="movie-rating-percent">
                                            <span>327 Montague Street</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="event-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>cr1.png" alt="event" style="height: 300px;">
                                        </a>
                                        <div class="event-date">
                                            <h6 class="date-title">28</h6>
                                            <span>Dec</span>
                                        </div>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">digital thinkers meetup</a>
                                        </h5>
                                        <div class="movie-rating-percent">
                                            <span>327 Montague Street</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="event-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>event01.jpg" alt="event" style="height: 300px;">
                                        </a>
                                        <div class="event-date">
                                            <h6 class="date-title">28</h6>
                                            <span>Dec</span>
                                        </div>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">world digital conference 2020</a>
                                        </h5>
                                        <div class="movie-rating-percent">
                                            <span>327 Montague Street</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-item">
                        <div class="owl-carousel owl-theme tab-slider">
                            <div class="item">
                                <div class="event-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>event01.jpg" alt="event" style="height: 300px;">
                                        </a>
                                        <div class="event-date">
                                            <h6 class="date-title">28</h6>
                                            <span>Dec</span>
                                        </div>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">Digital Economy Conference 2020</a>
                                        </h5>
                                        <div class="movie-rating-percent">
                                            <span>327 Montague Street</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="event-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>cr.jpg" alt="event" style="height: 300px;">
                                        </a>
                                        <div class="event-date">
                                            <h6 class="date-title">28</h6>
                                            <span>Dec</span>
                                        </div>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">web design conference 2020</a>
                                        </h5>
                                        <div class="movie-rating-percent">
                                            <span>327 Montague Street</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="event-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>event01.jpg" alt="event" style="height: 300px;">
                                        </a>
                                        <div class="event-date">
                                            <h6 class="date-title">28</h6>
                                            <span>Dec</span>
                                        </div>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">digital thinkers meetup</a>
                                        </h5>
                                        <div class="movie-rating-percent">
                                            <span>327 Montague Street</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="event-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="#0">
                                            <img src="<?= base_url('assets_web1/images/')?>cr.jpg" alt="event" style="height: 300px;">
                                        </a>
                                        <div class="event-date">
                                            <h6 class="date-title">28</h6>
                                            <span>Dec</span>
                                        </div>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="#0">world digital conference 2020</a>
                                        </h5>
                                        <div class="movie-rating-percent">
                                            <span>327 Montague Street</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
    </section>


    <br>
    <section class="about-section padding-top" id="aboutus">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="event-about-content">
                        <div class="section-header-3 left-style m-0">
                            <span class="cate">About Us</span>
                            <h2 class="title">Get to know us</h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor  ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor  ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.Lorem ipsum dolor sit amet, consectetur adipiscing elit
                            </p>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="about-thumb">
                        <img src="<?= base_url('assets_web1/images/')?>about01.png" alt="about">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========Event-Section========== -->

    <!-- ==========Sports-Section========== -->

    <!-- ==========Sports-Section========== -->

    <!-- ==========Newslater-Section========== -->
<section class="event-details padding-top" id="sponsers">
        <div class="container">
            <div class="section-header-3">
                <span class="cate">EVENT SPONSORS</span>
                <h2 class="title">Partners & Sponsors</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor  ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p>
            </div>
            <div class="tabTwo sponsor-tab">
                <ul class="tab-menu">
                    <li class="active">
                        Platinum Sponsors
                    </li>
                    <li>
                        gold Sponsors
                    </li>
                    <li>
                        silver Sponsors
                    </li>
                </ul>
                <div class="tab-area">
                    <div class="tab-item active">
                        <div class="owl-theme owl-carousel sponsor-slider">
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>1.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>2.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>3.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>4.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>5.png" alt="sponsor">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-item">
                        <div class="owl-theme owl-carousel sponsor-slider">
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>3.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>4.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>5.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>1.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>2.png" alt="sponsor">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-item">
                        <div class="owl-theme owl-carousel sponsor-slider">
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>3.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>1.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>4.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>2.png" alt="sponsor">
                                </a>
                            </div>
                            <div class="sponsor-thumb">
                                <a href="#0">
                                    <img src="<?= base_url('assets_web1/images/sponsers/')?>5.png" alt="sponsor">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <section class="client-section padding-bottom padding-top bg_img" data-background="<?= base_url('assets_web1/images/')?>client-bg.jpg" id="testimonials">
        <div class="container">
            <div class="section-header-3">
                <span class="cate">testimonials</span>
                <h2 class="title">the fans have spoken</h2>
            </div>
            <div class="client-slider owl-carousel owl-theme">
                <div class="client-item">
                    <div class="client-thumb">
                        <img src="<?= base_url('assets_web1/images/')?>client01.jpg" alt="client">
                    </div>
                    <div class="client-content">
                        <h5 class="title">
                            <a href="#0">Rafuz</a>
                        </h5>
                        <span class="info"><i class="fas fa-check"></i> Verified</span>
                        <blockquote class="client-quote">
                            "Great prices and Cheaper than other sites! Easy to use."
                        </blockquote>
                    </div>
                </div>
                <div class="client-item">
                    <div class="client-thumb">
                        <img src="<?= base_url('assets_web1/images/')?>client03.jpg" alt="client">
                    </div>
                    <div class="client-content">
                        <h5 class="title">
                            <a href="#0">Rudra</a>
                        </h5>
                        <span class="info"><i class="fas fa-check"></i> Verified</span>
                        <blockquote class="client-quote">
                            "Id iure est sint at illum ipsum non beatae cumque"
                        </blockquote>
                    </div>
                </div>
                <div class="client-item">
                    <div class="client-thumb">
                        <img src="<?= base_url('assets_web1/images/')?>client02.jpg" alt="client">
                    </div>
                    <div class="client-content">
                        <h5 class="title">
                            <a href="#0">Raihan</a>
                        </h5>
                        <span class="info"><i class="fas fa-check"></i> Verified</span>
                        <blockquote class="client-quote">
                            "amet consectetur adipisicing elit. Animi, ut consequuntur"
                        </blockquote>
                    </div>
                </div>
                <div class="client-item">
                    <div class="client-thumb">
                        <img src="<?= base_url('assets_web1/images/')?>client04.jpg" alt="client">
                    </div>
                    <div class="client-content">
                        <h5 class="title">
                            <a href="#0">Shahidul</a>
                        </h5>
                        <span class="info"><i class="fas fa-check"></i> Verified</span>
                        <blockquote class="client-quote">
                            "Quia voluptatum animi libero recusandae error."
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

           <section class="contact-section padding-top" id="contact">
        <div class="contact-container">
            <div class="bg-thumb bg_img" data-background="<?= base_url('assets_web1/images/')?>contact.jpg"></div>
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-7 col-lg-6 col-xl-5">
                        <div class="section-header-3 left-style">
                            <span class="cate">contact us</span>
                            <h2 class="title">get in touch</h2>
                            <p>We’d love to talk about how we can work together. Send us a message below and we’ll respond as soon as possible.</p>
                        </div>
                        <form class="contact-form" id="contact_form_submit">
                            <div class="form-group">
                                <label for="name">Name <span>*</span></label>
                                <input type="text" placeholder="Enter Your Full Name" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span>*</span></label>
                                <input type="text" placeholder="Enter Your Email" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject <span>*</span></label>
                                <input type="text" placeholder="Enter Your Subject" name="subject" id="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message <span>*</span></label>
                                <textarea name="message" id="message" placeholder="Enter Your Message" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Send Message">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <div class="padding-top padding-bottom contact-info">
                            <div class="info-area">
                                <div class="info-item">
                                    <div class="info-thumb">
                                        <img src="<?= base_url('assets_web1/images/')?>contact01.png" alt="contact">
                                    </div>
                                    <div class="info-content">
                                        <h6 class="title">phone number</h6>
                                        <a href="Tel:82828282034">+1234 56789</a>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-thumb">
                                        <img src="<?= base_url('assets_web1/images/')?>contact02.png" alt="contact">
                                    </div>
                                    <div class="info-content">
                                        <h6 class="title">Email</h6>
                                        <a href="Mailto:info@gmail.com">info@archiz.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <footer class="footer-section">
        <div class="newslater-section padding-bottom">
            <div class="container">
                <div class="newslater-container bg_img" data-background="<?= base_url('assets_web1/images/')?>newslater-bg01.jpg">
                    <div class="newslater-wrapper">
                        <h5 class="cate">subscribe to UKuni</h5>
                        <h3 class="title">to get exclusive benifits</h3>
                        <form class="newslater-form">
                            <input type="text" placeholder="Your Email Address">
                            <button type="submit">subscribe</button>
                        </form>
                        <p>We respect your privacy, so we never share your info</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer-top">
                <div class="logo">
                    <a href="index-1.html">
                       
                    </a>
                </div>
                <ul class="social-icons">
                    <li>
                        <a href="#0">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0" class="active">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fa fa-pinterest"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fa fa-google"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-bottom">
                <div class="footer-bottom-area">
                    <div class="left">
                        <p>Copyright © 2020.All Rights Reserved By <a href="#0">UKUni</a></p>
                    </div>
                    <ul class="links">
                        <li>
                            <a href="#0">About</a>
                        </li>
                        <li>
                            <a href="#0">Terms Of Use</a>
                        </li>
                        <li>
                            <a href="#0">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#0">FAQ</a>
                        </li>
                        <li>
                            <a href="#0">Feedback</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- ==========Newslater-Section========== -->


   <script src="<?= base_url('assets_web1/js/')?>jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets_web1/js/')?>modernizr-3.6.0.min.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>plugins.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>bootstrap.min.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>heandline.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>isotope.pkgd.min.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>magnific-popup.min.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>owl.carousel.min.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>wow.min.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>countdown.min.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>odometer.min.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>viewport.jquery.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>nice-select.js"></script>
    <script src="<?= base_url('assets_web1/js/')?>main.js"></script>
</body>

</html>