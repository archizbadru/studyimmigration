<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Archiz Solutions</title>
        <!-- Favicon and touch icons -->
        <!-- <link rel="shortcut icon" href="<?= base_url($this->session->userdata('favicon')) ?>"> -->
      <link rel="icon" href="https://archizsolutions.com/wp-content/uploads/2018/03/cropped-Archiz-logo-1-32x32.jpg" sizes="32x32" />
        <!-- jquery ui css -->
        <link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap --> 
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
     <!-- Font Awesome 4.7.0 -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- semantic css -->
        <link href="<?php echo base_url(); ?>assets/css/semantic.min.css" rel="stylesheet" type="text/css"/> 
        <!-- sliderAccess css -->
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" type="text/css"/> 
        <!-- slider  -->
        <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/> 
        <!-- DataTables CSS -->
        <link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
         <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <!-- pe-icon-7-stroke -->
        <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- themify icon css -->
        <link href="<?php echo base_url('assets/css/themify-icons.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- Pace css -->
        <link href="<?php echo base_url('assets/css/flash.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
        <?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    </head>
    <body class="sidebar-mini  sidebar-collapse pace-done" style="background-image: url('<?php echo base_url("assets/images/OSUM Smart Wall Paper.jpg")?>');background-repeat: no-repeat;background-size:cover;">
        <div class="se-pre-con"></div>
        <br>
    <div class="container">
                <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                    <div class="col-md-12 btn btn-danger">
                <?=$this->session->flashdata('SUCCESSMSG')?>
                </div>
                <?php } ?>
                <br>
                <div class="row">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4 panel panel-default thumbnail">
                    <img src="<?php echo base_url("assets/images/godspeed.png") ?>" alt="" style="height: 50px !important;">
                       <form method="post" class="form-inner panel-body">
                            <input type="hidden" id="name" name="create_dby" value="<?=$qr_row['web_created_by']?>">                            
                            <input type="hidden" id="qr_code_id" name="qr_code_id" value="<?=$qr_row['wid']?>">                            
                            <div class="form-group row">
                                <label for="description" class="col-xs-5 col-form-label"><?php echo display('name') ?>  <i class="text-danger">*</i></label>
                                <div class="col-xs-7">
                                    <input type="text" id="name" class="form-control br_25  m-0 icon_left_input" name="e_name" value="" placeholder="<?php echo display('name') ?>" required>
                                </div>
                            </div>                           
                            <div class="form-group row">
                                <label for="description" class="col-xs-5 col-form-label">Mobile  <i class="text-danger">*</i></label>
                                <div class="col-xs-7">
                                 <input type="text" class="form-control br_25  m-0 icon_left_input" maxlength='10' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="checkAlreadyExist(this.value)" name="e_mobile" value="" placeholder="Mobile" required>
                                 <span class="alreadyexistspanmob" style="color: red;"></span>
                             </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-xs-5 col-form-label">Email  <i class="text-danger">*</i></label>
                                <div class="col-xs-7">
                                 <input type="text" class="form-control br_25  m-0 icon_left_input" name="e_email" value="" onchange="checkAlreadyExist_email(this.value)" placeholder="Email" required>
                                 <span class="alreadyexistspan" style="color: red;"></span>
                             </div>
                            </div>
                            <div class="form-group row" style="display:none;"> 
                                <label class="col-xs-5 col-form-label"><?php echo 'Process' ?> </label>
                                <div class="col-xs-7">
                                    <select class="form-control br_25  m-0 icon_left_input" name="product_id" >
                                    <option value="">---Select Process---</option>
                                        <?php foreach($products as $product){?>
                                        <option value="<?=$product->sb_id ?>" <?php if($qr_row['assign_process']==$product->sb_id){echo "selected";}?>><?= ucwords($product->product_name); ?></option>
                                        <?php } ?>
                                    </select> 
                                </div>
                             </div>                              
                             
                            <div class="form-group row">
                                <label for="address" class="col-xs-5 col-form-label">Address </label>
                                <div class="col-xs-7">
                                    <textarea type="textarea" class="form-control br_25  m-0 icon_left_input" name="e_address" value="" placeholder="Address" ></textarea>
                                </div>
                            </div>
                            <div class="form-group row"> 
                                <label class="col-xs-5 col-form-label"><?php echo 'Visa Type' ?> </label>
                                <div class="col-xs-7">
                                    <select class="form-control br_25  m-0 icon_left_input" name="e_visa" >
                                    <option value="">---Select Visa Type---</option>
                                <?php foreach($visa_type as $visa){ ?>
                                    <option value="<?php echo $visa->id; ?>"><?php echo $visa->visa_type; ?></option>
                                <?php } ?>
                                    </select> 
                                </div>
                             </div>
                             <div class="form-group row"> 
                                <label class="col-xs-5 col-form-label"><?php echo 'Prefered  Country' ?> </label>
                                <div class="col-xs-7">
                                    <select class="form-control br_25  m-0 icon_left_input" name="e_prefered[]" id="preferred_country">
                                    <option value="">---Select Country---</option>
                                <?php foreach($country_list as $country){ ?>
                                    <option value="<?= $country->id_c?>"> <?= $country->country_name?></option>
                                <?php } ?>
                                    </select> 
                                </div>
                             </div>
                    <div class="form-group row">
                        <label class="col-xs-5 col-form-label"><?php echo 'Qualification' ?> <i class="text-danger"></i></label>
                        <div class="col-xs-7">
                        <input class="form-control" name="e_qualification" type="text"  placeholder="Enter Qualification">
                        </div> 
                    </div>

                    <div class="form-group row">
                        <label class="col-xs-5 col-form-label"><?php echo 'Age' ?> <i class="text-danger"></i></label>
                        <div class="col-xs-7">
                        <input class="form-control" value="<?php  echo set_value('age');?> " name="e_age" type="number"  placeholder="Enter Age">
                        </div> 
                     </div>

    <div class="form-group row">
      <label class="col-xs-5 col-form-label">State <i class="text-danger"></i></label>
      <div class="col-xs-7">                        
      <select name="state_id" class="form-control" id="fstate">
         <option value="" >Select</option>
         <?php foreach($state_list as $state){
            //echo  $state->id.' '.$details->state_id;
            ?>
         <option value="<?php echo $state->id ?>"><?php echo $state->state; ?></option>
         <?php } ?>
      </select>
     </div>
     <img src='https://consultantscrm.com/assets/images/loader_blue.gif' width='10px' height='10px' id="loader11" style="display: none;">
    </div>

    <div class="form-group row">
      <label class="col-xs-5 col-form-label">City <i class="text-danger"></i></label>
      <div class="col-xs-7">
      <select name="city_id" class="form-control" id="fcity">
         <option value="" >Select</option>
         <?php
            foreach ($city_list as $value) { ?>
         <option value="<?=$value->id?>"><?=$value->city;?></option>
         <?php                           
            }
            ?>
      </select>
      </div>
   </div>

                     <div class="form-group row">
                        <label class="col-xs-5 col-form-label"><?php echo 'Experience' ?> <i class="text-danger"></i></label>
                        <div class="col-xs-7">
                        <select class="form-control" name="e_experience" class="" id="experience">
                           <option value="" style="">---Select Experience---</option>
                           <option value="Yes"> Yes</option>
                           <option value="No"> No</option>
                        </select> 
                        </div>
                     </div>

                            <div class="form-group row">
                                <label for="description" class="col-xs-5 col-form-label">Remarks </label>
                                <div class="col-xs-7">
                                    <textarea type="textarea" class="form-control br_25  m-0 icon_left_input" name="e_requirements" value="" placeholder="Remarks" ></textarea>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6 text-center">
                                    <div class="ui buttons">
                                        <button type="reset" onclick="reset()" class="ui button">
                                        <?php echo display('reset') ?>
                                        </button>
                                        <div class="or"></div>
                                        <button class="ui positive button" type="submit" id="data_save"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="col-md-3">&nbsp;</div>
            </div>
         </div>
      <div style="<?php if(!empty($this->session->popup)){echo 'display:block';} ?>">
      <div id="success_model" class="modal  <?php if(!empty($this->session->popup)){echo 'fade in';} ?>" role="dialog" style="<?php if(!empty($this->session->popup)){echo 'display:block';} ?>">
  <div class="modal-dialog">
     <div class="modal-content">        
        <div class="modal-body">
            <!--<center><img src="<?php echo base_url();?>assets/images/logo.png" style="width:130px;"></center>-->
          <h3>Thanks!! We will contact you shortly.</h3>
        </div>
        <div class="modal-footer">
            <center><button type="button" class="btn btn-danger" onClick="refreshPage()">OK</button>  <center>
        </div>
      </div>  
  </div>
