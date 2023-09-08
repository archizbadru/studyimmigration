<style type="text/css"> 
.custom-form-control
{
    border-radius: 15px;
    box-shadow: none;
    border: 1px solid #e4e5e7;
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none
}
</style>
<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary tab_list" data-t="" data-id="<?php echo base_url(); ?>api/whatsapp/a" > <i class="fa fa-list"></i>  <?php echo display('profile') ?> </a>  
                    &nbsp;<a class="btn btn-primary tab_list" data-t="1" data-id="<?php echo base_url(); ?>api/whatsapp/get_list" data-i="<?php echo display('sms_transaction_detail'); ?>"> <i class="fa fa-comments"></i>  <?php echo display('sms_transaction_detail'); ?> </a>  
                    &nbsp;<a class="btn btn-primary tab_list" data-t="2" data-id="<?php echo base_url(); ?>api/whatsapp/get_list" data-i="<?php echo display('whatapp_transaction_detail'); ?>"> <i class="fa fa-whatsapp"></i>  <?php echo display('whatapp_transaction_detail'); ?> </a>  
                    &nbsp;<a class="btn btn-primary tab_list" data-t="3" data-id="<?php echo base_url(); ?>api/whatsapp/get_list" data-i="<?php echo display('email_transaction_detail'); ?>"> <i class="fa fa-envelope"></i>  <?php echo display('email_transaction_detail'); ?> </a>  
                    &nbsp;<a class="btn btn-primary tab_list" data-t="4" data-id="<?php echo base_url(); ?>api/whatsapp/get_list" data-i="<?php echo display('telephony_transaction_detail'); ?>"> <i class="fa fa-phone"></i> <?php echo display('telephony_transaction_detail'); ?> </a>  
                </div>
            </div> 
            <div class="panel-body panel-form">
                <div class="row" id="tab1">
				<div class="col-md-12">
				<?php echo form_open_multipart('dashboard/form/','class="form-inner" id="territory"') ?>
				<?php echo form_hidden('dprt_id',$department->pk_i_admin_id) ?>
				<div class="form-row">
				<?php if(!empty($department->picture)){?>
				<div class="col-sm-4" align="center"> 
                                <img alt="Picture" src="<?php echo (!empty($department->picture)?base_url($department->picture):base_url("assets/images/no-img.png")) ?>" id="picture" width="150" height="150">
                                  <input class="form-control" name="file" type="file" id="file" value="<?= $department->picture ?>" onchange="document.getElementById('picture').src = window.URL.createObjectURL(this.files[0])">
                                    <input type="hidden" name="new_file" value="<?= $department->picture ?>" class="form-control" >
                                <h3>
								</h3>
                            </div>
                                <?php }else{ ?>
                                <div class="col-sm-4" align="center"> 
                                <img alt="Picture" src="<?php echo (!empty($department->picture)?base_url($department->picture):base_url("assets/images/no-img.png")) ?>" id="picture" width="150" height="150">
                                  <input class="form-control" name="file" type="file" id="file" value="<?= $department->picture ?>" onchange="document.getElementById('picture').src = window.URL.createObjectURL(this.files[0])">
                                    <input type="hidden" name="new_file" value="<?= $department->picture ?>" class="form-control" >
                                <h3>
                                </h3>
                            </div>
                                <?php } ?>
								<div class="form-group col-md-4">
                                        <label for="description" ><?php echo display('employee_id') ?>  <i class="text-danger">*</i></label>
                                     <input type="text" id="name" class="form-control br_25  m-0 icon_left_input" name="employee_id" value="<?php  if(!empty($enq_id)){ echo $enq_id; }else{echo $department->employee_id;} ?>" placeholder="<?php echo display('employee_id') ?>" readonly>
                                 </div>
                                 <?php if($this->session->user_id==9){?>
                                 <div class="form-group col-md-4">
                                    <label>Organisation Name <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="org_name" id="designation" value="<?= $department->orgisation_name ?>" placeholder="Organisation Name" required>
									</div>
                                 <?php }else{ ?>
                                 <div class="form-group col-md-4">
                                    <label>Designation<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="designation" id="designation" value="<?= $department->designation ?>" placeholde="Designation" required>
                                 </div>
                                <?php } ?>
                                 <div class="form-group  col-md-4">
                                        <label for="description" class="col-form-label">First Name  <i class="text-danger">*</i></label>
                                        <input type="text" id="name" class="form-control br_25  m-0 icon_left_input" name="Name" value="<?php echo $department->s_display_name;?>" placeholder="First Name">
                                 </div>
								 <div class="form-group  col-md-4">
                                        <label for="description" class="col-form-label">Last Name  <i class="text-default"></i></label>
                                        <input type="text" id="last_name" class="form-control br_25  m-0 icon_left_input" name="last_name" value="<?php echo $department->last_name;?>" placeholder="Last Name">
                                 </div>
                               <div class="form-group col-md-4">
                                <label for="description">Primary Email <i class="text-danger">*</i></label>
                                   <input type="email" id="emailid" class="form-control br_25  m-0 icon_left_input" value="<?php echo $department->s_user_email; ?>"  placeholder="Email" name="email" readonly>
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Secondary Email</label>
                                   <input type="email" id="emailid" class="form-control br_25  m-0 icon_left_input" value="<?php echo $department->second_email; ?>"  placeholder="Secondary Email" name="second_email">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Primary Phone Number</label>
                               <input type="text" id="mobile" pattern="[0-9]{10}" class="form-control br_25  m-0 icon_left_input" maxlength="10"  placeholder="Primary Phone Number" value="<?php echo $department->s_phoneno; ?>" name="cell">
                               </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Secondary Phone Number</label>
                                    <input type="text" id="mobile" pattern="[0-9]{10}" class="form-control br_25  m-0 icon_left_input" maxlength="10"  placeholder="Secondary Phone Number" value="<?php echo $department->second_phone; ?>" name="second_phone">
                               </div>
                                 <?php 	if (empty($department->pk_i_admin_id)) { ?>
                                <div class="form-group col-md-4">
                                     <label for="description"><?php echo display('password') ?>  <i class="text-danger">*</i></label>
                                     <input type="password" id="password" class="form-control br_25  m-0 icon_left_input" name="password" placeholder="Password" >
                                </div>
                                 <?php 	}?>
                            </div>
                            <div class="form-row">

                                

                                <div class="form-group col-md-4">

                                    <label for="description">Date of birth <i class="text-danger">*</i></label>

                                    <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $department->date_of_birth;?>" required>

                                    

                                </div>

                                


                                 <div class="form-group col-md-4">

                                    <label for="exampleFormControlTextarea1">Address</label>

                                    <textarea class="custom-form-control" id="address" name="address"><?php echo $department->add_ress;?></textarea>

                                </div>

                                

                            </div>

                            

                            <div class="form-row">

                                
                                <div class="form-group col-md-4">

                                     <label><?php echo display('country_name')?> <i class="text-danger">*</i></label>

                                     <select class="form-control" name="country" id="country">

                                       <option value="" style="display:none;">---Select country---</option>

                                  <?php  foreach($county_list as $c){ ?>

                                   <option value="<?php echo $c->id_c; ?>" <?php if($c->id_c==$department->country){echo 'selected';}?>><?php echo $c->country_name; ?></option>

                                   <?php } ?>

                                   </select>

                                    

                                </div>

                                

                            </div>

                            

                            <div class="form-row">

                                

                                  <div class="form-group col-md-4">

                                    <label><?php echo display('region_list')?> <i class="text-danger">*</i></label>

                                     <select class="form-control" name="region" id="region" >

                                            

                                            <?php foreach($region_list as $region){?>

                                                

                                                <option value="<?=$region->region_id ?>" <?php if($region->region_id==$department->region){echo 'selected';} ?>><?=$region->region_name ?></option>

                                                

                                            <?php } ?>

                                            

                                     </select>

                                    

                                </div>

                                

                                

                                

                                <div class="form-group col-md-4">
                                    <label><?php echo display('state_name')?> <i class="text-danger">*</i></label>

                                   <select class="form-control state_id" name="state_id" id="state_id">

                                       

                                       <?php foreach($state_list as $state){?>

                                       

                                            <option value="<?= $state->id?>" <?php if($state->id==$department->state_id){echo 'selected';} ?>><?=$state->state ?></option>

                                       

                                       <?php } ?>

                                       

                                       

                                   </select>

                                   

                                </div>

                                

                                <div class="form-group col-md-4">

                                       <label  class="col-form-label"><?php echo display('territory_name')?> <i class="text-danger">*</i></label>
                                       <select class="form-control territory" name="territory" id="territory">

                                       

                                       <?php foreach($territory_lsit as $territory){?>

                                       

                                            <option value="<?= $territory->territory_id ?>" <?php if($territory->territory_id==$department->territory_name){echo 'selected';} ?>><?=$territory->territory_name ?></option>

                                       

                                       <?php } ?>

                                       

                                   </select>

                                    

                                    

                                </div>

                                

                            </div>

                            

                            <div class="form-row">

                                

                                 <div class="form-group col-md-4">

                                     <label><?php echo display('city_name')?> <i class="text-danger">*</i></label>

                                    <select class="form-control city_name" name="city_name" id="city_name" required>

                                        

                                        <?php foreach($city_list as $city){?>

                                        

                                            <option value="<?= $city->id?>" <?php if($city->id==$department->city_id){echo 'selected';} ?>><?= $city->city ?></option>

                                        

                                        <?php } ?>

                                  

                                   </select>

                                    

                                </div>

                                

                                 <div class="form-group col-md-4" style="display:none">

                                     <label><?php echo display('user_function') ?><i class="text-danger">*</i></label>

                                     <select name='user_type' class="form-control" >

                						<option value='' style="display:none;">---Select User Type----</option>

                						<?php foreach($user_role as $r){?>

                						 <option value="<?php echo $r->use_id; ?>" <?php if($department->user_type==$r->use_id){echo "selected";}?>><?php echo $r->user_role; ?></option>

                                       <?php } ?>

            						</select>

                                </div>

                                

                                

                                <div class="form-group col-md-4"  style="display:none">

                                    <label>User Hierarchy <i class="text-danger">*</i></label>

                                    <select name='user_role' class="form-control" >

                						<option value='' style="display:none;">---Select User Type---</option>

                						<option value='2' <?php if($department->user_roles==2){echo "selected";}?>>Admin</option>

                                        <option value='3' <?php if($department->user_roles==3){echo "selected";}?>>Country Head</option>

                                        <option value='4' <?php if($department->user_roles==4){echo "selected";}?>>Region Head</option>

                                        <option value='5' <?php if($department->user_roles==5){echo "selected";}?>>State Head</option>

                                        <option value='6' <?php if($department->user_roles==6){echo "selected";}?>>Territory Head </option>

                                        <option value='7' <?php if($department->user_roles==7){echo "selected";}?>>City Head </option>

                                        <option value='8' <?php if($department->user_roles==8){echo "selected";}?>>User</option>

                                        <option value='9' <?php if($department->user_roles==9){echo "selected";}?>>Channel Partner</option>

            						</select>

                                </div>
								</div>
							<div class="form-row">
							<div class="form-group col-md-4"  style="display:none">
								<label>Report to</label>
                                    <select class="form-control" name="report_to" >
                                        <option value="" style="display:none;">---Select---</option>
                                        <?php foreach($user_list as $user){?>
										<option value="<?= $user->pk_i_admin_id ?>" <?php if($user->pk_i_admin_id==$department->report_to){echo 'selected';}?>><?= $user->s_display_name." ".$user->last_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php if (!empty($department->pk_i_admin_id)) { ?>
                                <input type="hidden" id="password" class="form-control br_25  m-0 icon_left_input" name="old_pass" placeholder="Password"  value="<?php echo $department->s_password; ?>" >
                                 <?php 	}?>
                                <div class="form-group col-md-4" style="display:none;">
								<label><?php echo display('status') ?></label>
                                     <div class="form-check">
                                        <label class="radio-inline"><input type="radio" name="status" value="1" <?php if($department->b_status==1){echo 'checked';}?>><?php echo display('active') ?></label>

                                        <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($department->b_status==0){echo 'checked';}?> ><?php echo display('inactive') ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-12 text-center">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close() ?>
                       </div>
                </div>
				 <div id="tab2" style="display: none;">
                 <table class="table table-bordered table-hover mobile-optimised" style="width:100%;">
  <caption class="text-center" id="sms_heading"></caption>
  <thead>
    <tr>
      <th>S.NO</th>
      <th>Qty</th>
	  <th>Price/Qty</th>
	  <th>Amount</th>
	   <th>Expiry Date</th>
	   <th>Added Date</th>
	    <th>Added By </th>
    </tr>
  </thead>
  <tbody id="tBody"></tbody>
</table>
                </div>
				      
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
         $(".tab_list").click(function(){
		  $(this).removeClass('active'); 
          var url = $(this).attr("data-id");
		  var type = $(this).attr("data-t");
		  var ti = $(this).attr("data-i");
		  if(url=="<?php echo base_url(); ?>api/whatsapp/a"){
				$('#tab2').hide();
			    $('#tab1').show();  
		  }else{
		  
          $.ajax({
			type: 'POST',
			url: url,
			data:{"type":type},
			success: function(data){
			$(this).addClass('active');
			$('#tab1').hide();	
			$('#sms_heading').html("<h1>"+ti+"</h1>");	
			$('#tab2').show();
			     var trHTML = '';
				 //var obj  =$.parseJSON(data);
				 console.log(data.message);
                        $.each(data.message, function (i, userData) {
							var t=i+1;
                                trHTML +=
                                    '<tr><td>'
                                    + t
                                    + '</td><td>'
                                    + userData.qty
                                    + '</td><td>'
                                    + userData.price 
                                    + '</td><td>'
                                    + userData.total_amt
                                    + '</td><td>'
                                    + userData.expiry_date
                                    + '</td><td>'
                                    + userData.created_date 
                                    + '</td><td>'
                                    + userData.created_by_name 
                                    + '</td></tr>';
                            
                        });
                        $('#tBody').html(trHTML);
			}
			});
		  }
       });
    })
 </script>

 