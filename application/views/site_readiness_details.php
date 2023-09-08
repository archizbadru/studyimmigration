 <?php function initials($str) {     
        $ret = '';
        foreach (explode(' ', $str) as $word)
        $ret .= strtoupper(substr($word,0,1));
        
        return $ret; 
    } ?>
 <style type="text/css">
  [data-black]:before  
  {
    content:attr(data-black);
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
  td{
      
      font-size:13px;
  }
  
  label{
      
      font-size:13px;
  }
  .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
    color: white !important;
    background-color: #37a000 !important; }
    
    .nav-pills > li > a {
    color:black !important; }
  </style>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="row">
    <!--  table area -->
    <div class="col-md-12" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
  

        <div class="col-md-4" > Installation /Site readiness  Sheet</div>
        
        <div class="col-md-4">
            <div class="col-md-12">
                
                <ul class="nav nav-pills">
                    
                    <li class="active">
            		    <a href="#tab-all" data-toggle="tab" aria-expanded="true">Readiness Form 1</a>
            		</li>
            		
                    <li>
            		    <a href="#tab-all1" data-toggle="tab" aria-expanded="true">Readiness Form 2</a>
            		</li>
            		
                </ul>
                
            </div>
        </div>
        
        <div class="col-md-4" >  
        <div style="float:right">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="<?php echo base_url();?>installationprocess" title="Refresh">
               <i class="fa fa-arrow-left icon_color"></i>
            </a>                                                    
        </div>
        </div>
        </div>
</div>
    <div class="col-md-3" style="text-align:center;min-height: calc(100vh - 105px);background:#F6F8F8;"> 
                              <div class="avatar" title="<?php echo $clientDetails->cl_name; ?>" style="margin-top:5%;">
                              <p data-black="<?php $string = $clientDetails->cl_name; echo initials($string);?>"></p>
                              </div>
                             <h5 style="text-align:center"><?php echo $clientDetails->cl_name;?><br>         
                             <?php echo $clientDetails->cl_mobile;?><br> <?php echo $clientDetails->cl_email;?></h5>
                             <div class="row">
                             <button class="btn btn-success btn-sm" data-toggle="modal" type="button" title="Send SMS" data-target="#sendsms<?php echo $clientDetails->cli_id;?>" onclick="getTemplates('2')" >
                             <i class="fa fa-paper-plane-o"></i>
                             </button>
                             <!--<button class="btn btn-info btn-sm" data-toggle="modal" type="button" title="Send Email" data-target="#sendsms<?php echo $clientDetails->cli_id;?>" onclick="getTemplates('3')" >-->
                             <button class="btn btn-info btn-sm" type="button" id="send_email">
                             <i class="fa fa-envelope"></i>
                             </button>
                             <button class="btn btn-success btn-sm" data-toggle="modal" type="button" title="Send Whatsapp" data-target="#sendsms<?php echo $clientDetails->cli_id;?>" onclick="getTemplates('1')">
                             <i class="fa fa-whatsapp"></i>
                             </button>
                             <br>
                             </div>
                  <table style="width: 100%;margin-top: 5%;" id="dataTable" class="table table-responsive-sm table-hover table-outline mb-0" >
                    <tbody>
                      <tr>
                    <td><b>Client Type</b></td>
                    <td><?php if($clientDetails->enquiry_cust_type==1) { echo 'Channel Partner'; } ?>
                    <?php if($clientDetails->enquiry_cust_type==11) { echo 'Customer'; } ?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Estimated Opportunity Size</b></td>
                        <td><?=$clientDetails->op_size ?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Orgnisation Name</b></td>
                        <td><?=$clientDetails->org_name ?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Source</b></td>
                        <td><?=$clientDetails->lead_name ?></td>
                        
                    </tr>
                    
                    </tr> 
                     <td><b><?php echo display('Country_name');?></b></td>
                    <td><?php echo $clientDetails->country_name;?></td>
                    </tr>
                    </tr> 
                     <td><b><?php echo display('region_name');?></b></td>
                    <td><?php echo $clientDetails->region_name;?></td>
                    </tr>
                    
                    <tr>
                    <td><b><?php echo display('state_name');?></b></td>
                    <td><?php echo $clientDetails->state;?></td>
                    </tr> 
                    
                    <tr> 
                     <td><b><?php echo display('territory_name');?></b></td>
                    <td><?php echo $clientDetails->territory_name;?></td>
                    </tr>
                    
                    <td><b><?php echo display('city_name');?></b></td>
                    <td><?php echo $clientDetails->city;?></td>
                    </tr>
                    
                    <tr>
                    <td><b>Pin code</b></td>
                    <td><?php echo $clientDetails->pin_code;?></td>
                    </tr>
                    
                    <tr>
                    <td><b><?php echo display('address');?></b></td>
                    <td><?php echo $clientDetails->address;?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Requirement/Product</b></td>
                        <td><?php echo $clientDetails->enquiry ?></td>
                    </tr>
                    
                    <tr>
                    <td><b>Created By</b></td>
                    <td><?php echo $clientDetails->s_display_name." ".$clientDetails->last_name ?></td>
                    </tr>
                    <tr>
                    <td><b><?php echo display('create_date');?></b></td>
                    <td><?php echo date('d-m-Y',strtotime($clientDetails->created_date));?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Installtion Date</b></td>
                        <td style="color:red">
                            <?php $id = $clientDetails->cli_id;
                            
                                $date = $this->db->select('*')->from('readiness_check_list')->where('client_id',$id)->get()->row();
                                  
                                if(!empty($date->accepted_date)){
                                    
                                    echo date('d-m-Y',strtotime($date->accepted_date));
                                    
                                }else{
                                    
                                    echo "Not approved yet";
                                }
                            
                             ?>
                        </td>
                        
                    </tr>
                    
                     </tbody></table>
   
                                               
           </div>

    <div class="col-md-9">
        <div class="tab-content">
        <div id="tab-all" class="tab-pane active">
        <div class="panel panel-default thumbnail"> 
                <div class="panel-heading no-print">
         <h3>OSUM - Checklist for Site Readiness before Installation</h3>
        </div>
            <div class="panel-body">
                <br>
           <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php } ?>
           
           <br>
                
    
                    <?php echo form_open('/Installationprocess/add_readiness_sheet', 'class="form-inner"'); ?>
                    
                    	<div class="form-group col-md-6">
                    	    <label>Client Name</label>
                    	  <input class="form-control" name="client_name"  type="text" value="<?php echo $clientDetails->cl_name;?>" readonly>
                    	  <input type="hidden" id="user_id" value="<?= $clientDetails->cli_id ?>" name="user_id" class="form-control">
                    	</div>
                    	
                    	<div class="form-group col-md-6">
                    	    <label>Client Mail id</label>
                    	  <input class="form-control" name="mail" id="mail"  type="text" value="<?php echo $clientDetails->cl_email;?>" readonly>
                    	</div>
                    	
                        <div class="form-group col-md-6">
                    	    <label>Client Mobile Number</label>
                    	  <input class="form-control" name="mobile"  type="text" value="<?php echo $clientDetails->cl_mobile;?>" readonly>
                    	</div>
                    	
                    	<div class="form-group col-md-6">
                    	    <label>Channel partner</label>
                    	  <input class="form-control" name="channel_partner"  type="text" value="" required>
                    	</div>
                    	
                    	<div class="form-group col-md-6">
                    	    <label>Site Address</label>
                    	  <input class="form-control" name="site_address"  type="text" value="<?php echo $clientDetails->address;?>" readonly>
                    	</div>
                    	
                    	<div class="form-group col-md-6">
                    	    <label>Tech Support Engineer</label>
                    	  <input class="form-control" name="tech_support_engg"  type="text" value="" required>
                    	</div>
                    
                    <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead style="background-color:black;color:#ffff;">
                          <tr>
                            <th class="text-center" style="font-size:12px;">Sno.</th>
                            <th class="text-center" style="font-size:12px;" nowrap>Check points</th>
                            <th class="text-center" style="font-size: 12px;">Description</th>
                            <th class="text-center" style="width:10px;width:124px;font-size: 12px;">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                          <?php $i=1;$x=0;
                          
                          $anser  = explode(',',$ans->status_val);
                            
                          foreach($readiness_list as $list){ 
                          
                          foreach($list as $row_list){
                            
                           
                          
                          ?>
                          
                          <input type="hidden" value="<?= $row_list->install_id?>" name="desc_id" >
                          
                         
                          
                          <tr>
                            <td class="text-center" style="font-size:12px;"><?= $i++ ?></td>
                            <td class="text-center" style="font-size:12px;"><?= $row_list->check_points ?></td>
                            <td class="text-center" style="font-size:12px;"><?= $row_list->description?></td>
                            <td class="text-center" style="font-size:12px;"><?php 
                                
                                $val = explode(',',$row_list->status_val);
                                
                                $totl = count($val);
                                
                                    if($row_list->readiness_status_type==1){
                                        $k=1;
                                        for($j=0; $j <$totl; $j++){?>
                                        
                                           <div class="form-check">
                                              <input class="form-check-input" name="status_val[]" type="checkbox" value="<?= $val[$j] ?>" id="defaultCheck<?= $k ?>">
                                              <label class="form-check-label" for="defaultCheck<?= $k ?>">
                                                <?= $val[$j] ?>
                                              </label>
                                            </div>
                                            
                                    <?php $k++;}}else if($row_list->readiness_status_type==2){?>
                                        
                                        <div class="col-sm-6"><?php $k=1; 
                                            for($j=0; $j<$totl; $j++){?>
                                            <div class="radio radio-danger">
                                                <input type="radio" name="status_val[]"  id="radio<?= $k ?>" value="<?= $val[$j]?>">
                                                <label for="radio<?= $k ?>">
                                                    <?= $val[$j] ?>
                                                </label>
                                            </div>
                                            <?php $k++;} ?>
                                        </div>
                                        
                                    <?php }else if($row_list->readiness_status_type==3){?>
                                        
                                        <input class="form-control" name="status_val[]"  type="text" >
                                        
                                    <?php }else{ ?>
                                        
                                         
                                        <select class="form-control" name="status_val[]" required>
                                         
                                            <option value="" style="display:none;">Select...</option>
                                            
                                            <?php for($j=0; $j < $totl; $j++ ){ ?>
                                                
                                                 <option value="<?= $val[$j]?>" <?php if($val[$j]==$anser[$x]){echo'selected';}?>><?= $val[$j] ?></option>
                                                 
                                            <?php } ?>
                                            
                                        </select>
                                   <?php  }
                             ?></td>
                          </tr>
                          <?php }$x++;} ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="form-group col-md-12 text-center">
                            
                           <button type="button" class="btn btn-success" data-toggle="modal" data-target="#suggestedDate">CONFIRM</button>
                            <!--<button type="button" class="btn btn-success">Edit</button>-->
                        
                    </div>
                    </form>
                </div>
            </div>
            </div>
            <!------------------- Second Tab --------------------->
            <div id="tab-all1" class="tab-pane">
                
                <div class="panel panel-default thumbnail"> 
                <div class="panel-heading no-print">
         <h3>OSUM - Checklist for Site Readiness before Installation</h3>
        </div>
            <div class="panel-body">
                <br>
                                      
                    <form action="http://0903.ga/Installationprocess/sitereadiness_form_two" class="form-inner" method="post" accept-charset="utf-8">
                    
                    
                    <div class="col-md-12">
                        <input value="5" name="user_id" type="hidden">
                    <table class="table table-bordered">
                        <thead style="background-color:black;color:#ffff;">
                          <tr>
                            <th class="text-center" style="font-size:12px;">Sno.</th>
                            <th class="text-center" style="font-size:12px;" nowrap="">Device Type</th>
                            <th class="text-center" style="font-size: 12px;">Device Brand Name</th>
                            <th class="text-center" style="width:10px;width:124px;font-size: 12px;">Device Model No.</th>
                            <th class="text-center" style="width:10px;width:124px;font-size: 12px;">Qty</th>
                            <th class="text-center" style="width:10px;width:124px;font-size: 12px;">Device Load</th>
                          </tr>
                        </thead>
                        <tbody> 
                            <?php   $j=1; 
                             
                            if(!empty($second_form->client_id)){
                             
                            $devices = explode(',',$second_form->device_type);
                            
                            $brand = explode(',',$second_form->brand);
                            
                            $model_no = explode(',',$second_form->model_no);
                            
                            $quntity = explode(',',$second_form->quantity);
                            
                            $device_load = explode(',',$second_form->device_load);
                             
                            for($i=0; $i < count($devices); $i++){?>
                             
                            <tr>
                                <td><?= $j++ ?></td>
                                <td><?= $devices[$i]; ?><input type="hidden" value="Router" class="form-control" name="device_type[]"></td>
                                <td><input type="text" class="form-control" name="device_brand[]" value="<?= $brand[$i] ?>" readonly></td>
                                <td><input type="text" class="form-control" name="device_model[]" value="<?= $model_no[$i] ?>" readonly></td>
                                <td><input type="text" class="form-control" name="quantity[]" value="<?= $quntity[$i] ?>" readonly></td>
                                <td><input type="text" class="form-control" name="devices_load[]" value="<?= $device_load[$i] ?>" readonly></td>
                            </tr>
                            
                            <?php } ?>
                            <tr>
                                <td colspan="6"><strong>Please specify if any Site specific need or observation that we should know</strong></td>
                            </tr>
                             <tr>
                                <td colspan="6"><textarea class="form-control" rows="5" name="additional" readonly><?=$second_form->site_observation ?></textarea></td>
                            </tr>
                             <?php }else{ ?>
                             
                                <td colspan="6" style="color:red" align="center">Second form is not submitted by client...</td>
                             
                             <?php } ?>
                        </tbody>
                       
                    </table>
                    </div>
                    <div class="form-group col-md-12 text-center">
                            
                            <!--<button type="submit" class="btn btn-success">Submit</button>-->
                            <!--<button type="button" class="btn btn-success">Edit</button>-->
                        
                    </div>
                    </form>
                </div>
            </div>
                
                
            </div>
            
            <!------------------- End Second tab ----------------->
            </div>
        </div>
    </div>
