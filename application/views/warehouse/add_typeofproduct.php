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
                        <?php echo form_open_multipart('warehouse/addtypeofproduct','class="form-inner"') ?>
                        <?php echo form_hidden('id',$formdata->id)?>
                            <div class="form-group row">
                                <label for="country_name" class="col-xs-3 col-form-label">Warehouse Name<i class="text-danger">*</i></label>
                                <div class="col-xs-3">
                                    <select name="warehousename"  class="form-control" id="warehousename" required>
                                        <option>Select</option>
                                        <?php if(!empty($warehouse_list)){

                                            foreach($warehouse_list as $warehouselist){
                                            ?>
                                        <option value="<?= $warehouselist->id?>" <?php if($formdata->id==$warehouselist->id) { ?> selected <?php }?>><?= ucwords($warehouselist->name); ?></option>

                                    <?php }}?>
                                    </select>
                                </div>

                                <label for="country_name" class="col-xs-3 col-form-label">Name<i class="text-danger">*</i></label>
                                <div class="col-xs-3">
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Television or Mobile" value="<?= $formdata->name?>" required>
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