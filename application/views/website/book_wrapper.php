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


<section class="checkout spad">
<div class="container">
<div class="checkout__form">
<h4>Check All Schedules</h4>
<form action="#">
<div class="row">
<div class="col-lg-8 col-md-6">
<div class="row">
<div class="col-lg-6">
<div class="checkout__input">
<p>Type<span>*</span></p>
                <select name="type">
                    <option value="">Select Appointment Type</option>
                    <option value="general">General</option>
                    <option value="premium">Premium</option>
                    <option value="urgent">Urgent</option>
                </select>
</div>
</div>
<div class="col-lg-6">
<div class="checkout__input">
<p>Available Slot<span>*</span></p>
                <select name="scheldules">
                    <option value="">Select Available Slot</option>
                    <option value="02:00">02:00 AM</option>
                    <option value="02:30">02:30 AM</option>
                </select>
</div>
</div>
</div></br>
<div class="row">
<div class="col-lg-6">
<div class="checkout__input">
<p>First Name<span>*</span></p>
<input type="text">
</div>
</div>
<div class="col-lg-6">
<div class="checkout__input">
<p>Last Name<span>*</span></p>
<input type="text">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
<div class="checkout__input">
<p>Country<span>*</span></p>
<input type="text">
</div>
</div>
<div class="col-lg-6">
<div class="checkout__input">
<p>Address<span>*</span></p>
<input type="text" placeholder="Street Address" class="checkout__input__add">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
<div class="checkout__input">
<p>Town/City<span>*</span></p>
<input type="text">
</div>
</div>
<div class="col-lg-6">
<div class="checkout__input">
<p>Country/State<span>*</span></p>
<input type="text">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
<div class="checkout__input">
<p>Phone<span>*</span></p>
<input type="text">
</div>
</div>
<div class="col-lg-6">
<div class="checkout__input">
 <p>Email<span>*</span></p>
<input type="text">
</div>
</div>
</div>
<div class="checkout__input__checkbox">
<label for="acc">
Create an account?
<input type="checkbox" id="acc">
<span class="checkmark"></span>
</label>
</div>
<p>Create an account by entering the information below. If you are a returning customer
please login at the top of the page</p>
<div class="checkout__input">
<p>Account Password<span>*</span></p>
<input type="text">
</div>



<div class="checkout__input">
<p>Order notes<span>*</span></p>
<input type="text" placeholder="Notes about your order, e.g. special notes for delivery.">
</div>
</div>
<div class="col-lg-4 col-md-6">
<div class="checkout__order">
<h4>Your Order</h4>
<div class="checkout__order__products">Products <span>Total</span></div>
<ul>
<li>Vegetable’s Package <span>$75.99</span></li>
<li>Fresh Vegetable <span>$151.99</span></li>
<li>Organic Bananas <span>$53.99</span></li>
</ul>
<div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div>
<div class="checkout__order__total">Total <span>$750.99</span></div>
<div class="checkout__input__checkbox">
<label for="acc-or">
Create an account?
<input type="checkbox" id="acc-or">
<span class="checkmark"></span>
</label>
</div>
<p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
ut labore et dolore magna aliqua.</p>
<div class="checkout__input__checkbox">
<label for="payment">
Check Payment
<input type="checkbox" id="payment">
<span class="checkmark"></span>
</label>
</div>
<div class="checkout__input__checkbox">
<label for="paypal">
Paypal
<input type="checkbox" id="paypal">
<span class="checkmark"></span>
</label>
</div>
 <button type="submit" class="site-btn">PLACE ORDER</button>
</div>
</div>
</div>
</form>
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