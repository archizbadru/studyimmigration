<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                
                <div class="col-12">
                                    <a href="#" class="btn btn-raised btn-success"
				data-toggle="modal" data-target="#createLead"><i class="ti-plus text-white"></i> &nbsp;Add New Lead Probability</a>
                                </div>
                                <br>
                
                

<div id="createLead" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Lead Probability</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/lead_score','class="form-inner"') ?> 

<div class="row">
	<div class="form-group col-md-6">
	    <label>Name</label>
	  <input class="form-control" name="score_name" placeholder="Lead Probability"  type="text" value="" required>
	</div>
	
	<div class="form-group col-md-6">
	    <label>Probability</label>
	  <input class="form-control" name="score_rate" placeholder="Score Probability Rate"  type="text" value="" required>
	</div>
	
	
	
	<div class="sgnbtnmn form-group col-md-12">
	  <div class="sgnbtn">
		<input id="signupbtn" type="submit" value="Add Score" class="btn btn-success"  name="addlead">
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
                            <th>Lead Score</th>
                            <th>Probability Rate</th>
                            <th>Action</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 1; ?>
                            <?php foreach ($lead_score as $score) {  ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >
                                    <!--<td ><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $score->lsid;?>'>&nbsp; <?php echo $sl;?></td>-->
                                    <td><?php echo $sl;?></td>
                                    <td><?php echo $score->score_name; ?></td>
                                    <td><?php echo $score->probability; ?></td>
                                    <td class="center">
                                        <a href="<?php //echo base_url("user/edit/$score->use_id") ?>" class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#Editscore<?php echo $score->sc_id;?>"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/delete_score/$score->sc_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                                
                                
<div id="Editscore<?php echo $score->sc_id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Lead Source</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/update_score','class="form-inner"') ?> 

<div class="row">
	<div class="form-group col-md-6">
	    <label>Name</label>
	    <input type="hidden" name="score_id" value="<?php echo $score->sc_id;?>">
	  <input class="form-control" name="score_name" placeholder="Lead Probability"  type="text" value="<?php echo $score->score_name;?>" required>
	</div>
	
	<div class="form-group col-md-6">
	    <label>Probability</label>
	  <input class="form-control" name="score_rate" placeholder="Score Probability Rate"  type="text" value="<?php echo $score->probability;?>" required>
	</div>
	
	
	
	<div class="sgnbtnmn form-group col-md-12">
	  <div class="sgnbtn">
		<input id="signupbtn" type="submit" value="Update Score" class="btn btn-success"  name="addlead">
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


 