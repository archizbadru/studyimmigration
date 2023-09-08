<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail"> 
            <div class="panel-body">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>                 
                
                <div class="col-12">
                <a href="#" class="btn btn-raised btn-success" data-toggle="modal" data-target="#createurl"><i class="ti-plus text-white"></i> &nbsp;Add New Urls</a>
                </div>
                <br>
<div id="createurl" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New URL</h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('lead/url','class="form-inner"') ?> 
<div class="row">
    <div class="form-group col-md-6">
        <label>Url Name</label>
        <input class="form-control" name="url_name" placeholder="put Name here.."  type="text" required>
    </div>
    <div class="form-group col-md-6">
        <label>Country</label>
        <select class="form-control"  name="url_counrty"  id="url_counrty"> 
                <option>Select Country</option>
                <?php foreach($country as $cntry){ ?>
                <option value = "<?php echo $cntry->id_c; ?>"><?php echo $cntry->country_name; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Url Link</label>
        <textarea class="form-control" name="url_link" placeholder="put link here.."  type="text" value="" required></textarea>
    </div>
</div>
<div class="row">       
    <div class="sgnbtnmn form-group col-md-12">
      <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Add Url" class="btn btn-success"  name="addurl">
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
                            <th>Url Name</th>
                            <th>Url Counrty</th>
                            <th>Url Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 1; ?>
                            <?php foreach ($all_url as $url) {  ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?> clickable-row" style="cursor:pointer;"  >
                                    <td><?php echo $sl;?></td>
                                    <td><?php echo $url->url_name;?></td>
                                    <td><?php foreach($country as $cntry){ if($cntry->id_c==$url->url_counrty){echo $cntry->country_name;}} ?></td>
									<td><?php echo $url->url_link; ?></td>
                                     <td class="center">
                                        <a href="" class="btn btn-xs  btn-primary" data-toggle="modal" data-target="#Editurl<?php echo $url->id;?>"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/delete_url/$url->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                    
                                </tr>
                                
        
        <div id="Editurl<?php echo $url->id;?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Url</h4>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('lead/update_url','class="form-inner"') ?>        
        <div class="row">

        <div class="form-group col-md-6">
        <label>Url Name</label>
        <input class="form-control" name="url_name" placeholder="put Name here.."  value="<?php echo $url->url_name; ?>" type="text" required>
        </div>

        <div class="form-group col-md-6">
        <label>Country</label>
        <input type="hidden" name="url_id" value="<?php echo $url->id;?>">
        <select class="form-control"  name="url_counrty"  id="url_counrty"> 
                <option>Select Country</option>
                <?php foreach($country as $cntry){ ?>
                <option value = "<?php echo $cntry->id_c; ?>" <?php if($cntry->id_c==$url->url_counrty){ echo 'selected';};?>><?php echo $cntry->country_name; ?></option>
            <?php } ?>
        </select>
        </div>
		
		<div class="form-group col-md-6">
        <label>Url Link</label>
        <textarea class="form-control" name="url_link" placeholder="link"  type="text" value="<?php echo $url->url_link;?>" required><?php echo $url->url_link;?></textarea>
        </div>
        
</div>
    <div class="row">      
        <div class="sgnbtnmn form-group col-md-12">
        <div class="sgnbtn">
        <input id="signupbtn" type="submit" value="Update Url" class="btn btn-success"  name="addurl">
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