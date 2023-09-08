
  <div  class="panel panel-default thumbnail">
        <div class="panel-body panel-form">
                            <div class="row ">
                                    <div class="col-md-9 col-sm-12">
                                <div class="col-lg-10 ">
                                
                                    <form   action='' method="post" id="login">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
											  
											
											<?php  foreach($all_subactive_item as $user){?>
												 
                                                <div class="row m-t-20">
                                                    <div class="col-12">
                                                        <label for="name" class="col-form-label">Edit Sub Function Name</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group ">
                                                            <div class="input_icon">
                                                                <input type="text" class="form-control br_25  m-0 icon_left_input" name="item_name" placeholder="Function Name" value="<?php echo $user->sub_f_name;?>">
                                                                <i class="icon_in_input input_icon_left ion-arrow-graph-up-right text-info"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											
                                                
												<div class="row m-t-20">
                                                    <div class="col-12">
                                                        <label for="name" class="col-form-label">Function Name</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group ">
                                                            <div class="input_icon">
                                                             <select class="form-control  br_25" name="rooms">
															<?php foreach($all_active_item as $value){ ?>
				                                                <option value='<?php echo $value->itemlist_id;?>' <?php if($user->s_room_id==$value->itemlist_id){echo "Selected";}?>><?php echo $value->item_name;?></option>
																<?php } ?>
						                                        </select>

															 </div>
                                                        </div>
                                                    </div>
                                                </div>
												
                                           <?php } ?>
                                            </div>
                                            <div class="col-md-4 m-t-20 ">
                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        
                                                    </div>
                                                </div>
                                           </div>
										
									
										
										   
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-10">
                                                <div class="row">
                                                 
                                                    <div class="col-12 m-t-10">
                                                        <button class="btn btn-primary" type="submit" >
                                                            <i class="ti-user"></i>
                                                            Save
                                                        </button>
                                                        <button class="btn btn-warning" type="reset" id="clear">
                                                            <i class="ti-reload"></i>
                                                            Reset
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
