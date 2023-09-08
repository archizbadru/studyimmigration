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
  </style>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="row">
    <!--  table area -->
    <div class="col-md-12" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
  

        <div class="col-md-6" > Installation /Site Audit Sheet
        </div>
        <div class="col-md-6" >  
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
                             <!--<button class="btn btn-info btn-sm" data-toggle="modal" type="button" title="Send Email" data-target="#sendsms<?php echo $clientDetails->cli_id;?>" onclick="getTemplates('3')">
                             <i class="fa fa-envelope"></i>
                             </button>-->
                             <button class="btn btn-info btn-sm" type="button" title="Send Email" onclick="send_form_link()">
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
                    
                    <tr>
                        <td><b>Est. Opportunity Size</b></td>
                        <td><?=$clientDetails->op_size ?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Organisation Name</b></td>
                        <td><?=$clientDetails->org_name ?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Source</b></td>
                        <td><?=$clientDetails->lead_name ?></td>
                    </tr>
                    
                     <td><b><?php echo display('Country_name');?></b></td>
                    <td><?php echo $clientDetails->country_name;?></td>
                    </tr>
                    </tr> 
                     <td><b><?php echo display('region_name');?></b></td>
                    <td><?php echo $clientDetails->region_name;?></td>
                    </tr>
                    </tr> 
                     <td><b><?php echo display('territory_name');?></b></td>
                    <td><?php echo $clientDetails->territory_name;?></td>
                    </tr>
                    <tr>
                    <td><b><?php echo display('state_name');?></b></td>
                    <td><?php echo $clientDetails->state;?></td>
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
                        <td><b>Requirements</b></td>
                        <td><?=$clientDetails->enquiry ?></td>
                    </tr>
                    
                    <tr>
                    <td><b>Created By</b></td>
                    <td><?=$clientDetails->s_display_name." ".$clientDetails->last_name ?></td>
                    </tr>
                    <tr>
                    <td><b><?php echo display('create_date');?></b></td>
                    <td><?php echo date('d-m-Y',strtotime($clientDetails->created_date));?></td>
                    </tr>
                    <tr>
                         <td><b>Installation Date</b></td>
                         <td style="color:red"><?php if(($clientDetails->accepted_date==null)){echo"Not approved yet";}else{echo date('d-m-Y',strtotime($clientDetails->accepted_date));} ?></td>
                    </tr>
                    
                     </tbody></table>
   
                                               
           </div> 
    <div class="col-md-9">
        <div class="panel panel-default thumbnail"> 
        <div class="panel-heading no-print">
         <h3>OSUM - Site Audit Report</h3>
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
                
                <!-- Site Audit Form --->
                <form action="<?php echo base_url('Installationprocess/add_site_audit_report') ?>" class="form-inner " id="MyForm" method="post" accept-charset="utf-8">
                    
                    	<div class="form-group col-md-3">
                    	    <label>Report no.</label>
                    	  <input class="form-control" name="report_no" type="text" value="" required>
                    	  
                    	  <input class="form-control" name="customer_id" type="hidden" value="<?= $clientDetails->cli_id ?>">
                    	</div>
                    	<input type="hidden" name="user_id" id="user_id" value="<?=$clientDetails->cli_id ?> ">
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Date</label>
                    	  <input class="form-control date" id="r_date" name="date" type="text"  required>
                    	</div>
                    	
                        <div class="form-group col-md-3">
                    	    <label>Customer Name</label>
                    	  <input class="form-control" name="customer_name" type="text" value="<?= $clientDetails->cl_name?>" readonly="">
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Client ID</label>
                    	  <input class="form-control" id="customer_id" name="client_id" type="text" value="<?= $clientDetails->customer_code?>" readonly>
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Contact Number</label>
                    	  <input class="form-control" name="contact_no" type="text" value="<?= $clientDetails->cl_mobile ?>" readonly="">
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Email ID</label>
                    	  <input class="form-control" name="email" id="email" type="text" value="<?= $clientDetails->cl_email?>" readonly="">
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Address</label>
                    	  <textarea class="form-control" id="exampleFormControlTextarea1"  name="address" readonly><?=$clientDetails->address?></textarea>
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Partner Name</label>
                    	    <select class="form-control" name="partner_name">
                    	        <option value="" style="display:none">Select...</option>
                    	        <option value="partner">Partner</option>
                    	    </select>
                    	</div>
                    	
                    	<div class="row">
                    	    <div class="col-md-12">
                        	<div class="form-group col-md-3">
                        	    <label>Sales Executive</label>
                        	    <input type="text" class="form-control" name="sale_exc" value="<?=$clientDetails->sale_executive ?>">
                        	</div>
                        	
                        	<div class="form-group col-md-3">
                        	    <label>Pre-sales Executive</label>
                        	    <input type="text" class="form-control" name="pre_sale_exc" value="<?=$clientDetails->pre_sale_exec?> ">
                        	</div>
                        	
                        	<div class="form-group col-md-3">
                        	    <label>Installation Engineer</label>
                        	    <input type="text" class="form-control" name="installation_eng" value="<?=$clientDetails->installation_engg ?> ">
                        	</div>
                        	
                        	<div class="form-group col-md-3">
                        	    <label>Type of site</label>
                        	    <select class="form-control" name="resident_type">
                        	        <option value="<?=$clientDetails->residence_type ?>" style="display:none;"><?=$clientDetails->residence_type ?></option>
                        	        <option value="residential">Residential</option>
                        	        <option value="commercial">Commercial</option>
                        	    </select>
                        	</div>
                        	</div>
                    	</div>
                    	
                    	<div class="form-group col-md-12">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th class="text-center">Floor</th>
                                <th class="text-center">Area</th>
                                <th class="text-center">Modular Box</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Type of Load</th>
                                <th class="text-center">Total Load</th>
                                <th class="text-center">Function</th>
                                <th class="text-center">Remark</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php /*$sub_title=''; $area='';*/$j=1; foreach($boqdata as $row){
                                
                                    /*$title=$row->baq_floor;
                                    
                                    $sub_area = $row->baq_room;
                                    
                                 
                                    if( ! ( $title == $sub_title ) ) {
                                        
                                       $sub_title = $title;
                                    }
                                    else {
                                        
                                       $title = ' &nbsp; ';
                                    }
                                    
                                     if( ! ( $area == $sub_area ) ) {
                                        
                                       $sub_area = $area;
                                    }
                                    else {
                                        
                                       $area = ' &nbsp; ';
                                    }
                                */
                                ?>
                                <!--<tr>
                                    <td><?= $row->baq_floor ?></td>
                                    <td><?= $row->baq_room ?></td>
                                    <td><?= $row->moduels ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <select class="form-control" name="remark[]">
                                            
                                            <option value="" style="display:none">Select...</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            
                                        </select>
                                        
                                        
                                    </td>
                                </tr>-->
                               
                                <tr> 
                                    <?php if($j==1){?>
                                    <td><?= $row->baq_floor ?><input type="hidden" value="<?= $row->baq_floor ?>" name="floor"></td>
                                    <td><?= $row->baq_room ?><input type="hidden" value="<?= $row->baq_room ?>" name="area"></td>
                                    
                                    <td>
                                        <select class="form-control" name="modular_box">
                                            <option value="" style="display:none;">---Select---</option>
                                            <?php foreach($boqdata as $row){?>
                                                <option value="<?= $row->moduels ?>"<?php if($clientDetails->modular_box==$row->moduels){echo"selected";} ?>><?= $row->moduels ?></option>
                                            <?php } ?>
                                            
                                        </select> 
                                    </td>
                                    <td>
                                        <select class="form-control description" name="description">
                                            
                                            <option value="" style="display:none">---Select---</option>
                                            <?php foreach($description as $list){?>
                                                <option value="<?= $list->sub_f_name ?>"<?php if($clientDetails->description==$list->sub_f_name){echo"selected";} ?>><?= $list->sub_f_name ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </td>
                                    <td>
                                        <div class="create_text_box"></div>
                                        <?php $total = count(explode(',',($clientDetails->type_of_load)));
                                        
                                        $data = explode(',',($clientDetails->type_of_load));
                                        for($i=0; $i<$total; $i++){?>
                                            
                                            <input type="text" class="form-control" style="border-color:#696969" name="load_type[]" value="<?=$data[$i]?>"><br>
                                            
                                        <?php  } ?>
                                        
                                        
                                        
                                        
                                    </td>
                                    <td>
                                        <div class="total_load_input"></div>
                                        
                                        <?php $total = count(explode(',',($clientDetails->total_load)));
                                        
                                        $data = explode(',',($clientDetails->total_load));
                                        for($i=0; $i<$total; $i++){?>
                                            
                                            <input type="text" class="form-control" style="border-color:#696969" name="total_load[]" value="<?=$data[$i]?>"><br>
                                            
                                        <?php  } ?>
                                        
                                    </td>
                                    
                                    <td>
                                        <div class="add_new"></div>
                                         <?php $total = count(explode(',',($clientDetails->functions)));
                                        
                                        $data = explode(',',($clientDetails->functions)); 
                                        
                                        for($j=0; $j <$total; $j++){?>
                                        <select class="form-control" name="functions[]">
                                        <?php for($i=0; $i<$total; $i++){?>
                                            
                                           <option value="<?php $data[$i] ?>" <?php if($data[$j]==$data[$i]){echo"selected";}?>><?= $data[$i]?></option>
                                            
                                        <?php  } ?>
                                        </select><br>
                                        <?php } ?>
                                       
                                    </td>
                                    <td> <div class="remarks"></div>
                                    
                                        <?php $total = count(explode(',',($clientDetails->remark)));
                                        
                                        $data = explode(',',($clientDetails->remark));
                                        for($i=0; $i<$total; $i++){?>
                                            
                                           <input type="text" name="remarks[]" class="form-control" style="border-color:#696969" value="<?= $data[$i] ?>"><br>
                                            
                                        <?php  } ?>
                                    
                                    
                                    </td>
                                </tr>
                                <?php }$j++;} ?>
                        </tbody>
                    </table>
                    </div>
                  
                    <div class="form-group col-md-12 text-center"><br>
                    	    <?php if($clientDetails->is_approved==1){?>
                    	    
                    	     <button type="button" class="btn btn-success" disabled>Site audit has approved</button>
                    	    
                    	    <?php }else{?>
                    	    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#suggestedDate">Confirm</button>
                            <!--<button type="button" class="btn btn-success ">Edit</button>-->
                            <?php } ?>
                    </div>
                   </form>
                </div>
                
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
                                                    <input type="hidden" class="form-control" name="user" value="<?=$clientDetails->a_id ?>">
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
<!------------------------------>
<script>
    
    $(function(){
        
        $('.description').change(function(){
            
            var val = $(this).val();
            
            var html='';
            var html2='';
            var html3='';
            var new_field='';
            
            var  total = val.replace ( /[^\d.]/g, '' ); 
            
            //Get functions list
             $.ajax({
                    
                    url : '<?php echo base_url('Installationprocess/get_functions') ?>',
                    type:'POST',
                    success:function(data){
                        
                        var obj = JSON.parse(data);
                  
                        for(var i=0;  i < parseInt(total); i++){
                            
                            html +='<input type="text" class="form-control" style="border-color:#696969" name="load_type[]"><br>';
                            
                            html2 +='<input type="text" class="form-control" style="border-color:#696969" name="total_load[]"><br>';
                            
                            html3 +='<input type="text" name="remarks[]" class="form-control" style="border-color:#696969"><br>';
                            
                                    
                                         new_field +='<select class="form-control" name="functions[]">';
                                    
                                         new_field +='<option value="" style="display:none">---Select---</option>';
                                        
                                        for(var j=0; j < (obj.length); j++){
                                            
                                            new_field +='<option value="'+obj[j].item_name+'">'+obj[j].item_name+'</option>';
                                        }
                                    
                                    new_field +='</select><br>';
                        }
            
                        $('.create_text_box').html(html);
                        
                        $('.total_load_input').html(html2);
                        
                        $('.add_new').html(new_field);
                        
                        $('.remarks').html(html3);
                }
            
                });
        });
    });
    
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    
    function send_form_link(){
        
        var email       = $("#email").val();
        var customer_id = $("#customer_id").val();
        var user_id     = $("#user_id").val();
        
        swal({
            
              title: "Are you sure?",
              text: "Want to sent site audit sheet to this client!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  
                     $.ajax({
            
                        url : '<?php echo base_url('Installationprocess/send_site_audit_sheet') ?>',
                        type: 'POST',
                        data: {email:email,customer_id:customer_id,user_id:user_id},
                        success:function(data){
                            
                            swal("Mail sent successfully...", {
                              icon: "success",
                              
                            });
                            
                            
                        }
                        
                        
                    });
                  
               
              } 
        });
    }
    
</script>

<script>
    
    $(function(){
        
        $("#send_installation_date").submit(function(e){
            
            e.preventDefault();
            
            $.ajax({
                
                url : '<?php echo base_url('Installationprocess/suggested_date_for_installation')?>',
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



<script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/moment.js"></script>

 