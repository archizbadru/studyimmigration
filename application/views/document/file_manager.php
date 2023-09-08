<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link href="<?php echo base_url(); ?>assets/summernote/summernote-bs4.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/c3/c3.min.css" rel="stylesheet" type="text/css"  />
<div class="row">
   <!--  table area --> 
   <div class="col-sm-12">
      <div class="panel panel-default thumbnail">
         <br>
         <div class="panel-body">
               <div class="tab-content clearfix">                  
                  <div class="tab-pane active" id="tab-templates">
                     <br>
                     <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewtemplate"><i class="fa fa-plus"></i> Add New File</button>
                     <br>
                     <br>
                     <form   action='' method="post" id="temptable">
                        <table width="100%" class="datatable table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_alltemp" value="check all" >&nbsp; <?php echo display('serial') ?></th>
                                 <th  nowrap>File Name</th>
								                 <th  nowrap>File</th>
                                 <th  nowrap>File View</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($all_files)) { ?>
                              <?php $sl = 1; ?>
                              <?php foreach ($all_files as $file) { ?>
                              <tr>
                                 <td class="th0"><input type='checkbox' onclick="event.stopPropagation();" name='sel_temp[]' class="checkboxtemp" value='<?php echo $file->id;?>'>&nbsp; <?php echo $sl;?></td>
                                 <td class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="color:green;cursor:pointer;" data-toggle="modal" data-target="#createnewtemplate<?php echo $file->id;?>"><?php echo $file->file_title; ?></td>
								                 <td class="th1"><?php echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/'.$this->session->awsfolder.'/'.$file->data_file; ?></td>
                                 <td class="th1"><?php if(!empty($file->data_file)){ ?>
                                    <a href="<?php echo 'https://studyandimmigration.s3.ap-south-1.amazonaws.com/'.$this->session->awsfolder.'/'.$file->data_file; ?>" target="_blank" class="titlehover" data-title="File"><i class="fa fa-file" aria-hidden="true"></i></a>
                               <?php } ?></td>
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
                     <?php foreach ($all_files as $flist) { ?>
                     <div id="createnewtemplate<?php echo $flist->id;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                           <!-- Modal content-->
                           <div class="modal-content" >
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Edit File <?php echo $flist->id; ?></h4>
                              </div>
                              <div class="modal-body">
                                 <!--<form>-->
                                 <?php echo form_open_multipart('location/file_manager_update','class="form-inner"') ?>                      
                                 <div class="row">
                                    <input type="hidden" name="file_id" value="<?php echo $flist->id; ?>">
                                    <div class="form-group   col-sm-6">
                                       <label>File Name</label>
                                       <input class="form-control" name="file_name" type="text" required="" value="<?php echo $flist->file_title; ?>">
                                    </div>
                                    <div class="form-group   col-sm-6">
                                      <label>Data File*</label>
                                      <input class="form-control" name="file_data" type="file">
                                    </div>
                                    <input class="form-control" name="file_data_old" type="hidden" required="" value="<?php echo $flist->data_file; ?>">
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
            <h4 class="modal-title">Create New File</h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('location/file_manager','class="form-inner" id="file_manager"') ?>                      
            <div class="row">
			    <div class="form-group   col-sm-6">
                  <label>File Name</label>
                  <input class="form-control" name="file_name" type="text" required="">
                </div>
                <div class="form-group   col-sm-6">
                  <label>Data File*</label>
                  <input class="form-control" name="file_data" type="file" required="">
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
   
   url: '<?php echo base_url();?>location/delete_file_manager',
   
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