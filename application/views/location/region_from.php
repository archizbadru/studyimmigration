<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("location/region") ?>"> <i class="fa fa-list"></i>  <?php echo display('region_list') ?> </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <?php echo form_open_multipart('location/add_region','class="form-inner"') ?> 
                            <?php echo form_hidden('user_id',$doctor->region_id) ?>
                            <div class="form-group row">
                                <label  class="col-md-3 col-xs-12 col-form-label"><?php echo display('country_name')?> <i class="text-danger">*</i></label>
                                <div class="col-md-9 col-xs-12">
                                    <select class="form-control" name="country_id">
                                   <?php foreach($country as $c){ ?>
                                   <option value="<?php echo $c->id_c; ?>" <?php if($doctor->country_id==$c->id_c){echo 'selected';}?>><?php echo $c->country_name; ?></option>
                                   <?php } ?>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="region_name" class="col-md-3 col-xs-12 col-form-label"><?php echo display('region_name')?> <i class="text-danger">*</i></label>
                                <div class="col-md-9 col-xs-12">
                                    <input name="region_name" type="text" class="form-control" id="firstname" placeholder="<?php echo display('region_name')?>" value="<?php echo $doctor->region_name ?>" >
                                </div>
                            </div>
                            
                              
                               <div class="form-group row">
                                <label class="col-md-3 col-xs-12"><?php echo display('status') ?></label>
                                <div class="col-md-9 col-xs-12">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="1" <?php echo  set_radio('status', '1', TRUE); ?> ><?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="0" <?php echo  set_radio('status', '0'); ?> ><?php echo display('inactive') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                           
                           
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>

</div>