<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>                 
                
                <div class="col-12">
                <a href="#" class="btn btn-raised btn-success" data-toggle="modal" data-target="#createbranch"><i class="ti-plus text-white"></i> &nbsp;Add New Mapping</a>
                </div>
                <br>
<div id="createbranch" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Mapping</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/branch_master','class="form-inner"') ?> 
<div class="row">
    <div class="form-group col-md-6">
        <label>Branch Name</label>
        <select class="form-control branch_name"  name="branch_name[]" multiple>
        <?php foreach ($all_branch as $brnh) { ?>
                            <option value="<?php echo $brnh->id; ?>">
                              <?=$brnh->b_name ?>                               
                            </option>
                            <?php 
                        } ?>                                                      
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Department</label>
        <select class="form-control"  name="branch_dept" id="branch_dept">
        <?php foreach ($all_department as $dept) { ?>
                            <option value="<?php echo $dept->id; ?>">
                              <?=$dept->dept_name ?>                                
                            </option>
                            <?php 
                        } ?>                                                      
        </select>
    </div>

    <!-- <div class="form-group col-md-12">
        <label>User List</label>
        <select class="form-control"  name="assign_employee" id="select_user1">
        <?php foreach ($user_list as $user) { ?>
                            <option value="<?php echo $user->pk_i_admin_id; ?>">
                              <?=$user->s_display_name ?>&nbsp;<?=$user->last_name.' - '.$user->s_user_email; ?> (<?= $user->user_role ?>)                                
                            </option>
                            <?php 
                        } ?>                                                      
        </select>
    </div> -->
</div>
<div class="row">       
    <div class="sgnbtnmn form-group col-md-12">
      <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Add Mapping" class="btn btn-success"  name="addbanch">
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
                            <th>Branch Name</th>
                            <th>Department</th>
                            <!-- <th>Assigned Person</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 1; ?>
                            <?php foreach ($all_branch_master as $branch) {  
                                $branch_ids = explode(',', $branch->branch_name); ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >
                                    <td><?php echo $sl;?></td>
                                    <td><?php foreach($all_branch as $brnh){ if(in_array($brnh->id, $branch_ids)){echo $brnh->b_name.',';}} ?></td>
                                    <td><?php foreach($all_department as $department){ if($department->id==$branch->branch_dept){echo $department->dept_name;}} ?></td>
                                    <!-- <td><?php foreach($user_list as $user){ if($user->pk_i_admin_id==$branch->assign_employee){echo $user->s_display_name.' '.$user->last_name.' - '.$user->s_user_email.' ('.$user->user_role.')';}} ?></td> -->
                                     <td class="center">
                                        <a href="" class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#Editbranch<?php echo $branch->id;?>"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/delete_branch_master/$branch->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                    
                                </tr>
                                
        
        <div id="Editbranch<?php echo $branch->id;?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Mapping</h4>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('lead/update_branch_master','class="form-inner"') ?>        
        <div class="row">
        <input type="hidden" name="branch_master_id" value="<?php echo $branch->id;?>">
        <div class="form-group col-md-6">
        <label>Branch Name</label>
        <?php
        $branch_ids = array();
        if (!empty($branch->branch_name)) {
            $branch_ids    =   explode(',', $branch->branch_name);
        }
        ?>
        <select class="form-control branch_name"  name="branch_name[]" multiple>
        <?php foreach ($all_branch as $brnhedit) { ?>
                            <option value="<?php echo $brnhedit->id; ?>" <?php if(in_array($brnhedit->id, $branch_ids)){ echo 'selected';};?>>
                              <?=$brnhedit->b_name ?>                               
                            </option>
                            <?php 
                        } ?>                                                      
        </select>
        </div>

        <div class="form-group col-md-6">
        <label>Department</label>
        <select class="form-control"  name="branch_dept" id="branch_dept">
        <?php foreach ($all_department as $deptedit) { ?>
                            <option value="<?php echo $deptedit->id; ?>" <?php if($deptedit->id==$branch->branch_dept){ echo 'selected';};?>>
                              <?=$deptedit->dept_name ?>                                
                            </option>
                            <?php 
                        } ?>                                                      
        </select>
        </div>

        <!-- <div class="form-group col-md-12">
        <label>User List</label>
        <select class="form-control"  name="assign_employee" id="select_user">
        <?php foreach ($user_list as $user) { ?>
                            <option value="<?php echo $user->pk_i_admin_id; ?>" <?php if($user->pk_i_admin_id==$branch->assign_employee){ echo 'selected';};?>>
                              <?=$user->s_display_name ?>&nbsp;<?=$user->last_name.' - '.$user->s_user_email; ?> (<?= $user->user_role ?>)                                
                            </option>
                            <?php 
                        } ?>                                                      
        </select>
    </div> -->
        
</div>
    <div class="row">      
        <div class="sgnbtnmn form-group col-md-12">
        <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Update Mapping" class="btn btn-success"  name="addbranch">
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
<script>
    $('.branch_name').select2({});
</script>