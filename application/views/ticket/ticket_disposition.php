<script src="<?=base_url()?>/assets/summernote/summernote-bs4.min.js"></script>
<link href="<?=base_url()?>/assets/summernote/summernote-bs4.css" rel="stylesheet" />


<div class="row">   
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
                <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>        
                <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" href="<?=base_url().'ticket/add'?>" title="New Ticket"></a>                       
            </div>
         </div>
         <div class="panel-body">
            <div class="col-md-3 col-height">          
              <h5 style="text-align:center">
                <br>
                <?php
                echo 'Ticket No - '.$ticket->ticketno;
                ?>
              <br>

                <br><a href="<?php if(!empty($enquiry->enquiry_id)){ echo base_url().'client/view/'.$enquiry->enquiry_id;}?>"><?php  (!empty($enquiry->name)) ? ucwords($enquiry->name_prefix." ".$enquiry->name." ".$enquiry->lastname) : ""; ?></a>
              <br>
              
              <?php 
              if(!empty($enquiry->gender))
              {
                if($enquiry->gender == 1) {
                 echo 'Male<br>'; 
                }else if($enquiry->gender == 2){
                  echo 'Female<br>';
                }else if($enquiry->gender == 3){
                  echo 'Other<br>';
                } 

              }
              $p = (!empty($enquiry->gender)) ? $enquiry->phone : '';
              if (user_access(450)) {
                $p = '##########';
              }
            ?>
            <a href='javascript:void(0)' onclick='send_parameters(".<?php if(!empty($enquiry->phone)) {echo $enquiry->phone;} ?>.")'><?php echo $p ?></a>
            <br><?php if(!empty($enquiry->email)) { echo $enquiry->email; }             
            ?>            
         </h5>
         <div class="row text-center">
              <a class="btn btn-primary btn-sm"  data-toggle="modal" type="button" title="Send SMS" data-target="#sendsms<?php if(!empty($enquiry->enquiry_id)) {echo $enquiry->enquiry_id;} ?>" data-toggle="modal"  onclick="getTemplates('2','Send SMS')">
                <i class="fa fa-paper-plane-o"></i>
              </a>
              <a class="btn btn-info btn-sm"  data-toggle="modal" type="button" title="Send Email" data-target="#sendsms<?php if(!empty($enquiry->enquiry_id)) {echo $enquiry->enquiry_id;} ?>" data-toggle="modal"  onclick="getTemplates('3','Send Email')">
                <i class="fa fa-envelope"></i>
              </a>
              <a class="btn btn-primary btn-sm"  data-toggle="modal" type="button" title="Send Whatsapp" data-target="#sendsms<?php if(!empty($enquiry->enquiry_id)) {echo $enquiry->enquiry_id;} ?>" data-toggle="modal"  onclick="getTemplates('1','Send Whatsapp')">
                <i class="fa fa-whatsapp"></i>
              </a>
         </div>
              <button class="btn btn-basic" type="button" style="width: 100%; margin-top: 5px;margin-bottom: 5px;">Disposition</button>
            
              <div id="disposition-section" class="mobile-hide">
                <div class="row" > 
                   <?php echo form_open_multipart('ticket/ticket_disposition/'.$ticket->id,array('id'=>'','class'=>'form-inner')) ?>                     
                   <input type="hidden" name="client" value="<?php if(!empty($enquiry->enquiry_id)) { echo $enquiry->enquiry_id;}?>">
                   <input type="hidden" name="ticketno" value="<?=$ticket->ticketno?>">
                    <div class="form-group">                 
                      <select class="form-control" id="lead_stage_change" name="lead_stage" onchange="find_description()">
                        <option>---Select Stage---</option>
                        <?php foreach($ticket_stages as $single){                               
                                $id=$single->lead_stage; ?>                              
                            <option value="<?=$single->stg_id?>"><?php echo $single->lead_stage_name; ?></option>
                            <?php } ?>
                       </select>
                    </div>
                    <div class="form-group">                           
                       <select class="form-control" id="lead_description" name="lead_description">
                           <option>---Select Description---</option>
                          <?php foreach($all_description_lists as $discription){ ?>                                   
                               <option value="<?php echo $discription->id; ?>"><?php echo $discription->description; ?></option>
                               <?php } ?>
                       </select>
                    </div>             
                    <div class="form-group">
                      <textarea class="form-control" name="conversation"></textarea>
                    </div>

                   <div class="sgnbtnmn form-group text-center">
                      <div class="sgnbtn">
                         <input type="submit" value="Submit" class="btn btn-primary"  name="Submit">
                      </div>
                   </div>       
                   <?php echo form_close()?>
                </div>         
              </div>
            </div>
         