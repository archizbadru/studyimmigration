<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/length") ?>"> <i class="fa fa-list"></i>  <?php echo display('program_length') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                       <div class="card-body">
              <?php echo form_open_multipart('lead/add_length','class="form-inner" id="length"') ?> 
              <?php echo form_hidden('length_id',$length->id) ?>
                <div class="card-body">

<div class="form-group col-sm-6">				
<label for="level"><?php echo display('program_level') ?></label>
<select class="form-control" name="level_id" id="level_id">
  <option value="">Please Select</option>
<?php foreach($level as $lvl){ ?>
  <option value="<?php echo $lvl->id; ?>" <?php if($lvl->id==$length->level_id){ echo 'selected';}?>><?php echo $lvl->level; ?></option>
<?php } ?>
</select>
</div>				
                  <div class="form-group col-sm-6">
                    <label for="length_name"><?php echo display('program_length')?> <i class="text-danger">*</i></label>
                    <input name="length_name" type="text" class="form-control" placeholder="<?php echo display('program_length')?>" value="<?php echo $length->length; ?>">
                  </div>
				  
                  
                  <div class="form-group col-sm-6">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php if($length->status == 1) { echo 'checked'; } ?> > <?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php if($length->status == 0) { echo 'checked'; } ?> > <?php echo display('inactive') ?>
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