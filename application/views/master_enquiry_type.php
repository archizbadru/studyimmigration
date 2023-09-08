<div class="row">
    <div class="col-sm-12">
        <div class="panel-heading no-print">
            <div class="btn-group"> 
                <button class="btn btn-info" type="button" id="customer-type">Customer Type</button>
                 <button class="btn btn-default" type="button" id="name-prefix">Name prefix</button>
            </div>
        </div>
    </div>
    <!--  table area -->
    <div class="col-sm-12 customer-type">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#cus_type"> <i class="fa fa-plus"></i> Add Customer Type</button>  
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered" cellspacing="0" width="80%" align="center">
                    <thead>
                        <tr>
                            <th style="width:33px;"># <input type="checkbox" id="check_all"></th>
                            <th>Sno.</th>
                            <th>Customer Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($customer_types as $row){?>
                        <tr>
                            <td><input type="checkbox" name="delete[]" value="<?= $row->cus_id ?>"></td>
                            <td><?= $i++ ?></td>
                            <td><?= $row->customer_type ?></td>
                            <td><button class="btn btn-default" data-toggle="modal" data-target="#<?= $row->cus_id ?>" type="button"><i class="fa fa-pencil-square-o"></i></button></td>
                        </tr>
                         <!-- Edit Modal -->
                          <div class="modal fade" id="<?= $row->cus_id ?>" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Edit Customer Type</h4>
                                </div>
                                <form action="<?php echo base_url('Enquiry/edit_customer_types')?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                          <label for="usr">Customer Type:</label>
                                          <input type="text" class="form-control" id="input_cus_type" name="input_cus_type" value="<?= $row->customer_type ?>">
                                          <input type="hidden" value="<?= $row->cus_id ?>" name="row_id">
                                        </div>
                                        
                                        <div class="form-check">
                                            <label class="radio-inline">
                                            <input type="radio" name="status" value="1" checked="<?php if($row->is_active==1){echo "checked";}?>">Active</label>
                                            <label class="radio-inline">
                                            <input type="radio" name="status" value="0">Inactive</label>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="modal-footer">
                                      <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                      <button type="submit" class="btn btn-success">SUBMIT</button>
                                    </div>
                                </form>
                              </div>
                              
                            </div>
                          </div>
                        <?php } ?>
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
             <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <button class="btn btn-danger" type="button" id="delete_customer_type"><i class="fa fa-trash"></i> DELETE</button>  
                </div>
            </div>
        </div>
    </div>
 
    
    <!------ Nme prefix ---------->
    <div class="col-sm-12 name_prefix" style="display:none;" id="name_prefix">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#enq-name-prefix"> <i class="fa fa-plus"></i> Add Name Prefix</button>  
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered" cellspacing="0" width="80%" align="center">
                    <thead>
                        <tr>
                            <th style="width:1px;"># <input type="checkbox" id="select_name_prefix"></th>
                            <th>Sno.</th>
                            <th>Name Prefix</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $j=1; foreach($name_prefix as $prefix){?>
                        <tr>
                            <td><input type="checkbox" name="delete[]" value="<?= $prefix->np_id ?>"></td>
                            <td><?= $j++ ?></td>
                            <td><?= $prefix->prefix ?></td>
                            <td><button class="btn btn-default" data-toggle="modal" data-target="#N<?= $prefix->np_id ?>"><i class="fa fa-pencil-square-o"></i></button></td>
                        </tr>
                        <!-- Edit Modal -->
                          <div class="modal fade" id="N<?= $prefix->np_id ?>" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Edit Name Prefix</h4>
                                </div>
                                <form action="<?php echo base_url('Enquiry/update_name_prefix')?>" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                          <label for="usr">Name Prefix:</label>
                                          <input type="text" class="form-control" id="name-prefix" name="name-prefix" value="<?= $prefix->prefix ?>">
                                          <input type="hidden" value="<?= $prefix->np_id ?>" name="row_id">
                                        </div>
                                        
                                        <div class="form-check">
                                            <label class="radio-inline">
                                            <input type="radio" name="status" value="1" checked="<?php if($prefix->is_active==1){echo "checked";}?>">Active</label>
                                            <label class="radio-inline">
                                            <input type="radio" name="status" value="0">Inactive</label>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="modal-footer">
                                      <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                      <button type="submit" class="btn btn-success">SUBMIT</button>
                                    </div>
                                </form>
                              </div>
                              
                            </div>
                          </div>
                        <?php } ?>
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <button class="btn btn-danger" type="button" id="delete_name_prefix"><i class="fa fa-trash"></i> DELETE</button>  
                </div>
            </div>
        </div>
    </div>
  
    
