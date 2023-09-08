<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url();?>floor-add"> <i class="fa fa-plus"></i>  <?php echo display('Add_More') ?> </a> 
                    
                </div>
            </div>
            <div class="panel-body">
                	<div class="row m-t-20"><?php if($this->session->error!=''){ ?>
                                                           <button  class='btn btn-danger text-left'><?php echo $this->session->error; ?></button>
									                        <?php } ?>
															<?php if($this->session->success!=''){ ?>
                                                            <button  class='btn  btn-success left'><?php echo $this->session->success; ?></button>
									                        <?php } ?>
													 
                                                </div>
                                  
									<form class="form-horizontal "  action='' method="post" id="login">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                         
                                                <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">
												<input type='checkbox' class="checked_all" value="check all" >&nbsp; S.N</th>
                                                <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Floor Name</th>
                                                <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Status</th>
                                                <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Actions</th>
											
                                            
                        </tr>
                    </thead>
                    <tbody>
                      	<?php $i=1;foreach($get_users as $user){?>
                                            <tr role="row" class="even">
											  <td><input type='checkbox' name='user_status[]' class="checkbox" value='<?php echo $user->f_id;?>'>&nbsp; <?php echo $i;?></td>
                                                <td class="sorting_1 user_face">
												 <?php echo $user->f_name;?></td>
												<td class="center"> <?php if($user->foolr_status==1){echo "Active"; }else{echo "InActive";} ;?></td>
                                               <td>&nbsp; &nbsp;
											 <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" 
                                                        href="<?php echo base_url();?>edit-floor/<?php echo base64_encode($user->f_id);?>"><i class="ti-pencil"></i></a>
												</td>
                                            </tr>
											<?php $i++; } ?>
                    </tbody>
                </table>  <!-- /.table-responsive -->
                	<button class="btn btn-danger" type="button" onclick="deactive_user()" >
                                             <i class="ti-trash"></i>
                                                  Delete
                                            </button>
                                      </form>
            </div>
        </div>
    </div>
</div>

       

<script>
function is_Active(){
$.ajax({
type: 'POST',
url: '<?php echo base_url();?>dash/active_floor',
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
		window.location.href = '<?php echo base_url()?>floor-list';
}
})
.fail(function() {
alert( "fail!" );

});
}
</script>
<script>
function deactive_user(){
      var x=  confirm('Are you sure delete this Records ? ');
  if(x==true){
$.ajax({
type: 'POST',
url: '<?php echo base_url();?>dash/dactive_floor',
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
		window.location.href = '<?php echo base_url()?>floor-list';
}
})
.fail(function() {
alert( "fail!" );

});
}else{
  location.reload();   
}
}
</script>
 <script type="text/javascript">
        $('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
        });
        $('.checkbox').change(function(){ 
            if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
        });
    </script>

