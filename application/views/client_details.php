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
   background: #37a000;
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
   color: #fff;
   cursor: default;
   background-color: #37a000;
   border: none!important;
   }
   table th,td{font-size:11px;}
   .list-group{margin-top:10px!important;}
</style>
<style type="text/css">
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
               <a class="btn" href="<?php echo base_url(); ?>client" title="Refresh">
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
         <div class="avatar" title="<?php echo $clientDetails->name; ?>" style="margin-top:5%;margin-left:40%;">
            <p data-black="<?php $string = $clientDetails->name; echo initials($string);?>"></p>
         </div>
         <h5 style="text-align:center"><br><br><br><br><?php echo $clientDetails->name;?><br>         
            <?php echo $clientDetails->phone;?><br> <?php echo $clientDetails->email;?>
         </h5>
         <div class="row">
            <button class="btn btn-success btn-sm" data-toggle="modal" type="button" title="Send SMS" data-target="#sendsms<?php echo $clientDetails->enquiry_id;?>" onclick="getTemplates('2','Send SMS')" >
            <i class="fa fa-paper-plane-o"></i>
            </button>
            <button class="btn btn-info btn-sm" data-toggle="modal" type="button" title="Send Email" data-target="#sendsms<?php echo $clientDetails->enquiry_id;?>" onclick="getTemplates('3','Send Email')">
            <i class="fa fa-envelope"></i>
            </button>
            <button class="btn btn-success btn-sm" data-toggle="modal" type="button" title="Send Whatsapp" data-target="#sendsms<?php echo $clientDetails->enquiry_id;?>" onclick="getTemplates('1','Send Whatsapp')">
            <i class="fa fa-whatsapp"></i>
            </button>
            <br>
         </div>
         <table style="width: 100%;margin-top: 5%;" id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0" >
            <tbody>
               <tr>
                  <td>Source</td>
                  <td><?=$clientDetails->lead_name ?></td>
               </tr>
               <tr>
                  <td>Requirement/Product</td>
                  <td><?= $clientDetails->enquiry?></td>
               </tr>
               <tr>
                  <td>Created By</td>
                  <td><?=$clientDetails->s_display_name." ".$clientDetails->last_name?> </td>
               </tr>
               <tr>
                  <td><?php echo display('create_date');?></td>
                  <td><?php echo date('d-m-Y',strtotime($clientDetails->created_date));?></td>
               </tr>
            </tbody>
         </table>
      </div>
      <div class="bg-white col-md-9" style="background:#fff;">
         <div id="exTab3" class="">
            <ul  class="nav nav-tabs" role="tablist">
               <li class="active">
                  <a  href="#info" data-toggle="tab" style="padding: 15px 25px; font-size: 15px;">Info</a>
               </li>
               <!--<li><a href="#personaltab" data-toggle="tab">Pesonal</a></li>
               <li><a href="#socialprofiletab" data-toggle="tab">Social Profile</a></li>
               <li><a href="#kyctab" data-toggle="tab">KYC</a></li>
               <li><a href="#workhistorytab" data-toggle="tab">Work History</a></li>
               <li><a href="#educationtab" data-toggle="tab">Education</a></li>
               <li><a href="#travelhistorytab" data-toggle="tab">Travel History</a></li>               
               <li><a href="#familydetailtab" data-toggle="tab">Family</a></li>-->
               <li><a href="#task" data-toggle="tab" style="padding: 15px 25px; font-size: 15px;">TBRO</a>
               <li><a href="#contacts" data-toggle="tab" style="padding: 15px 25px; font-size: 15px;">Contacts</a></li>
               </li>
              <!-- <li><a href="#sales" data-toggle="tab">Documents</a>
               </li>
               <li><a href="#support_tickect" data-toggle="tab">Support Tickets</a></li>-->
               
            </ul>
            <div class="tab-content clearfix">
               <div class="tab-pane active" id="info">
                  <hr>

               <?php echo form_open_multipart('client/updateclient/'.$details->enquiry_id,'class="form-inner"') ?>  
                  <input type="hidden" name="form" value="client">
                  <div class="row">
                     <div class="form-group col-sm-4">
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
                     <div class="form-group col-sm-4"> 
                        <label>Last Name <i class="text-danger">*</i></label>
                        <input class="form-control" value="<?php echo $details->lastname ?>" name="lastname" type="text" placeholder="Last Name" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display('mobile') ?></label>
                        <input class="form-control" name="mobileno" type="text" maxlength='10' value="<?php echo $details->phone ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >  
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display('email') ?></label>
                        <input class="form-control" name="email" type="email" value="<?php echo $details->email ?>">  
                     </div>
                     <div class="form-group col-sm-4">
                        <label><?php echo display('company_name') ?> <i class="text-danger">*</i></label>
                        <input class="form-control" name="company" type="company" value="<?php echo $details->company ?>"> 
                     </div>
                     <div class="form-group col-sm-4">
                        <label><?php echo display('address') ?> <i class="text-danger">*</i></label>
                        <input class="form-control" name="address" type="address" value="<?php echo $details->address ?>">  
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
                     <br>
                     <div class="row"  id="save_button">                        
                           <div class="col-md-8">                                                
                              <button class="btn btn-primary" type="submit" >Save</button>            
                           </div>                        
                     </div>
                     </form>               
                
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
                              if(!empty($clientContacts)){
                              foreach ($clientContacts as $contact) { 
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
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewContact" class="btn btn-success">Add new contact</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>
               <div class="tab-pane" id="personaltab">
                  <hr>
                  <?php echo form_open_multipart('client/updateclientpersonel/'.$clientDetails->enquiry_id,'class="form-inner"') ?>  
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
                        <select class="form-control" name="corres_country_id" id="country_id" onchange="find_state()">
    <option value="">-Select Country-</option>
    <?php foreach($allcountry_list as $country){ ?>
    <option value="<?php echo $country->id_c; ?> " <?php if(!empty($allcountry_list)){if($alldetails->corres_country_id==$country->id_c){echo 'selected';}} ?>><?php echo $country->country_name; ?> </option>
    <?php } ?>
</select>


                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence State</label>
                                          <select class="form-control" name="corres_state_id" id="state_id">
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
                        <select class="form-control" name="corres_country_id" id="corres_country_id1">
    <option value="">-Select Country-</option>
    <?php foreach($allcountry_list as $country){ ?>
    <option value="<?php echo $country->id_c; ?> "><?php echo $country->country_name; ?> </option>
    <?php } ?>
</select>
                     </div>
                     <div class="form-group col-sm-4"> 
                        <label>Correspondence State</label>
                                          <select class="form-control" name="corres_state_id" id="corres_state_id1">
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
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewKyc" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>
           
               <div class="tab-pane" id="educationtab">
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
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewEducation" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>
                <div class="tab-pane" id="socialprofiletab">
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
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewSprofile" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>
                
                <div class="tab-pane" id="familydetailtab">
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
                     <br>
                     <center>
                        <h5><a style="cursor: pointer;" data-toggle="modal" data-target="#createnewMember" class="btn btn-primary">Add new</a></h5>
                     </center>
                     <br>              
                  </div>
               </div>
            </div>
         </div>
      </div>
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
 <div id="createnewKyc" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New KYC</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewkyc/'.$clientDetails->Enquery_id,'class="form-inner"') ?>
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
                  <input class="form-control" name="doc_file" id="doc_file" placeholder="Upload File"  type="file" >
               </div>
                <div class="form-group col-md-6">
                  <label>Valid Up To</label>
                  <input class="datepicker form-control" id="doc_validity" name="doc_validity" placeholder="Valid Up To"  type="text" >
               </div>
                <input type="hidden" id="kyc_unique_number" name="unique_number" value="<?php echo $clientDetails->Enquery_id;?>">
                <input type="hidden" id="kyc_enquiry_id" name="kyc_enquiry_id" value="<?php echo $clientDetails->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="createnewWork" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Work History</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewwork/'.$clientDetails->Enquery_id,'class="form-inner"') ?>
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
                <input type="hidden" id="work_unique_number" name="work_unique_number" value="<?php echo $clientDetails->Enquery_id;?>">
                <input type="hidden" id="work_enquiry_id" name="work_enquiry_id" value="<?php echo $clientDetails->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="createnewEducation" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Education</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewedu/'.$clientDetails->Enquery_id,'class="form-inner"') ?>
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
                <input type="hidden" id="edu_unique_number" name="edu_unique_number" value="<?php echo $clientDetails->Enquery_id;?>">
                <input type="hidden" id="edu_enquiry_id" name="edu_enquiry_id" value="<?php echo $clientDetails->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="createnewSprofile" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Social Profile</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewsprof/'.$clientDetails->Enquery_id,'class="form-inner"') ?>
               <div class="form-group col-md-6">
                  <label>Name of Social Media</label>
                  <input class="form-control" id="title" name="title" placeholder="Name of Social Media"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Profile URL</label>
                  <input class="form-control" id="profile" name="profile" placeholder="Profile URL"  type="text"  required>
               </div>
                <input type="hidden" id="sprof_unique_number" name="sprof_unique_number" value="<?php echo $clientDetails->Enquery_id;?>">
                <input type="hidden" id="sprof_enquiry_id" name="sprof_enquiry_id" value="<?php echo $clientDetails->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="createnewTravel" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Travel History</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewtravel/'.$clientDetails->Enquery_id,'class="form-inner"') ?>
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
                  <input class="datepicker form-control" id="travel_date" name="travel_date" placeholder="Travel Date"  type="date" style="padding-top:0px;"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>Visa Type</label>
                  <input class="form-control" id="visa_type" name="visa_type" placeholder="Visa Type"  type="text"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>From Date</label>
                  <input class="datepicker form-control" id="dfrom_date" name="dfrom_date" placeholder="From Date"  type="date" style="padding-top:0px;"  required>
               </div>
                <div class="form-group col-md-6">
                  <label>To Date</label>
                  <input class="datepicker form-control" id="dto_date" name="dto_date" placeholder="To Date"  type="date" style="padding-top:0px;"  required>
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
                <input type="hidden" id="travel_unique_number" name="travel_unique_number" value="<?php echo $clientDetails->Enquery_id;?>">
                <input type="hidden" id="travel_enquiry_id" name="travel_enquiry_id" value="<?php echo $clientDetails->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="createnewMember" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Member</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('lead/addnewmember/'.$clientDetails->Enquery_id,'class="form-inner"') ?>
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
                <input type="hidden" id="mem_unique_number" name="mem_unique_number" value="<?php echo $clientDetails->Enquery_id;?>">
                <input type="hidden" id="mem_enquiry_id" name="mem_enquiry_id" value="<?php echo $clientDetails->enquiry_id;?>">
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="createnewContact" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Contact</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('client/create_newcontact/'.$clientDetails->enquiry_id.'/'.$clientDetails->Enquery_id,'class="form-inner"') ?> 
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
                  <input class="form-control" name="mobileno" placeholder="Mobile No." maxlength="10"  type="text"  required>
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
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div id="sendsms<?php echo $clientDetails->enquiry_id;?>" class="modal fade" role="dialog">
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
               <textarea class="form-control" name="message_name" rows="10" type="number" id="template_message"></textarea>  
            </div>
         </div>
         <div class="col-md-12">
            <button class="btn btn-success" type="button" onclick="send_sms()">Send</button>            
            <input type="hidden" value="" id="mesge_type" name="mesge_type">
            <input type="hidden" value="<?php echo $clientDetails->email;?>"  name="mail">
            <input type="hidden" value="<?php echo $clientDetails->phone;?>"  name="mobile">
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

<!------------------------- Create New Contact ------------------------------>
<div id="createnewContact" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Contact</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('client/create_newcontact/'.$clientDetails->enquiry_id.'/'.$clientDetails->Enquery_id,'class="form-inner"') ?> 
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
                  <input class="form-control" name="mobileno" placeholder="Mobile No."  type="text" maxlength="10"  required>
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
                     <input id="signupbtn" type="submit" value="Add Contact" class="btn btn-success"  name="Add Contact">
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
<!---------------------------------------------------------------------------->
<!------------------- Create Task ------------------------->
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
                  <input type="text" class="form-control" value="<?php if(!empty($clientDetails->name)){echo $clientDetails->name;} ?>" name="contact_person"  placeholder="Contact Person Name">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Designation</label>
                  <input type="text" class="form-control" name="designation" value="<?= isset($clientDetails->designation)?$clientDetails->designation:''?>" placeholder="Contact Person Designation">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Mobile No</label>
                  <input type="text" class="form-control" value="<?php if(!empty($clientDetails->phone)){echo $clientDetails->phone;} ?>" name="mobileno" placeholder="Mobile No">
               </div>
               <div class="form-group col-sm-6" style="display:none;">
                  <label>Contact Person Email</label>
                  <input type="text" class="form-control" value="<?php if(!empty($clientDetails->email)){echo $clientDetails->email;} ?>" name="email" placeholder="Email">
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
                  <input type="hidden" name="enq_code"  value="<?php echo  $clientDetails->Enquery_id; ?>" >
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
               <input class="form-control" id="FormInfo" name="task_id" type="hidden" value="<?php echo $clientDetails->Enquery_id ; ?>" >
               <label>Date From:</label>
               <input class="form-control" id="txtDate" name="task_start" type="text" placeholder="Start Task Date" readonly>                
               <br> 
               <label>Date To:</label>
               <input class="form-control" id="txtDate2" name="task_end" type="text" placeholder="End Task Date" readonly>
               <br>
               <button class="btn btn-sm btn-success" style="float: right" type="button" onclick="search_comment_and_task()">
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
               <input class="form-control" id="FormInfo" name="lid" type="hidden" value="<?php echo $clientDetails->Enquery_id ; ?>" >
               <input class="form-control" id="FormInfo" name="coment_type" type="hidden" value="1" >
               <textarea class="form-control" id="LastComment" name="conversation" type="text" placeholder="Add followup comment"></textarea>
               <br>
               <button class="btn btn-sm btn-success" style="float: right">
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
                     <input class="form-control" value="<?php echo $clientDetails->Enquery_id; ?>" name="child_id" type="hidden">                
                  </div>
                  <div class="form-group col-sm-12">        
                     <input  class="btn btn-success" type="submit" value="Create New Deals " >      
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
   
     /* initialize the external events
      -----------------------------------------------------------------*/
     function init_events(ele) {
       ele.each(function () {
   
         // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
         // it doesn't need to have a start or end
         var eventObject = {
           title: $.trim($(this).text()) // use the element's text as the event title
         }
   
         // store the Event Object in the DOM element so we can get to it later
         $(this).data('eventObject', eventObject)
   
         // make the event draggable using jQuery UI
         $(this).draggable({
           zIndex        : 1070,
           revert        : true, // will cause the event to go back to its
           revertDuration: 0  //  original position after the drag
         })
   
       })
     }
   
     init_events($('#external-events div.external-event'))
   
     /* initialize the calendar
      -----------------------------------------------------------------*/
     //Date for the calendar events (dummy data)
     
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
       //Random default events
       
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
       dayClick:function(date,isEvent,view,resourseobj){
         $('td').dblclick(function(){
             
              $("#range").attr("style", "display:block");
           
        }); 
        
                     $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url();?>enquiry/search_comment_and_task/'+date.format()+'/<?php echo $clientDetails->Enquery_id ?>',
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
        
       },
   
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
   
          $('.dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><div class="form-group col-sm-3"><label>From </label><input class="form-control" name="from[]"  type="text" placeholder="From" ></div><div class="form-group col-sm-3"><label>To </label><input class="form-control" name="to[]"  type="text" placeholder="To" ></div><div class="form-group col-sm-3"><label>Mode </label><select class="form-control" name="mode[]" id="mode"><option value="" style="display:none">Select Mode</option><?php foreach($all_mode_type as $mode){ ?><option value="<?php echo $mode->exp_id; ?>" ><?php echo $mode->exp_mode; ?></option><?php } ?></select></div><div class="form-group col-sm-3"><label>Amount </label><input class="form-control" name="km[]"  type="text" placeholder="Amount" ></div></td><td><div class="form-group col-sm-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></td></tr>'); 
          
   
     });
   
   
     $(document).on('click', '.btn_remove', function(){  
   
          var button_id = $(this).attr("id");   
   
          $('#row'+button_id+'').remove();  
   
     });  
     
     
     
   });  
   
</script>
<script>
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
<script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/moment.js"></script>