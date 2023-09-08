<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/institutelist") ?>"> <i class="fa fa-list"></i>  <?php echo display('institute_list') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                       <div class="card-body">
              <?php echo form_open_multipart('lead/add_institute','class="form-inner" id="territory"') ?> 
              <?php echo form_hidden('institute_id',$institute->institute_id) ?>
                <div class="card-body">
                  <div class="form-group col-sm-6">
                    <label for="institute_name"><?php echo display('institute_name')?> <i class="text-danger">*</i></label>
                    <input name="institute_name" type="text" class="form-control" placeholder="<?php echo display('institute_name')?>" value="<?php echo $institute->institute_name ?>" >
                  </div>
				  
                  <div class="form-group col-sm-6">
                    <label for="profile_image"><?php echo display('profile_image')?> <i class="text-danger">*</i></label>
                    <input name="profile_image" type="file" class="form-control" placeholder="<?php echo display('profile_image')?>" value="<?php echo $institute->profile_image ?>" >
                  </div>
                  
                  <input name="profile_images" type="hidden" class="form-control" placeholder="<?php echo display('profile_image')?>" value="<?php echo $institute->profile_image ?>" >
                  
                  <div class="form-group col-sm-6">
                    <label for="agreement_comision"><?php echo display('agreement_comision')?> <i class="text-danger">*</i></label>
                    <input name="agreement_comision" type="text" class="form-control" placeholder="<?php echo display('agreement_comision')?>" value="<?php echo $institute->agreement_comision ?>" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="agreement_doc"><?php echo display('agreement_doc')?> <i class="text-danger">*</i></label>
                    <input name="agreement_doc" type="file" class="form-control" placeholder="<?php echo display('agreement_doc')?>" value="<?php echo $institute->agreement_doc ?>" >
                  </div>
                  
                   <input name="agreement_docs" type="hidden" class="form-control" placeholder="<?php echo display('agreement_doc')?>" value="<?php echo $institute->agreement_doc ?>" >
                  
                  <div class="form-group col-sm-6">
                    <label for="from_date"><?php echo display('from_date')?> <i class="text-danger">*</i></label>
                    <input name="from_date" type="date" class="form-control" placeholder="<?php echo display('from_date')?>" value="<?php echo $institute->from_date ?>" >
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="to_date"><?php echo display('to_date')?> <i class="text-danger">*</i></label>
                    <input name="to_date" type="date" class="form-control" placeholder="<?php echo display('to_date')?>" value="<?php echo $institute->to_date ?>" >
                  </div>
				  
				  
                  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('country_name')?> </label>
                    <select class="form-control" name="country_id" id="country_id" onchange="find_state()">
                        <option value="" selected>Select Country</option>
                        <?php foreach($country as $c){ ?>                                   
                        <option value="<?php echo $c->id_c; ?>" <?php if($institute->country_id==$c->id_c){echo 'selected';}?>><?php echo $c->country_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>
				  
				  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('state')?> </label>
                    <select class="form-control" name="state_id" id="state_id">

                    </select>
                  </div>
				  
                  <div class="form-group col-sm-6">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php if($institute->status == 1) { echo 'checked'; } ?> ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php if($institute->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
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
<script>
function find_state() { 

            var l_stage = $("#country_id").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>dashboard/select_state',
            data: {lead_stage:l_stage},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select length---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].state)+'</option>';
                }
                
                $("#state_id").html(html);
                
            }
            
            
            });

            }	
</script>