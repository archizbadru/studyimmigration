
<link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
	
       	<div class="row">
				 <div class="panel panel-default"> 
				<div class="panel-heading no-print">
					<div class="row">
						<div class="col-md-12 text-center">
                <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>        

							<h3><?php echo $ticket->ticketno; ?></h3> 				
						</div>
					</div>
				</div>
				<div class="panel-body">
				<div class="col-md-2"></div>
				<div class="col-md-8 panel-default panel-body" style ="border:1px solid #f7f7f7">
		
				
				<?php echo form_open_multipart(base_url("ticket/edit/".$ticket->ticketno)); ?>
			<div class="row ">
				<div class="col-md-6">
					<div class="form-group">
						<label>Problem For</label>
						<select class="form-control add-select2 choose-client" name = "client" required>
							<option value = "" style ="display:none;">---Select---</option>
							<?php if(!empty($clients)){
								foreach($clients as $ind => $clt){
									?><option value ="<?php echo $clt->enquiry_id ?>" <?php if($ticket->client == $clt->enquiry_id){ echo "selected";} ?> ><?php echo $clt->name." ".$clt->lastname; ?> </option><?php
								}
							} ?>
						</select>
					</div>
				</div>
				
						<input type = "hidden" class="form-control" value = "<?php echo $ticket->ticketno; ?>" name = "ticketno">
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Name</label>
						<input type = "text" class="form-control" value = "<?php echo $ticket->name; ?>" name = "name">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Phone Number </label>
						<input type="text" class="form-control" name = "phone" value = "<?php echo $ticket->phone; ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input type = "text" class="form-control" value = "<?php echo $ticket->email; ?>" name = "email">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Complain Date</label>
						<input type = "text" class="form-control add-date-picker" name = "complaindate" value= "<?php echo date("m/d/Y", strtotime($ticket->coml_date)) ?>">
					</div>
				</div>
		<?php if($this->session->companey_id!=83){ ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Product</label>
					<select class="form-control add-select2 chg-product" name = "product">
							<?php if(!empty($product)) {
								foreach($product as $ind => $prd){
									
									?><option value ="<?php echo $prd->id ?>" <?php echo ($ticket->product == $prd->id) ? "selected" : ""; ?>><?php echo $prd->country_name; ?> </option><?php
								}
								
							} ?>
						
							
						</select>
					</div>
				</div>
				<?php } ?>
				<div class="col-md-6">
						<div class="form-group">
						<label><?=display('ticket_problem')?></label>
						<select class="form-control add-select2" name = "relatedto">
					<?php  if(!empty($problem)) { ?>
									<option value="">-- Select --</option>
								<?php
								foreach($problem as $ind => $prblm){									
									?>
									<option value = "<?php echo $prblm->id; ?>" <?php echo ($prblm->id == $ticket->category) ? "selected" : ""; ?>><?php echo $prblm->subject_title ?> </option><?php
								}	
								
							} ?>
				
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nature of Complaint</label>
						<select class="form-control add-select2" name = "issue">
						<option value = ""> -- Select --</option>
					<?php  if(!empty($issues)) {
								foreach($issues as $ind => $issue){
									?><option value = "<?php echo $issue->id ?>" <?php echo ($issue->id == $ticket->issue) ? "selected" : ""; ?> ><?php echo ucfirst($issue->title) ?> </option><?php
								}	
							} ?>
						</select>
					</div>
				</div>
				<div class = "col-md-6" id = "waranty-start">
					
				</div>
				<div class = "col-md-6" id = "waranty-end">
					
				</div>
				<?php if($this->session->user_right!=214){ ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Priority</label>
						<select class="form-control add-select2" name = "priority">

							<option value = "1" <?php echo (1 == $ticket->priority) ? "selected" : ""; ?>>Low</option>
					
							<option value = "2" <?php echo (2 == $ticket->priority) ? "selected" : ""; ?>>Medium</option>
							<option value = "3" <?php echo (3 == $ticket->priority) ? "selected" : ""; ?>>High</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Source</label>
						<select class="form-control add-select2" name = "source">
							<?php  if(!empty($source)) {
								foreach($source as $ind => $prblm){
									
									?><option value = "<?php echo $prblm->lsid ?>" <?php echo ($ticket->sourse == $prblm->lsid) ? "selected" : ""; ?> ><?php echo $prblm->lead_name ?> </option><?php
								}	
								
							} ?>
						</select>
					</div>
				</div>
				<?php } ?>
				<div class="col-md-12">
					<div class="form-group">
						<label>Attachment</label>
						<input type = "file" name = "attachment" class="form-control">
						<a href="<?php echo base_url('assets/images/'.$ticket->attachment); ?>" target="_blank"><?php echo $ticket->attachment ?></a> 
					</div>
				</div>
				
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Remark</label>
						<textarea name = "remark" class="form-control"><?php echo $ticket->message; ?></textarea>
					</div>
				</div>
				<div class="col-md-12 text-center">
					<div class="form-group">
						<label>Complaint Type</label>
						<div>							
							<input type="radio" name="complaint_type" value="1" <?=($ticket->complaint_type==1)?'checked':''?>> <label>Is Complaint</label>
							<input type="radio" name="complaint_type" value="2" <?=($ticket->complaint_type==2)?'checked':''?>> <label>Is Query</label>
						</div>
					</div>
				</div>
				<input type = "hidden" name = "ticketno" value = "<?php echo $ticket->ticketno; ?>">
				<div class = "col-md-12 text-center">
					<button class="btn btn-success" type="submit">Save</button>
				</div>
				</div>
				<?php echo form_close(); ?>
			</div>
			</div>
			</div>
        </div>            
          
<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>      
<!-- DataTables JavaScript -->
<script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>  
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		
		$(".add-date-picker").datepicker({
			 format: 'yyyy/mm/dd',
			 startDate: '-7d'
		});	
	});
	$(document).on("change", ".choose-client", function(){		
		$.ajax({
			url     : "<?php echo base_url('ticket/loadinfo'); ?>",
			type    : "post",
			data    : {clientno : $(this).val()},
			success : function (resp){
				var jdata = JSON.parse(resp);
				$("input[name=name]").val(jdata.name);
				$("input[name=email]").val(jdata.email);
			}
		})
	});
</script>