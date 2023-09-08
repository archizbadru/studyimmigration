<div class="col-md-6" style="border: 1px solid #c8ced3;padding: 15px;border-top: none;">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Name</label> 
				<input type="text" class="form-control" value="<?php if(!empty($ticket->name)){ echo $ticket->name;} ?>" disabled>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" value="<?php if(!empty($ticket->email)){ echo $ticket->email;} ?>" disabled>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Phone</label>
				<input type="text" class="form-control" value="<?php  if(!empty($ticket->phone)){ echo $ticket->phone; } ?>" disabled>
			</div>
		</div>
		<?php if($this->session->companey_id!=83){ ?>
		<div class="col-md-6">
			<div class="form-group">
				<label>Product</label>
				<input type="text" class="form-control" value="<?php if(!empty($ticket->country_name)){ echo $ticket->country_name;} ?>" disabled>
			</div>
		</div>
		<?php } ?>
		<div class="col-md-6">
			<div class="form-group">
				<label><?=display('ticket_problem')?></label>
				<input type="text" class="form-control" value="<?php if(!empty($ticket->subject_title)){echo ucwords($ticket->subject_title);} ?>" disabled>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Source</label>
				<input type="text" class="form-control" value="<?php if(!empty($ticket->ticket_source)){ echo ucwords($ticket->ticket_source);} ?>" disabled>
			</div>
		</div>
		
	
		<div class="col-md-12">
			<label>Remark</label>
			<div style = "padding: 10px;border: 1px solid #e5e1e1;margin-right:25px;border-radius: 10px;font-size:16px;margin-bottom:10px;"><?php if(!empty($ticket->message)){ echo $ticket->message;} ?></div>
		</div>
		<div class="col-md-6">
			<div class="form-group">			
				<label>Attachment : </label>
				<?php
				if ($ticket->attachment) { ?>
					<span class=''><a target="_blank" href="<?=base_url().'uploads/ticket/'.$ticket->attachment?>"><?=$ticket->attachment?></a></span>
				<?php
				}else{
					echo "<span class='badge badge-danger'>No attachment</span>";
				}
				?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">			
				<label>Complaint Type : </label>
					<span class='badge badge-danger'>
					<?php
						if ($ticket->complaint_type==1) {
							echo "Complaint";
						}else if ($ticket->complaint_type==2) {
							echo "Query";
						}
					?>
					</span>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Priority</label>
			<?php
				if($ticket->priority == 1){
					?><span class="badge badge-info">Low</span><?php
				}else if($ticket->priority == 2){
					?><span class="badge badge-warning">Medium</span><?php
				}else if($ticket->priority == 3){
					?><span class="badge badge-danger">High</span><?php
				}
				?>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12" style ="background: #f7f7f7;border: 1px solid #ccc;padding: 15px;border-radius: 10px;margin-bottom:25px;">
				<?php echo form_open(base_url("ticket/view/".$ticket->ticketno)); ?>
					<div class="row">
					<div class = "col-md-12">
						<div class = "form-group">
							<label>Review</label>
							<textarea class = "form-control" name = "review"><?php echo (!empty($ticket->review)) ? $ticket->review : "";  ?></textarea>
						</div>
					</div>
					<div class="col-md-4">
							<div class="form-group">
								<label><?=display('ticket_problem')?> </label>
								<select class="form-control" name = "issue">
									<option value = "">-- Select --</option>
								<?php if(!empty($problem)) {
										foreach($problem as $ind => $prblm){
											?><option value = "<?php echo $prblm->subject_title; ?>" <?php echo ($ticket->category == $prblm->id) ? "selected" : "" ?>><?php echo $prblm->subject_title; ?></option><?php
										}	
									} ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Solution </label>
								<select class="form-control" name = "solution">
									<option value = "">-- Select --</option>
									<option value = "1"  <?php echo ($ticket->solution == 1) ? "selected" : "" ?>>Done</option>
									<option value = "2" <?php echo ($ticket->solution == 2) ? "selected" : "" ?>>Proccess</option>
									<option value = "3"  <?php echo ($ticket->solution == 3) ? "selected" : "" ?>>Defer</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Status </label>
								<select class="form-control" name = "status">
									<option value = "">-- Select --</option>
									<option value = "0" <?php echo ($ticket->status == 0) ? "selected" : "" ?>>Unread</option>
									<option value = "1" <?php echo ($ticket->status == 1) ? "selected" : "" ?>>Proccess</option>
									<option value = "2" <?php echo ($ticket->status == 2) ? "selected" : "" ?>>Read</option>
									<option value = "3" <?php echo ($ticket->status == 3) ? "selected" : "" ?>>Dropped</option>
								</select>
							</div>
						</div>
					</div>
					<div class="text-center">					
						<input type ="hidden" name = "ticketno" value = "<?php echo $ticket->id; ?>">
						<input type ="hidden" name = "client" value = "<?php echo $ticket->client; ?>">
						<button type = "submit" class="btn btn-success">Update</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>	
		</div>
	</div>
</div>