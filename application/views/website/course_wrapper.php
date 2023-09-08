<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        

        <!-- Facebook -->

        <meta property="og:url"           content="<?= current_url() ?>" />

        <meta property="og:type"          content="website" />

        <meta property="og:title"         content="<?= (!empty($setting->title)?strip_tags($setting->title):null) ?>" />

        <meta property="og:description"   content="<?= (!empty($item->description)?character_limiter(strip_tags($item->description),140):null) ?>" />

        <meta property="og:image"         content="<?= (!empty($setting->logo)?base_url($setting->logo):base_url('assets_web/images/icons/logo.png')) ?>" />





        <!-- Favicon -->

        <link rel="shortcut icon" href="<?= (!empty($setting->favicon)?base_url($setting->favicon):base_url('assets_web/images/icons/favicon.png')) ?>"/>

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title><?= (!empty($setting->title)?$setting->title:null) ?></title>

        <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <!-- Bootstrap -->

        <link href="<?= base_url('assets_web/css/bootstrap.min.css') ?>" rel="stylesheet">

        <!-- Jquery Ui -->

        <link href="<?= base_url('assets_web/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Font Awesome -->

        <link href="<?= base_url('assets_web/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Flaticon -->

        <link href="<?= base_url('assets_web/css/flaticon.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Owl Carousel -->


        <!-- Custom Style Sheet -->

        <link href="<?= base_url('assets_web/css/style.css') ?>" rel="stylesheet" type="text/css"/>


<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?php echo base_url()?>demo/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/nice-select.css" type="text/css">

<link rel="stylesheet" href="<?php echo base_url()?>demo/css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url()?>demo/css/style.css" type="text/css">


    </head>



    

    <body id="page-top">

        <!-- Load Facebook SDK for JavaScript -->

        <div id="fb-root"></div>

        <script>(function(d, s, id) {

          var js, fjs = d.getElementsByTagName(s)[0];

          if (d.getElementById(id)) return;

          js = d.createElement(s); js.id = id;

          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";

          fjs.parentNode.insertBefore(js, fjs);

        }(document, 'script', 'facebook-jssdk'));</script>





        <!-- Loader icon -->

        <div class="se-pre-con"></div> 



        <!-- Header section-->

        <?php @$this->load->view('website/includes/header2') ?>

 

        <!-- Slider section--> 

        <section class="">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12">

                        <div class="header-content">

                            <div class="header-content-inner"> 

                                <div class="ui breadcrumb">

                                    <a href="index.html" class="section"><?php echo display('home') ?></a>

                                    <div class="divider"> / </div>

                                    <div class="active section"><?php echo display('course_management') ?></div>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>










        <!-- Comment Form -->

        <section class="comment-form">

            <div class="container">

                <div class="col-sm-12">

               

	
