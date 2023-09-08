<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>                 
                
                <div class="col-12">
                <a href="#" class="btn btn-raised btn-success" data-toggle="modal" data-target="#createmapping"><i class="ti-plus text-white"></i> &nbsp;Add New Stage Mapping</a>
                </div>
                <br>
<div id="createmapping" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Stage Mapping</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/stage_mapping','class="form-inner"') ?> 
<div class="row">
    <div class="form-group col-md-6">
      <label>Lead Stage</label>
      <select  class="form-control" name="stage_name" required> 
      <option value="">---Select Stage---</option>       
         <?php foreach($lead_stages as $stage){ ?>
         <option value="<?=$stage->stg_id ?>"><?=$stage->lead_stage_name ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group col-md-6">
        <label>Stage Name For Student Panel</label>
        <input class="form-control" name="stage_lang"  type="text">
    </div>
    
</div>
<div class="row">
    
    <div class="form-group col-md-6">
      <label>Student Visible</label>
      <input name="visible_status" value="1"  type="checkbox">
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
                            <th><?php echo display('serial') ?></th>
                            <th>Application Stages</th>
                            <th>Applicant Stage Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 1; ?>
                            <?php foreach ($mapping_stages as $mstage) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >
                                    <td><?php echo $sl;?></td>
                                    <td>
                                      <?php foreach($lead_stages as $stage){ if($stage->stg_id==$mstage->stage_id){ echo $stage->lead_stage_name;}} ?>
                                    </td>
                                    <td><?php echo $mstage->lang_name; ?></td>
                                    <td><?php if($mstage->visible_status=='1'){ echo 'Yes';}else{ echo 'No';} ?></td>
                                     <td class="center">
                                        <a href="<?php //echo base_url("user/edit/$score->use_id") ?>" class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#Editmapping<?php echo $mstage->id;?>"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/delete_stage_map/$mstage->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>                                   
                                </tr>
                                
        
        <div id="Editmapping<?php echo $mstage->id;?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Stage Mapping</h4>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('lead/update_stage_map','class="form-inner"') ?> 
        
        <div class="row">
        <div class="form-group col-md-6">
        <label>Lead Stage</label>
        <input type="hidden" name="map_id" value="<?php echo $mstage->id;?>">
      <select  class="form-control" name="stage_name" required> 
      <option value="">---Select Stage---</option>       
         <?php foreach($lead_stages as $stage){ ?>
         <option value="<?=$stage->stg_id ?>" <?php if($stage->stg_id==$mstage->stage_id){ echo 'selected';}?>><?=$stage->lead_stage_name ?></option>
        <?php } ?>
      </select>
        </div>
        <div class="form-group col-md-6">
          <label>Stage Name For Student Panel</label>
          <input class="form-control" name="stage_lang" value="<?php echo $mstage->lang_name; ?>" type="text">
        </div>

</div>
    <div class="row">
    <div class="form-group col-md-6">
        <label>Student Visible</label>
        <input name="visible_status" value="<?php echo $mstage->visible_status; ?>"  <?php if($mstage->visible_status=='1'){ echo 'checked';} ?> type="checkbox">        
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
 </script>