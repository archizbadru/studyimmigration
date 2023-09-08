<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); 
   $settings = $this->db->select("site_align")
       ->get('setting')
       ->row();
        if(!empty($nav1)){

        }else{
          $nav1='';
        }
         $panel_menu = $this->db->select("tbl_user_role.user_permissions")
            ->where('pk_i_admin_id',$this->session->user_id)
            ->join('tbl_user_role','tbl_user_role.use_id=tbl_admin.user_permissions')
            ->get('tbl_admin')
            ->row();

            if (!empty($panel_menu->user_permissions)) {
              $module=explode(',',$panel_menu->user_permissions);
            }else{
              $module=array();
            }
            //print_r($module);
           $user_type = $this->session->userdata('user_type');
           $segment1 = $this->uri->segment(1);
           $segment2 = $this->uri->segment(2);
           $segment3 = $this->uri->segment(3);
   ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?= display('dashboard') ?> - <?php echo (!empty($title)?$title:null) ?></title>
      <link rel="shortcut icon" href="<?= base_url($this->session->userdata('favicon')) ?>">
      <link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>
      <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

      <?php 
      if (!empty($settings->site_align) && $settings->site_align == "RTL") {  
        ?>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>      
        <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php 
      } 
      ?>
      <!-- Font Awesome 4.7.0 -->
      <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
      <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
      <!-- semantic css -->
      <link href="<?php echo base_url(); ?>assets/css/semantic.min.css" rel="stylesheet" type="text/css"/>
      <!-- sliderAccess css -->
      <link href="<?php echo base_url(); ?>assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" type="text/css"/>
      <!-- slider  -->
      <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
      <!-- DataTables CSS -->
      <link href="<?= base_url('assets/datatables/css/dataTables.min.css?v=1.0') ?>" rel="stylesheet" type="text/css"/>
      <!-- pe-icon-7-stroke -->
      <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css?v=1.0') ?>" rel="stylesheet" type="text/css"/>
      <!-- themify icon css -->
      <link href="<?php echo base_url('assets/css/themify-icons.css?v=1.0') ?>" rel="stylesheet" type="text/css"/>
      <!-- Pace css -->
      <link href="<?php echo base_url('assets/css/flash.css') ?>" rel="stylesheet" type="text/css"/>
      <!-- Theme style -->
      <link href="<?php echo base_url('assets/css/custom.css?v=1.0') ?>" rel="stylesheet" type="text/css"/>
      <?php 
      if (!empty($settings->site_align) && $settings->site_align == "RTL") {  
        ?>
        <!-- THEME RTL -->
        <link href="<?php echo base_url('assets/css/custom-rtl.css?v=1.0') ?>" rel="stylesheet" type="text/css"/>
      <?php 
      } 
      ?>
      <!-- jQuery  -->
      <script src="<?php echo base_url('assets/js/jquery.min.js?v=1.0') ?>" type="text/javascript"></script>
      <?php
      if(in_array(220, $module)){ ?>      
      <script>
        function send_parameters(phn){          
          var agent_id = "<?=$this->session->telephony_agent_id?>";
          if(agent_id){          
            var url="https://agent.c-zentrixcloud.com/apps/appsHandler.php?transaction_id=CTI_DIAL&agent_id="+agent_id+"&phone_num="+phn+"&ip=https://agent.c-zentrixcloud.com&resFormat=3";
              $.ajax({
                  url:url,
                  type: 'GET',
                  success: function (data) {

                  }
              });
            }else{
              alert('Agent id does not found!');
            }
          }
          function listener(event) {      
            var spiltData = event.data.split('|');
            if (spiltData[0] == 'Accept') {
                

                //alert(event.data);

              if (localStorage.getItem('boolean') == 'false') {
                location.href = "<?=base_url().'telephony/forword_to/'?>" + spiltData[1];
                localStorage.setItem('boolean', 'true');
                url1 = "<?=base_url().'telephony/save_log'?>";                
                $.ajax({
                    url:url1,
                    type: 'POST',
                    data:{
                      log:event.data
                    }              
                });
                
              }
            }else if (spiltData[0] == 'Disconnect') {              
              localStorage.setItem('boolean', 'false');
            } 
          }
          if (window.parent.parent.addEventListener) {
            addEventListener("message", listener, false);
          }else{
            attachEvent("onmessage", listener);
          }  

        </script>

        <script>
            
            function  minimize_chats(){
                $('#minimize_chat').css('display', 'none');
                $('#maxmize_chat').css('display', 'block');
            }
            function  maxmize_chats(){
                $('#minimize_chat').css('display', 'block');
                $('#maxmize_chat').css('display', 'none');
            }

        </script>

        <div style="position:fixed;z-index:200;float:right;right:0px;bottom:0px;display:block;" id="maxmize_chat">
            <div> 
              <span class="btn btn-success" style="bottom:0px;z-index:300;" onclick="maxmize_chats()"> 
                <i class="fa fa-phone-square" style="font-size:30px;"></i>
              </span>              
            </div>
        </div>
        <div style="position:fixed;z-index:200;float:right;right:5px;bottom:0px;display:none;" id="minimize_chat">
            <div> 
                <span class="btn btn-primary btn-circle btn-xl" style="float:right;right:30px;bottom:0px;z-index:300;font-weight:bold" onclick="minimize_chats()" title='hide'>-</span>                
            </div>
          <iframe width="320px" height="350px"  scrolling="no" frameborder="0" align="right" gesture="media" src="http://admin.c-zentrixcloud.com/App/cti_handler.php?e=3111">
          </iframe>
        </div>
      <?php
      }
      ?>

      <style>
      .content {
       min-height: 900px;
       margin-right: auto;
       margin-left: auto;
       padding: 0 10px 10px !important;
      }
     .badge-notify{
      background-color: #db2828 !important;
      position:relative;
      top: -46px;
      left: 16px;
      }     
      body{       
       font-family: 'Montserrat';
      }
      label{       
       font-family: 'Montserrat';
      }
      td,th{       
       font-family: 'Montserrat';
      }     
      p,a,label,span{
        font-family: 'Montserrat';       
      };
      div{
        font-family: 'Montserrat';
      };
  </style>
      