</div>

<!------------ Modal for customer type--------------->

<!-- Modal -->
  <div class="modal fade" id="cus_type" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Customer Type</h4>
        </div>
        
        <form action="<?php echo base_url('Enquiry/add_customer_types')?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                  <label for="usr">Customer Type:</label>
                  <input type="text" class="form-control" id="input_cus_type" name="input_cus_type">
                </div>
                
                <div class="form-check">
                    <label class="radio-inline">
                    <input type="radio" name="status" value="1" checked="checked">Active</label>
                    <label class="radio-inline">
                    <input type="radio" name="status" value="0">Inactive</label>
                </div>
                
            </div>
            
            <div class="modal-footer">
              <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
              <button type="submit" class="btn btn-success">SUBMIT</button>
            </div>
        </form>
      </div>
    </div>
  </div>

<!------------- customer type modal end here -------->


<!----------------Modal for Channel partner Type ---->

<!-- Modal -->
  <div class="modal fade" id="ch_type" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Channel Partner Profile</h4>
        </div>
        <form action="<?php echo base_url('Enquiry/add_channel_partner_types')?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                  <label for="usr">Channel Partner Profile:</label>
                  <input type="text" class="form-control" id="channel_partner" name="channel_partner">
                </div>
                
                <div class="form-check">
                    <label class="radio-inline">
                    <input type="radio" name="status" value="1" checked="checked">Active</label>
                    <label class="radio-inline">
                    <input type="radio" name="status" value="0">Inactive</label>
                </div>
                
            </div>
            
            <div class="modal-footer">
              <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
              <button type="submit" class="btn btn-success">SUBMIT</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>

<!---------------- channel partner modal end here---->

<!----------------Modal for Name Prefix Type ---->

<!-- Modal -->
  <div class="modal fade" id="enq-name-prefix" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Name Prefix</h4>
        </div>
        <form action="<?php echo base_url('Enquiry/add_name_prefix')?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                  <label for="usr">Name Prefix:</label>
                  <input type="text" class="form-control" id="name_prefix" name="name_prefix">
                </div>
                
                <div class="form-check">
                    <label class="radio-inline">
                    <input type="radio" name="status" value="1" checked="checked">Active</label>
                    <label class="radio-inline">
                    <input type="radio" name="status" value="0">Inactive</label>
                </div>
                
            </div>
            
            <div class="modal-footer">
              <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
              <button type="submit" class="btn btn-success">SUBMIT</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>

<!-- New Modal -->
  <div class="modal fade" id="new-tabs" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Partner Type</h4>
        </div>
        <form action="<?php echo base_url('Enquiry/add_partner_type')?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                  <label for="usr">Partner Type:</label>
                  <input type="text" class="form-control" id="name_type" name="name_type">
                </div>
                
            </div>
            
            <div class="modal-footer">
              <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
              <button type="submit" class="btn btn-success">SUBMIT</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>


<!---------------- channel partner modal end here---->

