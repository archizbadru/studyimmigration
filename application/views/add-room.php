
  <div  class="panel panel-default thumbnail">
        <div class="panel-body panel-form">
                            <div class="row ">
                                <div class="col-md-12">  <a class="btn btn-primary" href="<?php echo base_url("room-list") ?>"> <i class="fa fa-list"></i> <?php echo display("room_list"); ?> </a> </div>
                                    <div class="col-md-9 col-sm-12">
                                      
                                <div class="col-lg-10 ">
                                    <form   action='' method="post" id="login">
                                        <div class="row ">
                                            <div class="col-md-6">
										
											
											<div class="row m-t-20">
                                                    <div class="col-12">
                                                        <label for="name" class="col-form-label"><?php echo display("room_name"); ?> </label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group ">
                                                            <div class="input_icon">
                                                                  <input type="text" id="comp_name"  class="form-control br_25  m-0 icon_left_input" placeholder="Room Name" name="area_name" value="<?php echo set_value('area_name');?>">
                                                            
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
										
                                        <div class="row justify-content-center">
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
function check_dublicate_comp(){
	var f=document.getElementById('comp_name').value;
	if(f!=''){
$.ajax({
type: 'POST',
url: '<?php echo base_url();?>check_dublicate_exp',
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
function add_comp(){
$.ajax({
type: 'POST',
url: '<?php echo base_url();?>expensehead-add',
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
