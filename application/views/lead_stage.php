<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>                 
                
                <div class="col-12">
                <a href="#" class="btn btn-raised btn-success" data-toggle="modal" data-target="#createLead"><i class="ti-plus text-white"></i> &nbsp;Add New Application Stage</a>
                </div>
                <br>
<div id="createLead" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Application Stage</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/stage','class="form-inner"') ?> 
<div class="row">
    <div class="form-group col-md-6">
        <label>Application Stage</label>
      <input class="form-control" name="stage_name" placeholder="Lead Stage"  type="text" value="" required>
    </div>
    <div class="form-group col-md-6">
        <label>Process</label>
      <select  class="form-control process" name="process[]" multiple>
      <!--<option value="">---<?php echo 'For Process'; ?>---</option> -->       
         <?php foreach($products as $product){?>
         <option value="<?=$product->sb_id ?>"><?=$product->product_name ?></option>
        <?php } ?>
      </select>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label>Stage For State</label>
      <select  class="form-control process" name="stage_for[]" multiple>
      <!--<option value="">---<?php echo 'For State'; ?>---</option>-->        
         <option value="1"><?php echo display('enquiry') ?></option>
         <option value="2"><?php echo display('lead') ?></option>
         <option value="3"><?php echo display('client') ?></option>
         <option value="4"><?php echo display('refund_list') ?></option>
      </select>
    </div>

    <div class="form-group col-md-6">
        <label>Department For Disposition</label>
      <select class="form-control department multiple" name="department[]" multiple>
        <!--<option value="">---<?php echo 'For Department'; ?>---</option>-->
          <?php foreach ($all_department as $department) { ?>
        <option value="<?= $department->id ?>"><?= $department->dept_name ?></option>
          <?php } ?>
      </select>
    </div>

    <div class="form-group col-md-6">
        <label>Stage For Disposition</label>
      <select  class="form-control process" name="stage_for_disp">
         <option value="">---<?php echo 'For Disposition'; ?>---</option>        
         <option value="1"><?php echo 'Call Disposition'; ?></option>
         <option value="2"><?php echo 'Onboarding Disposition' ?></option>
      </select>
    </div>
    
    <div class="form-group col-md-6">
        <label>Stage Order</label>
      <input class="form-control" name="stage_order" placeholder="Stage Order"  type="number">
    </div>
    
    
    <div class="sgnbtnmn form-group col-md-12">
      <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Add Stage" class="btn btn-success"  name="addlead">
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
                            <th>Application Stages</th>
                            <th>Process</th>
                            <th>Stages</th>
                            <th>Department</th>
                            <th>Disposition</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 1; ?>
                            <?php foreach ($lead_stages as $stage) {
                            $stages = explode(',', $stage->stage_for);  ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >
                                    <!--<td ><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $stage->stg_id;?>'>&nbsp; <?php echo $sl;?></td>-->
                                    <td><?php echo $sl;?></td>
                                    <td><?php echo $stage->lead_stage_name; ?></td>
                                    <td>
                                        <?php                                         
                                        if (!empty($stage->process_id)) {
                                            $q    =   $this->db->query("SELECT GROUP_CONCAT(tbl_product.product_name) as p from tbl_product where tbl_product.sb_id in ($stage->process_id)")->row_array();
                                            echo $q['p'];
                                        }else{
                                            echo "NA";
                                        }
                                        ?>                                        
                                    </td>
                                    <td>
                                    <?php if (in_array('4', $stages)) {  echo 'Refund Case'.','; }?>
                                                 <?php if (in_array('1', $stages)) {  echo display("enquiry").','; }?>
                                                     <?php  if (in_array('2', $stages)) { echo display("lead").','; } ?>
                                                     <?php  if (in_array('3', $stages)) { echo display("client").','; } ?></option>                                       
                                    </td>
                                    <td>
                                        <?php                                         
                                        if (!empty($stage->departments_for)) {
                                            $d    =   $this->db->query("SELECT GROUP_CONCAT(tbl_department.dept_name) as d from tbl_department where tbl_department.id in ($stage->departments_for)")->row_array();
                                            echo $d['d'];
                                        }else{
                                            echo "NA";
                                        }
                                        ?>                                        
                                    </td>
                                    <td><?php if($stage->stage_for_disp=='1'){ echo 'Call Disposition';}else if($stage->stage_for_disp=='2'){ echo 'Onboarding Disposition';}else{ echo 'NA'; } ?></td>
                                    <td><?php echo $stage->stage_order; ?></td>
                                     <td class="center">
                                        <a href="<?php //echo base_url("user/edit/$score->use_id") ?>" class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#Editstage<?php echo $stage->stg_id;?>"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/delete_stage/$stage->stg_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                    
                                </tr>
                                
        
        <div id="Editstage<?php echo $stage->stg_id;?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Application Stage</h4>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('lead/update_stage','class="form-inner"') ?> 
        
        <div class="row">
        <div class="form-group col-md-6">
        <label>Application Stage</label>
        <input type="hidden" name="stage_id" value="<?php echo $stage->stg_id;?>">
        <input class="form-control" name="stage_name" placeholder="Application Stage"  type="text" value="<?php echo $stage->lead_stage_name;?>" required>
        </div>
        <div class="form-group col-md-6">
        <label>Process</label>
        <?php
        $process_ids = array();
        if (!empty($stage->process_id)) {
            $process_ids    =   explode(',', $stage->process_id);
        }
        ?>
      <select  class="form-control process" name="process[]" multiple> 
      <!--<option value="">---<?php echo 'For Process'; ?>---</option>-->       
         <?php foreach($products as $product){?>
         <option value="<?=$product->sb_id ?>" <?php if(!empty($process_ids) && in_array($product->sb_id, $process_ids)){?>selected <?php }?>><?=$product->product_name ?></option>
        <?php } ?>
      </select>
    </div>

</div>
    <div class="row">
    <div class="form-group col-md-6">
        <label>Stage For</label>
        <?php
        $stage_for = array();
        if (!empty($stage->stage_for)) {
            $stage_for    =   explode(',', $stage->stage_for);
        }
        ?>
      <select  class="form-control process" name="stage_for[]" multiple>
      <!--<option value="">---<?php echo 'For State'; ?>---</option> -->       
         <option value="1" <?php if(!empty($stage_for) && in_array(1, $stage_for)){?>selected <?php }?>>Onboarding</option>
         <option value="2" <?php if(!empty($stage_for) && in_array(2, $stage_for)){?>selected <?php }?>>Application</option>
         <option value="3" <?php if(!empty($stage_for) && in_array(3, $stage_for)){?>selected <?php }?>>Case Management</option>
         <option value="4" <?php if(!empty($stage_for) && in_array(4, $stage_for)){?>selected <?php }?>>Refund Case</option>
      </select>
    </div>

    <div class="form-group col-sm-6">
      <div class="form-group">
        <label>Department For Disposition</label>
          <?php
            $departments = explode(',', $stage->departments_for);
          ?>
        <select class="form-control department multiple" name="department[]" multiple>
          <!--<option value="">---<?php echo 'For Department'; ?>---</option>-->
            <?php foreach ($all_department as $department) { ?> 
          <option value="<?= $department->id ?>" <?php if (in_array($department->id, $departments)) {
                        echo 'selected';} ?>><?= $department->dept_name ?></option>
            <?php } ?>
        </select>
      </div>
    </div>

    <div class="form-group col-md-6">
        <label>Stage For Disposition</label>
      <select  class="form-control process" name="stage_for_disp">
         <option value="">---<?php echo 'For Disposition'; ?>---</option>        
         <option value="1" <?php if(!empty($stage->stage_for_disp) && ($stage->stage_for_disp=='1')){ ?>selected <?php }?>><?php echo 'Call Disposition'; ?></option>
         <option value="2" <?php if(!empty($stage->stage_for_disp) && ($stage->stage_for_disp=='2')){ ?>selected <?php }?>><?php echo 'Onboarding Disposition' ?></option>
      </select>
    </div>

    <div class="form-group col-md-6">
        <label>Stage Order</label>
      <input class="form-control" name="stage_order" placeholder="Stage Order"  type="number" value="<?php echo $stage->stage_order;?>">
    </div>  
        
        
        <div class="sgnbtnmn form-group col-md-12">
        <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Update Stage" class="btn btn-success"  name="addlead">
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
 
 <script type="text/javascript">
    $('.process').select2({}); 
    $('.department').select2({});    
 </script>