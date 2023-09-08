<link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
<div class="panel panel-default">		
	<div class="panel-heading">		
		<div class="text-center">
			<h3><?=ucfirst($user->s_display_name).' '.ucfirst($user->last_name)?></h3>
		</div>		
	</div>
	<div class="panel-body">		
		<table class="table datatable1 table-bordered table-striped" style="width: 100%">
			<thead>
				
					<th>Check In</th>
					<th>Check Out</th>
					<th>Total</th>
				
			</thead>
			<tbody>
				<?php
				if (!empty($all_att_log)) {			
					foreach ($all_att_log as $key => $value) {
						?>
						<tr>
							<td><?=$value['check_in_time']?></td>
							<td><?=$value['check_out_time']?></td>
							<td><?=$value['dif']?></td>
						</tr>
					<?php
				}
				}else{
					?>
					<tr class="text-center">
						<td colspan="4"> No Record Found</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
