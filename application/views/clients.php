<style>

   .btn-outline-dark{ color: #2f353a!important;

   background-color: transparent!important;

   background-image: none!important;

   border-color: #2f353a!important;}

   .btn-outline-dark{display: inline-block!important;

   font-weight: 400!important;

   text-align: center!important;

   white-space: nowrap!important;

   vertical-align: middle!important;

   -webkit-user-select: none!important;

   -moz-user-select: none!important;

   -ms-user-select: none!important;

   user-select: none!important;

   border: 1px solid transparent!important;

   border-top-color: transparent!important;

   border-right-color: transparent!important;

   border-bottom-color: transparent!important;

   border-left-color: transparent!important;

   padding: 0.375rem 0.75rem!important;

   font-size: 0.875rem!important;

   line-height: 1.5!important;

   border-radius: 0.25rem!important;

   transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;}

   .fc-widget-content{height:50px!important;overflow:hidden;}

   .fc-scroller{height:336px!important;}

   table th,td{font-size:14px;}

   .border_bottom{border-bottom:2px solid #E4E5E6;min-height: 7vh;margin-bottom: 1vh;cursor:pointer;}  

   .border_bottom_active{border-bottom:2px solid #20A8D8;min-height: 7vh;margin-bottom: 1vh;cursor:pointer;}

   [data-green]:before {

   content: attr(data-green);

   display: inline-block;

   font-size: 1em;

   width: 2.5em;

   height: 2.5em;

   line-height: 2.5em;

   text-align: center;

   border-radius: 50%;

   background:green;

   vertical-align: middle;

   margin-right: 1em;

   color: white;

   }

   [data-black]:before {

   content: attr(data-black);

   display: inline-block;

   font-size: 1em;

   width: 2.5em;

   height: 2.5em;

   line-height: 2.5em;

   text-align: center;

   border-radius: 50%;

   background:#000;

   vertical-align: middle;

   margin-right: 1em;

   color: white;

   }

</style>

<div class="row">

   <div class="col-md-12" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">

      <div class="col-md-6" >Clients

      </div>

      <div class="col-md-6" >

         <div style="float:right">

            <!--<div class="btn-group" role="group" aria-label="Button group">

               <input class="form-control" id="searchBox" type="text" placeholder="Search" style="width: 300px;">            

               </div>

               <div class="btn-group" role="group" aria-label="Button group">

               <a class="btn" onClick="window.location.reload();" title="Refresh">

                  <i class="fa fa-refresh icon_color"></i>

               </a>

                             

                                   

               

                                   

               </div>-->

            <div class="btn-group" role="group" aria-label="Button group">

               <a class="dropdown-toggle" href="<?php echo base_url()?>enquiry/create" title="<?php echo display('add_new_enquiry');?>"> <i class="fa fa-plus" style="background:#fff !important;border:none!important;color:green;"></i></a>&nbsp;&nbsp;&nbsp;

            </div>

            <!-- <div class="btn-group" role="group" aria-label="Button group">

               <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#uploadbulk" title="upload Enquiry"> <i class="fa fa-upload" style="background:#fff !important;border:none!important;color:green;"></i></a>

            </div> -->

            <div class="btn-group" role="group" aria-label="Button group">

               <a class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

               <i class="fa fa-check icon_color"></i>

               </a>  

               <div class="dropdown-menu dropdown_css" style="max-height: 400px;overflow: auto;">

                  <h4 class="btn"><?php echo display('action');?></h4>

                  <a class="btn" data-toggle="modal" data-target="#AssignSelected" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;"><?php echo display('assign_selected'); ?></a>

                  <a class="btn"  data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('1','Send Whatssp');"  style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_whatsapp'); ?> </a>

                  <a class="btn " data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('2','Send Sms');" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php echo display('send_bulk_sms'); ?></a>

                  <!-- <a class="btn color-red" data-target="#deleteselected" data-toggle="modal"  style="color:#000;cursor:pointer;border-radius: 2px;border-bottom: 1px solid #fff;"><?php if($this->session->user_role==2||$this->session->user_role==1){ echo display('delete_selected'); }?></a>   -->

               </div>

            </div>

         </div>

      </div>

   </div>

   <div class="row">

      <div class="col-md-12" id="active_class" >

         <div class="col-md-2" >

            <div  class="col-12 border_bottom" >

               <p style="margin-top: 2vh;font-weight:bold;" onclick="changeMenu('client','enquery_detals_by_status','1')"   title="<?php echo display('created_today'); ?>"><i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo display('created_today'); ?><span style="float:right;" class="badge badge-pill badge-primary "><?php echo $all_created_today->num_rows();?></span></p>

            </div>

         </div>

         <div class="col-md-2" >

            <div class="col-12 border_bottom" style="min-height:7vh;margin-bottom: 1vh;cursor:pointer;">

               <p style="margin-top: 2vh;font-weight:bold;" onclick="changeMenu('client','enquery_detals_by_status','2')"  title="<?php echo display('updated_today'); ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;<?php echo display('updated_today'); ?><span style="float:right;background:#ffc107" class="badge badge-pill badge-warning badge badge-dark "><?php echo $all_Updated_today->num_rows();?></span></p>

            </div>

         </div>

         <div class="col-md-2" >

            <div  class="col-12 border_bottom border_bottom_active" >

               <p style="margin-top: 2vh;font-weight:bold;" onclick="changeMenu('client','enquery_detals_by_status','3')"   title="<?php echo display('active'); ?>"><i class="fa fa-file" ></i>&nbsp;&nbsp;<?php echo display('active'); ?><span style="float:right;" class="badge badge-pill badge-primary "><?php echo $all_Active_clients->num_rows();?></span></p>

            </div>

         </div>


         <div class="col-md-2" >

            <div class="col-12 border_bottom" >

               <p style="margin-top: 2vh;font-weight:bold;" onclick="changeMenu('client','enquery_detals_by_status','6')" title="<?php echo display('total'); ?>"><i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo display('total'); ?><span style="float:right;background:#000" class="badge badge-pill badge-dark "><?php echo $all_clients->num_rows(); ?></span></p>

            </div>
         </div> 

      </div>

      <div class="col-md-12">

         <form class="form-inner" method="post" id="enquery_assing_from" >

            <div class="panel panel-default">

               <div class="col-md-12" id="content_tabs"></div>

            </div>

      </div>

   </div>

   <div id="genLead" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <!-- Modal content-->

   <div class="modal-content">

   <div class="modal-header">

   <button type="button" class="close" data-dismiss="modal">&times;</button>

   <h4 class="modal-title">Enter info and Move to lead</h4>

   </div>

   <div class="modal-body">

   <div class="row">

   <div class="form-group col-sm-6">  

   <label>Opportunity Size</label>                  

   <input class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="opportunity_size" type="text" required>                

   </div>

   <div class="form-group col-sm-6">  

   <label>Expected Closer Date</label>                  

   <input class="form-control date2"  name="expected_date" type="text" readonly>                

   </div>

   <div class="form-group col-sm-6">

   <label class="col-form-label">Conversion Probability</label>

   <select class="form-control" id="LeadScore" name="lead_score">

   <option></option>                                               

   <?php foreach ($lead_score as $score) {  ?>

   <option value="<?= $score->sc_id?>"><?= $score->score_name?>&nbsp;<?= $score->probability?></option>

   <?php } ?>                       

   </select>

   </div>

   <div class="form-group col-sm-6">  

   <label>Add Comment</label>                  

   <input class="form-control" id="LastCommentGen" name="comment" type="text">                

   </div>

   <div class="form-group col-sm-12">        

   <button class="btn btn-success" type="button" onclick="moveto_lead();" >Move to Lead</button>        

   </div>

   </div>

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

   </div>

   </div>

   </div>

   </div>

   <div id="AssignSelected" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <!-- Modal content-->

   <div class="modal-content">

   <div class="modal-header">

   <button type="button" class="close" data-dismiss="modal">&times;</button>

   <h4 class="modal-title">Client Assignment</h4>

   </div>

   <div class="modal-body">

   <div class="row">

   <div class="form-group col-md-12">  

   <label>Select Employee</label>                  

   <select class="form-control"  name="assign_employee">                    

   <?php foreach ($user_list as $user) { 

      if (!empty($user->user_permissions)) {

                     $module=explode(',',$user->user_permissions);

                     }

                     

                     if(in_array(60,$module)==true||in_array(61,$module)==true||in_array(62,$module)==true){?>

   <option value="<?php echo $user->pk_i_admin_id; ?>"><?php echo $user->s_display_name; ?>&nbsp;<?php echo $user->last_name; ?></option>

   <?php } }?>                                                     

   </select> 

   </div>

   <input type="hidden" value="" class="enquiry_id_input" >

   <div class="form-group col-sm-12">        

   <button class="btn btn-success" type="button" onclick="assign_enquiry();"><?php echo display('Save'); ?></button>        

   </div>

   </div>

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

   </div>

   </div>

   </div>

   </div>

   <!---------------------------- DROP Enquiry -------------------------------->

   <div id="dropEnquiry" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <!-- Modal content-->

   <div class="modal-content">

   <div class="modal-header">

   <button type="button" class="close" data-dismiss="modal">&times;</button>

   <h4 class="modal-title">Drop Enquiry</h4>

   </div>

   <div class="modal-body">

   <div class="row">

   <div class="form-group col-sm-12">  

   <label>Drop Status</label>                  

   <select class="form-control"  name="drop_status">                    

   <?php foreach ($drops as $drop) {   ?>

   <option value="<?php echo $drop->d_id; ?>"><?php echo $drop->drop_reason; ?></option>

   <?php } ?>                                             

   </select> 

   </div>

   <div class="form-group col-sm-12"> 

   <label>Drop Reason*</label>

   <input class="form-control" name="reason" type="text" required="">  

   </div> 

   </div>          

   <div class="col-12" style="padding: 0px;">

   <div class="row">              

   <div class="col-12" style="text-align:center;">                                                

   <button class="btn btn-success" type="button" onclick="drop_enquiry()">Save</button>            

   </div>

   </div>                                   

   </div> 

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

   </div>

   </div>

   </div>

   </div>

   <div id="sendsms" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <!-- Modal content-->

   <div class="modal-content card">

   <div class="modal-header">

   <button type="button" class="close" data-dismiss="modal">&times;</button>

   <h4 class="modal-title" id="modal-titlesms"></h4>

   </div>

   <div>

   <div class="form-group col-sm-12">

   <label>Template</label>

   <select class="form-control" name="templates" required id="templates"  onchange="getMessage()">

   </select>

   </div>

   <div class="form-group col-sm-12"> 

   <label><?php echo display('message') ?></label>

   <textarea class="form-control" name="message_name"  rows="10" id="template_message"></textarea>  

   </div>

   </div>

   <div class="col-md-12">

   <button class="btn btn-success" type="button" onclick="send_sms()"><?php echo display('send');?></button>           

   <input type="hidden" value="2" id="mesge_type" name="mesge_type">

   <input type="hidden" value="<?php //echo  $enquiry->email;;?>"  name="email">

   <input type="hidden" value="<?php //echo $enquiry->phone;; ?>"  name="phone">

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

   </div>

   </div>

   </div>

   </div>

   <div id="deleteselected" class="modal fade" role="dialog">

   <div class="modal-dialog">

   <div class="modal-content">

   <div class="modal-body">

   <i class="fa fa-question-circle" style="font-size:100px;"></i><br><h1>Are you sure, you want to permanently delete selected record?</h1>

   </div>

   <div class="modal-footer">

   <button type="button" class="btn btn-success" onclick="delete_recorde()">Ok</button>

   <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

   </div>

   </div>

   </div>

   </div>

   </form>

</div>

</div>

<script>

   $('.checked_all').on('change', function() {     

               $('.checkbox').prop('checked', $(this).prop("checked"));              

       });

       $('.checkbox').change(function(){ 

           if($('.checkbox:checked').length == $('.checkbox').length){

                  $('.checked_all').prop('checked',true);

           }else{

                  $('.checked_all').prop('checked',false);

           }

       });

       

       

   

   $( "#service" ).click(function() {     

   if($('#another-element:visible').length)

       $('#another-element').hide();

   else

       $('#another-element').show();        

   });

   

   

   $( "#task_create_div" ).click(function() {     

   if($('#task_create:visible').length)

       $('#task_create').hide();

   else

       $('#task_create').show();        

   });

   

   

</script>

<style>

   .dropdown-header {

   display: block;

   padding: 0 1.5rem;

   margin-bottom: 0;

   color: #73818f;

   white-space: nowrap;

   }

   .dropdown_css {

   left:auto!important;

   right: 0 ! important;}

   .dropdown_css a,.dropdown_css a h4{width:100%;text-align:left! important;;

   border-bottom: 1px solid #c8ced3! important;}

   input[type=number]::-webkit-inner-spin-button, 

   input[type=number]::-webkit-outer-spin-button { 

   -webkit-appearance: none; 

   margin: 0; 

   }

   input[type=number]::-webkit-inner-spin-button, 

   input[type=number]::-webkit-outer-spin-button { 

   -webkit-appearance: none;

   -moz-appearance: none;

   appearance: none;

   margin: 0; 

   }

   [data-letters]:before {

   content: attr(data-letters);

   display: inline-block;

   font-size: 1em;

   width: 2.5em;

   height: 2.5em;

   line-height: 2.5em;

   text-align: center;

   border-radius: 50%;

   background: #37a000;

   vertical-align: middle;

   margin-right: 1em;

   color: white;

   }

</style>

<!--------------- ADD NEW CLIENT ------------->

<div id="createnewclient" class="modal fade" role="dialog">

   <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content">

         <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Create New Client</h4>

         </div>

         <div class="modal-body">

            <!--<form>-->

            <?php echo form_open_multipart('client/create_newclient','class="form-inner"') ?>                      

            <div class="row">

               <div class="form-group col-sm-6"> 

                  <label><?php echo display('name') ?>*</label>

                  <input class="form-control" name="clientname" type="text" required="">  

               </div>

               <div class="form-group col-sm-6"> 

                  <label><?php echo display('mobile') ?></label>

                  <input class="form-control" name="mobileno" type="number" max-length='10'>  

               </div>

               <div class="form-group col-sm-6"> 

                  <label><?php echo display('email') ?>*</label>

                  <input class="form-control" name="email" type="email" required="">  

               </div>

               <div class="form-group col-sm-6"> 

                  <label><?php echo display('address') ?>*</label>

                  <input class="form-control" name="address" type="text" required="">  

               </div>

               <div class="form-group   col-sm-6">

                  <label>Status</label>

                  <select class="form-control" name="status" required>

                     <option value=""></option>

                     <option value="1">Active</option>

                     <option value="0">Disabled</option>

                  </select>

               </div>

            </div>

            <div class="col-12" style="padding: 0px;">

               <div class="row">

                  <div class="col-12" style="text-align:center;">                                                

                     <button class="btn btn-success" type="submit">Save</button>            

                  </div>

               </div>

            </div>

            </form> 

         </div>

         <div class="modal-footer">

            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

         </div>

      </div>

   </div>

</div>

<script> 

   function hide_td(id,id2){

    var a=   document.getElementById(id2);

    if(a.checked==true){   

     $('.'+id).css('visibility','visible');

   $('.'+id).css('display','table-cell');  

     //  document.getElementsByClassName("th1").style.visibility = "hidden";

   }else{

       $('.'+id).css('visibility','hidden');

   $('.'+id).css('display','none');

       

   

   }

   }

       

       

</script>

<script>

   function getTemplates(SMS,type){

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>message/get_templates/'+SMS,

   })

   .done(function(data){

       

       $('#modal-titlesms').html(type);

       $('#mesge_type').val(SMS);

       $('#templates').html(data);

   })

   .fail(function() {

   alert( "fail!" );

   

   });

   }

</script>

<script>

   function getMessage(){

      id=document.getElementById('templates').value;

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>message/getMessage/'+id,

   })

   .done(function(data){

   $("#template_message").html(data);

   })

   .fail(function() {

   alert( "fail!" );

   

   });

   }

   

   

   function assign_enquiry(){

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>client/assign_enquiry',

   data: $('#enquery_assing_from').serialize(),

   success:function(data){

    alert(data); 
   location.reload();

   }});

   }

    function  send_sms(){
     $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>message/send_sms',
    data: $('#enquery_assing_from').serialize()
    })
    .done(function(data){
        
        alert(data);
      location.reload();
    })
    .fail(function() {
    alert( "fail!" );
    
    });   
}

   function moveto_lead(){

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>enquiry/move_to_lead',

   data: $('#enquery_assing_from').serialize(),

   success:function(data){

    alert(data); 

   }});

   }

   

   function drop_enquiry(){

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>enquiry/drop_enquiries',

   data: $('#enquery_assing_from').serialize(),

   success:function(data){

    alert(data); 

   }});

   }

   

   function delete_recorde(){

   $.ajax({

   type: 'POST',

   url: '<?php echo base_url();?>client/delete_recorde',

   data: $('#enquery_assing_from').serialize(),

   success:function(data){

    alert(data);

    window.location.href = '<?php echo base_url();?>client';

   }});

   }

