
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

    <title>Signup As a User</title>

<style>
    .account-area .account-form .form-group.checkgroup input:checked::after {
    content: "\f00c";
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

     <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="">
                      <img src="<?= base_url('assets_web1/images/')?>ukuni.png" style="width: 60px;height: 45px;">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="<?= base_url('website/home/university')?>" class="active">Home</a>
                       
                    </li>
                     <li>
                        <a href="<?= base_url('website/home/university')?>#services">Services</a>
                       
                    </li>
    
          
                    <li>
                        <a href="<?= base_url('website/home/university')?>#aboutus">About US</a>
                       
                    </li>
                     <li>
                        <a href="<?= base_url('website/home/university')?>#sponsers">Sponsers</a>
                    </li>
                     <li>
                        <a href="<?= base_url('website/home/university')?>#testimonials">Testimonials</a>
                    </li>
           
                    <li>
                        <a href="<?= base_url('website/home/university')?>#contact">contact</a>
                    </li>
                   
                    <li class="header-button pr-0">
                        <a href="<?= base_url('website/home/login1')?>">Login</a>
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
    
    <!-- ==========Sign-In-Section========== -->
    <section class="account-section bg_img" data-background="<?= base_url('assets_web1/images/')?>account-bg.jpg">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <div class="section-header-3">
                        <?php if(!empty($this->session->flashdata('message'))) { echo $this->session->flashdata('message'); }?>
                         <?php if(!empty($this->session->flashdata('error'))) { echo $this->session->flashdata('error'); }?>

                    
                        <span class="cate">Sign Up </span>
                        <h2 class="title"> </h2>
                    </div>
                    <form class="account-form" action="<?= base_url('website/home/signupuniversity')?>" method="post">
                         <div class="form-group">
                            <label for="email1">University Name<span>*</span></label>
                            <input type="text" placeholder="Enter Your University" id="uname" name="uname" required>
                        </div>
                        <div class="form-group">
                            <label for="email1">Email<span>*</span></label>
                            <input type="text" placeholder="Enter Your Email" id="email" name="email" required>
                        </div>
                         <div class="form-group">
                            <label for="email1">Phone<span>*</span></label>
                            <input type="text" placeholder="Enter University Phone" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="pass1">Password<span>*</span></label>
                            <input type="password" placeholder="Password" id="pass" name="pw" required>
                        </div>

                        <div class="form-group">
                                
                         <span class="show">City <span style="color: red">*</span></span>
                                        <select class="" style="color: black" required="" name="city" id="city">
                                            <option value="">Select</option>
                                            <?php if(!empty($city_list)){
                                            foreach($city_list as $citylist){

                                            ?>
                                            <option value="<?= $citylist->id?>"><?= $citylist->city?></option>
                                            <?php }}?>
                                        </select>
                        </div>
                     
                        <div class="form-group checkgroup" style="display: none">
                            <input type="checkbox" id="bal" required checked>
                            <label for="bal">I agree to the <a href="#0">Terms, Privacy Policy</a></label>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Sign Up">
                        </div>
                    </form>
                    <div class="option">
                        Already have an account? <a href="<?= base_url('website/home/login1')?>">Login</a>
                    </div>
                    <div class="or"><span>Or</span></div>
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
                                <i class="fa fa-google"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
        <footer class="footer-section">

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
    <!-- ==========Sign-In-Section========== -->


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