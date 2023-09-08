<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>                 
                
                <div class="col-12">
                <a href="#" class="btn btn-raised btn-success" data-toggle="modal" data-target="#createLead"><i class="ti-plus text-white"></i> &nbsp;Add New FAQ</a>
                </div>
                <br>
<div id="createLead" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New FAQ</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/faq','class="form-inner"') ?> 
<div class="row">
    <div class="form-group col-md-6">
        <label>FAQ Title</label>
      <input class="form-control" name="faq_title" placeholder="Title"  type="text" value="" required>
    </div>
    <div class="form-group col-md-6">
        <label>FAQ Discription</label>
    <textarea class="form-control" name="faq_dscptn" placeholder="Discription"  type="text" value="" required></textarea>
    </div>
</div>
<div class="row">       
    <div class="sgnbtnmn form-group col-md-12">
      <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Add FAQ" class="btn btn-success"  name="addlead">
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
                            <th>FAQ Title</th>
                            <th>FAQ Discription</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 1; ?>
                            <?php foreach ($all_faq as $faq) {  ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >
                                    <td><?php echo $sl;?></td>
                                    <td><?php echo $faq->que_type; ?></td>
									<td><?php echo $faq->answer; ?></td>
                                     <td class="center">
                                        <a href="" class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#Editfaq<?php echo $faq->id;?>"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/delete_faq/$faq->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                    
                                </tr>
                                
        
        <div id="Editfaq<?php echo $faq->id;?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit FAQ</h4>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('lead/update_faq','class="form-inner"') ?>        
        <div class="row">
        <div class="form-group col-md-6">
        <label>FAQ Title</label>
        <input type="hidden" name="faq_id" value="<?php echo $faq->id;?>">
        <input class="form-control" name="faq_title" placeholder="Faq title"  type="text" value="<?php echo $faq->que_type;?>" required>
        </div>
		
		<div class="form-group col-md-6">
        <label>FAQ Discription</label>
        <textarea class="form-control" name="faq_dscptn" placeholder="Discription"  type="text" value="<?php echo $faq->answer;?>" required><?php echo $faq->answer;?></textarea>
        </div>
        
</div>
    <div class="row">      
        <div class="sgnbtnmn form-group col-md-12">
        <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Update FAQ" class="btn btn-success"  name="addlead">
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