</div>  
</div> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function checkAlreadyExist(phone) {
    //alert(phone);
     $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>configurations/find_same_data',
            data: {cdata:phone},
         success:function(data){
            res = JSON.parse(data);
              if(res){

//$(".alreadyexistspanmob").html("This no already exists in our database"); 
var swaldt = "<table class='table table-striped'><thead><tr><th>Name</th><th>Email</th><th>Mobile</th></tr></thead><tbody><tr><td>"+res.name_prefix + res.name  +' '+ res.lastname+"</td><td>"+res.phone+"</td><td>"+res.email+"</td></tr><tr><td colspan='3'>Your details already exists in our CRM. Please contact at our helpline.</td></tr></tbody></table>";
Swal.fire(
  'Oops...',
  swaldt,
  'question'
)                   
$("input[name='e_mobile']").val("");            
                //$("input[name='e_name']").val(res.name_prefix + res.name  +' '+ res.lastname);
                //$("input[name='e_mobile']").val(res.phone);                
                //$("input[name='e_email']").val(res.email);
                //$("input[name='e_requirements']").val(res.enquiry);              
              }else{
$(".alreadyexistspanmob").text("");
}
         }               
     });      
}

function checkAlreadyExist_email(email) {
    //alert(phone);
     $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>configurations/find_same_data_email',
            data: {cdata:email},
         success:function(data){
            res = JSON.parse(data);
              if(res){
//$(".alreadyexistspan").html("This email already exists in our database");
var swaldt = "<table class='table table-striped'><thead><tr><th>Name</th><th>Email</th><th>Mobile</th></tr></thead><tbody><tr><td>"+res.name_prefix + res.name  +' '+ res.lastname+"</td><td>"+res.phone+"</td><td>"+res.email+"</td></tr><tr><td colspan='3'>Your details already exists in our CRM. Please contact at our helpline.</td></tr></tbody></table>";
Swal.fire(
  'Oops...',
  swaldt,
  'question'
)                
$("input[name='e_email']").val("");            
                //$("input[name='e_name']").val(res.name_prefix + res.name  +' '+ res.lastname);
                //$("input[name='e_mobile']").val(res.phone);                
                //$("input[name='e_email']").val(res.email);
                //$("input[name='e_requirements']").val(res.enquiry);              
              }else{
$(".alreadyexistspan").text("");
}
         }               
     });      
}
</script>
 
