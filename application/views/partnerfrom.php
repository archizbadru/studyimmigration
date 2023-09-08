<?php 
    if(!empty($nav1)){}else{$nav1='';}

?>

<div class="row form_align" style="margin-left:127px;margin-right:97;">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("user/channel_partner") ?>"> <i class="fa fa-list"></i>  Channel Patner </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-12">

                        <?php echo form_open_multipart('user/add_partner','class="form-inner" id="territory"') ?>

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
                                        <label for="description" ><?php echo display('partner_id') ?>  <i class="text-danger">*</i></label>
                                     <input type="text" id="name" class="form-control br_25  m-0 icon_left_input" name="employee_id" value="<?php  echo $department->employee_id; ?>" placeholder="<?php echo display('partner_id') ?>" required>
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Organisation Name <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="org_name" id="designation" value="<?= $department->orgisation_name ?>" placeholder="Organisation Name" required>
                                    
                                </div>
                                 
                                 <div class="form-group  col-md-4">
                                        <label for="description" class="col-form-label">First Name  <i class="text-danger">*</i></label>
                                         <input type="text" id="name" class="form-control br_25  m-0 icon_left_input" name="Name" value="<?php echo $department->s_display_name;?>" placeholder="First Name">
                                 </div>
                                 
                                 <div class="form-group  col-md-4">
                                        <label for="description" class="col-form-label">Last Name  <i class="text-default"></i></label>
                                         <input type="text" id="last_name" class="form-control br_25  m-0 icon_left_input" name="last_name" value="<?php echo $department->last_name;?>" placeholder="Last Name">
                                 </div>
                                 
                              
                               
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Primary Email</label>
                                     <input type="email" id="emailid" class="form-control br_25  m-0 icon_left_input" value="<?php echo $department->s_user_email; ?>"  placeholder="Primary Email" name="email">
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
                            
                                
                                <div class="form-group col-md-4">
                                    <label for="description">Date of birth <i class="text-danger">*</i></label>
                                    <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $department->date_of_birth;?>" required>
                                    
                                </div>
                                
                                 <div class="form-group col-md-4">
                                    <label for="description">Anniversary </label>
                                    <input name="anniversary" id="anniversary"  type="date" class="form-control"  value="<?php echo $department->anniversary;?>">
                                    
                                </div>
                                
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Address</label>
                                    <textarea class="form-control" id="address" rows="3" name="address"><?php echo $department->add_ress;?></textarea>
                                </div>
                                
                            </div>
                            
                            <div class="form-row">
                                
                              
                                
                                <div class="form-group col-md-4">
                                    <label>Blood Group <i class="text-danger">*</i></label>
                                    <select class="form-control" name="employee_band" id="employee_band" required>
                                        <option value="" style="display:none">---Select---</option>
                                        <option value="O +" <?php if($department->employee_band=='O +'){echo"selected";} ?>>O +</option>
                                        <option value="O -" <?php if($department->employee_band=='O -'){echo"selected";} ?>>O -</option>
                                        <option value="B +" <?php if($department->employee_band=='B +'){echo"selected";} ?>>B +</option>
                                        <option value="B -" <?php if($department->employee_band=='B -'){echo"selected";} ?>>B -</option>
                                        <option value="A +" <?php if($department->employee_band=='A +'){echo"selected";} ?>>A +</option>
                                        <option value="A -" <?php if($department->employee_band=='A -'){echo"selected";} ?>>A -</option>
                                        <option value="AB +" <?php if($department->employee_band=='AB +'){echo"selected";} ?>>AB +</option>
                                         <option value="AB -" <?php if($department->employee_band=='AB -'){echo"selected";} ?>>AB -</option>
                                    </select>
                                    
                                </div>
                                
                                <div class="form-group col-md-4">
                                     <label><?php echo display('country_name')?> <i class="text-danger">*</i></label>
                                     <select class="form-control" name="country" id="country">
                                       <option value="" style="display:none;">---Select country---</option>
                                  <?php  foreach($county_list as $c){
                                  if($c->id_c==$department->country){ ?>
                                   <option value="<?php echo $c->id_c; ?>" selected><?php echo $c->country_name; ?></option>
                                   <?php }else{ ?>
                                   <option value="<?php echo $c->id_c; ?>" ><?php echo $c->country_name; ?></option>
                                   <?php }} ?>
                                   </select>
                                    
                                </div>
                                
                            </div>
                            
                            <div class="form-row">
                                
                                  <div class="form-group col-md-4">
                                    <label><?php echo display('region_list')?> <i class="text-danger">*</i></label>
                                     <select class="form-control" name="region" id="region" >
                                            
                                            <?php foreach($region_list as $region){
                                            if($region->region_id==$department->region){?>
                                                
                                                <option value="<?=$region->region_id ?>" selected><?=$region->region_name ?></option>
                                               <?php }else{ ?>
                                               <option value="<?=$region->region_id ?>" ><?=$region->region_name ?></option>
                                            <?php }} ?>
                                            
                                     </select>
                                    
                                </div>
                                
                                
                                
                                <div class="form-group col-md-4">
                                    
                                    <label><?php echo display('state_name')?> <i class="text-danger">*</i></label>
                                     <!--<select class="form-control" name="state_id" id="state_id" onchange="find_city()" >
                                       <option value="" style="display:none">---Select State---</option>
                                  <?php  foreach($state_list as $c){ ?>
                                   <option value="<?php echo $c->id; ?>" ><?php echo $c->state; ?></option>
                                   <?php } ?>
                                   </select>-->
                                   
                                   <select class="form-control state_id" name="state_id" id="state_id">
                                       
                                       <?php foreach($state_list as $state){?>
                                       
                                            <option value="<?= $state->id?>" <?php if($state->id==$department->state_id){echo 'selected';} ?>><?=$state->state ?></option>
                                       
                                       <?php } ?>
                                       
                                       
                                   </select>
                                   
                                </div>
                                
                                <div class="form-group col-md-4">
                                       <label  class="col-form-label"><?php echo display('territory_name')?> <i class="text-danger">*</i></label>
                                       
                                      <!--<select class="form-control" name="territory" id="territory" >
                                       <option value="" style="display:none">---Select Territory---</option>
                                  <?php  foreach($state_list as $c){ ?>
                                   <option value="<?php echo $c->id; ?>" ><?php echo $c->state; ?></option>
                                   <?php } ?>
                                   </select>-->
                                   
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
                                
                                 <div class="form-group col-md-4">
                                     <label><?php echo display('user_function') ?><i class="text-danger">*</i></label>
                                     <select name='user_type' class="form-control" required>
                						<option value='' style="display:none;">---Select User Rights----</option>
                						<?php foreach($user_role as $r){?>
                						 <option value="<?php echo $r->use_id; ?>" <?php if($department->user_type==$r->use_id){echo "selected";}?>><?php echo $r->user_role; ?></option>
                                       <?php } ?>
            						</select>
                                </div>
                                <div class="form-group col-md-4">
                                     <label>Channel Partner Profile <i class="text-danger">*</i></label>
                                     <select class="form-control" name="channel_ptnr_types"  required>
                                        <option value="" style="display:none">---Channel Partner Profile---</option>
                                        <?php foreach($channel_p_type as $rows){?>
                                        
                                            <option value="<?= $rows->ch_id ?>" <?php if($department->partner_type==$rows->ch_id){echo "selected";}?>><?= $rows->channel_partner_type ?></option>
                                        
                                        <?php } ?>
                                        
                                        
                                        </select>
                                </div>
                                
                                <div class="form-group col-md-4">
                                     <label>Channel Partner Type <i class="text-danger">*</i></label>
                                     <select class="form-control" name="channel_ptnr_typ"  required>
                                        <option value="" style="display:none">---Channel Partner Type---</option>
                                        <?php foreach($type_list as $rows){?>
                                        
                                            <option value="<?= $rows->p_tid ?>" <?php if($department->p_type==$rows->p_tid){echo "selected";}?>><?= $rows->type ?></option>
                                        
                                        <?php } ?>
                                        
                                        
                                        </select>
                                </div>
                                
            						<input type="hidden"  name='user_role' value="9" >
                            </div>
                            
                            <div class="form-row">
                                
                                <div class="form-group col-md-4" style="display:none;">
                                    
                                    <label>Report to</label>
                                    <select class="form-control" name="report_to">
                                        <option value="" style="display:none;">---Select---</option>
                                        <?php foreach($user_list as $user){?>
                                        
                                            <option value="<?= $user->pk_i_admin_id ?>" <?php if($user->pk_i_admin_id==$department->report_to){echo 'selected';}?>><?= $user->s_display_name." ".$user->last_name ?></option>
                                        
                                        <?php } ?>
                                    </select>
                                    
                                </div>
                                
                                 <div class="form-group col-md-12">
                                     <h1>Contact Person Details</h1>
                                         
                                </div>
                                 
                                 
                                  <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Contact Person</label>
                                     <input type="text"  class="form-control br_25  m-0 icon_left_input" value="<?php echo $department->contact_pname; ?>"  placeholder="Contact Person" name="cname">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Primary Email</label>
                                     <input type="email" class="form-control br_25  m-0 icon_left_input" value="<?php echo $department->contact_pemail; ?>"  placeholder="Primary Email" name="cemail">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Secondary Email</label>
                                   <input type="email"  class="form-control br_25  m-0 icon_left_input" value="<?php echo $department->contact_semail; ?>"  placeholder="Secondary Email" name="csemail">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Primary Phone Number</label>
                                     <input type="text" pattern="[0-9]{10}"  maxlength="10" class="form-control br_25  m-0 icon_left_input" value="<?php echo $department->contact_phone; ?>"  placeholder="Primary Phone Number" name="cphone">
                                </div>
                                 <div class="form-group col-md-4">
                                    <label for="exampleFormControlTextarea1">Secondary Phone Number</label>
                                     <input type="text" pattern="[0-9]{10}" maxlength="10"  class="form-control br_25  m-0 icon_left_input" value="<?php echo $department->contact_sphone; ?>"  placeholder="Secondary Phone Number" name="csphone">
                                </div>
                                
                                
                               
                                <input type="hidden" id="password" class="form-control br_25  m-0 icon_left_input" name="old_pass" placeholder="Password"  value="<?php echo $department->s_password; ?>" >
                                       
                                
                                
                                <div class="form-group col-md-4">
                                    
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
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
           $('#new_pass, #c_pass').on('keyup', function () {
  if ($('#new_pass').val() == $('#c_pass').val()) {
    $('#password_error').html('Matching').css('color', 'green');
  } else 
    $('#password_error').html('Not Matching').css('color', 'red');
});
        </script>
        
        <script type="text/javascript">
            function find_teretory() {
       
                       $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>location/get_tretory_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('territory_id').innerHTML=data;
            }else{
              document.getElementById('territory_id').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
        </script>
         <script type="text/javascript">
            function find_state() {
       
                       $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>location/get_state_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('state_id').innerHTML=data;
            }else{
              document.getElementById('state_id').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
        </script>
         <script type="text/javascript">
            function find_city() {
       
                       $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>location/get_city_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('city_name').innerHTML=data;
            }else{
              document.getElementById('city_name').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
        </script>
        
        <script>
            $(function(){
                
                $("#country").change(function(){
                    
                    var country = $(this).val();
                    var html = '';
                    
                    $.ajax({
                        
                        url :'<?php echo base_url('Location/find_region') ?>',
                        type:'POST',
                        data:{country:country},
                        
                        success:function(data){
                            
                           var obj = JSON.parse(data);
                           
                            html +='<option value="" style="display:none">---Select Region---</option>';
                            
                            for(var i=0; i < (obj.length); i++){
                                
                                html +='<option value="'+obj[i].region_id+'">'+obj[i].region_name+'</option>';
                            }
                            $("#region").html(html);
                        }
                        
                        
                    });
                    
                });
                
                
                //Get region 
                $("#region").change(function(){
                    
                    var region_id = $(this).val();
                    
                    var html1 ='';
                    
                    $.ajax({
                        
                        url : '<?php echo base_url('Location/select_state_by_region') ?>',
                        type: 'POST',
                        data:{region_id:region_id},
                        success:function(data){
                            
                            var obj = JSON.parse(data);
                            
                            if(obj.lenght==0){
                                
                                console.log('NOT data found');
                                
                            }else{
                                
                                html1 +='<option value="" style="display:none">---Select State---</option>';
                            
                                for(var i=0; i < (obj.length); i++){
                                    
                                    html1 +='<option value="'+obj[i].id+'">'+obj[i].state+'</option>';
                                }
                                
                                $(".state_id").html(html1);
                                
                            }
                            
                           
                            
                        }
                        
                        
                    });
                    
                });
                
                //Get State according to region..
                
                
                //Find state base on territory
                $(".state_id").change(function(){
                    
                    var state_id = $(this).val();
                    var html='';
                    
                    $.ajax({
                        
                        url : '<?php echo base_url('Location/select_territory_by_state') ?>',
                        type: 'POST',
                        data: {state_id:state_id},
                        success:function(data){
                            
                            var obj = JSON.parse(data); 
                            
                            html +='<option value="" style="display:none">---Select Territory---</option>';
                            
                             for(var i=0; i < (obj.length); i++){
                                
                                 html +='<option value="'+obj[i].territory_id+'">'+obj[i].territory_name+'</option>';
                            }
                            
                            $('.territory').html(html);
                            
                            //console.log(data);
                        }
                        
                        
                    });
                    
                });
                
                //Find City based on territory....
                $(".territory").change(function(){
                    
                    var territory_id = $(this).val();
                    var html='';
                    
                    $.ajax({
                        
                        url : '<?php echo base_url('Location/select_city') ?>',
                        type: 'POST',
                        data: {territory_id:territory_id},
                        success:function(data){
                            
                            var obj = JSON.parse(data); 
                            
                            html +='<option value="" style="display:none">---Select City---</option>';
                            
                             for(var i=0; i < (obj.length); i++){
                                
                                 html +='<option value="'+obj[i].id+'">'+obj[i].city+'</option>';
                            }
                            
                            $('.city_name').html(html);
                            
                            //console.log(data);
                        }
                        
                        
                    });
                    
                });
                
            });
            
        </script>
        
        
        
        