<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" onclick="window.history.back()"> <i class="fa fa-arrow-left"></i> Back </a>  
                </div>					
            </div>
            <div class="panel-body panel-form">

		
		<div class="row">

							<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
										<div class = "row col-12">
										<div class = "col-12">
									
					
														<?php   $othrurl = "";
											if(isset($_GET)){
												
												foreach($_GET as $ind => $gt){
													
													if($ind == 0){
														$othrurl = "?".$ind."=".$gt;
													}else{
														$othrurl = "&".$ind."=".$gt;
													}
													
												}
												
											} ?>
									<?php echo form_open(base_url("payment"), array("id"=> "filter-form-ajx")); ?>
									<div class = "row" id = "filter-area" style = "display:none;">
										<div class = "col-12">
											<hr />
										</div>
										<div class = "form-group col-3">
											<label>Start Date</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
														</div>
													</div>
													<input class="form-control" name="startdate" id = "start-date" placeholder="DD/MM/YYYY" value="" type="date" autocomplete = "off">
												</div>
										</div>
										<div class = "form-group col-3">
											<label>End Date</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
														</div>
													</div><input class="form-control" name="enddate" id = "end-date" placeholder="DD/MM/YYYY" value="" type="text" autocomplete = "off">
												</div>
										</div>
										<div class = "form-group col-3">
											<label>Filter</label>
												<div class="input-group">
													<select name="status" id="fltr-status" class="form-control">
														<option value =""></option>
															<?php foreach($product as $p)
															{?>
																<option value = "<?php echo $p->product; ?>"><?php echo $p->product; ?></option>
															<?php }?>
															<!-- <?php   if(!empty($product)) { 
																foreach($product as $key => $mstr) { 
																
																if($mstr->type == 2) {
																?>
															
																<option value = "<?php echo $mstr->id; ?>"><?php echo $mstr->title; ?></option>
															<?php }
																}
															}
															?> -->
													</select>
												</div>
										</div>
										<div class = "form-group col-3">
										<a href="javascript:void(0)" class="btn btn-dark btn-sm btn-pill slide-chng-div float-right" data-target="#filter-area"><i class  = "fe fe-arrow-up"></i></a>
											<br />
											<a class = "btn btn-warning btn-pill addit-filter-ord"><i class  = "fa fa-search"></i> </a>
											<button type = "reset" class = "btn btn-secondary btn-pill"><i class="fa fa-refresh" aria-hidden="true"></i></button>
											<button type = "submit" name = "downloadexel" value = "downloadexel" class = "btn btn-info btn-pill"><i class  = "fa fa-download"></i> Excel</button>
										</div>
									</div>
									<?php echo form_close(); ?>
									</div>
								</div>	
							
								</div>
								<div class="card-body">
								
                                	<div class="table-responsive">
										<table class="table table-striped datatable1 table-bordered">
											<thead>
												<tr>
													<th class="wd-15p">S.No.</th>
												
													<th class="wd-15p">Order</th>
											
													<!-- <th class="wd-15p">Product</th> -->
													<th class="wd-15p">Total Pay</th>
													<th class="wd-15p">Paid</th>
													<th class="wd-15p">Balance</th>
													<th class="wd-15p">Mode</th>
													<th class="wd-15p">Transaction No</th>
													<!-- <th class="wd-15p">Status</th> -->
													<th class="wd-15p">Payment Date</th>
													<!-- <th class="wd-15p">Action</th> -->
													
												</tr>
											</thead>

											<tbody>
												<?php if(!empty($payments)){

												   $sl=1;
                                                  foreach($payments as $ind =>  $pay){
												?>
												<tr> 

													<td><?= $ind + 1; ?></td>
													<td><a href="<?=base_url().'order/view/'.$pay->ord_no?>"><?php echo $pay->ord_no; ?></a></td>
												
													<!-- <td><?php echo $pay->product ?></td> -->
													<td>
														<?php echo $pay->total_price; ?>
													</td>
													<td><?php echo $pay->pay; ?></td>
													<td> <?php echo $pay->balance;  ?></td>
													<td><?php  if($pay->pay_mode == 1){
														echo "Cash on delivery";
													}else if ($pay->pay_mode == 2) {
														echo "Online";
													} ?></td>
													<td><?= $pay->transaction_no; ?></td>
													<!-- <td><?= $pay->status; ?></td> -->
													<td><?= $pay->pay_date;  ?></td>
													<!--td>
														<a href="<?php echo base_url("payment/update/".urlencode(base64_encode(base64_encode($pay->id)))); ?>" class="btn btn-info">
														<i class="fa fa-pencil" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>

														<a href="<?php echo urlencode(base64_encode(base64_encode($pay->id))); ?>"  class="btn btn-danger delete-content">
														<i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>

													</td-->
												</tr>
												<?php  $sl++; }

											}?>
											</tbody>
										</table>
									</div>
                                </div>
								<!-- table-wrapper -->
							</div>
							<!-- section-wrapper -->
							</div>
						</div>
						<!-- row end -->

					</div>

				</div>
				<!-- End app-content-->
			</div>
		</div>

		
	<?php echo form_open(base_url("ajax/deletesingle/payment"), array("id" => "hide-ajx-form")); ?>
			<input type = "hidden" name = "contentno" id = "contentno-no">
		<?php echo form_close(); ?>
		
				
		<?php
			
		//	$urlarr["ajax"]["url"] =  base_url('table/payments');	
	//	echo datatable("#add-datatable" , $urlarr); ?>
	<script>
			$(document).on("click", ".delete-content", function(e){
				
				e.preventDefault();
				
				$("#contentno-no").val($(this).attr("href"));
				
			
					
					swal({
					  title: "Are you sure?",
					  text: "Once deleted, you will not be able to recover this imaginary file!",
					  type: "warning",
					  showCancelButton: true,
					  buttons: true,
					  dangerMode: true,
					  confirmButtonText: 'Delete',
					  confirmButtonColor: '#f52b3e',
					  cancelButtonText: 'Close'
					});	
			});
		</script>
		<script>
			$(document).on("click", "button.confirm", function(e){
				
				e.preventDefault();
				$.ajax({
					url     : $("#hide-ajx-form").attr("action"),
					type    : "post",
					data    : $("#hide-ajx-form").serialize(),
					success : function(resp){
						
						var jresp = JSON.parse(resp);
						
						if(jresp.status == "success"){
							
							location.reload();
						}
						
					}
				});
			});
		</script>
				<script>
			$(document).on("click", ".approve-pay", function(e){
				
				e.preventDefault();
				
				var r = confirm("Are you sure to confirm payment");
					if (r == true) {
					 
					} else {
					  txt = "You pressed Cancel!";
					}
				
				$.ajax({
					url  	: "<?php echo base_url('ajax/approve/payment'); ?>",
					type 	: "post",
					data 	: {"contentno" : $(this).attr("href"), "status" : 1},
					success	: function (resp){
						
						resp = JSON.parse(resp);
						
						if(resp.status == "success"){
							
							location.reload();
						}
						
						
					}
				});
				
			});
		</script>				
		<script>
			/*$(document).on("click", ".addit-filter-ord", function(){
				

				  $('#add-datatable').DataTable().destroy();		
				$("#add-datatable").dataTable({
						serverSide:"true",
						lengthMenu:[10,30,100,500,1000,-1,50,100,500,1000,"All"],
						ajax:{url: $("#filter-form-ajx").attr("action"),
							  type:"post", data: {"startdate":$("#start-date").val(),"enddate":$("#end-date").val(),"action":$("#fltr-status").val(),'type':"ajaxfilter" } },
						columnDefs:{orderable:"false",target:0},
						order:[1,"desc"]
						});
			
		});
	*/
		</script>