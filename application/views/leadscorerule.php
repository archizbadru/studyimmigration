<!-- <div class="row">

    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 



            <div class="panel-body">

                

                <div class="col-12">

                                    <a href="#" class="btn btn-raised btn-success"

				data-toggle="modal" data-target="#createLead"><i class="ti-plus text-white"></i> &nbsp;Add New Lead Rule</a>

                                </div>

                                <br> -->

                

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default thumbnail"> 
      <div class="panel-body">
        <div class="col-12">
          <a href="#" data-toggle="modal" data-target="#rulemodal" class="btn btn-raised btn-success" onclick="showRuleList()"><i class="ti-plus text-white"></i> &nbsp;Add New Lead Rule</a>
        </div>
      </div>
    </div>
    <div class="panel panel-default thumbnail"> 
      <div class="panel-body">
        <div class="col-12">
          <?php echo $table; ?>
        </div>
      </div>
    </div>
  </div>
</div>            

<div id="rulemodal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add New Lead Rule</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="display: none;" id="rulelist">
          <div class="col-sm-12">
            <label>Select Field</label>
            <select class="fields form-control" onchange="makeRowForFields(this.value)">
              <option value="">Select</option>
              <option value="fn">Name</option>
              <option value="process">Process</option>
              <option value="gender">Gender</option>
              <option value="product">Product</option>
              <option value="enqs">Enquiry Source</option>
              <option value="subsrc">Sub Source</option>
              <option value="state">State</option>
              <option value="city">City</option>
              <option value="country">Country</option>
              <!-- <option value="">Select</option>
              <option value="">Select</option>
              <option value="">Select</option>
              <option value="">Select</option>
              <option value="">Select</option>
              <option value="">Select</option>
              <option value="">Select</option>
              <option value="">Select</option>
              <option value="">Select</option> -->
            </select>
          </div>
        </div>
        <div class="rulediv" style="display: none;">
          <div class="row">
            <div class="col-sm-12">
              <form action="<?=base_url('Leadscorerule/saveRule')?>" method="post">
                <table width="100%" class="datatable table table-striped table-bordered table-hover ruletable">
                  <thead>
                      <tr>
                        <th>Field</th>
                        <th>Condition</th>
                        <th>Value</th>
                        <th>Lead Score</th>
                      </tr>
                  </thead>

                  <tbody>
                  </tbody>
                </table>
                <button type="submit" name="=submit" class="btn btn-success">Save</button>
                <button type="submit" name="=button" data-dismiss="modal" class="btn btn-default close">Close</button>
              </form>
          </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

      





<script type="text/javascript">

  function showRuleList()
  {
    $('#rulelist').css('display','block');
  }

  function makeRowForFields(field)
  { 
    $(".rulediv").css('display','block');
    if(field == "fn")
    {
      $(".ruletable > tbody").append("<tr><td>First Name</td><td><select class='fields form-control' name='namecondition'><option value=''>Select</option><option value='LIKE %'>Start With</option><option value='LIKE %'>End With</option></select></td><td><input type='text' name='fname' class='form-control'></td><td><input type='text' name='nameaction' class='form-control'></td></tr>");
    }
    
    else if(field == "process")
    {
      $(".ruletable > tbody").append("<tr><td>Process</td><td><select class='fields form-control' name='procondition'><option value=''>Select</option><option value='LIKE %'>Start With</option><option value='LIKE %'>End With</option><option value='='>Is</option><option value='>'>Is Greater Than</option><option value='<'>Is Less Than</option></select></td><td><input type='text' name='process' class='form-control'></td><td><input type='text' name='processaction' class='form-control'></td></tr>");
    } 
    else if(field == "gender")
    {
      $(".ruletable > tbody").append("<tr><td>Gender</td><td><select class='fields form-control' name='gendercondition'><option value=''>Select</option><option value='LIKE %'>Start With</option><option value='LIKE %'>End With</option><option value='='>Is</option><option value='>'>Is Greater Than</option><option value='<'>Is Less Than</option></select></td><td><input type='text' name='gender' class='form-control'></td><td><input type='text' name='genderaction' class='form-control'></td></tr>");
    }
    else if(field == "product")
    {
      $(".ruletable > tbody").append("<tr><td>Product</td><td><select class='fields form-control' name='productcondition'><option value=''>Select</option><option value='LIKE %'>Start With</option><option value='LIKE %'>End With</option><option value='='>Is</option><option value='>'>Is Greater Than</option><option value='<'>Is Less Than</option></select></td><td><input type='text' name='product' class='form-control'></td><td><input type='text' name='productaction' class='form-control'></td></tr>");
    }
    else if(field == "enqs")
    {
      $(".ruletable > tbody").append("<tr><td>Enquiry Source</td><td><select class='fields form-control' name='sourcecondition'><option value=''>Select</option><option value='LIKE %'>Start With</option><option value='LIKE %'>End With</option><option value='='>Is</option><option value='>'>Is Greater Than</option><option value='<'>Is Less Than</option></select></td><td><input type='text' name='enqs' class='form-control'></td><td><input type='text' name='enqsaction' class='form-control'></td></tr>");
    }
    else if(field == "subsrc")
    {
      $(".ruletable > tbody").append("<tr><td>Sub Source</td><td><select class='fields form-control' name='subscondition'><option value=''>Select</option><option value='LIKE %'>Start With</option><option value='LIKE %'>End With</option><option value='='>Is</option><option value='>'>Is Greater Than</option><option value='<'>Is Less Than</option></select></td><td><input type='text' name='subs' class='form-control'></td><td><input type='text' name='subsaction' class='form-control'></td></tr>");
    }
    else if(field == "state")
    {
      $(".ruletable > tbody").append("<tr><td>State</td><td><select class='fields form-control' name='statecondition'><option value=''>Select</option><option value='LIKE %'>Start With</option><option value='LIKE %'>End With</option><option value='='>Is</option><option value='>'>Is Greater Than</option><option value='<'>Is Less Than</option></select></td><td><input type='text' name='state' class='form-control'></td><td><input type='text' name='stateaction' class='form-control'></td></tr>");
    }
    else if(field == "city")
    {
      $(".ruletable > tbody").append("<tr><td>City</td><td><select class='fields form-control' name='citycondition'><option value=''>Select</option><option value='LIKE %'>Start With</option><option value='LIKE %'>End With</option><option value='='>Is</option><option value='>'>Is Greater Than</option><option value='<'>Is Less Than</option></select></td><td><input type='text' name='city' class='form-control'></td><td><input type='text' name='cityaction' class='form-control'></td></tr>");
    }
    else if(field == "country")
    {
      $(".ruletable > tbody").append("<tr><td>Country</td><td><select class='fields form-control' name='countrycondition'><option value=''>Select</option><option value='LIKE %'>Start With</option><option value='LIKE %'>End With</option><option value='='>Is</option><option value='>'>Is Greater Than</option><option value='<'>Is Less Than</option></select></td><td><input type='text' name='country' class='form-control'></td><td><input type='text' name='countryaction' class='form-control'></td></tr>");
    }
    
  }

</script>
<!--

<div id="createLead" class="modal fade" role="dialog">

  <div class="modal-dialog">




    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add New Lead Rule</h4>

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

                            <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1"><input type='checkbox' class="checked_all" value="check all" >&nbsp; <?php echo display('serial') ?></th>

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

                                    <td ><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $score->lsid;?>'>&nbsp; <?php echo $sl;?></td>-

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

                </table>  

            </div>

        </div>

    </div>

</div>





  -->