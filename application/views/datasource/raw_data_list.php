<div class="row">
    <div class="col-sm-12">
    	<div  class="panel panel-default thumbnail">
    	<form action="<?=base_url().'lead/delete_raw_data/'?>" method='post' id='delete_raw_data_form'>
    		<input type="hidden" name="datasource_id" value="<?=$datasource_id?>">
    		 <div class="panel-heading no-print">
                <div class="btn-group"> 
                   <a href="<?= base_url('lead/datasourcelist')?>" class="btn btn-success" style="width: 150px;">Back</a>  
                </div>
            </div>
	        
	        	<div class="panel-body">
				<table class="datatable1 table table-bordered table-striped" style="width: 100%">
					<thead>
						<tr>
							<th>
								<input type="checkbox" name="enq_all" value="all">
							</th>
							<th>
								#
							</th>
							<th>
								Name
							</th>
							<th>
								Mobile
							</th>
							<th>
								Email
							</th>
							<th>
								Created Date
							</th>
							<th>
								Process
							</th>
							<th>
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!empty($raw_data)) {
							$i  = 1;
							foreach ($raw_data as $key => $value) { ?>
								<tr>
									<td><input type="checkbox" class="enq-select" name="enq_id[]" value="<?=$value['enquiry_id']?>"></td>			
									<td><?=$i?></td>
									<td><?=$value['name_prefix'].' '.$value['name'].' '.$value['lastname']?></td>			
									<td><?=$value['phone']?></td>			
									<td><?=$value['email']?></td>			
									<td><?=$value['created_date']?></td>			
									<td><?=$value['product_name']?></td>			
									<td>No Action</td>			
								</tr>				
							<?php
							$i++;
							}
						}
						?>
					</tbody>
				</table>
			</div>
				<a id='delete_raw_data' href="javascript:void(0)" class="btn btn-danger">Delete Selected</a> 
				<input type="submit" name="delete_raw_data" id="delete_raw_data_btn" style="visibility: hidden;" value="submit">
			
		</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("input[name='enq_all']").on('click',function(){
			if($("input[name='enq_all']").is(":checked")){
				$('.enq-select').prop('checked',true);
			}else{
				$('.enq-select').prop('checked',false);				
			}
		});		
		$("#delete_raw_data").on('click',function(e){			
			var sel = $('.enq-select:checked').length;
			if (sel) {
				Swal.fire({
					  title: 'Are you sure to delete '+sel+' records?',
					  text: "You won't be able to revert this!",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					  if (result.value) {
					  	$("#delete_raw_data_btn").click();
					  }
					})
			}else{				
				Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  text: 'Sorry! No data selected to delete'				  
				});				 
			}
		});
	});
</script>