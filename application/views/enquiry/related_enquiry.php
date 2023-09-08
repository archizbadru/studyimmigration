<hr>
<table class="table table-bordered">	
	<thead>
		<tr>
			<th>ID</th>			
			<th>Created Date</th>
			<th>Status</th>
		</tr>
	</thead>	
	<tbody>
		<?php
			if (!empty($result)) {
				foreach ($result as $key => $value) { 
					if ($value['enquiry_id'] != $enquiry_id) {
					?>
					<tr>
						<td><a href="<?=base_url().'enquiry/enq_redirect/'.$value['enquiry_id']?>"><?=$value['Enquery_id']?></a></td>
						<td><?=$value['created_date']?></td>
						<td>
							<?php
								if($value['status']==1){
									echo display('enquiry');
								}
								else if($value['status']==2){
									echo display('lead');
								}
								else if($value['status']==3){
									display('client');
								}
							?>
						</td>
					</tr>
				<?php
					}
				}
			}else{
				?>
				<td colspan="4">No related data found!</td>
				<?php
			}
		?>
	</tbody>	
</table>