<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                
                <div class="col-12">
                                    <a href="#" class="btn btn-raised btn-success"
				data-toggle="modal" data-target="#createLead"><i class="ti-plus text-white"></i> &nbsp;Add Modular Box</a>
                                </div>
                                <br>
                
                

<div id="createLead" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Modular Box</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('dash/add_modulerbox','class="form-inner"') ?> 

<div class="row">
	<div class="form-group col-md-6">
	    <label>Modular Box</label>
	  <input class="form-control" name="m_name" placeholder="Modular Box"  type="text" value="" required>
	</div>
	
	<div class="form-group col-md-6">
	    <label>Modular No of Field</label>
	  <input class="form-control" name="m_input" placeholder="Modular No of Field"  type="text" value="" required>
	</div>
	
	<div class="sgnbtnmn form-group col-md-12">
	  <div class="sgnbtn">
		<input id="signupbtn" type="submit" value="Moduler Box" class="btn btn-success"  name="addlead">
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
                            <th><?php echo display('serial') ?></th>
                            <th>Modular  Box</th>
                            <th>Modular No of Field</th>
                            <th>Action</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 1; ?>
                            <?php foreach ($moduler_box as $box) {  ?>
                                <tr   class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >
                                    <!--<td ><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $box->lsid;?>'>&nbsp; <?php echo $sl;?></td>-->
                                    <td><?php echo $sl;?></td>
                                    <td><?php echo $box->m_name; ?></td>
                                    <td><?php echo $box->m_input; ?></td>
                                     <td class="center">
                                        <a  class="edit" data-toggle="modal" data-target="#Editsource<?php echo $box->m_id;?>"><i class="ti-pencil"></i></a> 
                                       <!--- <a href="<?php echo base_url("lead/delete_source/$box->m_name") ?>" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> --->
                                    </td>
                                   
                                </tr>
                                
                                
<div id="Editsource<?php echo $box->m_id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modular Box</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('dash/update_modularbox','class="form-inner"') ?> 

<div class="row">
	<div class="form-group col-md-6">
	    <label>Modular Box</label>
	    <input type="hidden" name="m_id" value="<?php echo $box->m_id;?>">
	   
	  <input  class="form-control" name="m_name" placeholder="Lead Source"  type="text" value="<?php echo $box->m_name;?>" required>
	 </div>
	 <div class="form-group col-md-6">
	 	      <label>Modular No of Field</label>
	   <input class="form-control" name="m_input" value="<?php echo $box->m_input;?>">
	</div>
	
	
	
	<div class="sgnbtnmn form-group col-md-12">
	  <div class="sgnbtn">
		<input id="signupbtn" type="submit" value="Update" class="btn btn-success"  name="addlead">
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


 