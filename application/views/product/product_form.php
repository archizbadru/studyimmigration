    <section class="content">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
          <div class="card">
            <div class="card-header">
              <a class="btn btn-success" href="<?php echo base_url("product/productlist") ?>"> <i class="fa fa-list"></i>  <?php echo display('product_list') ?> </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php echo form_open_multipart('product/add_product','class="form-inner" id="territory"') ?> 
              <?php echo form_hidden('product_id',$product->product_id) ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="dise_code"><?php echo display('dise_code')?> <i class="text-danger">*</i></label>
                    <input name="dise_code" type="text" class="form-control" placeholder="<?php echo display('dise_code')?>" value="<?php echo $product->dise_code ?>" >
                  </div>
                  <div class="form-group">
                    <label for="product_name"><?php echo display('product_name')?> <i class="text-danger">*</i></label>
                    <input name="product_name" type="text" class="form-control" placeholder="<?php echo display('product_name')?>" value="<?php echo $product->product_name ?>" >
                  </div>
                  <div class="form-group">
                    <label for="contact_name"><?php echo display('contact_name')?> <i class="text-danger">*</i></label>
                    <input name="contact_name" type="text" class="form-control" placeholder="<?php echo display('contact_name')?>" value="<?php echo $product->contact_name ?>" >
                  </div>
                 <div class="form-group">
                    <label for="contact_number"><?php echo display('contact_number')?> <i class="text-danger">*</i></label>
                    <input name="contact_number" type="text" class="form-control" placeholder="<?php echo display('contact_number')?>" value="<?php echo $product->contact_number ?>" >
                  </div>
                  <div class="form-group">
                    <label for="address"><?php echo display('address')?> <i class="text-danger">*</i></label>
                    <textarea name="address" type="text" class="form-control" placeholder="<?php echo display('address')?>"><?php echo $product->address ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="country_name"><?php echo display('country_name')?> <i class="text-danger">*</i></label>
                    <select class="form-control" name="country_id" onchange="find_region()" id="country_id">
                        <option value="" selected>Select Country</option>
                        <?php foreach($country as $c){ ?>                                   
                        <option value="<?php echo $c->id_c; ?>" <?php if($product->country_id==$c->id_c){echo 'selected';}?>><?php echo $c->country_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>                    
                   <div class="form-group">
                    <label for="region_name"><?php echo display('region_name')?> <i class="text-danger">*</i></label>
                    <select class="form-control" name="region_id" id="region_id" onchange="find_state()">
                    <?php foreach($region_list as $rl){ ?>
                   <option value="<?php echo $rl->region_id; ?>" <?php if($product->region_id==$rl->region_id){echo 'selected';}?>><?php echo $rl->region_name; ?></option>
                   <?php } ?>
                   </select>
                  </div>                    
                  <div class="form-group">
                    <label for="state_name"><?php echo display('state_name')?> <i class="text-danger">*</i></label>
                    <select class="form-control" name="state_id" id="state_id" onchange="find_city()">                 
                    <?php foreach($state_list as $sl){ ?>                                   
                   <option value="<?php echo $sl->id; ?>" <?php if($product->state_id==$sl->id){echo 'selected';}?>><?php echo $sl->state; ?></option>
                   <?php } ?>                                   
                   </select>
                  </div>
                   <div class="form-group">
                    <label for="city_name"><?php echo display('city_name')?> <i class="text-danger">*</i></label>
                  <select class="form-control" name="city_id" id="city_id" onchange="find_block()">                 
                    <?php foreach($city_list as $sl){ ?>                                   
                   <option value="<?php echo $sl->id; ?>" <?php if($product->city_id==$sl->id){echo 'selected';}?>><?php echo $sl->city; ?></option>
                   <?php } ?>                                   
                   </select>
                  </div>
                  <div class="form-group">
                      <label for="block_name"><?php echo display('block_name')?> <i class="text-danger">*</i></label>
                    <select class="form-control" name="block_id" id="block_id">                 
                    <?php foreach($block_list as $sl){ ?>                                   
                   <option value="<?php echo $sl->block_id; ?>" <?php if($product->block_id==$sl->block_id){echo 'selected';}?>><?php echo $sl->block; ?></option>
                   <?php } ?>                                   
                   </select>
                  </div>
                  <div class="form-group">
                    <label for="status"><?php echo display('status') ?></label>
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
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="reset" class="btn btn-default"><?php echo display('reset') ?></button> &nbsp;<button class="btn btn-primary"><?php echo display('save') ?></button>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<script type="text/javascript">
            function find_region() {
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>location/get_region_byid',
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
            function find_city() {
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>location/get_city_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('city_id').innerHTML=data;
            }else{
              document.getElementById('city_id').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
            function find_state() {
            var region_id = $("#region_id").val();
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>location/select_state_by_region',
            data: {region_id:region_id},            
            success:function(data){                
                var html='';
                var obj = JSON.parse(data);
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].state)+'</option>';
                }                
                $("#state_id").html(html);                
            }    
            });
            }
            
            function find_block() {
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>location/get_block_byid',
            data: $('#territory').serialize()
            })
            .done(function(data){
            if(data!=''){
              document.getElementById('block_id').innerHTML=data;
            }else{
              document.getElementById('block_id').innerHTML='';   
            }
            })
            .fail(function() {
            
            });
            }
            $(function(){                
                $("#state_id").change(function(){                    
                    var state_id = $("#state_id").val();                
                $.ajax({                    
                    url: '<?php echo base_url('location/select_territory_by_state') ?>',
                    type:'POST',
                    data:{state_id:state_id},
                    success:function(data){                        
                        var html='';
                        var obj = JSON.parse(data);                        
                        html +='<option value="" style="display:none">---Select---</option>';
                        for(var i=0; i <(obj.length);i++){
                            html +='<option value="'+(obj[i].territory_id)+'">'+(obj[i].territory_name)+'</option>';
                        }                        
                        $("#territory_id").html(html);
                    }            
                }); 
                }); 
            });
        </script>