<link rel = "stylesheet" href = "<?php echo base_url("assets/plugins/sweet-alert/sweetalert.css"); ?>">
<div class="bg-white p-3 header-secondary header-submenu">
					<div class="container ">
						<div class="row">
							<div class="col">
									<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="">Order</a></li>
								<li class="breadcrumb-item active" aria-current="page">Booking List</li>
							</ol><!-- End breadcrumb -->
							</div>
							<div class="col col-auto">
								<a href="<?php echo base_url("order"); ?>" class="btn btn-pill btn-secondary"> Order</a>
							</div>
						</div>
					</div>
				</div><!--End Header submenu -->

                <!-- app-content-->
				<div class="container content-area">
					<div class="side-app">

						<!-- page-header -->
						<div class="page-header">
							
							<div class="ml-auto">
								
							</div>
						</div>
						<!-- End page-header -->

						<!-- row -->
						<div class="row">
							<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Order List</div>
								
								</div>
								<div class="card-body">
                                	<div class="table-responsive">
										<table class="table table-striped table-bordered text-nowrap w-100 dataTable no-footer" id = "add-datatable">
											<thead>
												<tr>
													<th class="wd-15p">S.No.</th>

													<th class="wd-15p">Order</th>
													<th class="wd-15p">Product</th>
													<th class="wd-15p">Confirm Order</th>
													<th class="wd-15p">Pending Order</th>
													<th class="wd-15p">Delivery Order</th>
													<th class="wd-15p">Pending Order</th>
													<th class="wd-15p">Status</th>
													<th class="wd-15p">Update</th>
													<th class="wd-15p">Action</th>
													
												</tr>
											</thead>

											<tbody>
												<?php if(!empty($bookings)){

												   $sl=1;
                                                  foreach($bookings as $ind =>  $bkg){
												?>
												<tr>

													<td><?= $ind + 1; ?></td>
													<td><?php echo $bkg->ord_no; ?></td>
													<td><?php echo $bkg->product; ?></td>
													<td><?php echo $bkg->delv_qty; ?></td>
													<td>
														<?php echo $bkg->pending_qty;?>
													</td>
													<td><?= $bkg->delivery_date; ?></td>
													<td><?= $bkg->pending_deliver; ?></td>
													<td><?= $bkg->status; ?></td>
													<td><?= date("d, M Y", strtotime($bkg->created_date));  ?></td>
													<td>
														<a href="<?php echo base_url("order/bookingupdate/".urlencode(base64_encode(base64_encode($bkg->id)))); ?>" class="btn btn-info">
														<i class="fe fe-edit" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>

														<a href="<?php echo urlencode(base64_encode(base64_encode($bkg->id))); ?>"  class="btn btn-danger delete-content">
														<i class="fe fe-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>

													</td>
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
	<?php echo form_open(base_url("ajax/deletesingle/bookings"), array("id" => "hide-ajx-form")); ?>
			<input type = "hidden" name = "contentno" id = "contentno-no">
		<?php echo form_close(); ?>
		<script src = "<?php echo base_url("assets/plugins/sweet-alert/sweetalert.min.js"); ?>"></script>
				
		<?php
			
			$urlarr["ajax"]["url"] =  base_url('table/bookings');	
		echo datatable("#add-datatable" , $urlarr); ?>
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
				
