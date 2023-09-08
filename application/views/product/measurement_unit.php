<div class="row">
	<div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
				<a href = "javascript:void(0)" onclick="window.history.back()" class="btn btn-success"> Back </a>
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
			<div class = "row ">
				<div class = "col-md-12">
					<?php echo form_open() ?>
					<div class = "row">
						<div class="col-md-3"></div>
						<div class = "form-group col-md-2">
							<label>Unit Title</label>
						</div>
						<div class = "form-group col-md-3">
							<input type = "text" class = "form-control col-md-7" name = "unit" value ="" required>
						</div>
						<div class = "form-group col-md-3">							
							<button type = "submit" class = "btn btn-info"> Create Unit </button>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<br>
      <form id='product_unit_form'>            
            <table class="datatable1 table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                  	<tr role="row">
						<th>
							<input type='checkbox' class="checked_all" value="check all" >&nbsp; 
						</th>
						<th>S.N </th>
						<th>Title</th>
						<th>Created At</th>
						<th>Created By</th>
						<!-- <th>Actions</th> -->
                    </tr>
               </thead>
               <tbody>
                  <?php 
                  $i=1;                   
                  if (!empty($units)) {                  
	                  foreach($units as $unit){ ?>
	                  <tr>
	                    <td><input type='checkbox' name='unit[]' class="checkbox" value='<?php echo $unit->id;?>'>&nbsp; </td>
	                    <td><?=$i++ ?></td>
	                    <td><?=$unit->title ?></td>
	                    <td><?=$unit->created_date ?></td>                    
	                    <td><?=$unit->created_by_name ?></td>                    
	                    <!-- <td></td> -->
	                  </tr>
	                  <?php }
              	 } ?>
               </tbody>
            </table>
            <button class="btn btn-danger" type="button" onclick="delete_unit()">
            <i class="ti-trash"></i>
            Delete
            </button>
            </form>
         </div>
      </div>
   </div>
</div>
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
<script>
   	function delete_unit(){
     	var x=  confirm('Are you sure delete this Records ? ');
		if(x==true){   
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url();?>product/delete_product_unit',
				data: $('#product_unit_form').serialize()
			})
			.done(function(data){   
			  alert( "Deleted successfully" );
			  window.location.reload();
			})
			.fail(function() {
				alert( "fail!" );
			});
		}else{
		  location.reload(); 
		}}
</script>
