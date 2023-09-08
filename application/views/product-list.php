<div class="row">
   <!--  table area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?php echo display('Add_More') ?></button> 
            </div>
         </div>
         <div class="panel-body">
            <div class="row m-t-20"><?php if($this->session->error!=''){ ?>
               <div role="alert" class="alert alert-success">
                  <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->error; ?>
              </div>
               <?php } ?>
               <?php if($this->session->success!=''){ ?>
               <div role="alert" class="alert alert-success">
                  <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                    <?php echo $this->session->success; ?></button>
                </div>

               <?php } ?>
            </div>
            <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                  <tr role="row">
                     <th class=" wid-20" tabindex="0" rowspan="1" colspan="1">
                        <input type='checkbox' class="checked_all" value="check all" >&nbsp; 
                     </th>
                     <th class="sorting wid-10" style="border-left:none;">S.N </th>
                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Process Name</th>
                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Status</th>
                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Actions</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i=1; foreach($product_list as $row){?>
                  <tr>
                     <td>
                          <!-- <form action='' method="post" id="login"> -->
                            <input type='checkbox' name='product_status' class="checkbox" value='<?php echo $row->sb_id;?>'>
                          <!-- </form> -->&nbsp; </td>
                     <td><?=$i++ ?></td>
                     <td><?=$row->product_name ?></td>
                     <td><?php echo (($row->status==1)?display('active'):display('inactive')); ?></td>
                     <td class="center">
                        <a  class="edit" data-toggle="modal" data-target="#product_list<?php echo $row->sb_id;?>"><i class="ti-pencil"></i></a> 
                     </td>
                  </tr>
                  <?php } ?>
                  <?php  foreach($product_list as $rows){?>
                  <div class="modal fade" id="product_list<?php echo $rows->sb_id;?>"  role="dialog">
                     <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Update Process</h4>
                           </div>
                           <div class="modal-body">
                              <form method="POST" action="<?php echo base_url('dash/update_product')?>">
                                 <div class="col-md-12">
                                    <div class="form-group col-md-12">
                                       <label>Process Name</label>
                                       <input type="hidden" name="sb_id" value="<?php echo $rows->sb_id;?>" >
                                       <input type="text" class="form-control" value="<?php echo $rows->product_name;?>" name="product_name" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label><?php echo display('product_status');?></label>
                                       <input name="status"  type="radio" value="1" <?php if($rows->status == 1) { echo 'checked'; } ?>>&nbsp;&nbsp;Active
                                       <input  name="status" type="radio" value="0" <?php if($rows->status == 0) { echo 'checked'; } ?>>&nbsp;&nbsp;Inactive
                                    </div>
                                    <div class="form-group col-md-12">
                                       <button class="btn btn-success" type="submit">update</button>
                                    </div>
                                 </div>
                                 <div class="row">
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </tbody>
            </table>
            <button class="btn btn-danger" type="button" onclick="delete_product()">
            <i class="ti-trash"></i>
            Delete
            </button>            
         </div>
      </div>
   </div>
</div>
<!----- Add switch box modal -------->
<!-- Modal -->
<div class="modal fade" id="myModal"  role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo display('add_process');?></h4>
         </div>
         <div class="modal-body">
            <form method="POST" action="<?php echo base_url('dash/add_product')?>">
               <div class="row">
                  <div class="form-group col-md-12">
                     <label>Process name</label>
                     <input type="text" class="form-control" name="product_name" required>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-6">
                     <button class="btn btn-success" type="submit">Submit</button>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<!----------------------------------->       
<script type="text/javascript">
   $('.checked_all').on('change', function() {     
           $('.checkbox').prop('checked', $(this).prop("checked"));              
   });
   $('.checkbox').change(function(){ 
       if($('.checkbox:checked').length == $('.checkbox').length){
              $('.checked_all').prop('checked',true);
       }else{
              $('.checked_all').prop('checked',false);
       }
   });
   
</script>
<script>
   function delete_product(){
     var x=  confirm('Are you sure delete this Records ? ');     
    if(x==true){   
      var p = $("input[name='product_status']").val();
      var p_arr = Array();
      
      $("input:checkbox[name=product_status]:checked").each(function(){
          p_arr.push($(this).val());
      });

   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>dash/deactive_products',
   data: {
    product_status:p_arr
   }
   })
   .done(function(data){
   if(data==1){	
       alert( "Delete successfully" );
       window.location.reload();
       
   }else{
   alert( "Delete Unsuccessful" );
       //window.location.reload();
    
   }
   })
   .fail(function() {
   alert( "fail!" );
   
   });
   }else{
        location.reload(); 
   }}
</script>
