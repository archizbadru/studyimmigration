<?php if(!empty($oldticket)) { ?>
<h4>Old Ticket on this product</h4>
<table class = "table" id = "old-tck-table">
	<thead>
		<tr>
			<th>Ticket No</th>
			<th>issue</th>
			<th>Sourse</th>
			<th>Last Update</th>
		</tr>
	</thead>
	<tbody>
<?php if(!empty($oldticket)) {
			foreach($oldticket as $ind => $tck) {
			
			?><tr>
				<td><?php echo $tck->ticketno ?></td>
				<td><?php echo $tck->category ?></td>
				<td><?php if($tck->sourse  == 1) {
					echo "Email";
				}else if($tck->sourse  == 2) {
					echo "Phone";	
				} else if($tck->sourse  == 3) {
					echo "Visit";
				} ?></td>
				<td><?php echo date("d, M Y h:i A", strtotime($tck->last_update)); ?></td>
				<?php
			?></tr><?php
			}
		} ?>
	</tbody>
</table>
<?php } ?>