<script>
    $(function(){
        
        $("#customer-type").click(function(){
            
            $("#channel-partner").removeClass('btn-info');
            $("#name-prefix").removeClass('btn-info');
            $("#new-tab").removeClass('btn-info');
            $("#channel-partner").addClass('btn-default');
            $("#name-prefix").addClass('btn-default');
            $("#new-tab").addClass('btn-default');
            
            $("#customer-type").addClass('btn-info');
            
            $(".channel-partner").hide();
            $(".name_prefix").hide();
            $(".new-tab").hide();
            $(".customer-type").show();
            
            
        });
        
        $("#channel-partner").click(function(){
            
            $("#customer-type").removeClass('btn-info');
            $("#name-prefix").removeClass('btn-info');
            $("#new-tab").removeClass('btn-info');
            $("#customer-type").addClass('btn-default');
              $("#name-prefix").addClass('btn-default');
              $("#new-tab").addClass('btn-default');
            
            $("#channel-partner").addClass('btn-info');
          
            
            
            $(".customer-type").hide();
            $(".name_prefix").hide();
            $(".new-tab").hide();
            $(".channel-partner").show();
            
        });
        
        
        $("#name-prefix").click(function(){
            
            $("#channel-partner").removeClass('btn-info');
            $("#customer-type").removeClass('btn-info');
            $("#new-tab").removeClass('btn-info');
            
            $("#channel-partner").addClass('btn-default');
            $("#customer-type").addClass('btn-default');
            $("#new-tab").addClass('btn-default');
            
            $("#name-prefix").addClass('btn-info');
            
            
            $(".customer-type").hide();
            $(".channel-partner").hide();
            $(".new-tab").hide();
            
            $(".name_prefix").show();
            
            
        });
        
          $("#new-tab").click(function(){
            
            $("#channel-partner").removeClass('btn-info');
            $("#customer-type").removeClass('btn-info');
            $("#name-prefix").removeClass('btn-info');
            
            $("#channel-partner").addClass('btn-default');
            $("#customer-type").addClass('btn-default');
            $("#name-prefix").addClass('btn-default');
            
            $("#new-tab").addClass('btn-info');
            
            
            $(".customer-type").hide();
            $(".channel-partner").hide();
            $(".name_prefix").hide();
            
            $(".new-tab").show();
            
            
        });
        
    });
    
</script>

<script>
    
    $(function(){
       
       //Select all customer type..
       $('#check_all').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
            
        });
        
        //Select all channel partner type..
        $('#ch_partner').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
            
        });
        
        //Select all channel partner type..
        $('#select_name_prefix').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
            
        });
        
        
        $("#delete_customer_type").click(function(){
            
            var favorite = [];
            
                $.each($("input[name='delete[]']:checked"), function(){            
                    favorite.push($(this).val());
            });
            
            if(confirm('Are you sure want to delete this ?')){
                
                $.ajax({
                    
                    url : '<?php echo base_url('Enquiry/delete_customer_type') ?>',
                    type: 'POST',
                    data: {favorite:favorite},
                    success:function(data){
                        
                       alert('Deleted Successfully');
                       location.reload();
                       
                    }
                    
                });
                
            }
        
        });
        
        //Delete all channel partner..
        $("#delete_ch_type").click(function(){
            
            var favorite = [];
            
                $.each($("input[name='delete[]']:checked"), function(){            
                    favorite.push($(this).val());
            });
            
            if(confirm('Are you sure want to delete this ?')){
                
                $.ajax({
                    
                    url : '<?php echo base_url('Enquiry/delete_channel_partner') ?>',
                    type: 'POST',
                    data: {favorite:favorite},
                    success:function(data){
                        
                       alert('Deleted Successfully');
                       location.reload();
                       
                    }
                    
                });
                
            }
        
        });
        
        $("#delete_name_prefix").click(function(){
            
            var favorite = [];
            
                $.each($("input[name='delete[]']:checked"), function(){            
                    favorite.push($(this).val());
            });
            
            if(confirm('Are you sure want to delete this ?')){
                
                $.ajax({
                    
                    url : '<?php echo base_url('Enquiry/delete_name_prefix') ?>',
                    type: 'POST',
                    data: {favorite:favorite},
                    success:function(data){
                        
                        alert('Deleted Successfully');
                        location.reload();
                        
                    }
                    
                    
                    
                    
                });
                
                
            }
            
        });
        
        $("#delete_name_partner").click(function(){
            
            var favorite = [];
            
                $.each($("input[name='delete[]']:checked"), function(){            
                    favorite.push($(this).val());
            });
            
            if(confirm('Are you sure want to delete this ?')){
                
                $.ajax({
                    
                    url : '<?php echo base_url('Enquiry/delete_name_partners') ?>',
                    type: 'POST',
                    data: {favorite:favorite},
                    success:function(data){
                        
                        alert('Deleted Successfully');
                        location.reload();
                        
                    }
                    
                    
                    
                    
                });
                
                
            }
            
        });
       
       
    });
    
</script>