</head>

   <body class="sidebar-mini" data-baseUrl="<?php echo base_url(); ?>">      
      <style>
        .main-header .logo{
          background-color:#fff !important;
        }
        .sidebar-menu > li > ul > li.active > a {
          border-left: 3px solid #37a000;     
        }
        .navbar-nav > li > a > i {
         border :1px solid #fff !important;
         padding: 12px 3px;
         width: 24px;
         text-align: center;
         color: #374767;
         background-color: #fff !important;
         height: 29px;
         font-size: 19px;
       }
        .icon_color{
          background:#fff !important;border:none!important;color:green!important;
        }   
         /* .main-header .logo{box-shadow:0 0 0 0px !important;} */ 
        .main-header { 
          position: fixed!important;width:100%!important;
        }

      </style>
      <!----------------------------------------------------------------------------------------------------alert reminder------------------------------------------------------------->
      <!----------------------------------------------------------------------------------------------------alert reminder------------------------------------------------------------->
      <style>
      .dialog-overlay{
        display: none;
        position: fixed;
        top:0;
        left:0;

        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.3);
        z-index: 9999999;
      }

/* The dialogs themselves */

    .dialog-card{
      box-sizing: border-box;
      width: 570px;
      position: absolute;
      left: 50%;
      margin-left: -285px;
      top: 20%;

      font: bold 14px sans-serif;

      border-radius: 3px;
      background-color:  #ffffff;
      box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.12);
      padding: 45px 50px;
    }

  .dialog-card .dialog-question-sign{
    float: left;
    width: 68px;
    height: 68px;
    border-radius: 50%;
    color:  #ffffff;
    text-align: center;
    line-height: 68px;
    font-size: 40px;
    margin-right: 50px;
    background-color:  #b4d8f3;
  }

  .dialog-card .dialog-info{
    float: left;
    max-width: 350px;
  }

  .dialog-card h5{	/* Dialog title */
    color:  #383c3e;
    font-size: 24px;
    margin: 5px 0 30px;
  }

  .dialog-card p{		/* Dialog text */
    color:  #595d60;
    font-weight: normal;
    line-height: 21px;
    margin: 30px 0;
  }

  .dialog-card .dialog-confirm-button,
  .dialog-card .dialog-reject-button{
    font-weight: inherit;
    box-sizing: border-box;
    color: #ffffff;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
    padding: 12px 40px;
    border: 0;
    cursor: pointer;
    outline: 0;
  }

  .dialog-card .dialog-confirm-button{
    background-color:  #87bae1;
    margin-right: 12px;
  }

  .dialog-card .dialog-reject-button{
    background-color:  #e4749e;
  }

  .dialog-card button:hover{
    opacity:0.96;
  }

  .dialog-card button:active{
    position:relative;
    bottom:-1px;
  }

