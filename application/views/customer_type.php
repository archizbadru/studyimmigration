<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                
                <div class="col-12">
                                    <a href="#" class="btn btn-raised btn-success"
				data-toggle="modal" data-target="#createLead"><i class="ti-plus text-white"></i> &nbsp;Add New Customer Type</a>
                                </div>
                                <br>
                
                

<div id="createLead" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Customer Type</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/customer_type','class="form-inner"') ?> 

        <div class="row">
        
        <div class="form-group col-md-6">
        <label>Customer Type</label>
        <select class="form-control" name="c_type">
            <option></option>
            <option value="1">Customer</option>
            <option value="2">Channel Partner</option>
        </select>
        </div>
        
        <div class="form-group col-md-6">
        <label>Type Name</label>
        <input class="form-control" name="c_typename" placeholder="Type Name"  type="text" value="" required>
        </div>
        
        
        
        <div class="sgnbtnmn form-group col-md-12">
        <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Add Type" class="btn btn-success"  name="addlead">
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
												
	
                
                
                
                
                
                
                
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <!--<th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_all" value="check all" >&nbsp; <?php echo display('serial') ?></th>-->
                            <th><?php echo display('serial') ?></th>
                            <th>Type Name</th>
                            <th>Customer Type</th>
                            <th>Action</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 1; ?>
                            <?php foreach ($c_type as $type) {  ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >
                                    <!--<td ><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $type->cid;?>'>&nbsp; <?php echo $sl;?></td>-->
                                    <td><?php echo $sl;?></td>
                                    <td><?php echo $type->c_typename; ?></td>
                                    <td><?php $ctype = $type->c_type; if($ctype=='1'){ echo "Customer"; } else{ echo "Channel Partner"; } ?></td>
                                   <td class="center">
                                        <a  class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#EditcustomerType<?php echo $type->cid;?>"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/delete_ctype/$type->cid") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                                
                                
<div id="EditcustomerType<?php echo $type->cid;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Customer Type</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/update_cusType','class="form-inner"') ?> 

        <div class="row">
        
        <div class="form-group col-md-6">
            <input type="hidden" name="cid" value="<?php echo $type->cid;?>">
        <label>Customer Type</label>
        <select class="form-control" name="c_type">
            <option></option>
            <option value="1" <?php if($type->c_type==1){ echo "selected";}?>>Customer</option>
            <option value="2" <?php if($type->c_type==2){ echo "selected";}?>>Channel Partner</option>
        </select>
        </div>
        
        <div class="form-group col-md-6">
        <label>Type Name</label>
        <input class="form-control" name="c_typename" placeholder="Type Name"  type="text" value="<?php echo $type->c_typename;?>" required>
        </div>
        
        
        
        <div class="sgnbtnmn form-group col-md-12">
        <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Add Type" class="btn btn-success"  name="addlead">
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
												
	
   
                                
                                
                                 <?php $sl++; ?>
                            <?php } ?> 
                       
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>


 