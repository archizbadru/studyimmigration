<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<div class="col-md-1"></div>
<div class="col-md-9 " style="margin-left:63px;">
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
                        
                    <?php 
                        
                       if ($link_sent==1 || $link_sent ==2){
                           
                           $dis = 'none';
                           $d   = 'block';
                           
                       }else{
                           
                           $dis = 'block';
                           $d   = 'none';
                       }
                  
                    ?>
                   <div class="col-md-12 text-center" style="display:<?=$d ?>"><h3 style="color:green">Thank you!! your site audit report has successfully submitted</h3></div>
                
                <div style="display:<?= $dis ?>">
                <!-- Site Audit Form --->
                <form action="<?php echo base_url('Installationprocess/submit_site_audit_report_by_client') ?>" class="form-inner " id="MyForm" method="post" accept-charset="utf-8">
                    
                    	<div class="form-group col-md-3">
                    	    <label>Report no.</label>
                    	  <input class="form-control" name="report_no" type="text" value="" required>
                    	  
                    	  <input class="form-control" name="customer_id" type="hidden" value="<?= $clientDetails->cli_id ?>">
                    	</div>
                    	<input type="hidden" name="user_id" id="user_id" value="<?=$clientDetails->cli_id ?> ">
                    	<div class="form-group col-md-3">
                    	    <label>Date</label>
                    	  <input class="form-control date" id="r_date" name="date" type="date"  required>
                    	</div>
                    	
                        <div class="form-group col-md-3">
                    	    <label>Customer Name</label>
                    	  <input class="form-control" name="customer_name" type="text" value="<?= $clientDetails->cl_name?>" readonly="">
                    	</div>
                    	
                    	<div class="form-group col-md-3">
                    	    <label>Client ID</label>
                    	  <input class="form-control" name="client_id" type="text" value="<?= $clientDetails->customer_code?>" readonly>
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
                        	    <input type="text" class="form-control" name="sale_exc">
                        	</div>
                        	
                        	<div class="form-group col-md-3">
                        	    <label>Pre-sales Executive</label>
                        	    <input type="text" class="form-control" name="pre_sale_exc">
                        	</div>
                        	
                        	<div class="form-group col-md-3">
                        	    <label>Installation Engineer</label>
                        	    <input type="text" class="form-control" name="installation_eng">
                        	</div>
                        	
                        	<div class="form-group col-md-3">
                        	    <label>Type of site</label>
                        	    <select class="form-control" name="resident_type">
                        	        <option value="" style="display:none;">Select...</option>
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
                                                <option value="<?= $row->moduels ?>"><?= $row->moduels ?></option>
                                            <?php } ?>
                                            
                                        </select> 
                                    </td>
                                    <td>
                                        <select class="form-control description" name="description">
                                            
                                            <option value="" style="display:none">---Select---</option>
                                            <?php foreach($description as $list){?>
                                                <option value="<?= $list->sub_f_name ?>"><?= $list->sub_f_name ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </td>
                                    <td>
                                        <div class="create_text_box">
                                            
                                        </div>
                                    </td>
                                    <td>
                                        <div class="total_load_input">
                                            
                                        </div>
                                    </td>
                                    <td>
                                        
                                        <div class="add_new"></div>
                                    </td>
                                    
                                    <td> 
                                        <div class="remarks"></div>
                                    </td>
                                </tr>
                                <?php }$j++;} ?>
                        </tbody>
                    </table>
                    </div>
                  
                    <div class="form-group col-md-12 text-center"><br>
                    	  
                    	    <button type="submit" class="btn btn-success">Submit</button>
                            <!--<button type="button" class="btn btn-success ">Edit</button>-->
                    </div>
                   </form></div>
                </div>
                
        </div>
        
        </div>
        
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