</div>

 <!---- Send To Client Modal----->
                                    <div id="suggestedDate" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Suggested Date For Installation</h4>
                                          </div><form method="POST" id="send_installation_date">
                                          <div class="modal-body">
                                              <div class="row">
                                                
                                                 <div class="form-group col-md-12 text-center" style="display:none;" id="su-msg">
                                                    <label style="color:green;">Suggested date sent successfully to client...</label>
                                                </div>
                                                
                                                
                                               <div class="form-group col-md-6">
                                                    <label>Date1</label>
                                                    <input type="date" class="form-control" name="date1">
                                                    <input type="hidden" class="form-control" name="user" value="<?=$this->uri->segment(3)?>">
                                                    <input type="hidden" class="form-control" name="email" value="<?=$clientDetails->cl_email ?>">
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label>Date2</label>
                                                    <input type="date" class="form-control" name="date2">
                                                </div>
                                                
                                                <div class="form-group col-md-12">
                                                      
                                                      <p style="color:red;">Note : Select your convenient date for the installation.</p>
                                                  </div>
                                                
                                              </div>
                                    	  </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                          </div></form>
                                        </div>
                                      </div>
                                    </div>
                                    <script>
    
    $(function(){
        
        $("#send_installation_date").submit(function(e){
            
            e.preventDefault();
            
            $.ajax({
                
                url : '<?php echo base_url('Installationprocess/mail_sitereadiness_mail')?>',
                type: 'POST',
                data: $(this).serialize(),
                success:function(data){
                    
                    if(data==1){
                        
                        $("#su-msg").show().delay(2000).fadeOut(function(){
                            
                            location.reload();
                        });
                    }
                }
                
            });
            
            
        });
        
        
        
    });
    
</script>