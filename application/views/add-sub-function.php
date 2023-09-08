  <div  class="panel panel-default thumbnail">
        <div class="panel-body panel-form">
                            <div class="row ">   <div class="col-md-12">
                                 <a class="btn btn-success"  href="<?php echo base_url();?>sub-function-list" > <i class="fa fa-list"></i>  <?php echo display("list_sub_function"); ?> </a> </div>
                                    <div class="col-md-9 col-sm-12">
                                <div class="col-lg-10 ">
                                    <form  action='' method="post" id="login">
                                        <div class="row">
                                            <div class="col-md-6">
											    
											
											
												 
                                                <div class="row m-t-20">
                                                    <div class="col-12">
                                                        <label for="name" class="col-form-label"> <?php echo display("sub_function_name"); ?></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group ">
                                                            <div class="input_icon">
                                                                <input type="text" class="form-control br_25  m-0 icon_left_input" name="item_name" placeholder="Function Name" value="<?php echo set_value('item_name');?>">
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											
                                                
												<div class="row m-t-20">
                                                    <div class="col-12">
                                                        <label for="name" class="col-form-label"> <?php echo display("function_name"); ?></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group ">
                                                            <div class="input_icon">
                                                             <select class="form-control  br_25" name="rooms">
															<?php foreach($all_active_item as $value){ ?>
				                                                <option value='<?php echo $value->itemlist_id;?>' <?php if(set_value('modules')==$value->itemlist_id){echo "Selected";}?>><?php echo $value->item_name;?></option>
																<?php } ?>
						                                        </select>

															 </div>
                                                        </div>
                                                    </div>
                                                </div>
												
                                           
                                            </div>
                                            <div class="col-md-4 m-t-20 ">
                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        
                                                    </div>
                                                </div>
                                           </div>
										
									
										
										   
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-10">
                                                <div class="row">
                                                 
                                                    <div class="col-12 m-t-10">
                                                        <button class="btn btn-primary" type="submit" >
                                                            <i class="ti-user"></i>
                                                            <?php echo display("save"); ?>
                                                        </button>
                                                        <button class="btn btn-warning" type="reset" id="clear">
                                                            <i class="ti-reload"></i>
                                                            <?php echo display("reset"); ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                             </div>            </div>
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
