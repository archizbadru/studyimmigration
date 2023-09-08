<?php $task_list = $this->config->item('task_list');?>
<style type="text/css">
   [data-lettersEmployee]:before  
   {
    content:attr(data-lettersEmployee);
    display:inline-block;
    font-size:1em;
    width:2.5em;
    height:2.5em;
    line-height:2.5em;
    text-align:center;
    border-radius:50%;
    background:#2F353A;
    vertical-align:middle;
    margin-right:1em;
    color:white;
   }
   [data-black]:before {
    content: attr(data-black);
    display: inline-block;
    font-size: 1em;
    width: 4.5em;
    height: 4.5em;
    line-height: 4.5em;
    text-align: center;
    border-radius: 50%;
    background: #283593;
    vertical-align: middle;
    margin-right: 2em;float:left;
    color: white;
   }
   [data-lettersGenerated]:before {
    content: attr(data-lettersGenerated);
    display: inline-block;
    font-size: 1em;
    width: 2.5em;
    height: 2.5em;
    line-height: 2.5em;
    text-align: center;
    border-radius: 50%;
    background: #5FBD75;
    vertical-align: middle;
    margin-right: 1em;
    color: white;
   }
   .nav-tabs > li.active > a:hover {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: none!important;
   }
   .nav-tabs > li.active > a {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: none!important;
   }
   table th,td{font-size:11px;}
   .list-group{margin-top:10px!important;}
   .btnStatus{
    padding: 0px 4px !important;
    color: #fff !important;
    width: 36% !important; 
   }
   .Pending{
   background-color: #337ab7 !important;
   border-color: #337ab7 !important;
   }
   .Processing{
   background-color: #f2711c !important;
   border-color: #f2711c !important;
   }
   .Completed{
   background-color: #37a000 !important;
   border-color: #318d01 !important;
   }
   .Closed{
   background-color: #db2828 !important;
   border-color: #db2828 !important;
   }
   .nav-tabs >li {
    background-color: #283593;
}
#exTab3 .nav-tabs > li > a {
    color: #fff;
}
.nav-tabs > li.active > a {
    color: #555 !important;
    background-color: #fff;
}
</style>
<?php
   function initials($str) {     
        $ret = '';
        foreach (explode(' ', $str) as $word)
        $ret= strtoupper(substr($word,0,1));
        return $ret;                       
    }?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="row">
   <div class="col-md-12" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
      <div class="col-md-6" > Client Details</div>
      <div class="col-md-6" >
         <div style="float:right">
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" onClick="window.location.reload();" title="Refresh"><i class="fa fa-refresh icon_color"></i></a>                
            </div>
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="dropdown-toggle" href="<?php echo base_url()?>enquiry/create" title="<?php echo display('add_new_enquiry');?>"> <i class="fa fa-plus" style="background:#fff !important;border:none!important;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
            </div>
           
            <!-- <div class="btn-group" role="group" aria-label="Button group">
               <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#uploadbulk" title="upload Enquiry"> <i class="fa fa-upload" style="background:#fff !important;border:none!important;color:green;"></i></a>
            </div> -->

            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" href="<?php echo base_url(); ?>lead" title="Lead List">
               <i class="fa fa-arrow-left icon_color"></i>
               </a>                                                    
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="row col-md-12" id="ThreadEnq">
      <div class="col-md-3" style="text-align:center;min-height: calc(100vh - 105px);background:#F6F8F8;">
         <div class="avatar" title="<?php echo $details->name; ?>" style="margin-top:5%;margin-left:40%;">
            <p data-black="<?php $string = $details->name; echo initials($string);?>"></p>
         </div>
         <h5 style="text-align:center"><br><br><br><br><?php echo $details->name;?><br>         
            <?php echo $details->phone;?><br> <?php echo $details->email;?>
         </h5>
         <div class="row">
            <?php if ($check_status->drop_status > 0) { ?>
            <a class="btn btn-danger btn-outline-dark btn-md"  href="<?php echo base_url(); ?>lead/active_lead/<?php echo $details->enquiry_id ?>" title="Active Leads"  data-toggle="modal">
            <i class="fa fa-user-times"></i>
            </a>
            <?php } else if ($details->lead_stage == "Account") {
               echo redirect(base_url() . 'client/views/' . $details->Enquery_id);
               } else { ?>
            <button class="btn btn-primary "  data-toggle="modal" type="button" title="<?php echo display('send_sms'); ?>" data-target="#sendsms<?php echo $details->enquiry_id ?>" data-toggle="modal"  onclick="getTemplates('2', 'Send Sms')">
            <i class="fa fa-paper-plane-o"></i>
            </button>
            <button class="btn btn-info " data-toggle="modal" type="button" title="<?php echo display('send_mail'); ?>" data-target="#sendsms<?php echo $details->enquiry_id ?>" data-toggle="modal"  onclick="getTemplates('3', 'Send Email')">
            <i class="fa fa-envelope"></i>
            </button>
            <button class="btn btn-primary "  data-toggle="modal" type="button" title="Send Whatsapp" data-target="#sendsms<?php echo $details->enquiry_id ?>" data-toggle="modal"  onclick="getTemplates('1', 'Send Whatsapp')">
            <i class="fa fa-whatsapp"></i>
            </button>
            <button class="btn btn-info "  type="button" title="Add Comment" data-target="#Coment" data-toggle="modal" >
            <i class="fa fa-pencil"></i>
            </button>
            <button class="btn btn-primary "  type="button" title="Add TBRO" data-target="#createTask" data-toggle="modal" >
            <i class="fa fa-flask"></i>
            </button>
            <a class="btn btn-primary " href="<?php echo base_url(); ?>lead/convert_to_lead/<?php echo $details->enquiry_id ?>" title="<?php echo display('convert_to_client'); ?>" >
            <input type="hidden" name="lead_id" value="<?php echo $details->Enquery_id ?>">
            <i class="fa fa-user"></i>
            </a>
            <button class="btn btn-danger "   type="button" title="<?php echo display('drop_lead'); ?>" data-target="#dropLead" data-toggle="modal">
            <i class="fa fa-thumbs-o-down"></i>
            </button>
            <?php } ?>
         </div>
         <table style="width: 100%;margin-top: 5%;" id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0" >
            <tbody>
               <tr>
                  <td><button class="btn btn-basic" type="button" style="width: 100%;">Disposition</button></td>
               </tr>
            </tbody>
         </table>
            <div class="row" >
               <?php echo form_open_multipart('lead/update_description/'.$details->enquiry_id,'class="form-inner"') ?>
               <input type="hidden" name="unique_no" value="<?php echo $details->Enquery_id; ?>" >
               <input type="hidden" name="latest_task_id">
                <div class="form-group col-sm-12">
                           <!--<label class="col-form-label">Lead Stage</label>-->
                           <select class="form-control" id="lead_stage_change" name="lead_stage" onchange="find_description()">
                              <option>---Select Stage---</option>
                              <?php foreach($all_estage_lists as $single){                               
                              $id=$single->lead_stage;                              
                              }
                              ?>
                              <?php foreach ($all_stage_lists as $stage) {  ?>
                              <option value="<?= $stage->stg_id?>"><?php echo $stage->lead_stage_name; ?></option>
                              <?php } ?>
                           </select>
                    </div>

                    <div class="form-group col-sm-12">
                           <!--<label class="col-form-label">Description</label>-->
                           <select class="form-control" id="lead_description" name="lead_description" onchange="showDiv(this)">
                               <option>---Select Description---</option>
							   <option value="new">New</option>
							   <option value="updt">Upadate</option>
                              <?php foreach($all_description_lists as $discription){ ?>
                                   
                                   <option value="<?php echo $discription->id; ?>"><?php echo $discription->description; ?></option>
                                   <?php } ?>
                           </select>
                        </div>


                    <input type="hidden" name="enq_code1"  value="<?php echo  $details->Enquery_id; ?>" >
                    <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Name</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->name)){echo $details->name;} ?>" name="contact_person1"  placeholder="Contact Person Name">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Designation</label>
                  <input type="text" class="form-control" name="designation1" value="<?= isset($details->designation)?$details->designation:''?>" placeholder="Contact Person Designation">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Mobile No</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->phone)){echo $details->phone;} ?>" name="mobileno1" placeholder="Mobile No">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Email</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->email)){echo $details->email;} ?>" name="email1" placeholder="Email">
               </div>

                     <div class="form-group col-sm-12" id="otherTypev" style="display:none;">
                                    <div class="form-group col-sm-12">
                                    <input type="date" name="c_date" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="time" name="c_time" class="form-control" placeholder="" required>
                                </div>
                                </div>
                   
                        <div class="form-group col-sm-12">
                                    <!--<label>Remaks</label>-->
                                    <textarea class="form-control" name="conversation"></textarea>
                                </div>
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
      </div>      
