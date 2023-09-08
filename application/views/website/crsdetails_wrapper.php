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


<section class="product-details spad">
<div class="container">
<div class="row">
<div class="col-lg-6 col-md-6">
<div class="product__details__pic">
<div class="product__details__pic__item">
<img class="product__details__pic__item--large" src="<?php echo base_url()?>demo/img/product/details/product-details-1.jpg" alt="">
</div>
</div>
</div>
<div class="col-lg-6 col-md-6">
<div class="product__details__text">
<h3>Vetgetable’s Package</h3>
<div class="product__details__rating">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star-half-o"></i>
<span>(18 reviews)</span>
</div>
<div class="product__details__price">$50.00</div>
<p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam
vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet
quam vehicula elementum sed sit amet dui. Proin eget tortor risus.</p>
<div class="product__details__quantity">
<div class="quantity">
<div class="pro-qty">
<input type="text" value="1">
</div>
</div>
</div>
<a href="<?php base_url();?>course_appointment" class="primary-btn">ADD TO CARD</a>
<a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
<ul>
<li><b>Availability</b> <span>In Stock</span></li>
<li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
<li><b>Weight</b> <span>0.5 kg</span></li>
<li><b>Share on</b>
<div class="share">
<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>
<a href="#"><i class="fa fa-pinterest"></i></a>
</div>
</li>
</ul>
</div>
</div>
<div class="col-lg-12">
<div class="product__details__tab">
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item" style="margin-left: 370px;">
<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
</li>
<li class="nav-item" style="margin-left: 10px;">
<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Information</a>
</li>
<li class="nav-item" style="margin-left: 10px;">
<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span>(1)</span></a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tabs-1" role="tabpanel">
<div class="product__details__tab__desc">
<h6>Products Infomation</h6>
<p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
<p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
 sed sit amet dui. Proin eget tortor risus.</p>
</div>
</div>
<div class="tab-pane" id="tabs-2" role="tabpanel">
<div class="product__details__tab__desc">
<h6>Products Infomation</h6>
<p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
Proin eget tortor risus.</p>
<p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
</div>
</div>
<div class="tab-pane" id="tabs-3" role="tabpanel">
<div class="product__details__tab__desc">
<h6>Products Infomation</h6>
<p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
Proin eget tortor risus.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="related-product">
<div class="container">
<div class="row">
<div class="col-lg-12">
 <div class="section-title related__product__title">
<h2>Related Product</h2>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-3 col-md-4 col-sm-6">
<div class="product__item">
<div class="product__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/product/product-1.jpg" alt="">
<ul class="product__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="product__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6">
<div class="product__item">
<div class="product__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/product/product-2.jpg" alt="">
<ul class="product__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="product__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6">
<div class="product__item">
<div class="product__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/product/product-3.jpg" alt="">
<ul class="product__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="product__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6">
<div class="product__item">
<div class="product__item__pic set-bg">
<img src="<?php echo base_url()?>demo/img/product/product-7.jpg" alt="">
<ul class="product__item__pic__hover">
<li><a href="#"><i class="fa fa-heart"></i></a></li>
<li><a href="#"><i class="fa fa-retweet"></i></a></li>
<li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="product__item__text">
<h6><a href="#">Crab Pool Security</a></h6>
<h5>$30.00</h5>
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