<section class="hero">
<div class="container">
<div class="row">
<div class="col-lg-3">
<div class="hero__categories">
<div class="hero__categories__all">
<i class="fa fa-bars"></i>
<span>All departments</span>
</div>
<ul>
<li><a href="#">Fresh Meat</a></li>
<li><a href="#">Vegetables</a></li>
<li><a href="#">Fruit & Nut Gifts</a></li>
<li><a href="#">Fresh Berries</a></li>
<li><a href="#">Ocean Foods</a></li>
<li><a href="#">Butter & Eggs</a></li>
<li><a href="#">Fastfood</a></li>
<li><a href="#">Fresh Onion</a></li>
<li><a href="#">Papayaya & Crisps</a></li>
<li><a href="#">Oatmeal</a></li>
<li><a href="#">Fresh Bananas</a></li>
</ul>
</div>
</div>
<div class="col-lg-9">
<div class="hero__search">
<div class="hero__search__form">
<form action="#">
<div class="hero__search__categories">
All Categories
<span class="arrow_carrot-down"></span>
</div>
<input type="text" placeholder="What do yo u need?">
<button type="submit" class="site-btn">SEARCH</button>
</form>
</div>
<div class="hero__search__phone">
<div class="hero__search__phone__icon">
<i class="fa fa-phone"></i>
</div>
<div class="hero__search__phone__text">
<h5>+65 11.188.888</h5>
<span>support 24/7 time</span>
</div>
</div>
</div>
<div class="set-bg">
<img src="<?php echo base_url()?>demo/img/hero/banner.jpg" alt="">
<div class="hero__text" style="margin-top:-270px;padding-left:50px;">
<span>FRUIT FRESH</span>
<h2>Vegetable <br />100% Organic</h2>
<p>Free Pickup and Delivery Available</p>
<a href="<?php base_url();?>course_details" class="primary-btn">SHOP NOW</a>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="categories">
<div class="container">
<div class="row">
<div class="categories__slider owl-carousel">
<div class="col-lg-3">
<div class="categories__item set-bg">
<img src="<?php echo base_url()?>demo/img/categories/cat-1.jpg" alt="">
<h5 style="width:270px;"><a href="#">Fresh Fruit</a></h5>
</div>
</div>
<div class="col-lg-3">
<div class="categories__item set-bg">
<img src="<?php echo base_url()?>demo/img/categories/cat-2.jpg" alt="">
<h5 style="width:270px;"><a href="#">Dried Fruit</a></h5>
</div>
</div>
<div class="col-lg-3">
<div class="categories__item set-bg">
<img src="<?php echo base_url()?>demo/img/categories/cat-3.jpg" alt="">
<h5 style="width:270px;"><a href="#">Vegetables</a></h5>
</div>
</div>
<div class="col-lg-3">
<div class="categories__item set-bg">
<img src="<?php echo base_url()?>demo/img/categories/cat-4.jpg" alt="">
<h5 style="width:270px;"><a href="#">drink fruits</a></h5>
</div>
</div>
<div class="col-lg-3">
<div class="categories__item set-bg">
<img src="<?php echo base_url()?>demo/img/categories/cat-5.jpg" alt="">
<h5 style="width:270px;"><a href="#">drink fruits</a></h5>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="featured spad">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="section-title">
<h2>Featured Product</h2>
</div>
<div class="featured__controls">
<ul>
<li class="active" data-filter="*">All</li>
<li data-filter=".oranges">Oranges</li>
<li data-filter=".fresh-meat">Fresh Meat</li>
<li data-filter=".vegetables">Vegetables</li>
<li data-filter=".fastfood">Fastfood</li>
</ul>
</div>
</div>
</div>
<div class="row featured__filter">
<div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
<div class="featured__item">
<div class="featured__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/featured/feature-1.jpg" alt="">
<ul class="featured__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="featured__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
<div class="featured__item">
<div class="featured__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/featured/feature-2.jpg" alt="">
<ul class="featured__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="featured__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fresh-meat">
<div class="featured__item">
<div class="featured__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/featured/feature-3.jpg" alt="">
<ul class="featured__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="featured__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6 mix fastfood oranges">
<div class="featured__item">
<div class="featured__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/featured/feature-4.jpg" alt="">
<ul class="featured__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="featured__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
<div class="featured__item">
<div class="featured__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/featured/feature-5.jpg" alt="">
<ul class="featured__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="featured__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6 mix oranges fastfood">
<div class="featured__item">
<div class="featured__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/featured/feature-6.jpg" alt="">
<ul class="featured__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="featured__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
<div class="featured__item">
<div class="featured__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/featured/feature-7.jpg" alt="">
<ul class="featured__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="featured__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6 mix fastfood vegetables">
<div class="featured__item">
<div class="featured__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/featured/feature-8.jpg" alt="">
<ul class="featured__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="featured__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
</div>
</div>
</section>


