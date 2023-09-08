<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= display('login') ?> - <?php echo (!empty($title)?$title:null) ?></title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo (!empty($favicon)?$favicon:null) ?>">

        <!-- Bootstrap --> 
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
        
        <!-- 7 stroke css -->
        <link href="<?php echo base_url(); ?>assets/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>

        <!-- style css -->
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
        
        <div class="col-md-12" style="margin-top:6%;display:<?php if($link->reset_password==0){echo"block";}else{echo"none";}?>;">
            <div class="alert alert-danger" role="alert">
              <h4>Link has been expired..</h4>
            </div>
        </div>
        <!-- Content Wrapper -->
        <div class="login-wrapper" style="display:<?php if($link->reset_password==1){echo"block";}else{echo"none";}?>;"> 
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3><?php echo (!empty($title)?$title:null) ?></h3>
                                <small><strong>Change your password</strong></small>
                            </div>
                        </div>
                        <div class="">
                        <br><br>
                            <!-- alert message -->
                            <?php if ($this->session->flashdata('message') != null) {  ?>
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('message'); ?>
                            </div> 
                            <?php } ?>
                            
                            <?php if ($this->session->flashdata('exception') != null) {  ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('exception'); ?>
                            </div>
                            <?php } ?>
                            
                            <?php if (validation_errors()) {  ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo validation_errors(); ?>
                            </div>
                            <?php } ?> 
                        </div>
                        
                        <div class="alert alert-danger alert-dismissable" style="display:none" id="err-messg">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4>Confirm password is not matched</h4>
                       </div>
                    </div>


                    <div class="panel-body" id="LoginDiv">
                        <form id="changepasswordForm">
                            
                            <div class="form-group">
                                <label class="control-label" for="password">New Password</label>
                                <input type="password"  name="npassword" id="npassword" class="form-control" required> 
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label" for="password">Confirm Password</label>
                                <input type="password"   name="cpassword" id="cpassword" class="form-control"> 
                            </div>
                            <div> 
                                <button  type="submit" class="btn btn-success">Change password</span> 
                            </div>
                            
                        </form>
                    </div> 
                    
                    
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        <script>
            
            $(function(){
                
                $("#fpassword").click(function(){
                    
                   $("#LoginDiv").hide();
                    
                   $("#ForgetPasswordDiv").show();
                   
                });
                
                $("#Llogin").click(function(){
                    
                    $("#LoginDiv").show();
                    
                   $("#ForgetPasswordDiv").hide();
                    
                });
                
            });
            
        </script>
        
        <script>
            
            $(function(){
                
                
                $("#changepasswordForm").submit(function(e){
                    
                    e.preventDefault();
                    
                    var cpassword = $("#cpassword").val();
                    var npassword = $("#npassword").val();
                    
                    if(npassword==cpassword){
                    
                    
                        $.ajax({
                            
                            url : '<?php echo base_url('change-password/'.$this->uri->segment('2'))?>',
                            
                            type : 'POST',
                            
                            data: $(this).serialize(),
                            
                            success:function(data){
                                
                                if(data==1){
                                    
                                    swal({
                                              title: "Congratulation",
                                              text: "Your password is changed successfully",
                                              icon: "success",
                                              button: "OK",
                                              
                                    }).then((value) => {
                                        
                                        window.location='<?php echo base_url('login')?>';
                                    });
                                
                                
                                }
                            }
                            
                        });
                        
                }else{
                    
                    $("#err-messg").show();
                    return false;
                    
                }
                    
                });
                
            });
            
        </script>
        
    </body>
</html>