</script>

<script>

   function reset_input(){

   $('input:checkbox').removeAttr('checked');

   }

   function check_all(checkclass,checkbox){

       $('.'+ checkclass).on('change', function() {     

                   $('.'+ checkbox).prop('checked', $(this).prop("checked"));

                   

           });

           $('.'+checkbox).change(function(){ 

               if($('.'+ checkbox +':checked').length == $('.'+ checkbox).length){

                      $('.'+ checkclass).prop('checked',true);

               }else{

                      $('.'+ checkclass).prop('checked',false);

               }

           });

   }  

           

           

           $('.checked_all1').on('change', function() {     

                   $('.checkbox1').prop('checked', $(this).prop("checked"));

                   

           });

           $('.checkbox1').change(function(){ 

               if($('.checkbox1:checked').length == $('.checkbox1').length){

                      $('.checked_all1').prop('checked',true);

               }else{

                      $('.checked_all1').prop('checked',false);

               }

           });

           

            $('.checked_all2').on('change', function() {     

                   $('.checkbox2').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox1').change(function(){ 

               if($('.checkbox2:checked').length == $('.checkbox2').length){

                      $('.checked_all2').prop('checked',true);

               }else{

                      $('.checked_all2').prop('checked',false);

               }

           });

           

            $('.checked_all3').on('change', function() {     

                   $('.checkbox3').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox3').change(function(){ 

               if($('.checkbox3:checked').length == $('.checkbox3').length){

                      $('.checked_all3').prop('checked',true);

               }else{

                      $('.checked_all3').prop('checked',false);

               }

           });

           

            $('.checked_all4').on('change', function() {     

                   $('.checkbox4').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox4').change(function(){ 

               if($('.checkbox4:checked').length == $('.checkbox4').length){

                      $('.checked_all4').prop('checked',true);

               }else{

                      $('.checked_all4').prop('checked',false);

               }

           });

           

            $('.checked_all5').on('change', function() {     

                   $('.checkbox5').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox5').change(function(){ 

               if($('.checkbox5:checked').length == $('.checkbox5').length){

                      $('.checked_all5').prop('checked',true);

               }else{

                      $('.checked_all5').prop('checked',false);

               }

           });

           

            $('.checked_all6').on('change', function() {     

                   $('.checkbox6').prop('checked', $(this).prop("checked"));              

           });

           $('.checkbox5').change(function(){ 

               if($('.checkbox6:checked').length == $('.checkbox6').length){

                      $('.checked_all6').prop('checked',true);

               }else{

                      $('.checked_all6').prop('checked',false);

               }

           });

           

           

   

   

       

</script>

<script>

   function changeMenu(menu,submenu,options)

    {    

     // alert('<?php echo base_url()?>/'+menu+'/'+submenu+'/'+options);

    $("#content_tabs").load('<?php echo base_url()?>/'+menu+'/'+submenu+'/'+options); 

   }

</script>

<script type='text/javascript'>

   $(window).load(function(){

     $("#content_tabs").load('<?php echo base_url()?>/client/enquery_detals_by_status/3'); 

   });  

</script>

<script type='text/javascript'>

   $(window).load(function(){

   $("#active_class p").click(function() {

       $('.border_bottom_active').removeClass('border_bottom_active');

       $(this).addClass("border_bottom_active");

   });

   });  

</script>