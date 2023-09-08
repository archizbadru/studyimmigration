<style>
   label{         
   font-weight:bold;
   font-size:13px;
   }
  
  

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
               <div id="basic_form_fields"></div>
               <?php if(0){?>        
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
                       <div class="form-group col-sm-4"> 
                   <label><?= ucwords($companylist['input_label'])?><i class="text-danger"></i></label>
                   <textarea   name="enqueryfield[][]"   id="<?= $companylist['input_name']?>" class="form-control" placeholder="<?= $companylist['input_place']; ?>" <?php if($companylist['label_required']==1){echo "required";}?>></textarea>
                     </div>


                     <?php }
           ?><input type="hidden" name= "inputfieldno[]" value = "<?php echo $companylist['input_id'];  ?>">
           <input type="hidden" name= "inputtype[]" value = "<?php echo $companylist['input_type'];  ?>">
        
           <?php
           }?>
        
                  
         <?php } ?>
         <div id="process_custom_fields">
           
         </div>
             </div>
           </div>
                
                   

        
            
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
      get_basic_field_field();
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
          // alert(data);         
            $("#process_custom_fields").html(data);
          }
        });
   }

$(document).ready(function(){
       process_id = $("select[name='product_id']").val(); 
       // alert(process_id);
            url = "<?=base_url().'form/form/get_basic_field_by_process/'?>";       
      $.ajax({
          type: "POST",
          url: url,
          data: {
            'process_id':process_id
          },
          success: function(data){       
          // alert(data);         
            $("#basic_form_fields").html(data);
          }
        });


 });

     function get_basic_field_field(){
      process_id = $("select[name='product_id']").val();  
       // alert(process_id); 
      url = "<?=base_url().'form/form/get_basic_field_by_process/'?>";       
      $.ajax({
          type: "POST",
          url: url,
          data: {
            'process_id':process_id
          },
          success: function(data){       
          // alert(data);         
            $("#basic_form_fields").html(data);
          }
        });
   }

  </script>
</body>
</html>