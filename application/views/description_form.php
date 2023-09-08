<div class="row">
    <div class="col-sm-12"> 
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/description") ?>"> <i class="fa fa-list"></i>  <?php echo display('description_list') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <div class="card-body">
                            <?php echo form_open_multipart('lead/add_description', 'class="form-inner" id="territory"') ?> 
                            <?php echo form_hidden('description_id', $description->id) ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="stage_name"><?php echo display('description_name') ?> <i class="text-danger">*</i></label>
                                    <input name="description_name" type="text" class="form-control" placeholder="<?php echo display('description_name') ?>" value="<?php echo $description->description ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="lead_stage_name"><?php echo display('lead_stages') ?> </label>
                                    <select class="form-control multiple" name="lead_stage_id[]" id="lead_stage_id" multiple required>
                                      
                                        <?php
                                        $stage_list = explode(',', $description->lead_stage_id);
                                         foreach ($lead_description_list as $c) { ?>                                   
                                            <option value="<?php echo $c->stg_id; ?>" <?php if (in_array($c->stg_id,$stage_list)) {echo 'selected';}?>><?php echo $c->lead_stage_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                               <!--  <div class="form-group">
                                    <label for="process">Process</label>
                                    <input type="text" class="form-control" name="process" id="process" readonly="">
                                        
                                </div> -->
                                <div class="form-group">
                                    <label for="status"><?php echo display('status') ?></label>
                                    <div class="form-check">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" <?php if ($description->status == 1) {echo 'checked'; } ?> ><?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" <?php if($description->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>   
<script>
    $('.multiple').select2({});  
    

// $('#lead_stage_id').on('change',function(){
//     var id = $(this).val();
//     $.ajax({
//             url      : '<?php echo base_url('lead/get_process_bystage') ?>',
//             type     : 'POST',
//             dataType : 'json',
//             data     : {id:id}, 
//             success  : function(data)
//             {                 // var obj = JSON.parse(data);
//                 $('#process').val(data.product_name);
//             }, 
//             error    : function() 
//             {
//                 alert('failed!');
//             }   
//         });
// });
</script>