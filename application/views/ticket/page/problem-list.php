
<link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
		
       	<div class="row">
				 <div class="panel panel-default pt-2"> 
				<div class="panel-heading no-print" style ="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
							<div class="row">
					<div class="col-md-12">
						<h4> Ticket 				<div style="float:right">
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" onclick="window.location.reload();" title="Refresh">
               <i class="fa fa-refresh icon_color"></i>
               </a>  
            </div>
         
            
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" href="<?php echo base_url("ticket/addproblems"); ?>" title="Refresh">
               <i class="fa fa-arrow-left icon_color"></i>
               </a>                                                    
            </div>
         </div></h4>
		 
					</div>
				</div>
				</div>
				<div class="panel-body">
				<div class="col-md-2"></div>
				<div class="col-md-8 panel-default panel-body" style ="border:1px solid #f7f7f7">
		
				
				<?php echo form_open(); ?>
				<div class="row ">
			
					<div class="col-md-9">
						<div class="form-group">
							<label>Problem</label>
							<input type = "text" class="form-control" name = "problem" value = "<?php echo (!empty($eproblem->title)) ? $eproblem->title : ""; ?>">
						</div>
					</div>
				
					<div class = "col-md-3 text-center"><br />
						<?php if(!empty($eproblem->title)) {
							
							?><input type = "hidden" name = "problemno" value = "<?php echo $eproblem->id; ?>"><?php
						} ?>
						<button class="btn btn-success" type="submit">Save</button>
					</div>
				</div>
				<?php echo form_close(); ?>
				<div class = "row">
					<div class = "col-md-12">
				<hr />
				<?php 	if(!empty($problem)) { ?>
						<table class = "table datatable">
							<thead>
								<tr>
								<th>Srno.</th>
								<th>Problem</th>
								<th></th>
								</tr>
							</thead>
							<tbody>
				
				<?php		foreach($problem as $ind => $prb){
								?>
								<tr>
								<td><?php echo $ind + 1; ?></td>
								<td> <?php echo $prb->title;  ?></td>
								<td><a class = "btn btn-default" href = "<?php echo base_url("ticket/addproblems/".$prb->id); ?>"> <i class = "fa fa-pencil"></i></a>
								<!--	<a class = "btn btn-danger" href = "<?php echo base_url("ticket/addproblems.html/".$prb->id); ?>"> <i class = "fa fa-trash"></i></a> -->
								</td>
								</tr>		
				<?php			} ?>
							</tbody>
						</table>	
				<?php	} ?>
						
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
	$(document).ready(function(){
		
		$(".add-date-picker").datepicker({
			 format: 'yyyy/mm/dd',
			 startDate: '-7d'
		});	
		$(".datatable").addDataTable();
		
	});
</script>
