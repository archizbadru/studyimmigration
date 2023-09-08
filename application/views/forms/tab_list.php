<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div class="panel panel-default thumbnail">

            <div class="panel-body">

                <div class="col-12">

                    <a href="#" class="btn btn-raised btn-success" data-toggle="modal" data-target="#createTab"><i class="ti-plus text-white"></i> &nbsp;Add New Tab</a>

                </div>

                <br>

                <div id="createTab" class="modal fade" role="dialog">

                    <div class="modal-dialog">

                        <!-- Modal content-->

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title">Add New Tab</h4>

                            </div>

                            <div class="modal-body">

                                <?php echo form_open_multipart('form/form/create_tab','class="form-inner"') ?>

                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label>Tab Name</label>
                                            <input class="form-control" name="tab_name" placeholder="Tab name" type="text" value="" required>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <!-- <label>Tab Name</label>
                                            <input class="form-control" name="tab_name" placeholder="Tab name" type="text" value="" required> -->
                                            <input type="checkbox" name="isqueryform" class="form-control" value="1">Is Query Type Form

                                        </div>

                                        <div class="form-group col-md-12 rights" style="display: none;">
                                            <label>Rights</label>
                                            <input type="checkbox" name="edit" value="1">Edit
                                            <input type="checkbox" name="delete" value="1">Delete
                                            <!-- <select name="rights" class="rights form-control">
                                                <option value="">Select</option>
                                                <option value="1">Normal</option>
                                                <option value="2">Query Type</option>
                                            </select> -->

                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Company</label>                                            
                                            <select class="form-control" name="comp_ids[]" multiple>                                                
                                                <?php foreach($company_list as $key=>$company){?>
                                                    <option value="<?=$company->user_id ?>">
                    									<?php echo empty($company->a_companyname)?$company->firstname.' '.$company->lastname:$company->a_companyname ?>
                                    					
                                                    </option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                        <div class="sgnbtnmn form-group col-md-12">
                                            <div class="sgnbtn">
                                                <input type="submit" value="Add Tab" class="btn btn-success" name="addTab">
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
                            <th>
                                <?php echo display('serial') ?>
                            </th>
                            <th>Tab Title</th>
                            <th>Tab For</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl = 1; ?>
                            <?php 
                            if (!empty($tab_list)) {
                            foreach ($tab_list as $tab) {  ?>

                                <tr>
                                    <td>
                                        <?php echo $sl;?>
                                    </td>
                                    <td>
                                        <?php echo $tab['title']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        
                                        if(!empty($tab['comp_id'])){
                                        	
                                        	$this->db->select("a_companyname,CONCAT_WS(' ',firstname,lastname) as name");

                                        	$where = " user_id IN (".$tab['comp_id'].") ";

                                        	$this->db->where($where);

                                        	$comps	=	$this->db->get('user')->result_array();

                                        	foreach ($comps as $key => $value) {
                                        		echo empty($value['a_companyname'])?$value['name']:$value['a_companyname'];
                                        		echo " <b>,</b><br> ";
                                        	}

                                        }
                                        ?>
                                    </td>

                                    <td class="center">

                                        <a href="" class="btn btn-xs  btn-primary edit_tab" data-tid="<?=$tab['id']?>" data-toggle="modal" data-target="#EditTab"><i class="fa fa-edit"></i></a>

                                        <a href="" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a>

                                    </td>

                                </tr>                                
                                <?php $sl++; ?>
                                    <?php } 
                                }?>
                    </tbody>

                </table>
                <!-- /.table-responsive -->

            </div>

        </div>

    </div>

</div>


				<div id="EditTab" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Tab</h4>
                            </div>
                            <div class="modal-body">
                                <?php echo form_open_multipart('form/form/create_tab',array('class'=>"form-inner",'id'=>'editTab'))?>
                                    
                                   </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

<script type="text/javascript">
    $('input[type="checkbox"][name="isqueryform"]').change(function() {
     if(this.checked) {
         // do something when checked
         $(".rights").css("display","block");
     }
     else
     {
        $(".rights").css("display","none");  
     }
 });
</script>


<script type="text/javascript">
	$("select[name='comp_ids[]']").select2();

	$(".edit_tab").on('click',function(){
		var tid = $(this).data('tid');
		var url = "<?=base_url().'form/form/get_edit_tab_content/'?>";
		$.ajax({
			type: "POST",
			url: url,
			data:{
				tab_id:tid
			},
			success: function(data){                
			  $("#editTab").html(data); 
			  $("#edit_tab_comp").select2();
			}
		});
	});
</script>