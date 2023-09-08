<div class="row">
   <!--  table area --> 
   <div class="col-sm-12">
      <div class="panel panel-default thumbnail">
         <br>
         <div class="panel-body">
               <div class="tab-content clearfix">                  
                  <div class="tab-pane active" id="tab-templates">
                     <br>
                     <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewtemplate"><i class="fa fa-plus"></i> Add New Test</button>
                     <br>
                     <br>
                     <form   action='' method="post" id="temptable">
                        <table width="100%" class="datatable table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_alltemp" value="check all" >&nbsp; <?php echo display('serial') ?></th>
                                 <th  nowrap>Language Test Name</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($all_test)) { ?>
                              <?php $sl = 1; ?>
                              <?php foreach ($all_test as $tlist) { ?>
                              <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="cursor:pointer;" data-toggle="modal" data-target="#createnewtemplate<?php echo $tlist->id;?>">
                                 <td class="th0"><input type='checkbox' onclick="event.stopPropagation();" name='sel_temp[]' class="checkboxtemp" value='<?php echo $tlist->id;?>'>&nbsp; <?php echo $sl;?></td>
                                 <td class="th1"><?php echo $tlist->test_language_name; ?></td>
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
                     <?php foreach ($all_test as $tlist) { ?>
                     <div id="createnewtemplate<?php echo $tlist->id;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                           <!-- Modal content-->
                           <div class="modal-content" >
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Edit Test <?php echo $tlist->test_language_name; ?></h4>
                              </div>
                              <div class="modal-body">
                                 <!--<form>-->
                                 <?php echo form_open_multipart('lead/language_test_update','class="form-inner"') ?>                      
                                 <div class="row">
                                    <input type="hidden" name="test_id" value="<?php echo $tlist->id; ?>">
                                    <div class="form-group   col-sm-12">
                                       <label>Test Name*</label>
                                       <input class="form-control" name="test_language_name" type="text" required="" value="<?php echo $tlist->test_language_name; ?>"> 
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
            <h4 class="modal-title">Create New Test</h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('lead/create_test_language','class="form-inner" id="create_test_language"') ?>                      
            <div class="row">
               <div class="form-group   col-sm-6">
                  <label>Test Name*</label>
                  <input class="form-control" name="test_language_name" type="text" required="">
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
   
   url: '<?php echo base_url();?>lead/delete_language_test',
   
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