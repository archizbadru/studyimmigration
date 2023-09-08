<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/vidlist") ?>"> <i class="fa fa-list"></i>  <?php echo display('vedio_list') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                       <div class="card-body">
              <?php echo form_open_multipart('lead/add_video','class="form-inner" id="territory"') ?> 
              <?php echo form_hidden('vid_id',$vid->id) ?>
                <div class="card-body">
                  <div class="form-group col-sm-6">
                    <label for="title_name"><?php echo display('title_name')?> <i class="text-danger">*</i></label>
                    <input name="title_name" type="text" class="form-control" placeholder="<?php echo display('title_name')?>" value="<?php echo $vid->title; ?>" >
                  </div> 
				  
				  <div class="form-group col-sm-6">
                    <label for="link_name"><?php echo display('link_name')?> <i class="text-danger">*</i></label>
                    <input name="link_name" type="url" class="form-control" placeholder="<?php echo display('link_name')?>" value="<?php echo $vid->link; ?>" >
                  </div> 
				  
				  <div class="form-group col-sm-6">
                    <label for="discription_name"><?php echo display('description')?> <i class="text-danger">*</i></label>
                    <textarea name="discription_name" type="text" class="form-control" placeholder="<?php echo display('description')?>" value="<?php echo $vid->des; ?>"><?php echo $vid->des; ?></textarea>
                  </div>

                 <div class="form-group col-sm-6">
                    <label for="key_name"><?php echo display('meta_keyword')?> <i class="text-danger">*</i></label>
                    <input name="key_name" type="text" class="form-control" placeholder="<?php echo display('meta_keyword')?>" value="<?php echo $vid->meta_key; ?>">
                  </div> 				  
				  
                  <div class="form-group col-sm-6">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php if($vid->status == 1) { echo 'checked'; } ?> ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php if($vid->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
                        </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer col-sm-12">
                    <button type="reset" class="btn btn-default"><?php echo display('reset') ?></button> &nbsp;<button class="btn btn-primary"><?php echo display('save') ?></button>
                </div>
              </form>
            </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