<!-- <script>
        $("#fstate").change(function(){        
        var state_id = $(this).val();        
        //console.log(city_name);        
    $.ajax({
            type: 'POST',
            url: 'http://0903.ga/location/get_city_byid',
            data: {state_id:state_id},
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('fcity').innerHTML=data;
            }else{
              document.getElementById('fcity').innerHTML='';   
            }
            })
            .fail(function() {            
            });            
    });

</script> -->

<script type="text/javascript">

    $(document).ready(function() {

           // $("#fstate").select2({});
           // $("#fcity").select2({});

    });

/*$(document).ready(function(){ 
  $('#preferred_country').select2({
     placeholder: "Select Country"
  }); 
 });*/

    $(document).ready(function() {
        $("#create_dby").select2({
        });
    });

$(document).on("change",'#fstate',function () {
  $("#loader11").show();
    var id = $(this).val(); // <-- change this line
    $.ajax({
        url: "<?php echo base_url();?>location/get_city_byidqr",
        async: false,
        type: "POST",
        data: {state_id:id},
       dataType: 'html',
        success: function(data) {
          $("#loader11").hide();
          $('#fcity').html(data);
        }
    })
});
</script>
<!-- jquery-ui js -->
        <script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script> 
        <!-- bootstrap js -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>  
        <!-- pace js -->
        <script src="<?php echo base_url('assets/js/pace.min.js') ?>" type="text/javascript"></script>  
        <!-- SlimScroll -->
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>  
        <!-- bootstrap timepicker -->
        <script src="<?php echo base_url() ?>assets/js/jquery-ui-sliderAccess.js" type="text/javascript"></script> 
        <!--<script src="<?php echo base_url() ?>assets/js/jquery-ui-timepicker-addon.min.js" type="text/javascript"></script> -->
        <!-- select2 js -->
        <script src="<?php echo base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/sparkline.min.js') ?>" type="text/javascript"></script> 
        <!-- Counter js -->
        <script src="<?php echo base_url('assets/js/waypoints.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/jquery.counterup.min.js') ?>" type="text/javascript"></script>
        <!-- ChartJs JavaScript -->
        <script src="<?php echo base_url('assets/js/Chart.min.js') ?>" type="text/javascript"></script>        
        <!-- semantic js -->
        <script src="<?php echo base_url() ?>assets/js/semantic.min.js" type="text/javascript"></script>
        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>
        <!-- tinymce texteditor -->
        <script src="<?php echo base_url() ?>assets/tinymce/tinymce.min.js" type="text/javascript"></script> 
        <!-- Table Head Fixer -->
        <script src="<?php echo base_url() ?>assets/js/tableHeadFixer.js" type="text/javascript"></script>
        <!-- Admin Script -->
        <script src="<?php echo base_url('assets/js/frame.js') ?>" type="text/javascript"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
        <script type="text/javascript">
function refreshPage(){
   $('#success_model').modal('hide');
} 
    $(function(){        
        $("#enquiry_type").change(function(){            
            var enq_type = $(this).val();            
            if(enq_type==1){                
                $("#customer_type").show(); 
            }else{                
                $("#customer_type").hide(); 
            }          
            if(enq_type==11){                
                $("#channel_partner").show();
                $("#optunity_size").hide();  
            }else{                
                $("#channel_partner").hide();                
                $("#optunity_size").show();
            }            
        });
    });    
 </script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js">
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
</body>
</html>