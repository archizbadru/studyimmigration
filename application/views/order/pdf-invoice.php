	<style>
		.container,.side-app{
			
			width:100%;
			display;block;
		}
		.col-md-12,.col-12{
			
			width:100%;
			display:block;
		}
		.pull-right{
			float:right;
			
		}
		.col-6,.col-md-6{
			width:50%;
			display:inline-block;
		}
		.row{
			width:100%;
			display:block;
		}
		.text-right{
			text-align:right;
		}
		table{
			 border-collapse: collapse;
			 text-align:center;
			 width:100%;
			 
		}
		table th,table td{
			border:1px solid #ccc;
			line-height:40px;
			text-align:center;
			font-size:12px;
		}
		.pull-left{
			float:left;
		}
		.avatar-md{
			width:30px;
			border-radius:50%;
		}
	</style>			
				<div class="container content-area">
					<div class="side-app">

		
		<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body row">
										<div class="col-12" style = "height:100px;">
											<div class = "col-6 pull-left">
												<a class="header-brand" href="#">
																<img class="" alt="img" src="<?php echo base_url(); ?>assets/images/brand/<?php echo (!empty($setting["site_logo"])) ? $setting["site_logo"] : ""; ?>" >
												</a>
											</div>
											<div class="pull-right text-right col-6 ml-auto">
												<h3 class="mb-1"> <?php echo $ord->ord_no; ?></h3>
												<span class="font-weight-semibold">Order Date :</span> <?php echo date("d, F Y", strtotime($ord->order_date)); ?><br />
												<span class="font-weight-semibold"> Date :</span> <?php echo date("d, F Y", strtotime($ord->order_date)); ?>
											</div>
										</div>
								
										<div class="row">
												<div class ="col-12">
										
										<hr>
										</div>
											<div class="col-md-6 ">
												<p class="h3">Form:</p>
												<address>
													Cona Industries<br/>
													Maharastra, Mumbai<br/>
													Region, Postal Code<br/>
													yourdomain@example.com
												</address>
											</div>
											<div class="col-md-6 text-right">
												<p class="h3">Order To:</p>
												<address>
													<?php echo $ord->customer; ?><br>
													<?php echo $ord->address; ?><br>
													<?php echo $ord->state.", ".$ord->city; ?><br>
													<br>
													<?php echo $ord->email; ?>
													<br>
													<?php echo $ord->phone; ?>													
													</address>
											</div>
										</div>
										<div class="table-responsive push">
											<table class="table table-bordered table-hover mb-0">
												<tbody>
								
												<tr class=" ">
													<th class="text-center " style="width: 1%"></th>
													<th colspan = "2">Item</th>
													<th class="text-center" style="width: 1%">Quantity</th>
													<th class="text-center" style="width: 1%">Confirm Order</th>
													<th class="text-center" style="width: 1%">Pending Order</th>
													<th class="text-right">Unit Price</th>
													<th class="text-right">Others</th>
													<th class="text-right">GST</th>
													<th class="text-right">Discount</th>
													<th class="text-right">Sub Total</th>
												</tr>
											<?php $total =  0; 
												$mord = $ord;	
												if(!empty($orders)) { 
													foreach($orders as $ind => $ord){ ?>
														
													<tr>
														<td class="text-center"><?php echo $ind + 1; ?></td>
														<td><?php $image = (!empty($ord->main_img)) ? base_url($ord->main_img)  : base_url("assets/images/profile/33.png");  ?>
															<p class="font-w600 mb-1"><img class="avatar avatar-md brround" src="<?php  echo $image; ?>"> </p>
															<div class="text-muted"><div class="text-muted"> </div></div>
														</td>
														<td><?php echo $ord->pro_name; ?></td>
														<td class="text-center"><?php echo $qty = $ord->quantity; ?></td>
														
														<td class="text-center" style="width: 1%">
														<?php
															$pending = $ord->quantity;
															$isanyconf = false;
															if(!empty($delivery[$ord->product])){
																
																$delvarr = $delivery[$ord->product];
																$totconfrm = 0;
																$isanyconf = true;
																?>
														
																
																<?php
																
																$cnt = ""; 
																foreach($delvarr as $ind => $dlv){
																	
																	$totconfrm = $totconfrm + $dlv->delv_qty;
																	$cnt .= "<li><a href = '#'>".$dlv->delivery_date." : <span class = 'badge badge-warning'>".$dlv->delv_qty."</span></a></li>";
																}
															
															$pending = $ord->quantity - $totconfrm;
															?>
																		<div class="btn-group">
																		<a href = "#" class="dropdown-toggle" data-toggle="dropdown">
																			<?php echo $totconfrm ?>
																		</a>
																		<ul class="dropdown-menu" role="menu">
																			<?php echo $cnt; ?>
																		</ul>
																	</div>
															
															
															<?php
															
															
															
															
															}else{
																?>-<?php
															}				
														?>
								
														
														</td>
														<td class="text-center" style="width: 1%"><?php echo $pending; ?></td>
														<td class="text-right"><i class ="fa fa-rupee"></i> <i ><?php echo $price = $ord->price; ?></td>
														<td class="text-right"><?php echo $oprice = $ord->other_price; ?></td>
														<td class="text-right"><?php echo  (!empty($ord->gst)) ? $ord->gst."%" : ""; ?></td>
														<td class="text-right"><?php echo $ord->offer; ?></td>
														<td class="text-right"><i class ="fa fa-rupee"></i><?php echo $ptotal = ($qty * $price) + $ord->other_price - $ord->offer; ?></td>
														
													</tr>		
														
											<?php	 $total = $total  + $ptotal;
											
													}
												} ?>
								
												<tr>
													<td colspan="10" class="font-weight-bold text-uppercase text-right">Total</td>
													<td class="font-weight-bold text-right h4"> <i class ="fa fa-rupee"></i>  <?php echo $total; ?></td>
												</tr>
											</tbody></table>
											
										</div>
										<div>
									<?php if(!empty($payment)) { 
											$data["payments"] = $payment;
											$data["totprice"] = $mord->total_price;
											$data["hideact"]      = true;
											$data["orderno"]   = $ord->ord_no;
											$this->load->view("payment/pages/payment-list",$data);
									} ?>

										</div>
									</div>
									<div class="card-footer text-right">
							
									</div>
								</div>
							</div>
						</div>	