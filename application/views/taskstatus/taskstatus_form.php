<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/taskstatuslist") ?>"> <i class="fa fa-list"></i>  <?php echo display('taskstatus_list') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                       <div class="card-body">
              <?php echo form_open_multipart('lead/add_taskstatus','class="form-inner" id="territory"') ?> 
              <?php echo form_hidden('taskstatus_id',$formdata->taskstatus_id) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="taskstatus_name"><?php echo display('taskstatus_name')?> <i class="text-danger">*</i></label>
                    <input name="taskstatus_name" type="text" class="form-control" placeholder="<?php echo display('taskstatus_name')?>" value="<?php echo $formdata->taskstatus_name ?>" >
                  </div>
                  <div class="form-group">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php if($formdata->status == 1) { echo 'checked'; } ?> ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php if($formdata->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
                        </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
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