<div class="banner">
<div class="container">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="banner__pic">
<img src="<?php echo base_url()?>demo/img/banner/banner-1.jpg" alt="">
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="banner__pic">
<img src="<?php echo base_url()?>demo/img/banner/banner-2.jpg" alt="">
</div>
</div>
</div>
</div>
</div>


<section class="latest-product spad">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-6">
<div class="latest-product__text">
<h4>Latest Products</h4>
<div class="latest-product__slider owl-carousel">
<div class="latest-prdouct__slider__item">
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-1.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-2.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-3.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
</div>
<div class="latest-prdouct__slider__item">
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-1.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-2.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-3.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6">
<div class="latest-product__text">
<h4>Top Rated Products</h4>
<div class="latest-product__slider owl-carousel">
<div class="latest-prdouct__slider__item">
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-1.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-2.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-3.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
</div>
<div class="latest-prdouct__slider__item">
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-1.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-2.jpg" alt="">
</div>
<div class="latest-product__item__text">
 <h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-3.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6">
<div class="latest-product__text">
<h4>Review Products</h4>
<div class="latest-product__slider owl-carousel">
<div class="latest-prdouct__slider__item">
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-1.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-2.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-3.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
</div>
<div class="latest-prdouct__slider__item">
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-1.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-2.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
 </div>
</a>
<a href="#" class="latest-product__item">
<div class="latest-product__item__pic">
<img src="<?php echo base_url()?>demo/img/latest-product/lp-3.jpg" alt="">
</div>
<div class="latest-product__item__text">
<h6>Crab Pool Security</h6>
<span>$30.00</span>
</div>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="from-blog spad">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="section-title from-blog__title">
<h2>From The Blog</h2>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-6">
<div class="blog__item">
<div class="blog__item__pic">
<img src="<?php echo base_url()?>demo/img/blog/blog-1.jpg" alt="">
</div>
<div class="blog__item__text">
<ul>
<li><i class="fa fa-calendar-o"></i> May 4,2019</li>
<li><i class="fa fa-comment-o"></i> 5</li>
</ul>
<h5><a href="#">Cooking tips make cooking simple</a></h5>
<p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
</div>
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-6">
<div class="blog__item">
<div class="blog__item__pic">
<img src="<?php echo base_url()?>demo/img/blog/blog-2.jpg" alt="">
</div>
<div class="blog__item__text">
<ul>
<li><i class="fa fa-calendar-o"></i> May 4,2019</li>
<li><i class="fa fa-comment-o"></i> 5</li>
</ul>
<h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
<p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
</div>
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-6">
<div class="blog__item">
<div class="blog__item__pic">
<img src="<?php echo base_url()?>demo/img/blog/blog-3.jpg" alt="">
</div>
<div class="blog__item__text">
<ul>
<li><i class="fa fa-calendar-o"></i> May 4,2019</li>
<li><i class="fa fa-comment-o"></i> 5</li>
</ul>
<h5><a href="#">Visit the clean farm in the US</a></h5>
<p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
</div>
</div>
</div>
</div>
</div>
</section>


                   

                </div>

        </section>



        <!-- Footer Section -->

        <?php @$this->load->view('website/includes/footer') ?>





<script src="<?php echo base_url()?>demo/js/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/jquery.nice-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/jquery.slicknav.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/mixitup.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>demo/js/main.js" type="text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="text/javascript"></script>

        

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

        <script src="<?= base_url('assets_web/js/jquery.min.js" type="text/javascript') ?>"></script> 

        <!-- Include all compiled plugins (below), or include individual files as needed -->


        <!-- owl carousel js -->


        <!-- Plugin JavaScript -->

        <script src="<?= base_url('assets_web/js/jquery.easing.min.js') ?>" type="text/javascript"></script>

        <!-- Jquery Ui -->


        <!-- Custom Js -->

        <script src="<?= base_url('assets_web/js/custom.js') ?>" type="text/javascript"></script> 



    </body>

</html>