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
						<a href="<?=base_url('ticket/natureOfComplaintList')?>" class="btn btn-success"> <i class="fa fa-list"></i> Nature Of Complaint List 
						</a>
					</div>
				</div>
				</div>
				<div class="panel-body">
				<div class="col-md-2"></div>
				<div class="col-md-8 panel-default panel-body" style ="border:1px solid #f7f7f7">
				<?php echo form_open_multipart(base_url("ticket/addNatureOfComplaint")); ?>
			<div class="row ">
				<div class="col-md-6">
					<div class="form-group">
						<label>Title <i class="text-danger">*</i></label>
						<input type="hidden" name="complainid" value="<?php if(!empty($detail->id)){ echo $detail->id; } ?>">
						<input type = "text" class="form-control" name = "title" value="<?php if(!empty($detail->title)){ echo $detail->title; } ?>" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Status <i class="text-danger">*</i></label>
						<select class="form-control add-select2 choose-client" name = "status" required>
							<!-- <option value = "" style ="display:none;">---Select---</option> -->
							<option value="1" <?php if(!empty($detail->status ) && $detail->status == 1){ echo "selected"; } ?> >Active</option>
							<option value="0" <?php if(empty($detail->status )){ echo "selected"; } ?> >InActive</option>
						</select>
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
