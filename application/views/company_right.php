<div class="col-sm-12">
          
                <?php if($this->session->flashdata('SUCCESSMSG')) { ?>
                                   <div role="alert" class="alert alert-success">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           
                                           <?=$this->session->flashdata('SUCCESSMSG')?>
                                   </div>
                           <?php } ?>
                           
                           
                            <?php if($this->session->flashdata('FAILMSG')) { ?>
                                   <div role="alert" class="alert alert-danger">
                                           <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                                           
                                           <?=$this->session->flashdata('FAILMSG')?>
                                   </div>
                           <?php } ?>
                
                
               
               <div class="form-group row">
                    <label for="inputText" class="col-sm-2 col-form-label">Edit <?php echo display('user_function') ?></label>
                    <div class="col-sm-4">
                      <input type="text"  class="form-control" id="inputText" name="user_type" value="<?= $user_role->user_role ?>" placeholder="<?php echo display('user_function') ?>" required>                      
                      <input type="hidden" value="<?= $user_role->use_id ?>" class="form-control" name="role_id">
                    </div>
               </div>
                <?php /* $modules = array(
                                  'Location Setting',
                                  'BoQ Settings',
                                  'Sales Settings',
                                  'Service Settings',
                                  'Api Configuration',
                                  'Enquiry',
                                  'Lead',
                                  'Client',
                                  'Task',
                                  'Installation',
                                  'Customer Service',
                                  'Reports',
                                  'User Management',
                                  'User Rights',
                                  'Company Profile',
                                  'Requirement Management',
                                  'Knowledge Base',
                                  'Invoice'
                                ); 
                      */          ?>
               
                <table class="table table-bordered table-hover">
                  <thead>
                  <tr bgcolor="#37a000" style="color:#fff"> 
                    <th scope="col" width="170px">&nbsp;<input type="checkbox" width="10px;"  class="checked_all1" >&nbsp;Service Modules</th>
                                           
                     <!--- <th scope="col" width="170px">&nbsp;<input type="checkbox" width="10px;"  class="checked_all1" >&nbsp;Service Modules</th>
                      <th scope="col" class="text-center"><input type="checkbox" width="10px;"  class="all_check check_0" onclick="check_all('check_0','check_alls0')"> Add</th>
                      <th scope="col" class="text-center"><input type="checkbox" width="10px;"  class="all_check check_1" onclick="check_all('check_1','check_alls1')"> Edit</th>
                      <th scope="col" class="text-center"><input type="checkbox" width="10px;"  class="all_check check_2" onclick="check_all('check_2','check_alls2')" > Delete</th>
                      <th scope="col" class="text-center"><input type="checkbox" width="10px;"  class="all_check check_3" onclick="check_all('check_3','check_alls3')"> View</th>
                      <th scope="col" class="text-center"><input type="checkbox" width="10px;"  class="all_check check_4" onclick="check_all('check_4','check_alls4')"> SMS</th>
                      <th scope="col" class="text-center"><input type="checkbox" width="10px;"  class="all_check check_5" onclick="check_all('check_5','check_alls5')" > Whatsapp</th>
                      <th scope="col" class="text-center"><input type="checkbox" width="10px;"  class="all_check check_6" onclick="check_all('check_6','check_alls6')" > Email</th>                      
                    --->
                    <td>Right Module</td>
                    </tr>
                  </thead>                  
                  <tbody>
                  <?php 
                    $permission = explode(',',$user_role->user_permissions);
                   // $n=1;
                    //for($i=0; $i < count($modules); $i++){  
                    foreach ($modules as $key => $value) {                                            
                      $jq= explode(',',$value['sub_module']) ;  
                         $j1= (count($jq)-1) ;                      
                    ?>
                    <tr class="<?=$value['id']?>">
                     
                      <th width="10px" scope="row">
                       
                        <input type="checkbox" width="10px;"  class="all_check check_all1<?php echo $value['id'];  ?>" onclick="check_all('check_all1<?php echo $value['id'];  ?>','check_all<?php echo $value['id'];  ?>')" >&nbsp;<?= ucfirst($value['title']) ?>

                      </th>
                      <td>
                      <div><?php for($j=0; $j <=$j1; $j++){ ?><div class="col-md-3">
                         
                            <input <?php  if(in_array($value['id'].$j,$permission)){echo 'checked';}?> type="checkbox" width="10px;" name="permissions[]"  value="<?php echo $value['id'].$j;  ?>" class="all_check check_all<?php echo $value['id'];  ?> check_alls<?php echo $j;  ?> form-check-input" >&nbsp;<?php echo $jq[$j];  ?>
                          
                       </div><?php }?> </div>
                         </td>                    
                      </tr>
                      <?php 
                     
                    }
                   ?>                    
                  </tbody>
                </table>
</div>
<style>
    th{
        
        font-weight:normal !important;
        font-size:14px;
        
        
    }
</style>


<script>
    function check_all(checkclass,checkbox){
  $('.'+ checkclass).on('change', function() {     
                $('.'+ checkbox).prop('checked', $(this).prop("checked"));
                
        });
        $('.'+checkbox).change(function(){ 
            if($('.'+ checkbox +':checked').length == $('.'+ checkbox).length){
                   $('.'+ checkclass).prop('checked',true);
            }else{
                   $('.'+ checkclass).prop('checked',false);
            }
        });
    }
   $('.checked_all1').on('change', function() {     
                $('.all_check').prop('checked', $(this).prop("checked"));
                
        });
        
         $('.all_check').change(function(){ 
            if($('.all_check:checked').length == $('.all_check').length){
                   $('.checked_all1').prop('checked',true);
            }else{
                   $('.checked_all1').prop('checked',false);
            }
        });
</script>