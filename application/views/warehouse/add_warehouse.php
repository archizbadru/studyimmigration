<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("warehouse/warehouse") ?>"> <i class="fa fa-list"></i>Warehouse List </a>  
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <?php echo form_open_multipart('warehouse/addwarehouse','class="form-inner"') ?>
                        <?php echo form_hidden('id',$formdata->id);?>
                            <div class="form-group row">
                                <label for="country_name" class="col-xs-3 col-form-label">Name<i class="text-danger">*</i></label>
                                <div class="col-xs-3">
                                    <input name="name" type="text" class="form-control" id="firstname" placeholder="Wareouse Name" value="<?= $formdata->name?>" required>
                                </div>

                                <label for="country_name" class="col-xs-3 col-form-label">Email<i class="text-danger">*</i></label>
                                <div class="col-xs-3">
                                    <input name="email" type="text" class="form-control" id="email" placeholder="Email" value="<?= $formdata->email?>" required>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-xs-3 col-form-label">Phone</label>
                                <div class="col-xs-3">
                                    <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone" value="<?= $formdata->phone?>" >
                                </div> 
                                <label for="address" class="col-xs-3 col-form-label">Address<i class="text-danger">*</i></label>
                                <div class="col-xs-3">
                                    <input name="address" type="text" class="form-control" id="address" placeholder="Address" value="<?= $formdata->address?>" required>
                                </div>                               
                            </div>

                            <div class="form-group row">
                                <label for="country" class="col-xs-3 col-form-label">Country</label>
                                <div class="col-xs-3">
                                    <select name="country" class="form-control" id="country" >
                                        <option>Select</option>
                                    <?php  foreach($country_list as $c){ ?>
                                    
                                    <option value="<?php echo $c->id_c; ?>" ><?php echo $c->country_name; ?></option>
                                  <?php }?>
                                    </select>
                                </div> 
                                <label for="state" class="col-xs-3 col-form-label">State<i class="text-danger">*</i></label>
                                <div class="col-xs-3">
                                    <select name="state" class="form-control" id="state" required>
                                    </select>
                                </div>                               
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-xs-3 col-form-label">City</label>
                                <div class="col-xs-3">
                                    <select name="city" class="form-control" id="city" required="">
                                    </select>
                                </div> 
                                                          
                            </div>
                              
                               <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('status') ?></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="1" <?php if($formdata->status == 1) { echo 'checked'; } ?>><?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="0" <?php if($formdata->status == 0) { echo 'checked'; } ?>><?php echo display('inactive') ?>
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

<script>
  
   $("#country").change(function() {

        var country = $(this).val();
        var html = '';

        $.ajax({

            url: '<?php echo base_url();?>Location/find_state_country',
            type: 'POST',
            data: {
                country: country
            },

            success: function(data) {

                var obj = JSON.parse(data);

                html += '<option value="" style="display:none">---Select State---</option>';

                for (var i = 0; i < (obj.length); i++) {

                    html += '<option value="' + obj[i].id + '">' + obj[i].state + '</option>';
                }
                $("#state").html(html);
            }


        });

    }); 


     $("#state").change(function() {

        var state_id = $(this).val();
        var html = '';

        $.ajax({

            url: '<?php echo base_url();?>Location/select_city_by_state',
            type: 'POST',
            data: {
                state_id: state_id
            },
            success: function(data) {

                var obj = JSON.parse(data);

                html += '<option value="" style="display:none">---Select City---</option>';

                for (var i = 0; i < (obj.length); i++) {

                    html += '<option value="' + obj[i].id + '">' + obj[i].city + '</option>';
                }

                $('#city').html(html);
            }
        });
    }); 

</script>

<script>
   
</script>