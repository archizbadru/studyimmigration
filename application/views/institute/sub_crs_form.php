<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("lead/sub_course") ?>"> <i class="fa fa-list"></i>  <?php echo display('sub_course_list') ?> </a> 
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                       <div class="card-body">
              <?php echo form_open_multipart('lead/add_sub_crs','class="form-inner" id="territory"') ?> 
              <?php echo form_hidden('sub_crs_id',$subcrs->id) ?>
                <div class="card-body">
				<div class="col-md-6">
					<div class="form-group">
						<label>Course</label>
						<select class="form-control add-select2" name = "course_name">
							<?php  if(!empty($cource)) {
								foreach($cource as $ind => $crs){
									?><option value = "<?php echo $crs->id ?>" <?php if($subcrs->course_name==$crs->id){ echo 'selected';}?>><?php echo $crs->course_name ?> </option><?php
								}	
							} ?>
						</select>
					</div>
				</div>
				
                  <div class="form-group col-sm-6">
                    <label for="sub_course"><?php echo display('sub_course')?> <i class="text-danger">*</i></label>
                    <input name="sub_course" type="text" class="form-control" placeholder="<?php echo display('sub_course')?>" value="<?php echo $subcrs->sub_course ?>" >
                  </div> 
				  
                  <div class="form-group col-sm-6">
                    <label for="status"><?php echo display('status') ?></label>
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php if($subcrs->status == 1) { echo 'checked'; } ?> ><?php echo display('active') ?>
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php if($subcrs->status == 0) { echo 'checked'; } ?> ><?php echo display('inactive') ?>
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
