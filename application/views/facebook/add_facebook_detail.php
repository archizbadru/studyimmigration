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

               <button  class='btn btn-danger text-left'><?php echo $this->session->error; ?></button>

               <?php } ?>

               <?php if($this->session->success!=''){ ?>

               <button  class='btn  btn-success left'><?php echo $this->session->success; ?></button>

               <?php } ?>

            </div>

            <table class="datatable table table-striped table-bordered mobile-optimised" cellspacing="0" width="100%">
               <thead>
                  <tr role="row">
                     <th class=" wid-20" tabindex="0" rowspan="1" colspan="1">
                        <input type='checkbox' class="checked_all" value="check all" >&nbsp; 
                     </th>
                     <th class="sorting wid-10" style="border-left:none;">S.N </th>
                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Ad Id</th>
                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Form Name</th>
                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Adset Name</th>
                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Campaign Name</th>
                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Ad name</th>
                      <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Product</th>
                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Actions</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i=1; foreach($form_details as $row){?>
                  <tr>
                     <td data-th=''><input type='checkbox' name='product_status[]' class="checkbox" value='<?php echo $row->id;?>'>&nbsp; </td>
                     <td data-th='S.N'><?=$i++ ?></td>
                     <td data-th='Product Name'><?php echo $row->from_id; ?></td>
                     <td data-th='Product Name'><?php echo $row->from_name; ?></td>
                     <td data-th='Product Name'><?php echo $row->add_set_name; ?></td>
                     <td data-th='Product Name'><?php echo $row->compaign_name; ?></td>
                     <td data-th='Product Name'><?php echo $row->add_name; ?></td>
                     <td data-th='Product Name'><?php echo $row->productcountry_name; ?></td>
                     <td data-th='Actions' class="center">
                        <a  class="edit" data-toggle="modal" data-target="#test<?php echo $row->form_update;?>"><i class="ti-pencil"></i></a> 
                     </td>
                  </tr>
              <?php } ?>
                <?php $i=1; foreach($form_details as $row){?>
                  <div class="modal fade" id="test<?php echo $row->form_update;?>"  role="dialog">
                     <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Update Product</h4>
                           </div>
                           <div class="modal-body">
                              <form method="POST" action="<?php echo base_url('facebook/add_product')?>">
                                 <div class="col-md-12">
                                <div class="form-group col-md-6">
                                   <label>Ad Id</label>
                                   <input type="text" class="form-control" name="from_id" value="<?php echo $row->from_id; ?>" required>
                                </div>
                                 <div class="form-group col-md-6">
                                   <label>Form Name</label>
                                   <input type="text" class="form-control" name="from_name" value="<?php echo $row->from_name; ?>" required>
                                </div>
                                 <div class="form-group col-md-6">
                                   <label>Adset Name</label>
                                   <input type="text" class="form-control" name="adset_name" value="<?php echo $row->add_set_name; ?>" required>
                                </div>
                                 <div class="form-group col-md-6">
                                   <label>Campaign Name</label>
                                   <input type="text" class="form-control" name="campaign_name" value="<?php echo $row->compaign_name; ?>" required>
                                </div>
                                 <div class="form-group col-md-6">
                                   <label>Ad name </label>
                                   <input type="text" class="form-control" name="ad_name" value="<?php echo $row->add_name; ?>" required>
                                </div>
                                
                                 <div class="form-group col-md-6">
                                   <label>Product</label>
                                  <select class="form-control" name="product_name">
                                    <?php foreach($product_list as $r){ ?>
                                      <?php if($r->p_id==$row->course_name){  ?>
                                    <option value="<?php echo $r->p_id; ?>" selected><?php echo $r->country_name; ?></option>
                                  <?php }else{ ?>
                                    <option value="<?php echo $r->p_id; ?>" ><?php echo $r->country_name; ?></option>
                                    <?php }} ?>
                                  }
                                  </select>
                                </div>
                                 <input type="hidden" class="form-control" name="form_update" value="<?php echo $row->form_update; ?>" required>
              
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
            <h4 class="modal-title">Add Product</h4>
         </div>
         <div class="modal-body">
            <form method="POST" action="<?php echo base_url('facebook/add_product')?>">
               <div class="row">
                  <div class="form-group col-md-6">
                     <label>Ad Id</label>
                     <input type="text" class="form-control" name="from_id" required>
                  </div>
                   <div class="form-group col-md-6">
                     <label>Form Name</label>
                     <input type="text" class="form-control" name="from_name" required>
                  </div>
                   <div class="form-group col-md-6">
                     <label>Adset Name</label>
                     <input type="text" class="form-control" name="adset_name" required>
                  </div>
                   <div class="form-group col-md-6">
                     <label>Campaign Name</label>
                     <input type="text" class="form-control" name="campaign_name" required>
                  </div>
                   <div class="form-group col-md-6">
                     <label>Ad name </label>
                     <input type="text" class="form-control" name="ad_name" required>
                  </div>
                  
                   <div class="form-group col-md-6">
                     <label>Product</label>
                    <select class="form-control" name="product_name">
                      <?php foreach($product_list as $row){ ?>
                      <option value="<?php echo $row->p_id; ?>"><?php echo $row->country_name; ?></option>
                      <?php } ?>
                    </select>
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
    if(x == true){   
     $.ajax({
     type: 'POST',
     url: '<?php echo base_url();?>deactive_product',
     data: $('#login').serialize()
     })
     .done(function(data){
     if(data==1){	
        alert( "Delete successfully" );
        window.location.href = '<?php echo base_url()?>dash/product_list';
     }else{
        alert( "Delete Unsuccessful" );
        window.location.href = '<?php echo base_url()?>dash/product_list';
     }
   })
   .fail(function() {
      alert("fail!");
   });
   }else{
      location.reload();
   }
 }
</script>
<script>
  function delete_switches(){       
     var ids = [];      
     $('input[name^="user_status[]"]').each(function() {          
        ids.push($(this).val());
     });
     if(confirm("Are you sure want to delete...")){          
        $.ajax({             
          url : '<?php echo base_url('dash/delete_switch_box')?>',
          type: 'POST',
          data: {ids:ids},
          success:function(data){                 
            alert("Deleted successfully");
            location.reload();
          }
        });
      }   
  }
</script>