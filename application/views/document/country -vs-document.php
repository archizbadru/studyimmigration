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
                     <button class="btn btn-sm btn-success" style="float: left" type="button" data-toggle="modal" data-target="#createnewtemplate"><i class="fa fa-plus"></i> Add New Document</button>
                     <br>
                     <br>
                     <form   action='' method="post" id="temptable">
                        <table width="100%" class="datatable table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th class="sorting_asc wid-20 th0" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_alltemp" value="check all" >&nbsp; <?php echo display('serial') ?></th>
                                 <th  nowrap>Country Name</th>
								 <th  nowrap>Document Type Name</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($all_c_vs_d)) { ?>
                              <?php $sl = 1; ?>
                              <?php foreach ($all_c_vs_d as $cvd) { ?>
                              <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="cursor:pointer;" data-toggle="modal" data-target="#createnewtemplate<?php echo $cvd->id;?>">
                                 <td class="th0"><input type='checkbox' onclick="event.stopPropagation();" name='sel_temp[]' class="checkboxtemp" value='<?php echo $cvd->id;?>'>&nbsp; <?php echo $sl;?></td>
                                 <td class="th1"><?php foreach($country as $cntry){ if($cntry->id_c==$cvd->country_id){echo $cntry->country_name;}} ?></td>
								 <td class="th1"><?php echo $cvd->document_type; ?></td>
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
                     <?php foreach ($all_c_vs_d as $tlist) { ?>
                     <div id="createnewtemplate<?php echo $tlist->id;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                           <!-- Modal content-->
                           <div class="modal-content" >
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Edit Document Type <?php echo $tlist->id; ?></h4>
                              </div>
                              <div class="modal-body">
                                 <!--<form>-->
                                 <?php echo form_open_multipart('location/cvd_update','class="form-inner"') ?>                      
                                 <div class="row">
                                    <input type="hidden" name="cvd_id" value="<?php echo $tlist->id; ?>">
                                    <div class="form-group   col-sm-6">
                                       <label>Preferred Country</label>
                                       <select class="form-control"  name="preferd_country"  id="preferd_country"> 
                                           <option>Select Country</option>
					                    <?php foreach($country as $cntry){ ?>
                                           <option value = "<?php echo $cntry->id_c; ?>" <?php if($cntry->id_c==$tlist->country_id){ echo 'selected';};?>><?php echo $cntry->country_name; ?></option>
					                    <?php } ?>
                                       </select>
                                    </div>
                                    <div class="form-group   col-sm-6">
                                      <label>Document Type Name*</label>
                                      <input class="form-control" name="document_type" type="text" required="" value="<?php echo $tlist->document_type; ?>">
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
            <h4 class="modal-title">Create New Document Type</h4>
         </div>
         <div class="modal-body">
            <!--<form>-->
            <?php echo form_open_multipart('location/country_vs_document','class="form-inner" id="country_vs_document"') ?>                      
            <div class="row">
			    <div class="form-group   col-sm-6">
                  <label>Preferred Country</label>
                  <select class="form-control"  name="preferd_country"  id="preferd_country"> 
                    <option>Select Country</option>
					<?php foreach($country as $cntry){ ?>
                    <option value = "<?php echo $cntry->id_c; ?>"><?php echo $cntry->country_name; ?></option>
					<?php } ?>
                  </select>
                </div>
                <div class="form-group   col-sm-6">
                  <label>Document Type Name*</label>
                  <input class="form-control" name="document_type" type="text" required="">
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
   
   url: '<?php echo base_url();?>location/delete_cvd',
   
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
<script src="<?php echo base_url(); ?>assets/summernote/summernote-bs4.min.js"></script>
<script>
   jQuery(document).ready(function(){
   
       $('.summernote').summernote({
   
           height: 200,                 // set editor height
   
           minHeight: null,             // set minimum height of editor
   
           maxHeight: null,             // set maximum height of editor
   
           focus: false                 // set focus to editable area after initializing summernote
   
       });
   
   });
   
</script>