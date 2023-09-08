<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("location/country") ?>"> <i class="fa fa-list"></i>  <?php echo display('country_list') ?> </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <?php echo form_open_multipart('location/create','class="form-inner"') ?> 

                            <?php echo form_hidden('user_id',$doctor->id_c) ?>

                            <div class="form-group row">
                                <label for="country_name" class="col-xs-12 col-md-3 col-form-label"><?php echo display('country_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-12 col-md-9">
                                    <input name="country_name" type="text" class="form-control" id="firstname" placeholder="<?php echo display('country_name')?>" value="<?php echo $doctor->country_name ?>" >
                                </div>
                            </div>
                              
                               <div class="form-group row">
                                <label class="col-md-3 col-xs-12"><?php echo display('status') ?></label>
                                <div class="col-xs-12 col-md-9">
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