<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/centerlist") ?>"> <i class="fa fa-list"></i>  <?php echo display('center_list') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                       <div class="card-body">
              <?php echo form_open_multipart('lead/add_center','class="form-inner" id="territory"') ?> 
              <?php echo form_hidden('center_id',$center->center_id) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="center_name"><?php echo display('center_name')?> <i class="text-danger">*</i></label>
                    <input name="center_name" type="text" class="form-control" placeholder="<?php echo display('center_name')?>" value="<?php echo $center->center_name ?>" >
                  </div>
                  <div class="form-group">
                    <label for="contact_name"><?php echo display('contact_name')?></label>
                    <input name="contact_name" type="text" class="form-control" placeholder="<?php echo display('contact_name')?>" value="<?php echo $center->contact_name ?>" >
                  </div>
                 <div class="form-group">
                    <label for="contact_number"><?php echo display('contact_number')?></label>
                    <input name="contact_number" type="text" class="form-control" placeholder="<?php echo display('contact_number')?>" value="<?php echo $center->contact_number ?>" >
                  </div>
                  <!--<div class="form-group">
                    <label for="address"><?php echo display('address')?> </label>
                    <textarea name="address" type="text" class="form-control" placeholder="<?php echo display('address')?>"><?php echo $center->address ?></textarea>
                  </div>-->
                  <div class="form-group">
                    <label for="country_name"><?php echo display('country_name')?> </label>
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="" selected>Select Country</option>
                        <?php foreach($country as $c){ ?>                                   
                        <option value="<?php echo $c->id_c; ?>" <?php if($center->country_id==$c->id_c){echo 'selected';}?>><?php echo $c->country_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php if($center->status == 1) { echo 'checked'; } ?> ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php if($center->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
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