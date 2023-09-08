<link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
	<style>
		#waranty-start,#waranty-end {
			line-height:40px;
		}
	</style>	
       	<div class="row">
				 <div class="panel panel-default pt-2"> 
				<div class="panel-heading no-print" style ="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
							<div class="row">
					<div class="col-md-12">
						<a href="<?=base_url('ticket/index')?>" class="btn btn-success"> <i class="fa fa-list"></i> Ticket List 
						</a>
					</div>
				</div>
				</div>
				<div class="panel-body">
				<div class="col-md-2"></div>
				<div class="col-md-8 panel-default panel-body" style ="border:1px solid #f7f7f7">
				<?php echo form_open_multipart(base_url("ticket/add")); ?>
			<div class="row ">
				<div class="col-md-6">
					<div class="form-group">
						<label>Problem For <i class="text-danger">*</i></label>
						<select class="form-control add-select2 choose-client" name = "client" >
							<option value = "" style ="display:none;">---Select---</option>
							<?php if(!empty($clients)){
								foreach($clients as $ind => $clt){
									?><option value ="<?php echo $clt->enquiry_id ?>"><?php echo $clt->name." ".$clt->lastname; ?> </option><?php
								}
							} ?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Name <i class="text-danger">*</i></label>
						<input type = "text" class="form-control" name = "name" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email <i class="text-danger">*</i></label>
						<input type = "text" class="form-control" name = "email" required>
					</div>
				</div>
	
				<div class="col-md-6">
					<div class="form-group">
						<label>Complaint Date</label>
						<input type="text" class="form-control add-date-picker" name = "complaindate" value="<?php echo date('m/d/Y') ?>">
					</div>
				</div>
				<?php if($this->session->companey_id!=83){ ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Product</label>
						<select class="form-control add-select2 chg-product" name = "product">
							<?php if(!empty($product)) {
								foreach($product as $ind => $prd){
									?><option value ="<?php echo $prd->id ?>"><?php echo ucfirst($prd->country_name); ?> </option><?php
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
						<option value = "">Select Subject</option>
					<?php  if(!empty($problem)) {
								foreach($problem as $ind => $prblm){
									?><option value = "<?php echo $prblm->id ?>"><?php echo ucfirst($prblm->subject_title) ?> </option><?php
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
									?><option value = "<?php echo $issue->id ?>"><?php echo ucfirst($issue->title) ?> </option><?php
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
							<option value = "1">Low</option>
							<option value = "2">Medium</option>
							<option value = "3">High</option>
						</select>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Source</label>
						<select class="form-control add-select2" name = "source">
							<?php  if(!empty($source)) {
								foreach($source as $ind => $prblm){
									?><option value = "<?php echo $prblm->lsid ?>"><?php echo $prblm->lead_name ?> </option><?php
								}	
							} ?>
						</select>
					</div>
				</div>
				<?php } ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Attachment</label>
						<input type="file" name="attachment" class="form-control">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Description</label>
						<textarea name="remark" class="form-control"></textarea>
					</div>
				</div>
				<div class="col-md-12 text-center">
					<div class="form-group">
						<label>Complaint Type</label>
						<div>							
							<input type="radio" name="complaint_type" value="1" checked> <label>Is Complaint</label>
							<input type="radio" name="complaint_type" value="2"> <label>Is Query</label>
						</div>
					</div>
				</div>
				<div class = "col-md-12 text-center">
					<button class="btn btn-success" type="submit">Save</button>
				</div>
				</div>
				<?php echo form_close(); ?>
				<div class = "row">
					<div class = "col-md-12" id = "oldticket">
					</div>
				</div>
			</div>
			</div>
			</div>
        </div>
<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>      
<!-- DataTables JavaScript -->
<script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>  
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
<script>
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
	$(document).on("change", ".chg-product", function(){
		$.ajax({
				url     : "<?php echo base_url('ticket/loadamc') ?>",
				type    : "post",
			    data    : {product: $(this).val(), client : $(".choose-client").val()},
				success : function(resp){
					var jresp = JSON.parse(resp);
					if(jresp.status == "found"){
						$("#waranty-start").html("<b>AMC From : </b>"+jresp.from_date+"<br />");
						$("#waranty-end").html("<b>AMC To : </b>"+jresp.to_date+"<br />");
					}else{
						$("#waranty-start").html('');
						$("#waranty-end").html("");
					}
				}
		})
		$("#oldticket").load("<?php echo base_url('ticket/loadoldticket') ?>/"+$(this).val())
	});
</script>
<script>
	$(document).ready(function(){
		
		$(".add-date-picker").datepicker({
			 format: 'yyyy/mm/dd',
			 startDate: '-7d'
		});	
	});
</script>