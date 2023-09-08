<link href="<?php echo base_url(); ?>assets/plugins/date-picker/spectrum.css" rel="stylesheet" />
   
				<!--Header submenu -->
				<div class="bg-white p-3 header-secondary header-submenu">
					<div class="container ">
						<div class="row">
							<div class="col">
									<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="<?php echo base_url("order"); ?>">Order</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
							</ol><!-- End breadcrumb -->
							</div>
							<div class="col col-auto">
								<a href="<?php echo base_url("Stock"); ?>" class="btn btn-pill btn-secondary"><i class="fe fe-arrow-left"></i> Stock List </a>
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
						<div class="card shadow">
							<div class="card-header">
								<h3 class="card-title mb-0"><?php echo $title; ?></h3>
							
							</div>
							<div class="card-body">
								
								<?php  echo form_open_multipart(); ?>
								<div class = "row">
									<div class = "col-md-8">
										<div class ="row">	
											<div class = "col-md-8">
												
												<div class="form-group">
													<h4><label>Product : </label>
													<b><?php echo $ord->pro_name ?></b></h4>
													<label>Ware house : </label>
												</div>
												<div class="form-group prod-details">
													<label>Category : <b class = "mand"></b></label>
													<b><?php echo $ord->pro_name ?></b>
												</div>
												<div class="form-group prod-details">
													<label>Brand : <b class = "mand"></b></label>
													<b><?php echo $ord->pro_name ?></b>
												</div>
											</div>
											<div class = "col-md-4 prod-details">
												
												<div class = "col-md-10">
												<div class = "card">
												   <div class = "card-header"> 
													<div class = "card-body">
															<h4>Profile Image</h4>
														<img  id = "prod-image" src = "<b><?php echo $ord->main_img; ?></b>">
													</div>        
												</div>
												</div>
										
												</div>
												
												<div class  = "col-md-2"></div>
											</div>
											<div class ="col-12">
												<div class ="row">
														<div class = "col-4">
										<div class="panel panel-default">
											<div class="list-group">
												<a href="javascript:void(0)" class="list-group-item"><label>Payment :</label>
											<?= $ord->quantity; ?></a>
												<a href="javascript:void(0)" class="list-group-item "><label>Mode :</label>
											<?php 
													if($ord->pay_mode == 1){
														echo "Online";	
													}else if($ord->pay_mode == 2){
														echo "Account Transfer";	
													}else if($ord->pay_mode == 3){
														echo "By Check";	
													}else if($ord->pay_mode == 4){
														echo "By Cash";	
													} ?></a>
											<a href="javascript:void(0)" class="list-group-item"><label>Status </label>
											<?php if($ord->pay_status == 1){
																echo "Pending";
															}else{
																echo "Complete";
															} ?></a>
											</div>
										</div>
									</div>	
									<div class = "col-4">
										<div class="panel panel-default">
											<div class="list-group">
												<a href="javascript:void(0)" class="list-group-item"><label>Prev Balance :</label>
											<?= $ord->balance; ?></a>
											</div>
											<div class="list-group">
												<a href="javascript:void(0)" class="list-group-item"><label>Current Balance :</label>
											<?= $ord->balance; ?></a>
											</div>
											<div class="list-group">
												<a href="javascript:void(0)" class="list-group-item"><label>Total Due :</label>
											<?= $ord->balance; ?></a>
											</div>
										</div>
									</div>	
									<div class = "col-4">
										<div class="panel panel-default">

											<div class="list-group">
												<a href="javascript:void(0)" class="list-group-item">
												<label>Delivery Date : </label><?= date("d,M Y", strtotime($ord->delivery_date)); ?>
												</a>
											</div>
											<div class="list-group">
												<a href="javascript:void(0)" class="list-group-item">Order Date</label><?= date("d, M Y", strtotime($ord->order_date)); ?>
												</a>
											</div>
											<div class="list-group">
												<a href="javascript:void(0)" class="list-group-item ">Status</label>
													<?php if($ord->status  == 1 ){
															echo "Request";
													}else if($ord->status  == 2 ){
															echo "Waiting";
													}else if($ord->status  == 3 ){
															echo "Half Confirm";
													}else if($ord->status  == 4 ){
															echo "Full Confirm";
													}else if($ord->status  == 5 ){
															echo "Reject";
													} ?>
												</a>
											</div>		
										</div>
									</div>
												</div>
											</div>
										</div>	
									</div>
									<div class ="col-4">
										<div class="panel panel-default">
											<div class="list-group">
													<a href="javascript:void(0)" class="list-group-item active"><label>Customer :</label><?php echo $ord->customer;  ?>
												</a>
											
												<a href="javascript:void(0)" class="list-group-item"><label>Order Quantity </label>
											<?= $ord->quantity; ?></a>
											<a href="javascript:void(0)" class="list-group-item"><label><label> Scheme :</label><?= $ord->scheme; ?> </label>
											</a>
											<a href="javascript:void(0)" class="list-group-item"><label>Price :<label /><?= $ord->price; ?>
											</a>
											<a href="javascript:void(0)" class="list-group-item"><label>Discount </label>: <?= $ord->offer; ?>
											</a>
											<a href="javascript:void(0)" class="list-group-item"><label>GST </label>: <?= $ord->gst; ?>
											</a>
											<a href="javascript:void(0)" class="list-group-item"><label>	Other :</label> <?= $ord->other_price; ?>
														
												
											</a>
												<a href="javascript:void(0" class="list-group-item active"><label>Total </label>: <?= $ord->total_price; ?></a>
											
											</div>
										</div>
									</div>
								</div>	
								<div class = "row">
									<div class = "col-12">	
										<hr />
										
									</div>
								</div>
							<?php echo form_open(); ?>
							
							<div class = "row">
								<div class = "col-4">
									<div class = "form-group">
										<label>Confirm Quantity</label>
										<input type = "number" class = "form-control" name = "confirmqty" value = "<?php echo $ord->confirm_order; ?>" placeholder = "Confirm Quantity">
									</div>
								</div>
								<div class = "col-4">
									<div class = "form-group">
										<label>Pending Quantity</label>
										<input type = "number" class = "form-control" name = "pendingqty"  value = "<?php echo $ord->pending_order; ?>" placeholder = "Pending Quantity">
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
												</div><input class="form-control fc-datepicker datepicker" name="delvdate"  placeholder="MM/DD/YYYY"  value = "<?php echo date("d/m/Y", strtotime($ord->delivery_date)); ?>" type="text">
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
												</div><input class="form-control fc-datepicker datepicker" name="penddate"  placeholder="MM/DD/YYYY"  value = "<?php echo date("d/m/Y", strtotime($ord->pend_deliver)); ?>" type="text">
											</div>
										
									</div>
								</div>
								<div class = "col-4">
									<div class = "form-group">
										<label>Delivery By</label>
										<input type = "text" class = "form-control" name = "delvby"  value = "<?php echo $ord->delivery_by; ?>" placeholder = "Delivery By">
									</div>
								</div>
								<div class = "col-4">
									<div class = "form-group">
										<label>Payment Mode</label>
										<select class = "form-control" name = "paymode">
											<option value = "1" >Online</option>
											<option value = "2">Account Transfer</option>
											<option value = "3">By Check</option>
											<option value = "4">By Cash</option>
										</select>
									</div>
								</div>
								<div class = "col-4">
									<div class = "form-group">
										<label>Payment Status</label>
										<select class = "form-control" name = "paystatus">
											<option value = "1">Pending</option>
											<option value = "2">Not full </option>
											<option value = "3">Pay</option>
										</select>
									</div>
								</div>
								<div class = "col-4">
									<div class = "form-group">
										<label>Transaction No</label>
										<input type = "text" class = "form-control"  value = "<?php echo $ord->	transaction_no; ?>" name= "transno">	
									</div>
								</div>
								<div class = "col-4">
									<div class = "form-group">
										<label>Total Pay</label>
										<input type = "text" class = "form-control"  value = "<?php echo $ord->pay_price; ?>" name= "totalpay">	
									</div>
								</div>
								<div class = "col-4">
									<div class = "form-group">
										<label>Previous Balance</label>
										<input type = "text" class = "form-control"  value = "0" name= "prevbal">	
									</div>
								</div>
								<div class = "col-4">
									<div class = "form-group">
										<label>Pending Balance</label>
										<input type = "text" class = "form-control"  value = "<?php echo $ord->balance; ?>" name= "pendingbal">	
									</div>
								</div>
								<div class = "col-4">
									<div class = "form-group">
										<label>Order Status</label>
										<select class = "form-control" name = "orderstatus">
											<option value = "1">Request</option>
											<option value = "2">Waiting</option>
											<option value = "3">Half Delivery</option>
											<option value = "4">Delivery Confirm</option>
											<option value = "5">Reject</option>
										</select>
									</div>
								</div>
								<div class = "col-12 text-center">
									<input type = "hidden" name = "orderno" value = "<?php echo $ord->id; ?>">
									<button type = "submit"  class="btn btn-pill btn-secondary"> Save </button>
								</div>
							</div>
								
							<?php echo form_close(); ?>
					</div>
				</div>		
		</div>
					</div>
				</div>
				<script src="<?php echo base_url(); ?>assets/plugins/date-picker/spectrum.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>
		<script>

		    $(document).ready(function(){
		        
		        $(".fc-datepicker").datepicker();
		    });
		</script>