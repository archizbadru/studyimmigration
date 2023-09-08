<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>                 
                
                <div class="col-12">
                <a href="#" class="btn btn-raised btn-success" data-toggle="modal" data-target="#createtype"><i class="ti-plus text-white"></i> &nbsp;Add New Desposition Type</a>
                </div>
                <br>
<div id="createtype" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Desposition Type</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/desp_type','class="form-inner"') ?> 
<div class="row">
    <div class="form-group col-md-6">
        <label>Desposition Type</label>
      <input class="form-control" name="type_name" placeholder="Disposition Type"  type="text" required>
    </div>
    
</div>
<div class="row">  
    
    <div class="sgnbtnmn form-group col-md-12">
      <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Add Type" class="btn btn-success"  name="addtype">
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
                            <th>Disposition Types</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 1; ?>
                            <?php foreach ($desp_type as $type) {  ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >
                                    <td><?php echo $sl;?></td>
                                    <td><?php echo $type->type_name; ?></td>
                                     <td class="center">
                                        <a href="#" class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#Edittype<?php echo $type->id;?>"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/delete_type/$type->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                    
                                </tr>
                                
        
        <div id="Edittype<?php echo $type->id;?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
       
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Disposition Type</h4>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('lead/update_type','class="form-inner"') ?> 
        
    <div class="row">
        <div class="form-group col-md-6">
        <label>Disposition Type</label>
        <input type="hidden" name="type_id" value="<?php echo $type->id;?>">
        <input class="form-control" name="type_name" placeholder="Disposition Type"  type="text" value="<?php echo $type->type_name ;?>" required>
        </div>

    </div>
    <div class="row">        
        
        <div class="sgnbtnmn form-group col-md-12">
        <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Disposition Type" class="btn btn-success"  name="addtype">
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