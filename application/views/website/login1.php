<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="en" class=" sizes customelements history pointerevents postmessage webgl websockets cssanimations csscolumns csscolumns-width csscolumns-span csscolumns-fill csscolumns-gap csscolumns-rule csscolumns-rulecolor csscolumns-rulestyle csscolumns-rulewidth csscolumns-breakbefore csscolumns-breakafter csscolumns-breakinside flexbox picture srcset webworkers"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
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

    <title>Login</title>


</head>

<body>
    <!-- ==========Preloader========== -->
    <div class="preloader" style="display: none;">
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
                        <a href="<?= base_url('website/home/signup_university')?>">Sign Up</a>
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
    <section class="account-section bg_img" data-background="<?= base_url('assets_web1/images/')?>account-bg.jpg" style="background-image: url(&quot;<?= base_url('assets_web1/images/')?>account-bg.jpg&quot;);">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <div class="section-header-3">
                        <span class="cate">Login</span>
                    
                    </div>
                    <?php echo form_open('dashboard/index','class="account-form"')?>
                    <!-- <form class="account-form" action="<?= base_url('dashboard/validate_login')?>" method="post" id="loginForm"> -->
                        <div class="form-group">
                            <label for="email2">Email<span>*</span></label>
                            <input type="text" placeholder="Enter Your Email" id="email2" name="email" required="">
                        </div>
                        <div class="form-group">
                            <label for="pass3">Password<span>*</span></label>
                            <input type="password" placeholder="Password" id="pass3" name="password" required="">
                        </div>
                        <div class="form-group checkgroup">
                            <input type="checkbox" id="bal2" required="" checked="">
                            <label for="bal2">remember password</label>
                            <a href="" class="forget-pass">Forget Password</a>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="log in">
                        </div>
                    </form>
                   
                    <div class="or"><span>Or</span></div>
                    <ul class="social-icons">
                        <li>
                            <a href="http://www.pixner.net/boleto/demo/sign-in.html#0">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.pixner.net/boleto/demo/sign-in.html#0" class="active">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.pixner.net/boleto/demo/sign-in.html#0">
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

    <script>
              $("#loginForm").on("submit",function(e){
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data){
                        data = JSON.parse(data);                        
                        if(data.process){
                            if(data.status){        
                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    data: form.serialize(), // serializes the form's elements.
                                    success: function(data){
                                        data = JSON.parse(data);                                        
                                       if(data.status){
                                            $("#process_html").html(data.process);
                                            $("#process_modal").modal('show');
                                        }else{                                            
                                            Swal.fire({                                    
                                              title: "Warning",
                                              html: data.message,
                                              icon: "warning",
                                              button: "OK",
                                              dangerMode: true,
                                            });
                                        }
                                    }
                                });
                            }else{
                                Swal.fire({                                    
                                  title: "Warning",
                                  html: data.message,
                                  icon: "warning",
                                  button: "OK",
                                  dangerMode: true,
                                })
                            }

                        }else{
                           if(data.status){
                                window.location.reload();
                           }else{
                             Swal.fire({                                    
                                  title: "Warning",
                                  html: data.message,
                                  icon: "warning",
                                  button: "OK",
                                  dangerMode: true,
                                })   
                           }
                        }
                    }
                }); 
            });
    </script>

</body></html>