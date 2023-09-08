<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/courselist") ?>"> <i class="fa fa-list"></i>  <?php echo display('course_list') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                       <div class="card-body">
              <?php echo form_open_multipart('lead/add_course','class="form-inner" id="territory"') ?> 
              <?php echo form_hidden('crs_id',$course->crs_id) ?>
                <div class="card-body">
				  <div class="form-group col-sm-6">
                    <label for="course_name"><?php echo display('course_name')?> </label>
                    <select class="form-control" name="course_name" id="course_name">
                        <option value="" selected>Select Course</option>
                        <?php foreach($courses as $cr){ ?>                                   
                        <option value="<?php echo $cr->id; ?>" <?php if(!empty($course->course_name)){ if($course->course_name==$cr->id){echo 'selected';}}?>><?php echo $cr->course_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>
				  <div class="form-group col-sm-6">
                    <label for="profile_image"><?php echo display('course_image')?> <i class="text-danger">*</i></label>
                    <input name="course_image" type="file" class="form-control" placeholder="<?php echo display('course_image')?>" value="<?php echo $course->course_image ?>" >
                  </div>
                  
                  <input name="course_images" type="hidden" class="form-control" placeholder="<?php echo display('course_image')?>" value="<?php echo $course->course_image ?>" >
                  
				  <div class="form-group col-sm-6">
                    <label for="course_rating"><?php echo display('course_rating')?> <i class="text-danger">*</i></label>
                    <input name="course_rating" type="text" class="form-control" placeholder="<?php echo display('course_rating')?>" value="<?php echo $course->course_rating ?>" >
                  </div>
				  <div class="form-group col-sm-6">
                    <label for="course_ielts"><?php echo display('course_ielts')?> <i class="text-danger">*</i></label>
					<select class="form-control" name="course_ielts" id="course_ielts">
                        <option value="" selected>Select IELTS/PTE</option>                                   
                        <option value="6.5/55" <?php if(!empty($course->course_ielts)){ if($course->course_ielts=='6.5/55'){echo 'selected';}}?>>6.5/55</option>
						<option value="6/53" <?php if(!empty($course->course_ielts)){ if($course->course_ielts=='6/53'){echo 'selected';}}?>>6/53</option>
						<option value="5.5/50" <?php if(!empty($course->course_ielts)){ if($course->course_ielts=='5.5/50'){echo 'selected';}}?>>5.5/50</option>
						<option value="5/48" <?php if(!empty($course->course_ielts)){ if($course->course_ielts=='5/48'){echo 'selected';}}?>>5/48</option>
						<option value="Without IELTS" <?php if(!empty($course->course_ielts)){ if($course->course_ielts=='Without IELTS'){echo 'selected';}}?>>Without IELTS</option>
                    </select>
                  </div>
				  
				  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('program_discipline')?> </label>
                    <select class="form-control" name="discipline" id="discipline">
                        <option value="" selected>Select discipline</option>
                        <?php foreach($discipline as $dc){ ?>                                   
                        <option value="<?php echo $dc->id; ?>" <?php if(!empty($course->discipline_id)){ if($course->discipline_id==$dc->id){echo 'selected';}}?>><?php echo $dc->discipline; ?></option>
                    <?php } ?>
                    </select>
                  </div>
				  
				  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('program_level')?> </label>
                    <select class="form-control" name="level" id="level" onchange="find_level()">
                        <option value="" selected>Select level</option>
                        <?php foreach($level as $lc){ ?>                                   
                        <option value="<?php echo $lc->id; ?>" <?php if(!empty($course->level_id)){if($course->level_id==$lc->id){echo 'selected';}}?>><?php echo $lc->level; ?></option>
                    <?php } ?>
                    </select>
                  </div>
				  
				  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('program_length')?> </label>
                    <select class="form-control" name="length" id="length">
                        <option value="" selected>Select length</option>
                        <?php foreach($length as $lg){ ?>                                   
                        <option value="<?php echo $lg->id; ?>" <?php if(!empty($course->length_id)){if($course->length_id==$lg->id){echo 'selected';}}?>><?php echo $lg->length; ?></option>
                    <?php } ?>
                    </select>
                  </div>
				  
                  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('institute_name')?> </label>
                    <select class="form-control" name="institute_id" id="institute_id">
                        <option value="" selected>Select Institute</option>
                        <?php foreach($institute as $c){ ?>                                   
                        <option value="<?php echo $c->institute_id; ?>" <?php if($course->institute_id==$c->institute_id){echo 'selected';}?>><?php echo $c->institute_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="country_name"><?php echo display('tuition_fees')?> </label>
                    <input type="text" class="form-control" name="tuition_fees" id="tuition_fees" value="<?=$course->tuition_fees?>">                        
                  </div>
				  
				  <div class="form-group col-sm-12">
                    <label for="course_discription"><?php echo display('course_discription')?> <i class="text-danger">*</i></label>
                    <textarea name="course_discription" class="form-control tinymce" rows="10"><?php echo $course->course_discription ?></textarea>
                  </div>
				  
                  <div class="form-group col-sm-6">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php if($course->status == 1) { echo 'checked'; } ?> ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php if($course->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
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
function find_level() { 

            var l_stage = $("#level").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>lead/select_length_lvl',
            data: {lead_stage:l_stage},
            
            success:function(data){
               // alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select length---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].length)+'</option>';
                }
                
                $("#length").html(html);
                
            }
            
            
            });

            }
</script>