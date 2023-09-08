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
                                  
									<form class="form-horizontal "  action='' method="post" id="login">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                       <tr role="row">
                                               <!--- <th class="sorting_asc wid-5" tabindex="0" rowspan="1" colspan="1">
												<input type='checkbox' class="checked_all" value="check all" ></th>--->
												<th class="sorting wid-10" style="border-left:none;">S.N </th>
                                                <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Swtch Box</th>

												<!--<th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Status</th>-->
                                                <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Actions</th>
												
                                            </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($switch as $row){?>
                        <tr>
                          <!---  <td><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $row->sb_id ?>'>&nbsp;</td>-->
                            <td><?=$i++ ?></td>
                            <td><?=$row->switch_box ?></td>
                             <td class="center">
                                        <a  class="edit" data-toggle="modal" data-target="#Editsource<?php echo $row->sb_id;?>"><i class="ti-pencil"></i></a> 
                                    </td>
                        </tr>
                        
                        
                        
  
                        <?php } ?>
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <!---	<button class="btn btn-danger" type="button" onclick="delete_switches()">
                                             <i class="ti-trash"></i>
                                                    Delete
                                            </button>--->
                                      </form>
            </div>
        </div>
    </div>
</div>

<!----- Add switch box modal -------->

    <?php foreach($switch as $row){?>
  <div class="modal fade" id="Editsource<?php echo $row->sb_id;?>"  role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Switch Boxes</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="<?php echo base_url('dash/update_switch_box')?>">
                <div class="col-md-12">
                    
                    <div class="form-group col-md-6">
                        <label>Switch Box</label>
                        <input type="hidden" name="sb_id" value="<?php echo $row->sb_id;?>" >
                        <input type="text" class="form-control" value="<?php echo $row->switch_box;?>" name="switch_box" required>
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
<!-- Modal -->
      
                          <div class="modal fade" id="myModal"  role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Switch Boxes</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="<?php echo base_url('dash/add_switch_box')?>">
                <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label>Switch Box</label>
                        <input type="text" class="form-control" name="switch_box" required>
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
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
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

