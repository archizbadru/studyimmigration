<style>
   label{         
   font-weight:bold;
   font-size:13px;
   }
  
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

</style>
<div class="col-md-1"></div>
<div class="col-sm-10">
   <div  class="panel panel-default thumbnail">
      <div class="panel-heading no-print">
         <div class="btn-group"> 
       <a class="btn btn-primary" href="<?php echo base_url("enquiry") ?>"> <i class="fa fa-list"></i>&nbsp;<?php echo display("enquiry"); ?></a>  
         </div>
      </div>
      <div class="panel-body panel-form">
         <div class="row">
            <div class="col-md-12 col-sm-12">        
               <form class="form-inner" action="<?php echo base_url()?>enquiry/create" id="enquery_from" method="POST">
                  <div id="error" class='btn btn-danger form-group col-sm-12'style="display:none;text-align:left"></div>
                  <div id="success" class='btn btn-success form-group col-sm-12' style="display:none;text-align:left"></div>
                  <?php
                  if(user_access(230) || user_access(231) || user_access(232) || user_access(233) || user_access(234) || user_access(235) || user_access(236)){ ?>
                  <div class="row">
                    <div class="form-group col-sm-4"></div>
                      <div class="form-group col-sm-4">
                        <label> <?php echo display("proccess"); ?> <i class="text-danger"></i></label>
                        <select name="product_id" class="form-control">
                           <option value="" style="display:none;">Select</option>
                           <?php foreach($products as $product){?>
                           <option value="<?=$product->sb_id ?>" <?php if (in_array($product->sb_id, $this->session->process)) { echo "selected"; }?> ><?=$product->product_name ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <?php
                  }
                  ?>
                  <div class="row">
                    <?php                    
                    if(is_active_field(FIRST_NAME)){
                    ?>
                     <div class="form-group col-sm-4">
                        <label> <?php echo display("first_name"); ?> <i class="text-danger"></i> </label>
                        <div class = "input-group" >
                           <span class="input-group-addon" style="padding:0px!important;border:0px!important;width:28%;">
                              <select class="form-control" name="name_prefix">
                                 <?php foreach($name_prefix as $n_prefix){?>
                                 <option value="<?= $n_prefix->prefix ?>"><?= $n_prefix->prefix ?></option>
                                 <?php } ?>
                              </select>
                           </span>
                           <input class="form-control" name="enquirername" type="text" value="<?php  echo set_value('enquirername');?>" placeholder="Enter First Name" style="width:100%;"/>
                        </div>
                     </div>
                     <?php
                   }
                   ?>
                    <?php
                    if(is_active_field(LAST_NAME)){
                    ?>
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display("last_name"); ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('lastname');?>" name="lastname" type="text" placeholder="Last Name">  
                     </div>
                     <?php
                   }
                   ?>
                   <?php
                    if(is_active_field(GENDER)){
                    ?>
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display("gender"); ?><i class="text-danger"></i></label>
                         <select name="gender" class="form-control">
                           <option value="">---Select---</option>
                           <option value="1"><?php echo display("male"); ?></option>
                           <option value="2"><?php echo display("female"); ?></option>
                           <option value="3"><?php echo display("other"); ?></option>
                         </select>                           
                     </div>
                  <?php
                   }
                   ?>
                   <?php
                    if(is_active_field(MOBILE)){
                    ?>
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
                        <input class="form-control" value="<?php  echo set_value('mobileno')?set_value('mobileno'):$this->input->get('phone')?$this->input->get('phone'):'';?>" name="mobileno" type="text" maxlength='10' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter Mobile Number" required="">
                        <i class="fa fa-plus" onclick="add_more_phone('add_more_phone')" style="float:right;margin-top:-25px;margin-right:10px;color:red"></i>
                     </div>
                     <?php
                   }
                   ?>
                     <div id="add_more_phone"></div>
                     <?php
                    if(is_active_field(EMAIL)){
                    ?>
                     <div class="form-group col-sm-4"> 
                        <label><?php echo display('email') ?> <i class="text-danger"></i> </label>
                        <input class="form-control" value="<?php  echo set_value('email');?> " name="email" type="email"  placeholder="Enter Email">  
                     </div>                     
                     <?php
                   }
                   ?>
                   <?php
                    if(is_active_field(COMPANY)){
                    ?>
                     <div class="form-group col-sm-4">
                        <label><?php echo display('company_name') ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('company');?> " name="company" type="text"  placeholder="Enter Company"> 
                     </div>
                     <?php
                   }
                   ?>  
                    <?php
                    if(is_active_field(LEAD_SOURCE)){
                    ?>                
                     <div class="form-group col-sm-4">
                        <label><?php echo display('lead_source') ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="lead_source" id="lead_source" onchange="find_sub()">
                           <option value="" style="display:none;">Select <?php echo display('lead_source') ?></option>
                           <?php foreach ($leadsource as $post){ ?>
                           <option value="<?= $post->lsid?>"><?= $post->lead_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                    <?php
                   }
                   ?>  
                    <?php
                    if(is_active_field(PRODUCT_FIELD)){
                    ?>                
                     <div class="form-group col-sm-4">
                        <label><?php echo display("product"); ?></label>
                        <select class="form-control" name="sub_source" id="sub_source">
                           <option value="" style="display:none;">Select Product</option>
                           <?php foreach ($product_contry as $subsource){ ?>
                           <option value="<?= $subsource->id?>"><?= $subsource->country_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                      <?php
                   }
                   ?>  
                    <?php
                    if(is_active_field(STATE_FIELD)){
                    ?>                
                     <div class="form-group col-sm-4">
                        <label> <?php echo display("state"); ?> <i class="text-danger"></i></label>
                        <select name="state_id" class="form-control" id="fstate">
                           <option value="" style="display:none;">Select</option>
                           <?php foreach($state_list as $state){?>
                           <option value="<?php echo $state->id ?>"><?php echo $state->state; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                       <?php
                   }
                   ?>  
                    <?php
                    if(is_active_field(CITY_FIELD)){
                    ?>                                      
                      <div class="form-group col-sm-4">
                        <label><?php echo display("city"); ?> <i class="text-danger"></i></label>
                        <select name="city_id" class="form-control" id="fcity" >
                           <option value="" style="display:none;">Select</option>
                       
                        </select>
                     </div>
                       <?php
                   }
                   ?>  
                    <?php
                    if(is_active_field(ADDRESS_FIELD)){
                    ?>                                     
                     <div class="form-group col-sm-4">
                        <label><?php echo display('address') ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('address');?> " name="address" type="text" placeholder="Enter Address"> 
                     </div>
                     <?php 
                   }
               if(!empty($company_list)){?>          
                      <?php foreach($company_list as $companylist){?>                        
                       <?php if($companylist['input_type']==1){?>
                     <div class="form-group col-sm-4">
                        <label> <?= ucwords($companylist['input_label'])?> <i class="text-danger"></i> </label>
                       
                             <input type="text" name="enqueryfield[]" id="<?= $companylist['input_name']?>" placeholder="<?= $companylist['input_place']; ?>"  <?php if($companylist['label_required']==1){echo "required";}?> class="form-control">
                          
                     </div>
                  <?php }if($companylist['input_type']==2){?>
                     <div class="form-group col-sm-4"> 
                        <label><?= ucwords($companylist['input_label'])?> <i class="text-danger"></i></label>
                     <select class="form-control"  name="enqueryfield[]"  id="<?= $companylist['input_name']?>"  <?php if($companylist['label_required']==1){echo "required";}?>> 
                        <option>Select</option>
            <?php $optarr = (!empty($companylist['input_values'])) ? explode(",",$companylist['input_values']) : array(); 
            foreach($optarr as $key => $val){
              
              ?><option value = "<?php echo $val ?>"><?php echo $val ?></option><?php
            } 
            
            ?>
                     </select> 
                     </div>
                  <?php }if($companylist['input_type']==3){?>
                     <div class="form-group col-sm-4"> 
                        <label><?= ucwords($companylist['input_label'])?><i class="text-danger"></i></label>
                         <input type="radio"  name="enqueryfield[]"  id="<?= $companylist['input_name']?>" class="form-control"  <?php if($companylist['label_required']==1){echo "required";}?>>                         
                     </div>
                    <?php }if($companylist['input_type']==4){?>
                     <div class="form-group col-sm-4"> 
                        <label><?= ucwords($companylist['input_label'])?><i class="text-danger"></i></label>
                         <input type="checkbox"  name="enqueryfield[][]"  id="<?= $companylist['input_name']?>" class="form-control" <?php if($companylist['label_required']==1){echo "required";}?>>                         
                     </div>
                    <?php }if($companylist['input_type']==5){ ?>
                   <label><?= ucwords($companylist['input_label'])?><i class="text-danger"></i></label>
                   <textarea   name="enqueryfield[][]"   id="<?= $companylist['input_name']?>" class="form-control" placeholder="<?= $companylist['input_place']; ?>" <?php if($companylist['label_required']==1){echo "required";}?>></textarea>



                     <?php }
           ?><input type="hidden" name= "inputfieldno[]" value = "<?php echo $companylist['input_id'];  ?>">
           <input type="hidden" name= "inputtype[]" value = "<?php echo $companylist['input_type'];  ?>">
        
           <?php
           }?>
        
                  
         <?php } ?>
         <div id="process_custom_fields">
           
         </div>
             </div></div>
                
                   

        
            
           <div class="col-md-12">
                     <div class="form-group"> 
                        <label> <?php echo display('remark'); ?></label>
                        <textarea class="form-control" rows="4" id="remarks"  name="enquiry" placeholder="Remarks"><?php  echo set_value('remarks');?></textarea>
                     </div>
                     <br>
                     <br>
                
         </div>
                  <div class="row">
                     <div class="col-md-6"  id="save_button">
                        <div class="row">
                           <div class="col-md-6">                                                
                              <input class="btn btn-success" type="submit" value="Save" >           
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
         
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
     function add_more_phone(add_more_phone) {
      var html='<div class="form-group col-sm-4"><label>Other No </label><input class="form-control"  name="other_no[]" type="text" placeholder="Other Number"   ></div>';
      $('#'+add_more_phone).append(html);          
   }
</script>
<!-----
<script>
function find_sub() {
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>enquiry/get_sub_byid',
            data: $('#enquery_from').serialize()
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
</script>--->
<div class="col-md-12"></div>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
   $(function () {
    $("#enquiry_date").datepicker({dateFormat:'yy-mm-dd'});
    get_custom_field_field();
  });
    $("select[name='product_id']").on('change',function(){              
      get_custom_field_field();
    });

   function get_custom_field_field(){
      process_id = $("select[name='product_id']").val();   
      url = "<?=base_url().'form/form/get_custom_field_by_process/'?>";       
      $.ajax({
          type: "POST",
          url: url,
          data: {
            'process_id':process_id
          },
          success: function(data){                
            $("#process_custom_fields").html(data);
          }
        });
   }

  </script>
</body>
</html>