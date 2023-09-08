				<div class = "card">
											<div class = "card-header">
													<div class = "col-md-12">
												Payments <small class ="font-weight-bold">Total :<?php echo $totprice; ?></small> 
											</div>	
											</div>
											<div class="card-body">

										<div class = "row">
										
											<div class = "col-md-12">
										<?php if(!empty($payments)){ 
										
												
										?>
												
												<table class="table table-bordered text-center table-hover mb-0">
														<thead>
															<tr>
																<th>Prev Balance</th>
																<th>Advance</th>
																<th>Payment</th>
																<th>Balance</th>
																<th>Payment Mode</th>
																<th>Transaction No</th>
																<th>Payment Date</th>
																<th>Next Payment</th>
																<th>status</th>
																<th>Remark</th>
																<?php if(empty($hideact)) { ?>
																<th>Action</th>
																<?php } ?>
															</tr>
														</thead>
														<tbody>
												
												
										<?php	$prev_balance = 0;
												$totalval = $totprice;
										
												foreach($payments as $ind => $pay){ 
										 			if($pay->ord_id == $ord->id) {
														$totalval = $pay->balance;
										
														$remain_balance = $pay->balance;
														 $totalval = $pay->balance;
										?>
														<tr>
															<td><?php echo (!empty($pay->prev_balance)) ? "<i class = 'fa fa-rupee'></i> ".$pay->prev_balance : " - "; ?></td>
															<td><?php echo (!empty($pay->advance_pay)) ? "<i class = 'fa fa-rupee'></i> ".$pay->advance_pay : " - "; ?></td>
															<td><i class = 'fa fa-rupee'></i> <?php echo  $pay->pay; ?></td>
															<td><?php echo (!empty($pay->balance)) ? "<i class = 'fa fa-rupee'></i> ".$pay->	balance : " - "; ?></td>
															<td><?php 
																	if($pay->	pay_mode == 1){
																		echo "Online";	
																	}else if($pay->	pay_mode == 2){
																		echo "Cash"	;
																	}else if($pay->	pay_mode == 3){
																		echo "DD/Check"	;
																	}else if($pay->	pay_mode == 4){
																		echo "Account Transfer";	
																	} ?></td>
															<td><?php echo $pay->transaction_no ; ?></td>
															<td><?php echo date("d, m Y", strtotime($pay->pay_date)); ?></td>
															<td><?php echo date("d, m Y", strtotime($pay->	next_pay)); ?></td>
															<td><?php if($pay->status == 1){
																			echo "Complete";
																	}else if($pay->status == 2){
																		echo "waiting";
																	} ?></td>
															<td><?php echo substr($pay->remark, 0, 40); ?></td>
																<?php if(empty($hideact)) { ?>
															<td>
															<a href="<?php echo base64_encode(base64_encode($pay->id));  ?>" class="btn btn-danger delete-content"><i class="fe fe-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>
															</td>
																<?php } ?>
														</tr>
												<?php } ?>		
										<?php	 }	?>
													</tbody>
											   </table>	
										<?php	} ?>
								
											</div>
											
										</div>
											
											</div>
										</div>	
										
									<?php if( ($totalval > 0 or $pendingodr > 0)) { ?>		
										<div class = "card">
										
											<div class="card-body">
												<div class = "col-md-12 text-center">
												
													<h4><?php if($totalval > 0) { ?>	Balance :  <i class = "fa fa-rupee"></i> <?php echo $totalval; ?> <a class = "btn btn-info btn-pill" href = "<?php echo base_url("payment/add/".$orderno); ?>"> Add Payment </a>
												<?php } ?>
														<?php if($this->session->mrole == 1 and  $pendingodr > 0) { ?>				
														 <a class = "btn btn-warning btn-pill" href = "<?php echo base_url("order/booking/".$ord->ord_no); ?>"> Confirm Order </a> 
														<?php } ?>
													</h4>
												</div>
													</div>
									</div>		
									<?php } ?>
											
											
										
										