<div class="row">
   <!--  table area --> 
   <div class="col-sm-12">
      <div class="panel panel-default thumbnail">
         <br>
         <div class="panel-body">
               <div class="tab-content clearfix">                  
                  <div class="tab-pane active" id="tab-templates">
                     <br>
                     <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewtemplate"><i class="fa fa-plus"></i> Add New Visa Mapping</button>
                     <br>
                     <br>
                     <form   action='' method="post" id="temptable">
                        <table width="100%" class="datatable table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_alltemp" value="check all" >&nbsp; <?php echo display('serial') ?></th>
                                 <th  nowrap>Country Name</th>
                                 <th  nowrap>Visa Name</th>
                                 <th  nowrap>Sub Class Name</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($visa_mapping)) { ?>
                              <?php $sl = 1; ?>
                              <?php foreach ($visa_mapping as $maplist) { ?>
                              <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="cursor:pointer;" data-toggle="modal" data-target="#createnewtemplate<?php echo $maplist->id;?>">
                                 <td class="th0"><input type='checkbox' onclick="event.stopPropagation();" name='sel_temp[]' class="checkboxtemp" value='<?php echo $maplist->id;?>'>&nbsp; <?php echo $sl;?></td>
                                 <td class="th1"><?php foreach ($country as $key => $cntry) {
                                                 if($cntry->id_c==$maplist->cntry_id){ echo $cntry->country_name; } } ?></td>
                                 <td class="th1"><?php foreach ($visa_type as $key => $visa) {
                                                 if($visa->id==$maplist->visa_type){ echo $visa->visa_type; } }?></td>
                                 <td class="th1"><?php echo $maplist->sub_class; ?></td>
                              </tr>
                              <?php $sl++; ?>
                              <?php } ?> 
                              <?php } ?> 
                           </tbody>
                        </table>
                        <button class="btn btn-danger" type="button" onclick="return is_deleteTemp()" >
                        <i class="ion-close-circled"></i>
                        Delete
                        </button>
                     </form>
                     <?php foreach ($visa_mapping as $maplist) { ?>
                     <div id="createnewtemplate<?php echo $maplist->id;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                           <!-- Modal content-->
                           <div class="modal-content" >
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Edit <?php echo $maplist->visa_type; ?></h4>
                              </div>
                              <div class="modal-body">
                                 <!--<form>-->
                                 <?php echo form_open_multipart('lead/visa_mapping_update','class="form-inner"') ?>
                                 <input type="hidden" name="test_id" value="<?php echo $maplist->id; ?>">                      
            <div class="row">
               <div class="form-group col-sm-6">
                  <label>Country Name*</label>
                  <select class="form-control" name="cntry" id="cntry" required>
                     <option value="">Select Country</option>
                     <?php foreach ($country as $key => $cntry) { ?>
                        <option value = "<?php echo $cntry->id_c; ?>" <?php if($cntry->id_c==$maplist->cntry_id){ echo 'selected';} ?>><?php echo $cntry->country_name; ?></option>
                    <?php } ?>                       
                  </select>
               </div>

               <div class="form-group col-sm-6">
                  <label>Visa Name*</label>
                  <select class="form-control" name="visa_type" id="visa_type" required>
                     <option value="">Select Visa</option>
                     <?php foreach ($visa_type as $key => $visa) { ?>
                        <option value = "<?php echo $visa->id; ?>" <?php if($visa->id==$maplist->visa_type){ echo 'selected';} ?>><?php echo $visa->visa_type; ?></option>
                    <?php } ?>    
                  </select>
               </div>

               <div class="form-group col-sm-12">
                  <label>Sub Class Name*</label>
                  <input class="form-control" name="sub_class" id="sub_class" type="text" value="<?php echo $maplist->sub_class; ?>" required>
               </div>
            </div>
                                 <div class="col-12" style="padding: 0px;">
                                    <div class="row">
                                       <div class="col-12" style="text-align:center;">                                                
                                          <button class="btn btn-success" type="submit">Save</button>            
                                       </div>
                                    </div>
                                 </div>
                                 </form> 
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                  </div>
               </div>
            <!-- /.table-responsive -->
         </div>
      </div>
   </div>
</div>

<!--------------- ADD NEW Template ------------->
<div id="createnewtemplate" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Visa Mapping</h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('lead/create_visa_mapping','class="form-inner" id="create_visa_mapping"') ?>                      
            <div class="row">
               <div class="form-group col-sm-6">
                  <label>Country Name*</label>
                  <select class="form-control" name="cntry" id="cntry" required>
                     <option value="">Select Country</option>
                     <?php foreach ($country as $key => $cntry) { ?>
                        <option value = "<?php echo $cntry->id_c; ?>"><?php echo $cntry->country_name; ?></option>
                    <?php } ?>                       
                  </select>
               </div>

               <div class="form-group col-sm-6">
                  <label>Visa Name*</label>
                  <select class="form-control" name="visa_type" id="visa_type" required>
                     <option value="">Select Visa</option>
                     <?php foreach ($visa_type as $key => $visa) { ?>
                        <option value = "<?php echo $visa->id; ?>"><?php echo $visa->visa_type; ?></option>
                    <?php } ?>    
                  </select>
               </div>

               <div class="form-group col-sm-12">
                  <label>Sub Class Name*</label>
                  <input class="form-control" name="sub_class" id="sub_class" type="text" required>
               </div>
            </div>

            <div class="col-6" style="padding: 0px;">
               <div class="row">
                  <div class="col-6" style="text-align:center;">                                                
                     <button class="btn btn-success" type="submit">Save</button>            
                  </div>
               </div>
            </div>
            </form> 
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<script src="<?php echo base_url('assets/js/editor/editor.js') ?>"></script>

<script>   
   $('.checked_alltemp').on('change', function() {     
   
                   $('.checkboxtemp').prop('checked', $(this).prop("checked"));              
   
           });
   
           $('.checkboxtemp').change(function(){ 
   
               if($('.checkboxtemp:checked').length == $('.checkboxtemp').length){
   
                      $('.checked_alltemp').prop('checked',true);
   
               }else{
   
                      $('.checked_alltemp').prop('checked',false);
   
               }
   
           });   
   
   
   function is_deleteTemp(){
   
     var x=  confirm('Are you sure want to delete ? ');
   
     if(x==true){
   
   $.ajax({
   
   type: 'POST',
   
   url: '<?php echo base_url();?>lead/delete_visa_mapping',
   
   data: $('#temptable').serialize()
   
   })
   
   .done(function(data){
   
   alert( "success!" );
   
   location.reload(); 
   
   })
   
   .fail(function() {
   
   alert( "fail!" );
 
   });
   
   }else{
   
       location.reload(); 
   
   }
   
   }  
</script>