</style>


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script>
   function send_data(){
       $.ajax({
         type: "POST",
         url: "<?php echo base_url();?>lead/alertList", 
         success: 
              function(data){
                  var obj = JSON.parse(data);
                  if(obj.status1==1){ document.getElementById("popupadd").innerHTML = obj.status_data;document.getElementById("cross_id").innerHTML = obj.status_id; $("#my-confirm-dialogg").fadeIn(750);
                  }else{  
                  }
              }
          })
       
   } 
</script>
	<div id="my-confirm-dialogg" class="dialog-overlay" style="display:none;">
	    <div class="dialog-card">
          <div class="dialog-question-sign"><i class="fa fa-check"></i></div>
          <div class="dialog-info">
            <div id="popupadd"></div>
          </div>
          <div id="cross_id"></div>
      </div>
  </div>
<script>
    function hide(id) {
       $.ajax({
       type: "POST",
       url: "<?php echo base_url();?>Lead/alertstatus/"+id, 
       success: 
        function(data){ 
        $("#my-confirm-dialogg").fadeOut(750);
           
        }
      });
    }
</script>
<!------------------------------------------------------------------------------------------------------------alert reminder end----------------------------------------------------->
    <br>
      <div class="wrapper">
<div class="col-md-1"></div>
<div class="col-sm-10">
   <div  class="panel panel-default thumbnail">

      <div class="panel-body panel-form">
         <div class="row">
            <div class="col-md-12 col-sm-12">
        
   <form class="form-inner" action="<?php echo base_url("enquiry_api/create_form/".$this->session->userdata('userno')."/".$this->session->userdata('proccessno')); ?>" id="enquery_from" method="POST">
                  <div id="error" class='btn btn-danger form-group col-sm-12'style="display:none;text-align:left"></div>
                  <div id="success" class='btn btn-success form-group col-sm-12' style="display:none;text-align:left"></div>
                  <div class="row">
                     <div class="form-group col-sm-4">
                        <label> <?php echo display("first_name"); ?> <i class="text-danger"></i> </label>
                        <div class = "input-group" >
                           <span class="input-group-addon" style="padding:0px!important;border:0px!important;width:28%;">
                              <select class="form-control" name="name_prefix">
                                 <?php foreach($name_prefix as $n_prefix){?>
                                 <option value="<?= $n_prefix->prefix ?>"><?= $n_prefix->prefix ?></option>
                                 <?php } ?>
                              </select>
                           </span>
                           <input class="form-control" name="enquirername" type="text" value="<?php  echo set_value('enquirername');?>" placeholder="Enter First Name" style="width:100%;"/>
                        </div>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display("last_name"); ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('lastname');?>" name="lastname" type="text" placeholder="Last Name">  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display("gender"); ?><i class="text-danger"></i></label>
                         <select name="gender" class="form-control">
                           <option value="">---Select---</option>
                           <option value="1"><?php echo display("male"); ?></option>
                           <option value="2"><?php echo display("female"); ?></option>
                           <option value="3"><?php echo display("other"); ?></option>
                         </select>                           
                     </div>
                  
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
                        <input class="form-control" value="<?php  echo set_value('mobileno')?set_value('mobileno'):$this->input->get('phone')?$this->input->get('phone'):'';?>" name="mobileno" type="text" maxlength='10' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter Mobile Number" required="">
                        <i class="fa fa-plus" onclick="add_more_phone('add_more_phone')" style="float:right;margin-top:-25px;margin-right:10px;color:red"></i>
                     </div>
                     
                     <div id="add_more_phone"></div>

                     <div class="form-group col-sm-4"> 
                        <label><?php echo display('email') ?> <i class="text-danger"></i> </label>
                        <input class="form-control" value="<?php  echo set_value('email');?> " name="email" type="email"  placeholder="Enter Email">  
                     </div>                     
                     <div class="form-group col-sm-4">
                        <label><?php echo display('company_name') ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('company');?> " name="company" type="text"  placeholder="Enter Company"> 
                     </div>
                                          
                     <div class="form-group col-sm-4">
                        <label><?php echo display('lead_source') ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="lead_source" id="lead_source" onchange="find_sub()">
                           <option value="" style="display:none;">Select <?php echo display('lead_source') ?></option>
                           <?php foreach ($leadsource as $post){ ?>
                           <option value="<?= $post->lsid?>"><?= $post->lead_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4">
                        <label><?php echo display("product"); ?></label>
                        <select class="form-control" name="sub_source" id="sub_source">
                           <option value="" style="display:none;">Select Product</option>
                           <?php foreach ($product_contry as $subsource){ ?>
                           <option value="<?= $subsource->id?>"><?= $subsource->country_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                    
                     <div class="form-group col-sm-4">
                        <label> <?php echo display("state"); ?> <i class="text-danger"></i></label>
                        <select name="state_id" class="form-control" id="fstate">
                           <option value="" style="display:none;">Select</option>
                           <?php foreach($state_list as $state){?>
                           <option value="<?php echo $state->id ?>"><?php echo $state->state; ?></option>
                           <?php } ?>
                        </select>
                     </div>                      
                      <div class="form-group col-sm-4">
                        <label><?php echo display("city"); ?> <i class="text-danger"></i></label>
                        <select name="city_id" class="form-control" id="fcity" required>
                           <option value="" style="display:none;">Select</option>
                       
                        </select>
                     </div>
                     <div class="form-group col-sm-4">
                        <label> <?php echo display("proccess"); ?> <i class="text-danger"></i></label>
                        <select name="product_id" class="form-control">
                           <option value="" style="display:none;">Select</option>
                           <?php foreach($products as $product){?>
                           <option value="<?=$product->sb_id ?>"><?=$product->product_name ?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4">
                        <label><?php echo display('address') ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('address');?> " name="address" type="text" placeholder="Enter Address"> 
                     </div>
					   
						 </div>
                
                    <div class="row col-md-12">
                      <?php 
               if(!empty($company_list)){ ?>
			
				   
                      <?php foreach($company_list as $companylist){?>
                        
							<?php $istype = false; ?>
                       <?php if($companylist['input_type']==1){
								
								$istype = true;
						   ?>
                     <div class="form-group">
                        <label> <?= ucwords($companylist['input_label'])?> <i class="text-danger"></i> </label>
                       
                             <input type="text" name="enqueryfield[]" id="<?= $companylist['input_name']?>" placeholder="<?= $companylist['input_place']; ?>"  <?php if($companylist['label_required']==1){echo "required";}?> class="form-control">
                          
                     </div>
                  <?php }if($companylist['input_type']==2){
							$istype = true;
					  ?>
                     <div class="form-group"> 
                        <label><?= ucwords($companylist['input_label'])?> <i class="text-danger"></i></label>
                     <select class="form-control"  name="enqueryfield[]"  id="<?= $companylist['input_name']?>"  <?php if($companylist['label_required']==1){echo "required";}?>> 
                        <option>Select</option>
						<?php $optarr = (!empty($companylist['input_values'])) ? explode(",",$companylist['input_values']) : array(); 
						foreach($optarr as $key => $val){
							
							?><option value = "<?php echo $val ?>"><?php echo $val ?></option><?php
						}	
						
						?>
                     </select> 
                     </div>
                  <?php }if($companylist['input_type']==3){
					  $istype = true;
					  ?>
                     <div class="form-group"> 
                        <label><?= ucwords($companylist['input_label'])?><i class="text-danger"></i></label>
                         <input type="radio"  name="enqueryfield[]"  id="<?= $companylist['input_name']?>" class="form-control"  <?php if($companylist['label_required']==1){echo "required";}?>>                         
                     </div>
                    <?php }if($companylist['input_type']==4){
						$istype = true;
						?>
                     <div class="form-group"> 
                        <label><?= ucwords($companylist['input_label'])?><i class="text-danger"></i></label>
                         <input type="checkbox"  name="enqueryfield[][]"  id="<?= $companylist['input_name']?>" class="form-control" <?php if($companylist['label_required']==1){echo "required";}?>>                         
                     </div>
                    <?php }if($companylist['input_type']==5){ 
					$istype = true;
					?>
                   <label><?= ucwords($companylist['input_label'])?><i class="text-danger"></i></label>
                   <textarea   name="enqueryfield[][]"   id="<?= $companylist['input_name']?>" class="form-control" placeholder="<?= $companylist['input_place']; ?>" <?php if($companylist['label_required']==1){echo "required";}?>></textarea>



                     <?php }
					 if($istype = true) {
					 ?><input type="hidden" name= "inputfieldno[]" value = "<?php echo $companylist['input_id'];  ?>">
					 <input type="hidden" name= "inputtype[]" value = "<?php echo $companylist['input_type'];  ?>">
				
					 <?php
					 }
					 }?>
                  
			   <?php } ?>
				   </div>
				    
					 <div class="row col-md-12">
                     <div class="form-group"> 
                        <label> <?php echo display('remark'); ?></label>
                        <textarea class="form-control" rows="4" id="remarks"  name="enquiry" placeholder="Remarks"><?php  echo set_value('remarks');?></textarea>
                     </div>
                     <br>
                     <br>
                
				 </div>
                  <div class="row">
                     <div class="col-md-6"  id="save_button">
                        <div class="row">
                           <div class="col-md-6">                                                
                              <input class="btn btn-success" type="submit" value="Save" >           
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
        
 
 </div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
     function add_more_phone(add_more_phone) {
      var html='<div class="form-group col-sm-4"><label>Other No </label><input class="form-control"  name="other_no[]" type="text" placeholder="Other Number"   ></div>';
      $('#'+add_more_phone).append(html);          
   }
</script>

      <script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>        
      <!---- new js file added by pp ------------->
      <script src="<?php echo base_url('assets/js/dashboard_js.js') ?>" type="text/javascript"></script> 
      <!----------------------------------------------------------------------------------------------->
      <!-- bootstrap js -->
      <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>  
     
      <!-- bootstrap timepicker -->
      <script src="<?php echo base_url() ?>assets/js/jquery-ui-sliderAccess.js?v=1.0" type="text/javascript"></script> 
      <script src="<?php echo base_url() ?>assets/js/select2.min.js?v=1.0" type="text/javascript"></script>
      <script src="<?php echo base_url('assets/js/sparkline.min.js?v=1.0') ?>" type="text/javascript"></script> 
    
      <!-- ChartJs JavaScript -->
      <script src="<?php echo base_url('assets/js/Chart.min.js?v=1.0') ?>" type="text/javascript"></script>
      <!-- semantic js -->
      <script src="<?php echo base_url() ?>assets/js/semantic.min.js?v=1.0" type="text/javascript"></script>
      <!-- DataTables JavaScript -->
      <script src="<?php echo base_url("assets/datatables/js/dataTables.min.js?v=1.0") ?>"></script>
      <!-- tinymce texteditor -->
      <script src="<?php echo base_url() ?>assets/tinymce/tinymce.min.js?v=1.0" type="text/javascript"></script> 
      <!-- Table Head Fixer -->
      <script src="<?php echo base_url() ?>assets/js/tableHeadFixer.js?v=1.0" type="text/javascript"></script> 
      <!-- Admin Script -->
      <script src="<?php echo base_url('assets/js/frame.js?v=1.0?v=1.0') ?>" type="text/javascript"></script> 
      <!-- Custom Theme JavaScript -->
      <script src="<?php echo base_url() ?>assets/js/custom.js?v=1.0.1" type="text/javascript"></script>
   </body>
</html>