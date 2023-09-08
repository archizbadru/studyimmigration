<link href="<?php echo base_url(); ?>assets/plugins/date-picker/spectrum.css" rel="stylesheet" />
    <style>
        .prod-details{
            display:none;
        }
    </style>
				<!--Header submenu -->
				<div class="bg-white p-3 header-secondary header-submenu">
					<div class="container ">
						<div class="row">
							<div class="col">
									<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="<?php echo base_url("delivery"); ?>">Delivery</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
							</ol><!-- End breadcrumb -->
							</div>
							<div class="col col-auto">
								<a href="<?php echo base_url("delivery"); ?>" class="btn btn-pill btn-secondary"><i class="fe fe-arrow-left"></i> Delivery List </a>
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
						<div class="row">
					<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div class="d-flex">
										<?php if(empty($ord->main_img)){
											$pimage = base_url("assets/images/profile/33.png");
										}else{
											$pimage = base_url($ord->main_img);
										} ?>
										<?php if(empty($ord->image)){
											$uimage = base_url("assets/images/profile/33.png");
										}else{
											$uimage = base_url($ord->image);
										} ?>
											<a class="header-brand" href="index.html">
															<img class="" alt="img" src="<?php echo $pimage; ?>" style = "height:90px;">
															
																
											</a>
												<address>
												<h4><img class ="avatar avatar-sm brround" src = "<?php echo $uimage; ?>">
													 <?php echo $ord->customer; ?></h4>
													<i class = "fa fa-map-signs"></i> <?php echo $ord->address; ?>
													<i class = "fa fa-globe"></i> <?php echo $ord->state.", ".$ord->city; ?><br>
													<br>
													<i class = "fa fa-envelope-o"></i> <?php echo $ord->email; ?>
													
													<i class = "fa fa-phone"></i><?php echo $ord->phone; ?>													
													</address>
											<div class="text-right ml-auto">
												<h2 class="mb-1"> <?php echo $ord->ord_no; ?></h2>
												<p class="mb-1"><span class="font-weight-semibold">Order Date :</span> <?php echo date("d, F Y", strtotime($ord->order_date)); ?> </p>
												<p><span class="font-weight-semibold"> Date :</span> <?php echo date("d, F Y", strtotime($ord->order_date)); ?></p>
											</div>
										</div>
										<hr>
										<div class = "row">
										
											<?php if(!empty($delivery)){
												
												?>
												
												<table class = "table">
													<thead>
														<tr>
															<td>Srno</td>
															<td>Confirm</td>
															<td>Pending</td>
															<td>Delivery Date</td>
															<td></td>
														</tr>
													</thead>
													<tbody>
														<?php foreach($delivery as $ind => $dlv) { ?>
														<tr>
															<td><?php echo $ind + 1;  ?></td>
															<td><?php echo $dlv->delv_qty ?></td>
															<td><?php echo $dlv->pending_qty; ?></td>
															<td><?php echo $dlv->delivery_date; ?></td>
															<td class = "text-right">		<a href="<?php echo base_url("order/bookingupdate/".urlencode(base64_encode(base64_encode($dlv->id)))); ?>" class="btn btn-info">
														<i class="fe fe-edit" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>

														<a href="<?php echo urlencode(base64_encode(base64_encode($dlv->id))); ?>"  class="btn btn-danger delete-content">
														<i class="fe fe-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i></a></td>
														</tr>
														<?php } ?>
													</tbody>
												</table>
										<?php	} ?>
										
											<div class = "col-md-12">
																<?php echo form_open(); ?>
									
																		<div class = "row">
																			<div class = "col-4">
																				<div class = "form-group pt-1">
																					<label>Order Quantity :</label>
																					<?php echo $ord->quantity; ?>
																				</div>
																			<?php
																			$totremain = 0;
																			if($ord->confirm_order > 0) {  ?>	
																				<div class = "form-group pt-1">
																					<label>Confirm Quantity :</label>
																					<?php echo $ord->confirm_order; ?>
																				</div>
																				
																				<div class = "form-group pt-1">
																					<label>Pending Quantity :</label>
																					<?php  $ord->confirm_order;
																						echo $totremain = $ord->quantity - 	$ord->confirm_order;	
																					?>
																				</div>
																			<?php } ?>	
																			</div>
																			<div class = "col-4">
																				<div class = "form-group">
																					<label>Confirm Quantity</label>
																					<input type = "number" class = "form-control" name = "confirmqty" value = "<?php echo $totremain; ?>" placeholder = "Confirm Quantity">
																				</div>
																			</div>
																			<div class = "col-4">
																				<div class = "form-group">
																					<label>Pending Quantity</label>
																					<input type = "number" class = "form-control" name = "pendingqty"  value = "0" placeholder = "Pending Quantity">
																				</div>
																			</div>
																			<div class = "col-4">
																				<div class = "form-group">
																					<label>Delivery Date</label>
																						<div class="input-group">
																							<div class="input-group-prepend">
																								<div class="input-group-text">
																									<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																								</div>
																							</div><input class="form-control fc-datepicker datepicker" name="delvdate"  placeholder="MM/DD/YYYY"  value = "" type="text">
																						</div>
																				</div>
																			</div>
																			<div class = "col-4">
																				<div class = "form-group">
																					<label>Pending Delivery Date</label>
																						<div class="input-group">
																							<div class="input-group-prepend">
																								<div class="input-group-text">
																									<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																								</div>
																							</div><input class="form-control fc-datepicker datepicker" name="penddate"  placeholder="MM/DD/YYYY"  value = "" type="text">
																						</div>
																					
																				</div>
																			</div>
																			<div class = "col-4">
																					<div class = "form-group">
																						<label>Delivery By</label>
																						<select class = "form-control" name = "deliverby">
																							<option value = "User 1">User 1</option>
																							<option value = "User 2">User 2</option>
																							<option value = "User 3">User 3</option>
																							<option value = "User 4">User 4</option>
																							<option value = "User 5">User 5</option>
																						</select>
																					</div>
																				</div>
																				<div class = "col-4">
																					<div class = "form-group">
																						<label>Order Status</label>
																						<select class = "form-control" name = "deliverstatus">
																							<option value = "1">Request</option>
																							<option value = "2">Waiting</option>
																							<option value = "3">Dispatch</option>
																							<option value = "4">Delivery Confirm</option>
																							<option value = "5">Reject</option>
																						</select>
																					</div>
																				</div>
																				<div class = "col-12 text-center">
																					
																					<input type = "hidden" name = "productno" value = "<?php echo $ord->prdid; ?>">
																					<input type = "hidden" name = "orderno" value = "<?php echo $ord->id; ?>">
																					<input type = "hidden" name = "ordernumb" value = "<?php echo $ord->ord_no; ?>">
																					
																					<button type = "submit" class = "btn btn-success btn-pill btn-xs mt-4 mt-sm-0" name = "saveorder">Confirm</button>
																				
																				</div>	
																		</div>
																
																		<?php echo form_close(); ?>
											
											</div>
										</div>	
									</div>
								</div>	
									
								</div>
								<?php echo form_close(); ?>
							</div>
					</div>
				</div>		
		</div>
					</div>
				</div>
				
				<?php echo form_open(base_url("ajax/deletesingle/bookings"), array("id" => "hide-ajx-form")); ?>
			<input type = "hidden" name = "contentno" id = "contentno-no">
		<?php echo form_close(); ?>
		<script src = "<?php echo base_url("assets/plugins/sweet-alert/sweetalert.min.js"); ?>"></script>
				
				<script src="<?php echo base_url(); ?>assets/plugins/date-picker/spectrum.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>
		<script>
		    $(document).on("change", ".load-ajx-product", function(){
		        
		        $.ajax({
		            url     : "<?php echo base_url("ajax/getproduct"); ?>",
		            type    : "post",
		            data    : {"prodno" : $(this).val()},
		            success : function(resp){
		                
		                var jresp = JSON.parse(resp);
		                $(".prod-details").fadeIn();
		                $("#prod-category").text(jresp.prod_category);
		                $("#prod-brand").text(jresp.prod_brand);
		                $("#prod-image").attr("src", jresp.prod_image);
		                $("#prod-stock").val(jresp.prod_stock);
						$("#prod-color").text(jresp.prod_color);
						$("#prod-sku-id").text(jresp.prod_skuid);
		            }
		        });
		    });
		    $(document).ready(function(){
		        
		        $(".fc-datepicker").datepicker();
		    });
		</script>
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