<script type="text/javascript"> 
        document.getElementById("lead_description").onchange = function() { 		
		var lead_stage = $("#lead_description").val();
  if(lead_stage == 'new'){
            document.getElementById("otherTypev").style.display = "block"; 
  }else if(lead_stage == 'updt'){
	      var lead_stage = $("#lead_stage_change").val();
            var unique_no = $("input[name='unique_no']").val();

           $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/get_last_task_by_code',
            data: {enq_code:unique_no},            
            success:function(data){
              
              res = JSON.parse(data);

              if(res){
              
                task_date  = res.task_date;
                task_time  = res.task_time;
              
                $("input[name='c_date']").val(task_date);
                $("input[name='c_time']").val(task_time);                
                $("input[name='latest_task_id']").val(res.resp_id);
                $("textarea[name='conversation']").val(res.task_remark);
              
              }
              
            }
          });
  }else{
	 document.getElementById("otherTypev").style.display = "none"; 
  }
  
        } 
    </script> 
      
     <script type="text/javascript">

          // function showDiv(e){
           // // alert(e);
            // var des = e.value;
            // if (des == new) {
              // $("input[name='c_date']").val('');
              // $("input[name='c_time']").val('');
              // $("input[name='latest_task_id']").attr('value','');
              // $("textarea[name='conversation']").val('');
            // }else{
              // find_description(1);
            // }
            
          // }

          function find_description(f=0) { 

           if(f==0){
            var l_stage = $("#lead_stage_change").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_des_by_stage',
            data: {lead_stage:l_stage},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
				html +='<option value="new" style="">New</option>';
				html +='<option value="updt" style="">Update</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].description)+'</option>';
                }
                
                $("#lead_description").html(html);
                
            }
            
            
            });
           }

            }
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_des_by_stage',
            data: {lead_stage:l_stage},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
				html +='<option value="new" style="">New</option>';
				html +='<option value="updt" style="">Update</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].description)+'</option>';
                }
                
                $("#lead_description").html(html);
                
            }
            });
            
        </script>
      <div class="bg-white col-md-6" style="background:#fff;">
         <div id="exTab3" class="">
            <ul  class="nav nav-tabs" role="tablist">
                <li class="active"><a  href="#basic" data-toggle="tab" style="padding: 15px 25px; font-size:15px;margin-right: 0px;">Basic</a></li>
           <!--    <li class=""><a  href="#personaltab" data-toggle="tab" style="padding: 5px 5px;font-size:10px;margin-right: 0px;">Personal</a></li>
               <li><a href="#kyctab" data-toggle="tab" style="padding: 5px 5px;font-size:10px;margin-right: 0px;">KYC</a></li>
               <li><a href="#workhistorytab" data-toggle="tab" style="padding: 5px 5px;font-size:10px;margin-right: 0px;">Work History</a></li>
               <li><a href="#educationtab" data-toggle="tab" style="padding: 5px 5px;font-size:10px;margin-right: 0px;">Education</a></li>
               <li><a href="#socialprofiletab" data-toggle="tab" style="padding: 5px 5px;font-size:10px;margin-right: 0px;">Social Profile</a></li>
               <li><a href="#travelhistorytab" data-toggle="tab" style="padding: 5px 5px;font-size:10px;margin-right: 0px;">Travel History</a></li>               
               <li><a href="#familydetailtab" data-toggle="tab" style="padding: 5px 5px;font-size:10px;margin-right: 0px;">Family</a></li>-->
               <li><a href="#task" data-toggle="tab" style="padding: 15px 25px;font-size:15px;margin-right: 0px;">Task</a></li>
               <li><a href="#contacts" data-toggle="tab" style="padding: 15px 25px;font-size:15px;margin-right: 0px;">Contacts</a></li>
            </ul>
            <div class="tab-content clearfix">
               <div class="tab-pane active" id="basic">
                  <hr>
                  <?php echo form_open_multipart('client/updateclient/'.$details->enquiry_id,'class="form-inner"') ?>  
                  <input type="hidden" name="form" value="client">
                  <div class="row">
                     <div class="form-group col-sm-6">
                        <label>First Name <i class="text-danger">*</i> </label>
                        <div class = "input-group">
                           <span class = "input-group-addon" style="padding:0px !important;border:0px !important;width:35%;">
                              <select class="form-control" name="name_prefix">
                                 <?php foreach($name_prefix as $n_prefix){?>
                                 <option value="<?= $n_prefix->prefix ?>" <?php if($n_prefix->prefix==$details->name_prefix){ echo 'selected';} ?>><?= $n_prefix->prefix ?></option>
                                 <?php } ?>
                              </select>
                           </span>
                           <input class="form-control" name="enquirername" type="text" value="<?php echo $details->name ?>" placeholder="Enter First Name" style="width:100%;" />
                        </div>
                     </div>
                     <div class="form-group col-sm-6"> 
                        <label>Last Name <i class="text-danger">*</i></label>
                        <input class="form-control" value="<?php echo $details->lastname ?>" name="lastname" type="text" placeholder="Last Name" >  
                     </div>
                     <div class="form-group col-sm-6"> 
                        <label><?php echo display('mobile') ?></label>
                        <input class="form-control" name="mobileno" type="text" maxlength='10' value="<?php echo $details->phone ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >  
                     </div>
                     <div class="form-group col-sm-6"> 
                        <label><?php echo display('email') ?></label>
                        <input class="form-control" name="email" type="email" value="<?php echo $details->email ?>">  
                     </div>
					  <div class="form-group col-sm-6">
                        <label>Product</label>
                        <select class="form-control" name="sub_source" id="sub_source">
                           <option value="" style="display:none;">Select Product</option>
                           <?php foreach ($product_contry as $subsource){ ?>
                           <option value="<?= $subsource->id?>" <?php if($subsource->id==$details->enquiry_subsource){ echo 'selected';}?>><?= $subsource->country_name?></option>
                           <?php } ?>
                        </select>
                     </div>
					  <div class="form-group col-sm-6">
                        <label>Process <i class="text-danger"></i></label>
                        <select name="product_id" class="form-control">
                           <option value="" style="display:none;">Select</option>
                           <?php foreach($products_list as $product){?>
                           <option value="<?=$product->sb_id ?>" <?php if($product->sb_id==$details->product_id){ echo 'selected';}?>><?=$product->product_name ?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-12">
                        <label><?php echo display('company_name') ?> <i class="text-danger">*</i></label>
                        <textarea class="form-control" name="company" type="company"><?php echo $details->company ?></textarea> 
                     </div>
                     <div class="form-group col-sm-12">
                        <label><?php echo display('address') ?> <i class="text-danger">*</i></label>
                        <textarea class="form-control" name="address" type="address" >  <?php echo $details->address ?></textarea>
                     </div>
                     <div class="form-group   col-sm-4">
                        <label><?php echo display('lead_source') ?></label>
                        <select class="form-control" name="lead_source" id="lead_source" onchange="find_sub()">
                           <option value=""><?php echo display('lead_source') ?></option>
                           <?php 
                              foreach ($leadsource as $post){?>
                           <option value="<?= $post->lsid?>" <?php if($details->enquiry_source==$post->lsid){echo 'selected';}?>><?= $post->lead_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-4">
                        <label>State <i class="text-danger"></i></label>
                        <select name="state_id" class="form-control" id="fstate">
                           <option value="" style="display:none;">Select</option>
                           <?php foreach($state_list as $state){?>

                            <option value="<?php echo $state->id ?>" <?php if(!empty($state_list)){ if($state->id == $details->enquiry_state_id){echo 'selected';} }?>><?php echo $state->state; ?></option>

                           
                           <?php } ?>
                        </select>
                     </div>                      
                      <div class="form-group col-sm-4">
                        <label>City <i class="text-danger"></i></label>
                        <select name="city_id" class="form-control" id="fcity">
                           <option value="" style="display:none;">Select</option>
                            <?php
                            foreach ($state_city_list as $value) { ?>                             
                             <option value="<?=$value->id?>" <?php if($details->enquiry_city_id == $value->id) echo "selected = selected";?>><?=$value->city;?></option>
                             <?php                           
                            }

                            ?>
                        </select>
                     </div>
                     <!--<div class="form-group   col-sm-4">
                        <label><?php echo display('sub_source') ?></label>
                          <select class="form-control" name="sub_source" id="sub_source" >
                           <option value="" style="display:none;">Select <?php echo display('sub_source') ?></option>
                           <?php foreach ($subsource_list as $subsource){ ?>
                           <option value="<?= $subsource->subsource_id?>" <?php if($details->enquiry_subsource==$subsource->subsource_id){echo 'selected';}?>><?= $subsource->subsource_name?></option>
                           <?php } ?>
                        </select>
                     </div>-->
                     <div class="form-group col-sm-4"> 
                        <label>Requirement/Product</label>
                        <textarea class="form-control" name="enquiry"><?php echo $details->enquiry; ?></textarea>
                        <!-- 
                        <input class="form-control" name="enquiry" type="text" value="<?php echo $details->enquiry ?>" >   -->
                     </div>
                     <br>
                     <div style="display: none;" id="another-element1">
                        <div class="form-group col-sm-6">  
                           <label>Expected Closer Date <i class="text-danger">*</i></label>                  
                           <input class="form-control date2"  name="expected_date" type="text" placeholder="Expected Closer Date" readonly>                
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
                        <div class="form-group col-md-6">
                           <label><?php echo display('lead_stage') ?> <i class="text-danger">*</i></label>                  
                           <select class="form-control" name="lead_stage" >
                              <option value="">Lead Stage</option>
                              <?php foreach ($lead_stages as $stage) {  ?>
                              <option  onclick="check_stage3(<?php echo $stage->stg_id;?>)"  value="<?php echo $stage->stg_id;?>"  id="lead_stage" ><?php echo $stage->lead_stage_name;?></option>
                              <?php } ?>                                             
                           </select>
                        </div>
                        <div class="form-group col-sm-12">  
                           <label><?php echo display('comments') ?></label>                  
                           <input class="form-control" id="LastCommentGen" name="comment" type="text" placeholder="Enter comment">                
                        </div>
                        <input class="form-control" name="en_comments" type="hidden" value="<?php echo $details->Enquery_id ?>" >    
                        <hr>
                     </div>
                     <div id="task_create1" style="display:none;">
                        <div class="form-group col-md-6">  
                           <label>TBRO Detail</label>                  
                           <input class="form-control"  name="task_detail" type="text" placeholder="Enter TBRO Details">                
                        </div>
                        <div class="form-group col-md-6">  
                           <label>Task Date</label>                  
                           <input class="form-control date" name="task_date" type="text" placeholder="Enter Task Date" readonly>                
                        </div>
                     </div>
                     <div class="col-md-12"  id="save_button">
                        <div class="row">
                           <div class="col-md-12">                                                
                              <button class="btn btn-primary" type="submit" >Save</button>            
                           </div>
                        </div>
                     </div>
                     </form>
                  </div>
               </div>
               <div class="tab-pane" id="personaltab">
                  <hr>
                  <?php echo form_open_multipart('client/updateclientpersonel/'.$details->enquiry_id,'class="form-inner"') ?>  
                  <input type="hidden" name="form" value="client">
                           <!--------------------------------------------------start----------------------------->
                     <?php if(!empty($personel_list)){ ?>
                    <?php foreach($personel_list as $alldetails){ ?>
                        <input class="form-control" name="unique_number" type="hidden" value="<?php echo $alldetails->unique_number; ?>">  
                    
                     <div class="form-group col-sm-4"> 
                        <label>Date of Birth</label>
                        <input class="form-control" name="date_of_birth" type="date" value="<?php echo $alldetails->date_of_birth; ?>" style="padding:0px !important;">  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Marital status</label>
<select class="form-control" name="marital_status" id="marital_status">
    <option value="">-Select Marital Status-</option>
    <option value="Single" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Single'){echo 'selected';}} ?>>Single</option>
    <option value="Married" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Married'){echo 'selected';}} ?>>Married</option>
    <option value="Widowed" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Widowed'){echo 'selected';}} ?>>Widowed</option>
    <option value="Separated" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Separated'){echo 'selected';}} ?>>Separated</option>
    <option value="Divorced" <?php if(!empty($personel_list)){if($alldetails->marital_status=='Divorced'){echo 'selected';}} ?>>Divorced</option>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Last Communication</label>
                        <input class="form-control" name="last_comm" type="date" value="<?php echo $alldetails->last_comm; ?>" style="padding:0px !important;">  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Mode Of Communication</label>
                        <input class="form-control" name="mode_of_comm" type="text" value="<?php echo $alldetails->mode_of_comm; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Remark</label>
                        <input class="form-control" name="remark" type="text" value="<?php echo $alldetails->remark; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Mother Toung</label>
                        <input class="form-control" name="mother_tongue" type="text" value="<?php echo $alldetails->mother_tongue; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Other Language</label>
                        <input class="form-control" name="other_language" type="text" value="<?php echo $alldetails->other_language; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 1</label>
                        <input class="form-control" name="corres_add_line1" type="text" value="<?php echo $alldetails->corres_add_line1; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 2</label>
                        <input class="form-control" name="corres_add_line2" type="text" value="<?php echo $alldetails->corres_add_line2; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 3</label>
                        <input class="form-control" name="corres_add_line3" type="text" value="<?php echo $alldetails->corres_add_line3; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Country</label>
                        <select class="form-control" name="corres_country_id" id="corres_country_id">
    <option value="">-Select Country-</option>
    <?php foreach($allcountry_list as $country){ ?>
    <option value="<?php echo $country->id_c; ?> " <?php if(!empty($allcountry_list)){if($alldetails->corres_country_id==$country->id_c){echo 'selected';}} ?>><?php echo $country->country_name; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence State</label>
                                          <select class="form-control" name="corres_state_id" id="corres_state_id">
    <option value="">-Select State-</option>
    <?php foreach($allstate_list as $state){ ?>
    <option value="<?php echo $state->id; ?> " <?php if(!empty($allstate_list)){if($alldetails->corres_state_id==$state->id){echo 'selected';}} ?>><?php echo $state->state; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence District</label>
                                                    <select class="form-control" name="corres_district_id" id="corres_district_id">
    <option value="">-Select District-</option>
    <?php foreach($allcity_list as $city){ ?>
    <option value="<?php echo $city->id; ?> " <?php if(!empty($allcity_list)){if($alldetails->corres_district_id==$city->id){echo 'selected';}} ?>><?php echo $city->city; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Pincode</label>
                        <input class="form-control" name="corres_pincode" type="text" value="<?php echo $alldetails->corres_pincode; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Landmark</label>
                        <input class="form-control" name="corres_landmark" type="text" value="<?php echo $alldetails->corres_landmark; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 1</label>
                        <input class="form-control" name="perm_add_line1" type="text" value="<?php echo $alldetails->perm_add_line1; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 2</label>
                        <input class="form-control" name="perm_add_line2" type="text" value="<?php echo $alldetails->perm_add_line2; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 3</label>
                        <input class="form-control" name="perm_add_line3" type="text" value="<?php echo $alldetails->perm_add_line3; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Country</label>
<select class="form-control" name="perm_country_id" id="perm_country_id">
    <option value="">-Select Country-</option>
    <?php foreach($allcountry_list as $country){ ?>
    <option value="<?php echo $country->id_c; ?> " <?php if(!empty($allcountry_list)){if($alldetails->perm_country_id==$country->id_c){echo 'selected';}} ?>><?php echo $country->country_name; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent State</label>
<select class="form-control" name="perm_state_id" id="perm_state_id">
    <option value="">-Select State-</option>
    <?php foreach($allstate_list as $state){ ?>
    <option value="<?php echo $state->id; ?> " <?php if(!empty($allstate_list)){if($alldetails->perm_state_id==$state->id){echo 'selected';}} ?>><?php echo $state->state; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent District</label>
<select class="form-control" name="perm_district_id" id="perm_district_id">
    <option value="">-Select District-</option>
    <?php foreach($allcity_list as $city){ ?>
    <option value="<?php echo $city->id; ?> " <?php if(!empty($allcity_list)){if($alldetails->perm_district_id==$city->id){echo 'selected';}} ?>><?php echo $city->city; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Pincode</label>
                        <input class="form-control" name="perm_pincode" type="text" value="<?php echo $alldetails->perm_pincode; ?>" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Landmark</label>
                        <input class="form-control" name="perm_landmark" type="text" value="<?php echo $alldetails->perm_landmark; ?>" >  
                     </div>
                      <?php } ?>
                      <?php }else{ ?>
                      <!-----------------------------------------------start-------------------------------------------->
                       <input class="form-control" name="unique_number" type="hidden" value="">  
                    
                     <div class="form-group col-sm-4"> 
                        <label>Date of Birth</label>
                        <input class="form-control" name="date_of_birth" type="date" value="" style="padding:0px !important;">  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Marital status</label>
<select class="form-control" name="marital_status" id="marital_status">
    <option value="">-Select Marital Status-</option>
    <option value="Single">Single</option>
    <option value="Married">Married</option>
    <option value="Widowed">Widowed</option>
    <option value="Separated">Separated</option>
    <option value="Divorced">Divorced</option>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Last Communication</label>
                        <input class="form-control" name="last_comm" type="date" value="" style="padding:0px !important;">  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Mode Of Communication</label>
                        <input class="form-control" name="mode_of_comm" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Remark</label>
                        <input class="form-control" name="remark" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Mother Toung</label>
                        <input class="form-control" name="mother_tongue" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Other Language</label>
                        <input class="form-control" name="other_language" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 1</label>
                        <input class="form-control" name="corres_add_line1" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 2</label>
                        <input class="form-control" name="corres_add_line2" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Address Line 3</label>
                        <input class="form-control" name="corres_add_line3" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Country</label>
                        <select class="form-control" name="corres_country_id" id="corres_country_id">
    <option value="">-Select Country-</option>
    <?php foreach($allcountry_list as $country){ ?>
    <option value="<?php echo $country->id_c; ?> "><?php echo $country->country_name; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence State</label>
                                          <select class="form-control" name="corres_state_id" id="corres_state_id">
    <option value="">-Select State-</option>
    <?php foreach($allstate_list as $state){ ?>
    <option value="<?php echo $state->id; ?> "><?php echo $state->state; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence District</label>
                                                    <select class="form-control" name="corres_district_id" id="corres_district_id">
    <option value="">-Select District-</option>
    <?php foreach($allcity_list as $city){ ?>
    <option value="<?php echo $city->id; ?> "><?php echo $city->city; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Pincode</label>
                        <input class="form-control" name="corres_pincode" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence Landmark</label>
                        <input class="form-control" name="corres_landmark" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 1</label>
                        <input class="form-control" name="perm_add_line1" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 2</label>
                        <input class="form-control" name="perm_add_line2" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Address Line 3</label>
                        <input class="form-control" name="perm_add_line3" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Country</label>
<select class="form-control" name="perm_country_id" id="perm_country_id">
    <option value="">-Select Country-</option>
    <?php foreach($allcountry_list as $country){ ?>
    <option value="<?php echo $country->id_c; ?> "><?php echo $country->country_name; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent State</label>
<select class="form-control" name="perm_state_id" id="perm_state_id">
    <option value="">-Select State-</option>
    <?php foreach($allstate_list as $state){ ?>
    <option value="<?php echo $state->id; ?> "><?php echo $state->state; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent District</label>
<select class="form-control" name="perm_district_id" id="perm_district_id">
    <option value="">-Select District-</option>
    <?php foreach($allcity_list as $city){ ?>
    <option value="<?php echo $city->id; ?>"><?php echo $city->city; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Pincode</label>
                        <input class="form-control" name="perm_pincode" type="text" value="" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Permanent Landmark</label>
                        <input class="form-control" name="perm_landmark" type="text" value="" >  
                     </div>
                     <?php } ?>
                     <div class="col-md-6"  id="save_button">
                        <div class="row">
                           <div class="col-md-12">                                                
                              <button class="btn btn-primary" type="submit" >Save</button>            
                           </div>
                        </div>
                     </div>
                        </form>
               </div>
               <div class="tab-pane" id="kyctab">
              <!--           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New KYC</h4>
         </div>-->
                  <hr>
            
                  <div class="row" >
               <?php echo form_open_multipart('lead/addnewkyc/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>Document Name</label>
                  <input class="form-control" id="doc_name" name="doc_name" placeholder="Document Name"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Document No.</label>
                  <input class="form-control" id="doc_number" name="doc_number" placeholder="Document No."  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Upload File</label>
                  <input class="form-control" name="doc_file" id="doc_file" placeholder="Upload File"  type="file" style="padding:0px;">
               </div>
                <div class="form-group col-md-6">
                  <label>Valid Up To</label>
                  <input class="datepicker form-control" id="doc_validity" name="doc_validity" placeholder="Valid Up To"  type="text" >
               </div>
                <input type="hidden" id="kyc_unique_number" name="unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="kyc_enquiry_id" name="kyc_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
            <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Document Name</th>
                              <th>Document Number</th>
                              <th>Valid Up To</th>
                              <th>Created On</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($kyc_doc_list)){
                              foreach ($kyc_doc_list as $kycDoc) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $kycDoc->doc_name; ?></td>
                              <td><?php echo $kycDoc->doc_number; ?></td>
                              <td><?php echo ($kycDoc->doc_validity !='')?$kycDoc->doc_validity:'N/A'; ?></td>
                              <td><?php echo $kycDoc->created_date; ?></td>
                              <td><a href="<?php echo base_url($kycDoc->doc_file);?>" target="_blank"><i class="fa fa-eye" style="color:green;"></i></a></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                   <!--  <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewKyc" class="btn btn-success">Add new</a></h5>
                     </center>
                     <br>-->              
                  </div>
               </div>
               <div class="tab-pane" id="workhistorytab">
              <!--           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Work History</h4>
         </div>-->
                  <hr>
             
                  <div class="row" >
               <?php echo form_open_multipart('lead/addnewwork/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>Company Name</label>
                  <input class="form-control" id="company" name="company" placeholder="Company Name"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Designation</label>
                  <input class="form-control" id="designation" name="designation" placeholder="Designation"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Start Date</label>
                  <input class="datepicker form-control" id="start_date" name="start_date" placeholder="Start Date"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>End Date</label>
                  <input class="datepicker form-control" id="end_date" name="end_date" placeholder="End Date"  type="text">
               </div>
                <div class="form-group col-md-6">
                  <label>Current CTC <small>(In Lac)</small></label>
                  <input class="form-control" id="current_ctc" name="current_ctc" placeholder="Current CTC"  type="text">
               </div>
                <input type="hidden" id="work_unique_number" name="work_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="work_enquiry_id" name="work_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
            <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Company Name</th>
                              <th>Designation</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Current CTC <small>(Lac)</small></th>
                              <th>Created On</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($work_history_list)){
                              foreach ($work_history_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->company; ?></td>
                              <td><?php echo $itemObj->designation; ?></td>
                              <td><?php echo date('d-m-Y',strtotime($itemObj->start_date)); ?></td>
                              <td><?php echo date('d-m-Y',strtotime($itemObj->end_date)); ?></td>
                              <td><?php echo $itemObj->current_ctc; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                              <td></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                    <!-- <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewWork" class="btn btn-success">Add new</a></h5>
                     </center>
                     <br>-->              
                  </div>
               </div>
               <div class="tab-pane" id="educationtab">
             <!--       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Education</h4>
         </div>-->
                  <hr>
                  <div class="row" >
               <?php echo form_open_multipart('lead/addnewedu/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>Title of Education</label>
                  <input class="form-control" id="title" name="title" placeholder="Title of Education"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>University Name</label>
                  <input class="form-control" id="university" name="university" placeholder="University Name"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Year of Passing</label>
                  <input class="form-control" id="passing_year" name="passing_year" placeholder="Year of Passing"  type="text"  required>
                </div>
                <input type="hidden" id="edu_unique_number" name="edu_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="edu_enquiry_id" name="edu_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
            <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Title</th>
                              <th>University</th>
                              <th>Year of Passing</th>
                              <th>Created On</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($education_list)){
                              foreach ($education_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->title; ?></td>
                              <td><?php echo $itemObj->university; ?></td>
                              <td><?php echo $itemObj->passing_year; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                    <!-- <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewEducation" class="btn btn-success">Add new</a></h5>
                     </center>
                     <br>-->              
                  </div>
               </div>
                <div class="tab-pane" id="socialprofiletab">
             <!--       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Social Profile</h4>
         </div>-->
                  <hr>
                  <div class="row" >
               <?php echo form_open_multipart('lead/addnewsprof/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>Name of Social Media</label>
                  <input class="form-control" id="title" name="title" placeholder="Name of Social Media"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Profile URL</label>
                  <input class="form-control" id="profile" name="profile" placeholder="Profile URL"  type="text"  required>
               </div>
                <input type="hidden" id="sprof_unique_number" name="sprof_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="sprof_enquiry_id" name="sprof_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
            <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Social Media</th>
                              <th>Profile URL</th>
                              <th>Created On</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($social_profile_list)){
                              foreach ($social_profile_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->title; ?></td>
                              <td><?php echo $itemObj->profile; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                    <!-- <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewSprofile" class="btn btn-success">Add new</a></h5>
                     </center>
                     <br>-->              
                  </div>
               </div>
                <div class="tab-pane" id="travelhistorytab">
              <!--      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Travel History</h4>
         </div>-->
                  <hr>
                           <div class="row" >
               <?php echo form_open_multipart('lead/addnewtravel/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>County</label>
                  <select name="country_id" class="form-control">
                    <?php foreach($all_country_list as $product){?>
                    <option value="<?=$product->id_c ?>"><?=$product->country_name ?></option>
                    <?php } ?>
                 </select>
               </div>                
               <div class="form-group col-md-6">
                  <label>Travel Date</label>
                  <input class="datepicker form-control" id="travel_date" name="travel_date" placeholder="Travel Date" style="padding-top:0px;"  type="date"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Visa Type</label>
                  <input class="form-control" id="visa_type" name="visa_type" placeholder="Visa Type"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>From Date</label>
                  <input class="datepicker form-control" id="dfrom_date" name="dfrom_date" placeholder="From Date" style="padding-top:0px;"  type="date"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>To Date</label>
                  <input class="datepicker form-control" id="dto_date" name="dto_date" placeholder="To Date" style="padding-top:0px;"  type="date"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Is Rejected</label>
                  <select name="is_rejected" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0" selected>No</option>
                  </select>
               </div>
                <div class="form-group col-md-6">
                  <label>Reject Remark</label>
                  <input class="form-control" id="reject_reason" name="reject_reason" placeholder="Reject Remark"  type="text">
               </div>
                <input type="hidden" id="travel_unique_number" name="travel_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="travel_enquiry_id" name="travel_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
            <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>County</th>
                              <th>Travel Date</th>
                              <th>Visa Type</th>
                              <th>Visa Duration</th>
                              <th>Is Rejected</th>
                              <th>Remark</th>
                              <th>Created On</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($travel_history_list)){
                              foreach ($travel_history_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->country_name; ?></td>
                              <td><?php echo date('d-m-Y',strtotime($itemObj->travel_date)); ?></td>
                              <td><?php echo $itemObj->visa_type; ?></td>
                              <td><?php echo date('d-m-Y',strtotime($itemObj->dfrom_date)).'-'.date('d-m-Y',strtotime($itemObj->dto_date)); ?></td>
                              <td><?php echo ($itemObj->is_rejected ==1)?'Yes':'No'; ?></td>
                              <td><?php echo $itemObj->reject_reason; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                    <!-- <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewTravel" class="btn btn-success">Add new</a></h5>
                     </center>
                     <br>-->              
                  </div>
               </div> 
                <div class="tab-pane" id="familydetailtab">
               <!--     <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Member</h4>
         </div>-->
                  <hr>
                              <div class="row" >
               <?php echo form_open_multipart('lead/addnewmember/'.$details->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>County</label>
                  <select name="country_id" class="form-control">
                    <?php foreach($all_country_list as $product){?>
                    <option value="<?=$product->id_c ?>"><?=$product->country_name ?></option>
                    <?php } ?>
                 </select>
               </div>
                <div class="form-group col-md-6">
                  <label>Name</label>
                  <input class="form-control" id="name" name="name" placeholder="Name"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Contact Number</label>
                  <input class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Contact Email</label>
                  <input class="form-control" id="contact_email" name="contact_email" placeholder="Contact Email"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Relationship</label>
                  <input class="form-control" id="relationship" name="relationship" placeholder="Relationship"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Visa Type</label>
                  <select name="visa_status" class="form-control">
                    <option value="1" selected>Valid</option>
                    <option value="0">Expired</option>
                  </select>
               </div>
               <div class="form-group col-md-6">
                  <label>They Help</label>
                  <select name="they_help" class="form-control">
                    <option value="0">No</option>
                    <option value="1" selected>Yes</option>
                  </select>
               </div>
                <input type="hidden" id="mem_unique_number" name="mem_unique_number" value="<?php echo $details->Enquery_id;?>">
                <input type="hidden" id="mem_enquiry_id" name="mem_enquiry_id" value="<?php echo $details->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
            <hr>
                  <div class="row">
                     <table class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>                              
                              <th>S.N.</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Email</th>
                              <th>County</th>
                              <th>relationship</th>
                              <th>Visa Status</th>
                              <th>They Help</th>
                              <th>Created On</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sl = 1;
                              if(!empty($close_femily_list)){
                              foreach ($close_femily_list as $itemObj) { 
                              ?>
                           <tr>
                              <td><?php echo $sl;?></td>
                              <td><?php echo $itemObj->name; ?></td>
                              <td><?php echo $itemObj->contact_number; ?></td>
                              <td><?php echo $itemObj->contact_email; ?></td>
                              <td><?php echo $itemObj->country_name; ?></td>
                              <td><?php echo $itemObj->relationship; ?></td>
                              <td><?php echo ($itemObj->visa_status ==1)?'Valid':'Expired'; ?></td>
                              <td><?php echo ($itemObj->they_help ==1)?'Yes':'No'; ?></td>
                              <td><?php echo $itemObj->created_date; ?></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                    <!-- <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewMember" class="btn btn-success">Add new</a></h5>
                     </center>
                     <br>-->              
                  </div>
               </div>
               <div class="tab-pane" id="task">
                  <hr>
                  <div class="col-md-12" style="border:none!important;border-radius:0px!important;">
                     <div  style="overflow-x: hidden;overflow-y: auto;" onscroll="scrolled(this)">
                        <!----------------- Calender View ------------>
                        <!--<link href="<?php echo base_url();?>assets/css/fullcalendar.min.css" rel="stylesheet">
                        <link href="<?php echo base_url();?>assets/css/fullcalendar.print.min.css" media="print">
                        <div id="calendar4"></div>-->
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="col-md-6" >
                          <!-- <div class="card"   style="margin-top:10px;">
                              <div class="card-body">   
                                 <span style="font-size: 14px;font-weight: bold;">
                                 Enquiry Details: 
                                 </span>
                                 <button class="btn btn-sm btn-success" style="float: right"  type="button" data-toggle="modal" data-target="#Coment">
                                 <i class="fa fa-dot-circle-o"></i> Add Comment</button>                    
                              </div>
                           </div>
                           <div id="comment_div" style="max-height:300px; overflow-y:scroll;">
                              <?php 
                                 if(!empty($comment_details)){               
                                     foreach ($comment_details as $ld_res) 
                                 {?>
                              <div class="list-group"  style="margin-top:10px;">
                                 <a class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                       <p class="mb-1"><?= $ld_res->comment_msg?></p>
                                       <small><b><?php echo date("j-M-Y h:i:s a",strtotime($ld_res->created_date)); ?></b></small>
                                    </div>
                                 </a>
                              </div>
                              <?php } }?>
                           </div>-->
                           <div  id="comment_div1" style="display:none;">
                           </div>
                        </div>
                        <div class="col-md-12" >
                           <div class=" card"  style="margin-top:10px;">
                              <div class="card-body">   
                                 <span style="font-size: 14px;font-weight: bold;">
                                 TBRO Details:
                                 </span>
                                 <button class="btn btn-sm btn-primary" style="float: right"  type="button" data-toggle="modal" data-target="#createTask">
                                 <i class="fa fa-dot-circle-o"></i> Create TBRO</button> 
                              </div>
                           </div>
                           <div  id="task_div" style="max-height:300px; overflow-y:scroll;margin-top:10px;">
                              <?php 
                                 foreach ($recent_tasks as $task)
                                 {?>
                              <div class="list-group">
                                 <div class="col-md-12 list-group-item list-group-item-action flex-column align-items-start" style="margin-top:10px;">
                                    <div class="d-flex w-100 justify-content-between">
                                       <div class="col-md-12"><b>Name :</b><?= $task->contact_person?></div>
                                       <div class="col-md-12"><b>Mobile No :</b><?= $task->mobile?></div>
                                       <div class="col-md-12"><b>Email :</b><?= $task->email?></div>
                                       <div class="col-md-12"><b>Designation :</b><?= isset($task->designation)?$task->designation:''?></div>
                                       <div class="col-md-12"><b>Remark  : </b><?= $task->task_remark?></div>
                                       <div class="col-md-12"><b>Task Date  : </b><?php echo date("d-m-Y",strtotime($task->task_date)); ?></div>
                                       <div class="col-md-12"><b>Task Time  : </b><?php echo date("h:i:s a",strtotime($task->task_time)); ?></div>
                                       <div class="col-md-12">
                                          <i class="fa fa-pencil color-primary" style="float:right;" data-toggle="modal" data-target="#task_edit<?php echo $task->resp_id; ?>"></i>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="task_edit<?php echo $task->resp_id; ?>" class="modal fade in" role="dialog">
                                    <div class="modal-dialog">
                                       <!-- Modal content-->
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" onclick="closedmodel()">&times;</button>
                                             <h4 class="modal-title">Edit Task</h4>
                                          </div>
                                          <div class="modal-body">
                                             <?php echo form_open_multipart('lead/enquiry_response_updatetask','class="form-inner"') ?>
                                             <div class="profile-edit">
                                               
                                                <div class="form-group col-sm-6" style="display:none;">
                                                   <label>Contact Person Name</label>
                                                   <input type="text" class="form-control" name="contact_person" value="<?= $task->contact_person?>" placeholder="Contact Person Name">
                                                </div>
                                                <div class="form-group col-sm-6" style="display:none;">
                                                   <label>Contact Person Designation</label>
                                                   <input type="text" class="form-control" name="designation" value="<?= isset($task->designation)?$task->designation:''?>" placeholder="Contact Person Designation">
                                                </div>
                                                <div class="form-group col-sm-6" style="display:none;">
                                                   <label>Contact Person Mobile No</label>
                                                   <input type="text" class="form-control" name="mobileno" value="<?= $task->mobile?>" maxlength='10' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                </div>
                                                <div class="form-group col-sm-6" style="display:none;">
                                                   <label>Contact Person Email</label>
                                                   <input type="text" class="form-control" name="email" value="<?= $task->email?>">
                                                </div>
                                                
                                                <div class="form-group col-sm-6" style="">
                                                   <label>Task Date</label>
                                                   <input type="text" class="form-control" name="task_date" value="<?= date("d-m-Y",strtotime($task->task_date)) ?>">
                                                </div>
                                                <div class="form-group col-sm-6" style="">
                                                   <label>Task Time</label>
                                                   <input type="text" class="form-control" name="task_time" value="<?= date("h:i:s a",strtotime($task->task_time))?>">
                                                </div>
                                                <div class="form-group col-sm-12" style="">
                                                   <label>Task Remark</label>
                                                   <input type="text" class="form-control" name="task_remark" value="<?= $task->task_remark?>">
                                                </div>
                                
                            <div class="form-group ">
                               <input type="hidden" name="enq_code"  value="<?php echo  $task->resp_id; ?>" >
                               <input type="hidden" name="task_type" value="1">
                               <input type="submit" name="update" class="btn btn-primary"  value="<?php echo display('update');?>" >
                            </div>
                                             </div>
                                             </form> 
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closedmodel()">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                           <div class="list-group" id="task_div1" style="display:none;">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>               
               <div class="tab-pane" id="contacts">
                <!--   <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Contact</h4>
         </div>-->
                  <hr>
                    <div class="row" >
               <?php echo form_open_multipart('client/create_newcontact/'.$details->enquiry_id.'/'.$details->Enquery_id,'class="form-inner"') ?> 
               <div class="form-group col-md-6">
                  <label>Designation</label>
                  <input class="form-control" name="designation" placeholder="Designation"  type="text" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Name</label>
                  <input class="form-control" name="name" placeholder="Contact Name"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Contact No.</label>
                  <input class="form-control" name="mobileno" placeholder="Mobile No."  maxlength="10"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Email</label>
                  <input class="form-control" name="email" placeholder="Email"  type="text"  required>
               </div>
               <div class="form-group col-md-12">
                  <label>Other Details</label>
                  <textarea class="form-control" name="otherdetails" rows="8"></textarea>
               </div>
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Add Contact" class="btn btn-primary"  name="Add Contact">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
            <hr>
                  <div class="row">
                     <table id="dataTable" class="table table-responsive-sm" style="background: #fff;">
                        <thead class="thead-light">
                           <tr>
                              <th>#</th>
                              <th style="width: 20%;">Designation</th>
                              <th style="width: 20%;">Name</th>
                              <th style="width: 20%;">Contact Number</th>
                              <th style="width: 20%;">Email ID</th>
                              <th style="width: 20%;">Other Detail</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody id="tblDataContact">
                           <?php $sl = 1;
                              if(!empty($all_contact_list)){
                              foreach ($all_contact_list as $contact) { 
                              ?>
                           <tr>
                              <td>#</td>
                              <td ><?php echo $contact->designation; ?></td>
                              <td ><?php echo $contact->c_name; ?></td>
                              <td ><?php echo $contact->contact_number; ?></td>
                              <td ><?php echo $contact->emailid; ?></td>
                              <td ><?php echo $contact->other_detail; ?></td>
                              <td></td>
                           </tr>
                           <?php $sl++; }} ?>
                        </tbody>
                     </table>
                    <!-- <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewContact" class="btn btn-success">Add new contact</a></h5>
                     </center>
                     <br>-->              
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3" style="background:#F6F8F8;height:600px;overflow: scroll;">
          <table style="width: 100%;margin-top: 5%;" id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0" >
            <tbody>
               <tr>
                  <td><button class="btn btn-basic" type="button" style="width: 100%;">Activity Timeline</button></td>
               </tr>
            </tbody>
         </table>
          <ul class="cbp_tmtimeline" style="margin-left:-30px;">

              <?php  

/*              echo "<pre>";
              print_r($comment_details);
              echo "</pre>";
*/

              foreach($comment_details as $comments){ ?>
              <?php if($comments->comment_msg=='Stage Updated'){ ?>
	<li>
		<div class="cbp_tmicon cbp_tmicon-phone" style="background:#cb4335;"></div>
		<div class="cbp_tmlabel"  style="background:#95a5a6;">
			<span style="font-weight:900;font-size:15px;"><?php echo $comments->comment_msg; ?></span></br>
			<?php if($comments->comment_msg=='Stage Updated'){ ?>
			<span style="font-weight:900;font-size:12px;"><?php echo $comments->lead_stage_name; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->description; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->remark; ?></span>
			<?php } ?>
			<p><?php echo date("j-M-Y h:i:s a",strtotime($comments->ddate)); ?><br>
      Updated By : <strong><?php echo $comments->comment_created_by . ' ' .$comments->lastname; ?></strong></p>

		</div>
	</li>
	<?php }else if($comments->comment_msg=='Enquiry moved'){ ?>
	<li>
		<div class="cbp_tmicon cbp_tmicon-phone"  style="background:#148f77;"></div>
		<div class="cbp_tmlabel"  style="background:#95a5a6;">
			<span style="font-weight:900;font-size:15px;"><?php echo $comments->comment_msg; ?></span></br>
			<?php if($comments->comment_msg=='Stage Updated'){ ?>
			<span style="font-weight:900;font-size:12px;"><?php echo $comments->lead_stage_name; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->description; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->remark; ?></span>
			<?php } ?>
			<p><?php echo date("j-M-Y h:i:s a",strtotime($comments->ddate)); ?><br>
        Updated By : <strong><?php echo $comments->comment_created_by . ' ' .$comments->lastname; ?></strong></p>
		</div>
	</li>
	<?php }else if($comments->comment_msg=='Move to leads'){ ?>
	<li>
		<div class="cbp_tmicon cbp_tmicon-phone"  style="background:#2980b9;"></div>
		<div class="cbp_tmlabel"  style="background:#95a5a6;">
		<span style="font-weight:900;font-size:15px;"><?php echo $comments->comment_msg; ?></span></br>
			<?php if($comments->comment_msg=='Stage Updated'){ ?>
			<span style="font-weight:900;font-size:12px;"><?php echo $comments->lead_stage_name; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->description; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->remark; ?></span>
			<?php } ?>
			<p><?php echo date("j-M-Y h:i:s a",strtotime($comments->ddate)); ?><br>
      Updated By : <strong><?php echo $comments->comment_created_by . ' ' .$comments->lastname; ?></strong></p>
		</div>
	</li>
	<?php }else if($comments->comment_msg=='Enquiry Created'){ ?>
	<li>
		<div class="cbp_tmicon cbp_tmicon-phone"  style="background:#d68910;"></div>
		<div class="cbp_tmlabel"  style="background:#95a5a6;">
			<span style="font-weight:900;font-size:15px;"><?php echo $comments->comment_msg; ?></span></br>
			<?php if($comments->comment_msg=='Stage Updated'){ ?>
			<span style="font-weight:900;font-size:12px;"><?php echo $comments->lead_stage_name; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->description; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->remark; ?></span>
			<?php } ?>
			<p><?php echo date("j-M-Y h:i:s a",strtotime($comments->ddate)); ?><br>
      Updated By : <strong><?php echo $comments->comment_created_by . ' ' .$comments->lastname; ?></strong></p>
		</div>
	</li>
	<?php }else{ ?>
	<li>
		<div class="cbp_tmicon cbp_tmicon-phone"  style=""></div>
		<div class="cbp_tmlabel"  style="background:#95a5a6;">
			<span style="font-weight:900;font-size:15px;"><?php echo $comments->comment_msg; ?></span></br>
			<?php if($comments->comment_msg=='Stage Updated'){ ?>
			<span style="font-weight:900;font-size:12px;"><?php echo $comments->lead_stage_name; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->description; ?></span>
			</br>
			<span style="font-weight:900;font-size:10px;"><?php echo $comments->remark; ?></span>
			<?php } ?>
			<p><?php echo date("j-M-Y h:i:s a",strtotime($comments->ddate)); ?><br>
        Updated By : <strong><?php echo $comments->comment_created_by . ' ' .$comments->lastname; ?></strong></p>
		</div>
	</li>
	<?php } ?>
	<?php } ?>
</ul>
<style>
@font-face {
	font-family: 'ecoico';
	src:url('../fonts/timelineicons/ecoico.eot');
	src:url('../fonts/timelineicons/ecoico.eot?#iefix') format('embedded-opentype'),
		url('../fonts/timelineicons/ecoico.woff') format('woff'),
		url('../fonts/timelineicons/ecoico.ttf') format('truetype'),
		url('../fonts/timelineicons/ecoico.svg#ecoico') format('svg');
	font-weight: normal;
	font-style: normal;
} /* Made with http://icomoon.io/ */

.cbp_tmtimeline {
	margin: 30px 0 0 0;
	padding: 0;
	list-style: none;
	position: relative;
} 

/* The line */
.cbp_tmtimeline:before {
	content: '';
	position: absolute;
	top: 0;
	bottom: 0;
	width: 10px;
	background: #afdcf8;
	left: 20%;
	margin-left: -10px;
}

.cbp_tmtimeline > li {
	position: relative;
}

/* The date/time */
.cbp_tmtimeline > li .cbp_tmtime {
	display: block;
	width: 25%;
	padding-right: 100px;
	position: absolute;
}

.cbp_tmtimeline > li .cbp_tmtime span {
	display: block;
	text-align: right;
}

.cbp_tmtimeline > li .cbp_tmtime span:first-child {
	font-size: 0.9em;
	color: #bdd0db;
}

.cbp_tmtimeline > li .cbp_tmtime span:last-child {
	font-size: 2.9em;
	color: #3594cb;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmtime span:last-child {
	color: #6cbfee;
}

/* Right content */
.cbp_tmtimeline > li .cbp_tmlabel {
	margin: 0 0 15px 25%;
	background: #3594cb;
	color: #fff;
	padding: 10px;
	font-size: 1.2em;
	font-weight: 300;
	line-height: 1.4;
	position: relative;
	border-radius: 5px;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel {
	background: #6cbfee;
}

.cbp_tmtimeline > li .cbp_tmlabel h2 { 
	margin-top: 0px;
	padding: 0 0 10px 0;
	border-bottom: 1px solid rgba(255,255,255,0.4);
}

/* The triangle */
.cbp_tmtimeline > li .cbp_tmlabel:after {
	right: 100%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
	border-right-color: #3594cb;
	border-width: 10px;
	top: 10px;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
	border-right-color: #6cbfee;
}

/* The icons */
.cbp_tmtimeline > li .cbp_tmicon {
	width: 40px;
	height: 40px;
	font-family: 'ecoico';
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	font-size: 1.4em;
	line-height: 40px;
	-webkit-font-smoothing: antialiased;
	position: absolute;
	color: #fff;
	background: #46a4da;
	border-radius: 50%;
	box-shadow: 0 0 0 8px #afdcf8;
	text-align: center;
	left: 20%;
	top: 0;
	margin: 0 0 0 -25px;
}

.cbp_tmicon-phone:before {
	content: "☣";
}

.cbp_tmicon-screen:before {
	content: "☣";
}

.cbp_tmicon-mail:before {
	content: "☣";
}

.cbp_tmicon-earth:before {
	content: "☣";
}

/* Example Media Queries */
@media screen and (max-width: 65.375em) {

	.cbp_tmtimeline > li .cbp_tmtime span:last-child {
		font-size: 1.5em;
	}
}

@media screen and (max-width: 47.2em) {
	.cbp_tmtimeline:before {
		display: none;
	}

	.cbp_tmtimeline > li .cbp_tmtime {
		width: 100%;
		position: relative;
		padding: 0 0 20px 0;
	}

	.cbp_tmtimeline > li .cbp_tmtime span {
		text-align: left;
	}

	.cbp_tmtimeline > li .cbp_tmlabel {
		margin: 0 0 30px 0;
		padding: 1em;
		font-weight: 400;
		font-size: 95%;
	}

	.cbp_tmtimeline > li .cbp_tmlabel:after {
		right: auto;
		left: 20px;
		border-right-color: transparent;
		border-bottom-color: #3594cb;
		top: -20px;
	}

	.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
		border-right-color: transparent;
		border-bottom-color: #6cbfee;
	}

	.cbp_tmtimeline > li .cbp_tmicon {
		position: relative;
		float: right;
		left: auto;
		margin: -55px 5px 0 0px;
	}	
}    
</style>
      </div>
      <script type="text/javascript">
function show(elementId) { 
 document.getElementById("id1").style.display="none";
 document.getElementById("id2").style.display="none";
 document.getElementById("id3").style.display="none";
 document.getElementById(elementId).style.display="block";
}
</script>
   </div>
</div>
<style>
   #exTab3 .nav-tabs > li > a {
   border-radius: 4px 4px 0 0 ;
   }
   #exTab3 .tab-content {
   /*color : white;*/
   background-color: #fff;
   padding : 5px 15px;
   }
   .card {
   position: relative;
   display: -ms-flexbox;
   display: flex;
   -ms-flex-direction: column;
   flex-direction: column;
   min-width: 0;
   word-wrap: break-word;
   /*background-color: #fff;*/
   background-clip: border-box;
   border: 1px solid #c8ced3;
   border-radius: 0.25rem;
   }
   .card-body {
   -ms-flex: 1 1 auto;
   flex: 1 1 auto;
   padding: 1.25rem;
   }
   .list-group {
   display: -ms-flexbox;
   display: flex;
   -ms-flex-direction: column;
   flex-direction: column;
   padding-left: 0;
   margin-bottom: 0;
   }
   .list-group-item {
   position: relative;
   display: block;
   padding: 0.75rem 1.25rem;
   margin-bottom: -1px;
   background-color: #fff;
   border: 1px solid rgba(0, 0, 0, 0.125);
   }
   .list-group-item-action {
   width: 100%;
   color: #5c6873;
   text-align: inherit;
   }
</style>
<div id="sendsms<?php echo $details->enquiry_id;?>" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <?php echo form_open_multipart('message/send_sms','class="form-inner" id="whatsaap"' ) ?> 
      <div class="modal-content card">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="modal-title"></h4>
         </div>
         <div>
            <div class="form-group col-sm-12">
               <label>Template</label>
               <select class="form-control" name="templates" required id="templates" onchange="getMessage(),this.form.reset();">
               </select>
            </div>
            <div class="form-group col-sm-12"> 
               <label><?php echo display('message') ?></label>
               <textarea class="form-control" name="message_name" rows="10"  id="template_message"></textarea>  
            </div>
         </div>
         <div class="col-md-12">
            <button class="btn btn-primary" type="button" onclick="send_sms()">Send</button>            
            <input type="hidden" value="" id="mesge_type" name="mesge_type">
            <input type="hidden" value="<?php echo $details->email;?>"  name="mail">
            <input type="hidden" value="<?php echo $details->phone;?>"  name="mobile">
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
      </form>
   </div>
</div>
<script>
   function getTemplates(SMS,type){
   $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>message/get_templates/'+SMS,
   })
   .done(function(data){
       $('#modal-title').html(type);
       $('#mesge_type').val(SMS);
       $('#templates').html(data);
   })
   .fail(function() {
        alert( "fail!" );   
   });
   }
  function  send_sms(){       
       $.ajax({            
           type: 'POST',
           url: '<?php echo base_url();?>message/send_sms',
           data: $('#whatsaap').serialize()
           })
           .done(function(data){               
               alert(data);
               location.reload();
             
           })
           .fail(function() {
           alert( "fail!" );       
       });     
       }
</script>
<script>
   function getMessage(){           
           var tmpl_id = document.getElementById('templates').value;
           $.ajax({               
               url : '<?php echo base_url('enquiry/msg_templates') ?>',
               type: 'POST',
               data: {tmpl_id:tmpl_id},
               success:function(data){                   
                   var obj = JSON.parse(data);
                    $('#templates option[value='+tmpl_id+']').attr("selected", "selected");
                   $("#template_message").html(obj.template_content);
               }
           });
     }
</script>
<!--<div id="createnewKyc" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New KYC</h4>
         </div>
         <div class="modal-body">
           
            
         </div>
      </div>
   </div>
</div>-->

<!--<div id="createnewWork" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Work History</h4>
         </div>
         <div class="modal-body">
            
            
         </div>
      </div>
   </div>
</div>-->
<!--<div id="createnewEducation" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Education</h4>
         </div>
         <div class="modal-body">
            
            
         </div>
      </div>
   </div>
</div>-->
<!--<div id="createnewSprofile" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Social Profile</h4>
         </div>
         <div class="modal-body">
            
            
         </div>
      </div>
   </div>
</div>-->
<!--<div id="createnewTravel" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Travel History</h4>
         </div>
         <div class="modal-body">
   
   
         </div>
      </div>
   </div>
</div>-->
<!--<div id="createnewMember" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Member</h4>
         </div>
         <div class="modal-body">


         </div>
      </div>
   </div>
</div>-->
<div id="createTicket<?php echo $details->enquiry_id;?>" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Ticket</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('ticket/addticket','class="form-inner"') ?> 
               <input class="form-control" name="clientid"  type="hidden" value="<?php echo $details->enquiry_id; ?>" required>
               <div class="form-group col-md-6">
                  <label>Name</label>
                  <input class="form-control" name="name" placeholder="Name"  type="text" value="<?php echo $details->name; ?>" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Mobile No.</label>
                  <input class="form-control" name="mobile" placeholder="Mobile No."  type="text" value="<?php echo $details->phone; ?>"  maxlength='10' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Email</label>
                  <input class="form-control" name="email" placeholder="Email"  type="text" value="<?php echo $details->email; ?>">
               </div>
               <div class="form-group col-md-6">
                  <label>Address</label>
                  <input class="form-control" name="address" placeholder="Address"  type="text" value="<?php echo $details->address; ?>" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Product</label>
                  <input class="form-control" name="product" placeholder="Product"  type="text" value="" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Problem</label>
                  <select class="form-control" name="problem">
                     <option></option>
                     <?php foreach ($problems as $problem) { ?>
                     <option value="<?php echo $problem->tp_id; ?>"><?php echo $problem->problem_name; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group col-md-6">
                  <label>Priority</label>
                  <select class="form-control" name="priority">
                     <option></option>
                     <?php foreach ($ticketpriority as $priority) { ?>
                     <option value="<?php echo $priority->priority_id; ?>"><?php echo $priority->priority_name; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group col-md-6">
                  <label>Source</label>
                  <select class="form-control" name="source">
                     <option></option>
                     <?php foreach ($ticketsource as $tsource) { ?>
                     <option value="<?php echo $tsource->ts_id; ?>"><?php echo $tsource->ticket_source; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group col-md-6">
                  <label>Due Date</label>
                  <input class="form-control" name="due_date" placeholder="Due Date"  type="date" value="" required>
               </div>
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Add Ticket" class="btn btn-primary"  name="Add Ticket">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!--<div id="createnewContact" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Contact</h4>
         </div>
         <div class="modal-body">
          
          
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>-->
<div id="createTask" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New TBRO</h4>
         </div>
         <div class="modal-body">
            <?php echo form_open_multipart('lead/enquiry_response_task','class="form-inner"') ?>
            <div class="profile-edit">
               <div class="form-group col-sm-6 hide">
                  <label>Billable * </label>
                  <br>
                  <input name="billabled" onclick="check_status('2')"  type="radio" value="2" checked>&nbsp;&nbsp;No 
                  <input  name="billabled" onclick="check_status('1')" type="radio" value="1" >&nbsp;&nbsp;Yes
               </div>
          
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Name</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->name)){echo $details->name;} ?>" name="contact_person"  placeholder="Contact Person Name">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Designation</label>
                  <input type="text" class="form-control" name="designation" value="<?= isset($details->designation)?$details->designation:''?>" placeholder="Contact Person Designation">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Mobile No</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->phone)){echo $details->phone;} ?>" name="mobileno" placeholder="Mobile No">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Email</label>
                  <input type="text" class="form-control" value="<?php if(!empty($details->email)){echo $details->email;} ?>" name="email" placeholder="Email">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Status</label>
                  <select class="form-control" name="task_status">
                     <?php foreach($task_list as $key=>$val){ ?>
                     <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="form-group col-sm-6">
                  <label>
                     Task Date <!-----Demo Plan Date--->
                  </label>
                  <input class="form-control" name="task_date"  type="date" placeholder="Task date" >
               </div>
               <div class="form-group col-sm-6">
                  <label>
                     Task Time <!-----Demo Plan Date--->
                  </label>
                  <input class="form-control" name="task_time"  type="time" value="" >
               </div>


               <div class="form-group col-sm-12">
                  <label>Remark Details</label>
                  <textarea class="form-control"   name="task_remark" placeholder="Conversaion Details"> 
                  </textarea>
               </div>
               <div class="form-group col-sm-12 dynamic_field" style="display:none;">
                  <table>
                     <tr>
                        <td>
                           <div class="form-group col-sm-3">
                              <label>From </label>
                              <input class="form-control" name="from[]"  type="text" placeholder="From" >
                           </div>
                           <div class="form-group col-sm-3">
                              <label>To </label>
                              <input class="form-control" name="to[]"  type="text" placeholder="To" >
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Mode </label>
                              <select class="form-control" name="mode[]" id="mode">
                                 <option value="" style="display:none">Select Mode</option>
                                 <?php foreach($all_mode_type as $mode){ ?>
                                 <option value="<?php echo $mode->exp_id; ?>" ><?php echo $mode->exp_mode; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Amount </label>
                              <input class="form-control" name="km[]"  type="text" placeholder="Amount" >
                           </div>
                        </td>
                        <td>
                           <br>
                           <div class="form-group col-sm-1">
                              <button type="button" class="add" class="btn btn-primary btn_remove">+</button>
                           </div>
                        </td>
                     </tr>
                  </table>
               </div>
               <div class="form-group">
                  <input type="hidden" name="enq_code"  value="<?php echo  $details->Enquery_id; ?>" >
                  <input type="hidden" name="task_type" value="1">
                  <input type="submit" name="update" class="btn btn-primary"  value="<?php echo display('create_Task');?>" >
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
<div id="range" class="modal fade in" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick="closedmodel()">&times;</button>
            <h4 class="modal-title">Search</h4>
         </div>
         <div class="modal-body">
            <form  action="" method="POST" id="searc_task">  
               <input class="form-control" id="FormInfo" name="task_id" type="hidden" value="<?php echo $details->Enquery_id ; ?>" >
               <label>Date From:</label>
               <input class="form-control" id="txtDate" name="task_start" type="text" placeholder="Start Task Date" readonly>                
               <br> 
               <label>Date To:</label>
               <input class="form-control" id="txtDate2" name="task_end" type="text" placeholder="End Task Date" readonly>
               <br>
               <button class="btn btn-sm btn-primary" style="float: right" type="button" onclick="search_comment_and_task()">
               <i class="fa fa-dot-circle-o"></i> <?php echo display('search'); ?></button>                    
               <br>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closedmodel()">Close</button>
         </div>
      </div>
   </div>
</div>
<div id="Coment" class="modal fade in" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick="closedmodel()">&times;</button>
            <h4 class="modal-title">Add Comment</h4>
         </div>
         <div class="modal-body">
            <form  action="<?php echo base_url(); ?>lead/add_comment" method="POST">  
               <input class="form-control" id="FormInfo" name="lid" type="hidden" value="<?php echo $details->Enquery_id ; ?>" >
               <input class="form-control" id="FormInfo" name="coment_type" type="hidden" value="1" >
               <textarea class="form-control" id="LastComment" name="conversation" type="text" placeholder="Add followup comment"></textarea>
               <br>
               <button class="btn btn-sm btn-primary" style="float: right">
               <i class="fa fa-dot-circle-o"></i> Add Comment</button>                    
               <br>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closedmodel()">Close</button>
         </div>
      </div>
   </div>
</div>
<div id="genLead" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form action="<?php echo base_url(); ?>client/re_oreder" method="post" class="form-inner">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Create New Deals</h4>
            </div>
            <div class="modal-body">
               <div class="row">
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
                     <input class="form-control" value="<?php echo $details->Enquery_id; ?>" name="child_id" type="hidden">                
                  </div>
                  <div class="form-group col-sm-12">        
                     <input  class="btn btn-primary" type="submit" value="Create New Deals " >      
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </form>
   </div>
</div>

<!---------------------------- DROP Enquiry -------------------------------->
<div id="dropLead" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Drop Lead <?= ucfirst($details->name); ?></h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('lead/drop_lead/'.$details->enquiry_id,'class="form-inner"') ?>                      
            <div class="row">
               <div class="form-group col-sm-12">
                  <label>Drop Reason</label>                  
                  <select class="form-control"  name="drop_status">
                     <option value="" style="display:none">---Select---</option>
                     <?php foreach ($drops as $drop) {   ?>
                     <option value="<?php echo $drop->d_id; ?>"><?php echo $drop->drop_reason; ?></option>
                     <?php } ?>                                             
                  </select>
               </div>
               <div class="form-group col-sm-12"> 
                  <label>Drop Comment</label>
                  <input class="form-control" name="reason" type="text" required="">  
               </div>
            </div>
            <div class="col-12" style="padding: 0px;">
               <div class="row">
                  <div class="col-12" style="text-align:center;">                                                
                     <button class="btn btn-primary" type="submit">Save</button>            
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
   function search_comment_and_task(){
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>enquiry/search_comment_and_task',
   data: $('#searc_task').serialize()
   })
   .done(function(data){
                           $("#comment_div").attr("style", "display:none");
                           $("#comment_div1").attr("style", "display:block");
                          
                           $("#task_div").attr("style", "display:none");
                           $("#task_div1").attr("style", "display:block");
                           $("#comment_div1").html(data.details);
                           $("#task_div1").html(data.details1);
                           
                            $("#range").attr("style", "display:none");
   })
   .fail(function(){
   alert( "fail!" );
   
   });
   }
   
</script>
<script>
   function closedmodel(){
     $("#range").attr("style", "display:none");
   } 
   
    $(function () {
      var bindDatePicker = function() {
   		$(".date").datetimepicker({
           format:'DD-MM-YYYY hh:mm:ss a',
   			icons: {
   				time: "fa fa-clock-o",
   				date: "fa fa-calendar",
   				up: "fa fa-arrow-up",
   				down: "fa fa-arrow-down"
   			}
   		}).find('input:first').on("blur",function () {
   			// check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
   			// update the format if it's yyyy-mm-dd
   			var date = parseDate($(this).val());
   
   			if (! isValidDate(date)) {
   				//create date based on momentjs (we have that)
   				date = moment().format('YYYY-MM-DD');
   			}
   
   			$(this).val(date);
   		});
   	}
      
      var isValidDate = function(value, format) {
   		format = format || false;
   		// lets parse the date to the best of our knowledge
   		if (format) {
   			value = parseDate(value);
   		}
   
   		var timestamp = Date.parse(value);
   
   		return isNaN(timestamp) == false;
      }
      
      var parseDate = function(value) {
   		var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
   		if (m)
   			value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);
   
   		return value;
      }
      
      bindDatePicker();
    });
     
      $(function () {
      var bindDatePicker = function() {
   		$(".date2").datetimepicker({
           format:'DD-MM-YYYY',
   			icons: {
   				time: "fa fa-clock-o",
   				date: "fa fa-calendar",
   				up: "fa fa-arrow-up",
   				down: "fa fa-arrow-down"
   			}
   		}).find('input:first').on("blur",function () {
   			var date = parseDate($(this).val());
   
   			if (! isValidDate(date)) {
   				//create date based on momentjs (we have that)
   				date = moment().format('YYYY-MM-DD');
   			}
   
   			$(this).val(date);
   		
   		});
   	}
      
      var isValidDate = function(value, format) {
   		format = format || false;
   		if (format) {
                    value = parseDate(value);
   		}
   
   		var timestamp = Date.parse(value);   
   		return isNaN(timestamp) == false;
      }
      
      var parseDate = function(value) {
   		var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
   		if (m)
                    value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);   
   		return value;
      }      
      bindDatePicker();
    });
      $(document).ready(function() {
      $('#txtDate').datepicker({format:'DD-MM-YYYY'});
      $('#txtDate').focus(function() {
        $(this).datepicker("show");
        setTimeout(function() {
          $('#txtDate').datepicker("hide");
          $('#txtDate').blur();
        }, 2000)
      })    
   });
    $(document).ready(function() {
      $('#txtDate2').datepicker({format:'DD-MM-YYYY'});
      $('#txtDate2').focus(function() {
        $(this).datepicker("show");
        setTimeout(function() {
          $('#txtDate2').datepicker("hide");
          $('#txtDate2').blur();
        }, 2000)
      })    
   });       
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
<script>
   $(function () {
     function init_events(ele) {
       ele.each(function () {
         var eventObject = {
           title: $.trim($(this).text()) // use the element's text as the event title
         }
         $(this).data('eventObject', eventObject)
         $(this).draggable({
           zIndex        : 1070,
           revert        : true, // will cause the event to go back to its
           revertDuration: 0  //  original position after the drag
         })
       })
     }   
     init_events($('#external-events div.external-event'))
     var date = new Date()
     var d    = date.getDate(),
         m    = date.getMonth(),
         y    = date.getFullYear()
     $('#calendar4').fullCalendar({
       header    : {
         left  : 'prev,next today',
         center: 'title',
         right : 'month,agendaWeek,agendaDay'
       },
       buttonText: {
         today: 'today',
         month: 'month',
         week : 'week',
         day  : 'day'
       },
        events    : [
           <?php foreach ($recent_tasks as $task):
      ?>
         {
           title          : '<?php echo $task->contact_person;?>',
           start          : new Date(y, m, <?php $dt = strtotime($task->nxt_date); echo date('d',$dt); ?>),
           backgroundColor: '#0073b7', 
           url            : '',
           borderColor    : '#0073b7'            
         },
         <?php endforeach; ?>        
       ],
      /* dayClick:function(date,isEvent,view,resourseobj){
         $('td').dblclick(function(){             
              $("#range").attr("style", "display:block");           
        });        
                     $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url();?>enquiry/search_comment_and_task/'+date.format()+'/<?php echo $details->Enquery_id ?>',
                     })
                     .done(function(data){
                          $("#comment_div").attr("style", "display:none");
                         $("#comment_div1").attr("style", "display:block");
                        
                         $("#task_div").attr("style", "display:none");
                         $("#task_div1").attr("style", "display:block");
                         $("#comment_div1").html(data.details);
                         $("#task_div1").html(data.details1);
                     })
                     .fail(function() {
                     alert( "fail!" );                     
                     });        
       }*/   
     })
   })
   function check_status(s){
   
   if(s==1){  
      $(".dynamic_field").css("display","block")
   } else{
      $(".dynamic_field").css("display","none")
   }  
   }
</script>
<script type="text/javascript">
   $(document).ready(function(){ 
     var i=1;
     $('.add').click(function(){    
          i++; 
          $('.dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><div class="form-group col-sm-3"><label>From </label><input class="form-control" name="from[]"  type="text" placeholder="From" ></div><div class="form-group col-sm-3"><label>To </label><input class="form-control" name="to[]"  type="text" placeholder="To" ></div><div class="form-group col-sm-3"><label>Mode </label><select class="form-control" name="mode[]" id="mode"><option value="" style="display:none">Select Mode</option><?php foreach($all_mode_type as $mode){ ?><option value="<?php echo $mode->exp_id; ?>" ><?php echo $mode->exp_mode; ?></option><?php } ?></select></div><div class="form-group col-sm-3"><label>Amount </label><input class="form-control" name="km[]"  type="text" placeholder="Amount" ></div></td><td><div class="form-group col-sm-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></td></tr>'); });
     $(document).on('click', '.btn_remove', function(){     
          var button_id = $(this).attr("id");
          $('#row'+button_id+'').remove();   
     });
   });  
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
<script>
function find_sub() {
     var sid =  document.getElementById("lead_source").value; 
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>enquiry/get_sub_byid1',
            data: {'sid': sid},
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('sub_source').innerHTML=data;
            }else{
              document.getElementById('sub_source').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
</script>
<script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/moment.js"></script>