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
											</div>
										</div>
										<hr>
											<?php echo form_open(); ?>
							<?php if(!empty($order)) {
									foreach($order as $ind =>$pord) {	
								
								?>
										
										<div class="row">
									<div class="col-md-3 text-center">
												<p class="font-w600 mb-1"><img class="avatar avatar-xxl brround" src="http://softwaresuggestion.in/cona/assets/images/profile/33.png"> </p>
												<h5><?php echo $pord->pro_name;?></h5>
												<h4>Quantity: <?php echo $pord->quantity; ?></h4>
												<label>Price : </label> <i class="fa fa-rupee"></i> <?php echo $pord->price; ?>
																																																							</div>
											<div class="col-md-9">
										
										<?php 
									
											if(!empty($delivery[$pord->id])) {
													$bkarr = $delivery[$pord->id];
													foreach($bkarr as $ind => $bkg) {	
													?>
												
													<div class = "row">		
														<div class="col-4">
															<div class="form-group">
																<label>Confirm Quantity</label>
																<input type="number" class="form-control" name="confirmqty[<?php echo $bkg->id; ?>]" value="<?php echo $bkg->delv_qty; ?>" placeholder="Confirm Quantity">
																	<input type = "hidden" name = "quantity[<?php echo $bkg->id; ?>]" value = "<?php echo $pord->quantity; ?>">
															</div>
														</div>
														<div class="col-4">
															<div class="form-group">
																<label>Pending Quantity</label>
																<input type="number" class="form-control" name="pendingqty[<?php echo $bkg->id; ?>]" value="<?php echo $bkg->pending_qty; ?>" placeholder="Pending Quantity">
															</div>
														</div>
														<div class="col-4">
															<div class="form-group">
																<label>Remaining Quantity</label>
																<input type="number" class="form-control" name="pendingqty[<?php echo $bkg->id; ?>]" value="<?php echo $bkg->pending_qty; ?>" placeholder="Pending Quantity">
															</div>
														</div>
													</div>
											
										<?php   }
											}else{ ?>
												   <div class = "row">
														<div class = "col-12">
															There is order confirm
														</div>
												   </div>	
									 <?php	}  ?>							
											
							
										</div>
									</div>
									<div class ="row">
										<div class = "col-12"><hr /></div>
									</div>
									<?php } ?>						
												<div class = "row">
															<div class = "col-3">
																<div class = "form-group">
																	<label>Delivery Date</label>
																		<div class="input-group">
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																				</div>
																			</div><input class="form-control fc-datepicker datepicker" name="delvdate"  placeholder="MM/DD/YYYY"  value = "<?php  echo date("m/d/Y", strtotime($ord->conf_delv)); ?>" type="text">
																		</div>
																</div>
															</div>
															<div class = "col-3">
																<div class = "form-group">
																	<label>Pending Delivery Date</label>
																		<div class="input-group">
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																				</div>
																			</div><input class="form-control fc-datepicker datepicker" name="penddate"  placeholder="MM/DD/YYYY"  value = "<?php  echo date("m/d/Y", strtotime($ord->pend_delv)); ?>" type="text">
																		</div>
																	
																</div>
															</div>
															<div class = "col-3">
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
																<div class = "col-3">
																	<div class = "form-group">
																		<label>Order Status</label>
																		<select class = "form-control" name = "deliverstatus">
																			<option value = "1" <?php echo ($ord->status == 1) ? "selected" : "" ?>>Request</option>
																			<option value = "2" <?php echo ($ord->status == 2) ? "selected" : "" ?>>Waiting</option>
																			<option value = "3"  <?php echo ($ord->status == 3) ? "selected" : "" ?>>Dispatch</option>
																			<option value = "4"  <?php echo ($ord->status == 4) ? "selected" : "" ?>>Delivery Confirm</option>
																			<option value = "5"  <?php echo ($ord->status == 5) ? "selected" : "" ?>>Reject</option>
																		</select>
																	</div>
																</div>
																<div class = "col-12 text-center">
																	
																	<input type = "hidden" name = "deliveryno" value = "<?php echo $ord->id; ?>">
																	
																	<button type = "submit" class = "btn btn-success btn-pill btn-xs mt-4 mt-sm-0" name = "saveorder">Confirm</button>
																
																</div>	
					</div>	
										
										
										<?php } ?>
									<?php echo form_close(); ?>	
										<div class = "row">
										
											<?php if(!empty($delivery) and !empty($sdfdf)){
												
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

		<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>
		