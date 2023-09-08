<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/subsourcelist") ?>"> <i class="fa fa-list"></i>  <?php echo display('subsource_list') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <div class="card-body">
                            <?php echo form_open_multipart('lead/add_subsource', 'class="form-inner" id="territory"') ?> 
                            <?php echo form_hidden('subsource_id', $subsource->subsource_id) ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="subsource_name"><?php echo display('subsource_name') ?> <i class="text-danger">*</i></label>
                                    <input name="subsource_name" type="text" class="form-control" placeholder="<?php echo display('subsource_name') ?>" value="<?php echo $subsource->subsource_name ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="lead_source_name"><?php echo display('lead_source') ?> </label>
                                    <select class="form-control" name="lead_source_id" id="lead_source_id">
                                        <option value="" selected>Select</option>
                                        <?php foreach ($lead_source_list as $c) { ?>                                   
                                            <option value="<?php echo $c->lsid; ?>" <?php if ($subsource->lead_source_id == $c->lsid) {echo 'selected';}?>><?php echo $c->lead_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status"><?php echo display('status') ?></label>
                                    <div class="form-check">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" <?php if($c->status == 1) { echo 'checked'; } ?> ><?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" <?php if($c->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
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