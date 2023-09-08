


<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 



            <div class="panel-body">

                

                <div class="col-12">

                                    <!--<a href="#" class="btn btn-raised btn-success"

				data-toggle="modal" data-target="#createLead"><i class="ti-plus text-white"></i> &nbsp;Add New</a> user_permissions.php-->
                <?php if(user_access(140)) { ?>
    				 <div class="btn-group"> 

                       <a href="<?php echo base_url('user/permissions') ?>" class="btn btn-raised btn-success"><i class="ti-plus text-white"></i> &nbsp;Add New</a> 

                    </div>

                    <!-- <div class="btn-group float-left"> 

<a href="<?php echo base_url('user/add_applicant') ?>" class="btn btn-raised btn-primary"><i class="ti-plus text-white"></i> &nbsp;Seperate Applicant List</a> 

</div> -->
                <?php } ?>

			

                                </div>

                                <br>

                

                



<div id="createLead" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add New</h4>

      </div>

      <div class="modal-body">

      <?php echo form_open_multipart('user/user_type_add','class="form-inner"') ?> 



<div class="row">

	<div class="form-group col-md-6">

	    <label>Add User Type</label>

	  <input class="form-control" name="user_type" placeholder="<?php echo display('user_function') ?>"  type="text" value="" required>

	</div>



	<div class="sgnbtnmn form-group col-md-12">

	  <div class="sgnbtn">

		<input id="signupbtn" type="submit" value="Save" class="btn btn-success"  name="addlead">

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

                            <th><?php echo display('user_function') ?></th>

                            <th>Status</th>

                            <th><?php echo display('action') ?></th>

                            

                            

                        </tr>

                    </thead>

                    <tbody>

                        

                            <?php $sl = 1; ?>

                            <?php foreach ($lead_score as $score) {  ?>

                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >

                                    <!--<td ><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $score->lsid;?>'>&nbsp; <?php echo $sl;?></td>-->

                                    <td><?php echo $sl;?></td>

                                    <td><?php echo $score->user_role; ?></td>

                                    <td>

                                        <?php if($score->status==1){echo 'Active';} else {echo 'DeActive';} ?>

                                       

                                      

                                    </td>

                                   <td class="center">

                                        <!--<a href="<?php //echo base_url("user/edit/$score->use_id") ?>" class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#EditRole<?php echo $score->use_id;?>"><i class="fa fa-edit"></i></a>-->
                                        <?php if(user_access(141)) { ?>
                                            <a href="<?php echo base_url("user/edit_user_role/$score->use_id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a>
                                        <?php }  if(user_access(142)) { ?>
                                            <a href="<?php echo base_url("user/delete_userrole/$score->use_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                        <?php } ?>
                                    </td>

                                </tr>

                                

                                

        

        <div id="EditRole<?php echo $score->use_id;?>" class="modal fade" role="dialog">

        <div class="modal-dialog">

        

        <!-- Modal content-->

        <div class="modal-content">

        <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Edit User Roles</h4>

        </div>

        <div class="modal-body">

        <?php echo form_open_multipart('user/update_role','class="form-inner"') ?> 

        

        <div class="row">

        <div class="form-group col-md-6">

        <label>Add User Type</label>

        <input type="hidden" name="role_id" value="<?php echo $score->use_id; ?>">

        <input class="form-control" name="user_type" placeholder="Enter User Type"  type="text" value="<?php echo $score->user_role; ?>" required>

        </div>

        

        <div class="sgnbtnmn form-group col-md-12">

        <div class="sgnbtn">

        <input id="signupbtn" type="submit" value="Save" class="btn btn-success"  name="addlead">

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

<style>

    

    .material-switch > input[type="checkbox"] {

    display: none;   

}



.material-switch > label {

    cursor: pointer;

    height: 0px;

    position: relative; 

    width: 40px;  

}



.material-switch > label::before {

    background: rgb(0, 0, 0);

    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);

    border-radius: 8px;

    content: '';

    height: 16px;

    margin-top: -8px;

    position:absolute;

    opacity: 0.3;

    transition: all 0.4s ease-in-out;

    width: 40px;

}

.material-switch > label::after {

    background: rgb(255, 255, 255);

    border-radius: 16px;

    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);

    content: '';

    height: 24px;

    left: -4px;

    margin-top: -8px;

    position: absolute;

    top: -4px;

    transition: all 0.3s ease-in-out;

    width: 24px;

}

.material-switch > input[type="checkbox"]:checked + label::before {

    background: inherit;

    opacity: 0.5;

}

.material-switch > input[type="checkbox"]:checked + label::after {

    background: inherit;

    left: 20px;

}



.label-success {

    border: none !important;

}

    

    

</style>



 