  <?php
  define('FIRST_NAME',1);
  define('LAST_NAME',2);
  define('GENDER',3);
  define('MOBILE',4);
  define('EMAIL',5);
  define('COMPANY',6);
  define('LEAD_SOURCE',7);
  define('PRODUCT_FIELD',8);
  define('STATE_FIELD',9);
  define('CITY_FIELD',10);
  define('ADDRESS_FIELD',11);  

  ?>
                
                  <div class="row">
                    <?php                    
                    if(is_active_field(FIRST_NAME)){
                    ?>
                     <div class="form-group col-sm-4">
                        <label>First Name <i class="text-danger">*</i> </label>
                        <div class = "input-group">
                           <span class = "input-group-addon" style="padding:0px !important;border:0px !important;width:44%;">
                              <select class="form-control" name="name_prefix">
                                 <?php foreach($name_prefix as $n_prefix){?>
                                 <option value="<?= $n_prefix->prefix ?>" <?php if($n_prefix->prefix==$details->name_prefix){ echo 'selected';} ?>><?= $n_prefix->prefix ?></option>
                                 <?php } ?>
                              </select>
                           </span>
                           <input class="form-control" name="enquirername" type="text" value="<?php echo $details->name ?>" placeholder="Enter First Name" style="width:100%;" />
                        </div>
                     </div>
                   <?php }?>
                   <?php
                    if(is_active_field(LAST_NAME)){
                    ?>
                     <div class="form-group col-sm-4"> 
                        <label>Last Name <i class="text-danger">*</i></label>
                        <input class="form-control" value="<?php echo $details->lastname ?>" name="lastname" type="text" placeholder="Last Name" >  
                     </div>
                    <?php }?>
                     <?php
                    if(is_active_field(MOBILE)){
                    ?>
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display('mobile') ?></label>
                        <input class="form-control" name="mobileno" type="text" maxlength='10' value="<?php echo $details->phone ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                        <i class="fa fa-plus" onclick="add_more_phone('add_more_phone')" style="float:right;margin-top:-25px;margin-right:10px;color:red"></i>
                     </div>
                   <?php }?>
                   </div>
                   <div class="row">
                     <?php
                    if(is_active_field(MOBILE)){
                    ?>
                      <div id="add_more_phone">
                        <?php
                        if (!empty($details->other_phone)) {
                          $other_phones = explode(',', $details->other_phone);
                          foreach ($other_phones as $k=>$p) { ?>
                            <div class="form-group col-sm-4">
                              <label>Other No </label>
                              <input class="form-control"  name="other_no[]" type="text" placeholder="Other Number" value="<?=$p?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>                            
                          <?php
                          }
                        }
                        ?>
                      </div>
                      <?php }?>                     
                   </div>
                  <div class="row">
                        <?php
                    if(is_active_field(EMAIL)){
                    ?>
                     
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display('email') ?></label>
                        <input class="form-control" name="email" type="email" value="<?php echo $details->email ?>">  
                     </div>
                    <?php }?>
					           
 <?php
                    if(is_active_field(PRODUCT_FIELD)){
                    ?>
					         <div class="form-group col-sm-4">
                        <label>Product</label>
                        <select class="form-control" name="sub_source" id="sub_source">
                           <option value="" style="display:none;">---Select---</option>
                           <?php foreach ($product_contry as $subsource){ ?>
                           <option value="<?= $subsource->id?>" <?php if($subsource->id==$enquiry->enquiry_subsource){ echo 'selected';}?>><?= $subsource->country_name?></option>
                           <?php } ?>
                        </select>
                     </div>
<?php }?>
                         <?php
                    if(is_active_field(LEAD_SOURCE)){
                    ?> 
                     <div class="form-group   col-sm-4">
                        <label><?php echo display('lead_source') ?></label>
                        <select class="form-control" name="lead_source" id="lead_source" onchange="find_sub()">
                           <option value="">---Select---</option>
                           <?php 
                              foreach ($leadsource as $post){?>
                           <option value="<?= $post->lsid?>" <?php if($details->enquiry_source==$post->lsid){echo 'selected';}?>><?= $post->lead_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                    <?php }?>

                   </div>
                   <div class="row">
                
                     <?php
                    if(is_active_field(STATE_FIELD)){
                    ?>  
                     <div class="form-group col-sm-4">
                        <label>State <i class="text-danger"></i></label>                        
                        <select name="state_id" class="form-control" id="fstate">
                           <option value="" style="display:none;">Select</option>
                           <?php foreach($state_list as $state){                           
                           ?>
                           <option value="<?php echo $state->id ?>" <?php if(!empty($state_list)){ if($state->id == $details->enquiry_state_id){echo 'selected';} }?>><?php echo $state->state; ?></option>
                           <?php } ?>
                        </select>
                     </div>   
                     <?php }?>
                     <?php
                    if(is_active_field(CITY_FIELD)){
                    ?>                   
                      <div class="form-group col-sm-4">
                        <label>City <i class="text-danger"></i></label>
                        <select name="city_id" class="form-control" id="fcity">
                          <?php
                          foreach ($state_city_list as $value) { ?>
                           <!-- <option value="" style="display:none;">Select</option> -->
                           <option value="<?=$value->id?>" <?php if($details->enquiry_city_id == $value->id) echo "selected = selected";?>><?=$value->city;?></option>
                           <?php                           
                          }
                          ?>                       
                        </select>
                     </div>
                   <?php }?>
                         <?php
                    if(is_active_field(COMPANY)){
                    ?>
                     <div class="form-group col-sm-4">
                        <label><?php echo display('company_name') ?> <i class="text-danger">*</i></label>
                        <input class="form-control" name="company" type="company" value="<?php echo $details->company; ?>">
                     </div>
                   <?php }?>
                   </div>
                    <div class="row">
                
                   <?php
                    if(is_active_field(ADDRESS_FIELD)){
                    ?>  
                     <div class="form-group col-sm-4">
                        <label><?php echo display('address') ?> <i class="text-danger">*</i></label>
                        <input class="form-control" name="address" type="address" value="<?php echo $details->address; ?>">
                     </div>
                   <?php }?>
                     <div class="form-group col-sm-4"> 
                        <label><?=display('remark')?></label>
                        <textarea class="form-control" name="enquiry"><?php echo $details->enquiry; ?></textarea>
                     </div>
                      <div class="form-group col-sm-4">
                        <label>Preferred Country <i class="text-danger">*</i></label>
                        <?php                      
                        /*echo "<pre>";     
                        print_r($details);
                        echo "</pre>";  */   

                          $current_country  = $details->enq_country;             
                          $current_country = explode(',',$current_country);                        
                        ?>
                        <select name="country_id[]" class="form-control">
                           <?php foreach($all_country_list as $product){ ?>
                           <option value="<?=$product->id_c?>" <?php if(in_array($product->id_c,$current_country)) echo "selected = selected"; ?>><?=$product->country_name ?></option>
                           <?php } ?>
                        </select>
                     
                    </div>
                    </div>