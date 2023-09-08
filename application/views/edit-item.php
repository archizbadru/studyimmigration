
  <div  class="panel panel-default thumbnail">
        <div class="panel-body panel-form">
                            <div class="row ">
                                    <div class="col-md-12">
                                    <form  action='' method="post" id="login" enctype="multipart/form-data">
									<?php foreach($all_item_byid as $value1){ ?>
									<input type="hidden" value='<?php echo  $value1->itemlist_id;?>' name='item_id'>
                                   <div class="row"><br>
                                            <div class="col-md-12">
											   <div class="col-md-6">
                                                        <div class="form-group ">
                                                             <label for="name" class="col-form-label">Function Name</label>
                                                            <div class="input_icon">
                                                             <select class="form-control  br_25" name="funtion_name" id="product_type">
															<?php foreach($all_active_item as $value){ ?>
				                                                <option value='<?php echo $value->sb_id;?>,<?php echo $value->a_id;?>' <?php if($value1->item_name==$value->sb_id){echo "Selected";}?>><?php echo $value->product_name;?></option>
																<?php } ?>
						                                        </select>

															 </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                             <label for="name" class="col-form-label">Color</label>
                                                            <div class="input_icon">
                                                                <input type="text" class="form-control br_25  m-0 icon_left_input" name="color" placeholder="color" value="<?php echo $value1->color;?>">
                                                                <i class="icon_in_input input_icon_left ion-arrow-graph-up-right text-info"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                      <div class="col-md-6">
                                                        <div class="form-group ">
                                                             <label for="name" class="col-form-label">Code </label>
                                                            <div class="input_icon">
                                                                   <input type="text"  class="form-control br_25  m-0 icon_left_input" name="item_shn"  placeholder="Function Code" value="<?php echo $value1->item_hsncode;?>">
                                                              <i class="icon_in_input input_icon_left ion-arrow-graph-up-right text-info"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                               
                                               <div class="col-md-6">
                                                        
                                                        <div class="form-group ">
                                                             <label for="name" class="col-form-label"> Price </label>
                                                            <div class="input_icon">
                                                                <input type="text"  class="form-control br_25  m-0 icon_left_input" name="Unite_p"  placeholder="Function Unite Price" value="<?php echo $value1->Unite_p;?>">
                                                                <i class="icon_in_input input_icon_left ion-arrow-graph-up-right text-info"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                   

                                                    
                                                  
                                                    
                                                    <!--- <div class="col-md-6">
                                                        <div class="form-group ">
                                                               <label for="name" class="col-form-label">Modules</label>
                                                            <div class="input_icon">
                                                                <input type="text"  class="form-control br_25  m-0 icon_left_input" name="modules" placeholder="Modules" value="<?php echo set_value('modules');?>">
                                                                <i class="icon_in_input input_icon_left ion-arrow-graph-up-right text-info"></i>
                                                            </div>
                                                        </div>
                                                    </div>--->
                                                
                                                
                                                
											
                                              
                                                <!--    
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                             <label for="name" class="col-form-label">Qty/by</label>
                                                            <div class="input_icon">
                                                             <input type="text"  class="form-control br_25  m-0 icon_left_input" name="qty_divie_by" placeholder="Qty/by" value="<?php echo set_value('qty_divie_by');?>">
                                                                <i class="icon_in_input input_icon_left ion-arrow-graph-up-right text-info"></i>

															 </div>
                                                        </div>
                                                     </div>--->
                                                
                                                 
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="name" class="col-form-label">Function-img</label>
                                                            <div class="input_icon">
                                                             <input type="file"  class="form-control br_25  m-0 icon_left_input" name="file" accept=".png,.jpeg,.jpg">
                                                                <i class="icon_in_input input_icon_left ion-arrow-graph-up-right text-info"></i>

															 </div>
                                                        </div>
                                                    </div>
                                                   <div class="col-md-6">
                                                        <div class="form-group ">
                                                            
                                                            <label for="name" class="col-form-label">Function Url</label>
                                                            <div class="input_icon">
                                                             <input type="text"  class="form-control br_25  m-0 icon_left_input" name="img_url" placeholder="Enter url" value="<?php echo $value1->img_url;?>">
                                                                <i class="icon_in_input input_icon_left ion-arrow-graph-up-right text-info"></i>

															 </div>
                                                        </div>
                                                    </div>
                                                
												
                                           
                                            </div>
                                            
										
									
                                              
                                                 
                                                        <div class="col-md-6">
                                                        <button class="btn btn-primary" type="submit" >
                                                            <i class="ion-arrow-up-a"></i>
                                                            Update
                                                        </button>
                                                        <a class="btn btn-warning" href="<?php echo base_url(); ?>function-list">
                                                            <i class="ion-arrow-left-a"></i>
                                                            Back
                                                        </a>
                                                    </div>
                                               
                                           
										
										   
                                        </div>
									<?php } ?>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
          
<script>
function check_dublicate_user(){
	var f=document.getElementById('username').value;
	if(f!=''){
$.ajax({
type: 'POST',
url: '<?php echo base_url();?>check_dublicate',
data: $('#login').serialize()
})
.done(function(data){
if(data=='User Exist'){	
     document.getElementById('success').style.display='none';
	 document.getElementById('error').style.display='inline';
	$('#error').html(data);
}else{
	document.getElementById('error').style.display='none';
	document.getElementById('success').style.display='inline';
	$('#success').html(data);
}
})
.fail(function() {
$('#error').html('Posting Failed');

});
}
}
</script>
<script>
function add_users(){
$.ajax({
type: 'POST',
url: '<?php echo base_url();?>add_user',
data: $('#login').serialize()
})
.done(function(data){
if(data=='User Exist'){	
     document.getElementById('success').style.display='none';
	 document.getElementById('error').style.display='inline';
	$('#error').html(data);
}else{
	document.getElementById('error').style.display='none';
	document.getElementById('success').style.display='inline';
	$('#success').html(data);
}
})
.fail(function() {
alert( "fail!" );

});
}
</script>
</body>
</html>
