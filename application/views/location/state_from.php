<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("location/state") ?>"> <i class="fa fa-list"></i>  <?php echo display('state_list') ?> </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <?php echo form_open_multipart('location/add_state','class="form-inner" id="territory"') ?> 

                            <?php echo form_hidden('user_id',$doctor->id) ?>
                            
                            <div class="form-group row">
                                <label  class="col-md-3 col-xs-12 col-form-label"><?php echo display('country_name')?> <i class="text-danger">*</i></label>
                                <div class="col-md-9 col-xs-12">
                                    <select class="form-control" name="country_id" onchange="find_region()" id="country_id">
                                         <option value="" selected>Select Country</option>
                                   <?php foreach($country as $c){ ?>
                                   <option value="<?php echo $c->id_c; ?>" <?php if($doctor->country_id==$c->id_c){echo 'selected';}?>><?php echo $c->country_name; ?></option>
                                   <?php } ?>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-3 col-xs-12 col-form-label"><?php echo display('region_name')?> <i class="text-danger">*</i></label>
                                <div class="col-md-9 col-xs-12">
                                    <select class="form-control" name="region_id" id="region_id" onchange="find_teretory()">
                                  <?php foreach($region_list as $rl){ ?>
                                   
                                   <option value="<?php echo $rl->region_id; ?>" <?php if($doctor->region_id==$rl->region_id){echo 'selected';}?>><?php echo $rl->region_name; ?></option>
                                   <?php } ?>
                                   </select>
                                </div>
                            </div>
                             <!--<div class="form-group row">
                                <label  class="col-xs-3 col-form-label"><?php echo display('territory_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <select class="form-control" name="territory_id" id="territory_id">
                                  <?php foreach($territory_list as $tl){ ?>
                                   
                                   <option value="<?php echo $tl->territory_id; ?>" <?php if($doctor->territory_id==$tl->territory_id){echo 'selected';}?>><?php echo $tl->territory_name; ?></option>
                                   <?php } ?>
                                   </select>
                                </div>
                            </div>-->
                            
                             <div class="form-group row">
                                <label for="state_name" class="col-md-3 col-xs-12 col-form-label"><?php echo display('state_name')?> <i class="text-danger">*</i></label>
                                <div class="col-md-9 col-xs-12">
                                    <input name="state_name" type="text" class="form-control" id="firstname" placeholder="<?php echo display('state_name')?>" value="<?php echo $doctor->state ?>" >
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
<script type="text/javascript">
            function find_region() {
       
                       $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>location/get_region_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('region_id').innerHTML=data;
            }else{
              document.getElementById('region_id').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
        </script>
        
        <script type="text/javascript">
            function find_teretory() {
       
                       $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>location/get_tretory_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('territory_id').innerHTML=data;
            }else{
              document.getElementById('territory_id').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
        </script>
