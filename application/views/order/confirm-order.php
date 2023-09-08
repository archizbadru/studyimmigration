	
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("order") ?>"> <i class="fa fa-list"></i> Order List </a>
                </div>
            </div> 
            <div class="panel-body">
            		<div class="row">
            			<div class="col-md-4 col-sm-12 col-xs-12">            				
		            		<?php if(!empty($order_meta)){ ?>						
							<fieldset>
		  						<legend style="width: unset;font-size: 12px;">Billing Details:</legend>
								<label>Name : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['fname'])?$order_meta['BILLING_DETAILS']['fname']:''?>
								<br><label>Email : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['email'])?$order_meta['BILLING_DETAILS']['email']:''?>
								<br><label>Mobile No. : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['phone'])?$order_meta['BILLING_DETAILS']['phone']:''?>
								<br><label>Address : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['address'])?$order_meta['BILLING_DETAILS']['address']:''?>
								<br><label>State : </label>&nbsp;
								<?php
								if(!empty($order_meta['BILLING_DETAILS']['state'])){
									$sid	=	$order_meta['BILLING_DETAILS']['state'];
									$state_row	=	$this->location_model->get_state_name_by_id($sid);
									if (!empty($state_row['state'])) {
										echo $state_row['state'];
									}else{
										echo "NA";
									}
								}else{
									echo "NA";
								}
								?>								
								<br><label>City : </label>&nbsp;
								<?php
								if(!empty($order_meta['BILLING_DETAILS']['city'])){
									$cid	=	$order_meta['BILLING_DETAILS']['city'];
									$city_row	=	$this->location_model->get_city_name_by_id($cid);
									if (!empty($city_row['city'])) {
										echo $city_row['city'];
									}else{
										echo "NA";
									}
								}else{
									echo "NA";
								}
								?>
								<br><label>Pincode : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['pincode'])?$order_meta['BILLING_DETAILS']['pincode']:''?>
								<br><label>GSTIN : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['gstin'])?$order_meta['BILLING_DETAILS']['gstin']:''?>
							</fieldset>
					<?php } ?> 

            			</div>
            			<div class="col-md-4 col-sm-12 col-xs-12 pull-right" >            				
		            		<?php if(!empty($order_meta)){ ?>
							<fieldset>
		  						<legend style="width: unset;font-size: 12px;">Shipping Details:</legend>
								<label>Name : </label>&nbsp; <?=!empty($order_meta['SHIPPING_DETAILS']['fname'])?$order_meta['SHIPPING_DETAILS']['fname']:''?>
								<br><label>Email : </label> &nbsp;<?=!empty($order_meta['SHIPPING_DETAILS']['email'])?$order_meta['SHIPPING_DETAILS']['email']:''?>
								<br><label>Mobile No. : </label>&nbsp;<?=!empty($order_meta['SHIPPING_DETAILS']['phone'])?$order_meta['SHIPPING_DETAILS']['phone']:''?>
								<br><label>Address : </label>&nbsp;<?=!empty($order_meta['SHIPPING_DETAILS']['address'])?$order_meta['SHIPPING_DETAILS']['address']:''?>
								<br><label>State : </label>&nbsp;
								<?php
								if(!empty($order_meta['SHIPPING_DETAILS']['state'])){
									$sid	=	$order_meta['SHIPPING_DETAILS']['state'];
									$state_row	=	$this->location_model->get_state_name_by_id($sid);
									if (!empty($state_row['state'])) {
										echo $state_row['state'];
									}else{
										echo "NA";
									}
								}else{
									echo "NA";
								}
								?>								
								<br><label>City : </label>&nbsp;
								<?php
								if(!empty($order_meta['SHIPPING_DETAILS']['city'])){
									$cid	=	$order_meta['SHIPPING_DETAILS']['city'];
									$city_row	=	$this->location_model->get_city_name_by_id($cid);
									if (!empty($city_row['city'])) {
										echo $city_row['city'];
									}else{
										echo "NA";
									}
								}else{
									echo "NA";
								}
								?>
								<br><label>Pincode : </label>&nbsp;<?=!empty($order_meta['SHIPPING_DETAILS']['pincode'])?$order_meta['SHIPPING_DETAILS']['pincode']:''?>
							</fieldset>
					<?php } ?> 
            			</div>
            		</div>

					<br>
					<div class="row">
						<div class = "col-md-12">
							<div class="card">
								<?php 	
									 $scmarr = array(); 
								?>
								<div class="">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Srno</th>
												<th>Product</th>
												<th>Stock</th>
												<th>Unit Price</th>
												<th>GST</th>
												<th>Scheme</th>
												<th>Discount</th>
												<th>Quantity</th>
												<th>Total Price</th>
												<th>Delivery By</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										<?php	$totprice = 0;
											if(!empty($orders)) { 
												foreach($orders as $ind => $ord){ 
													$totprice = $totprice + $ord->total_price;
													?>
													<tr>
														<th scope="row"><?php echo $ind+1; ?></th>
														<td><?php echo $ord->product_name; ?></td>
														<td><?php echo $ord->stock_qty; ?></td>
														<td><i class ="fa fa-rupee"></i> <?php echo $ord->unit_price; ?></td>
														<td><?php echo (!empty($ord->tax)) ? $ord->tax."%" : "0%"; ?></td>
														<!-- <td><i class = "fa fa-rupee"></i> <?php echo $totprice = ($ord->price - $ord->offer) + floor($ord->tax/100); ?>
														</td> -->
														<td>
															<?php
															$totper = 0;
															if(!empty($scmarr["product"][$ord->product])){			
																foreach($scmarr["product"][$ord->product] as $ind => $scm) {
																	if( $ord->quantity >= $scm->from_qty  and $ord->quantity <= $scm->to_qty) {
																		?><span class = "badge badge-info">Product : <?php echo $scm->discount; ?> % </span><br/><?php
																	$totper = $scm->discount;
																		break;
																	}
																}
															}
														 ?>
														<?php echo $totper."%"; ?>
													</td>
													<td><i class = "fa fa-rupee"></i><?php echo $totdisc =  $ord->price*$totper/100;  ?></td>
													<td> <?php echo $ord->quantity; ?></td>
													<td>
													<i class = "fa fa-rupee"></i> 
													<?php 
														$total = $totprice*$ord->quantity; 
														/*if (!empty($ord->tax)) {
															$total += $total*($ord->tax/100); 
														}*/
														echo $total;
													?>
													</td>
													<td>
														<select class="form-control" name="deliverby" onchange='update_delivery_by("<?=$ord->ord_no?>","<?=$ord->product?>",this)'>
															<option value="Seller" <?=(!empty($ord->deliver_by) && $ord->deliver_by=='Seller')?'selected':""?>>Seller</option>
															<option value="Lalantop" <?=(!empty($ord->deliver_by) && $ord->deliver_by=='Lalantop')?'selected':""?>>Lalantop</option>
														</select>
													</td>
													<td>
														<select class="form-control" name="deliverstatus" onchange='update_delivery_status("<?=$ord->ord_no?>","<?=$ord->product?>",this)'>
															<option value="1" <?=($ord->status==1)?'selected':''?> >Request</option>
															<option value="2" <?=($ord->status==2)?'selected':''?>>Waiting</option>
															<option value="3" <?=($ord->status==3)?'selected':''?>>Dispatch</option>
															<option value="4" <?=($ord->status==4)?'selected':''?>>Delivery Confirm</option>
															<option value="5" <?=($ord->status==5)?'selected':''?>>Reject</option>
														</select>
													</td>
												</tr>
													
										<?php	}
											}
										?>																
										</tbody>
									</table>
								</div> 
																	
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>	


	<!-- <div id="update_product_odr" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		   <form action="<?php echo base_url(); ?>order/update_ordered_product" method="post" >
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Update Status</h4>
			      </div>
			      <div class="modal-body">
			      	<div class="row">

			      		<div class="col-md-2">
			      		</div>

			      		<div class="col-md-4">
							<div class="form-group">
								<label>Delivery By</label>
								<select class="form-control" name="deliverby">
									<option value="Seller">Seller</option>
									<option value="Lalantop">Lalantop</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Order Status</label>
								<select class="form-control" name="deliverstatus">
									<option value="1">Request</option>
									<option value="2">Waiting</option>
									<option value="3">Dispatch</option>
									<option value="4">Delivery Confirm</option>
									<option value="5">Reject</option>
								</select>
							</div>
						</div>
			      	</div>
			      	<br>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-success btn-sm">Update</button>							
					</div>
			      </div>
			  </div>
			</form>
		</div>
	</div> -->
        
       
<script type="text/javascript">
	function update_delivery_status(order_id,product_id,curr){
		$.ajax({
		    type: 'GET',
		    url: "<?=base_url().'order/check_stock/'?>"+order_id+'/'+product_id,
		    success:function(data){
		    	if (data=='1') {
					var url = "<?=base_url().'order/updateorder_product_status'?>";
					status = curr.value;
					$.ajax({
					    type: 'POST',
					    url: url,
					    data: {
					    	order_id:order_id,
					    	product_id:product_id,
					    	status:status
					    },
					    success:function(data){
					      Swal.fire(
				            'success',
				            'Updated Successfully',
				            'success'
				            );
					      location.reload();
					    }
					});			
		    	}else{
		    		Swal.fire(
			            'Error',
			            'Out of stock item',
			            'error'
			            );
		    	}		      
		    }
		});			

	}

	function update_delivery_by(order_id,product_id,curr){
		var url = "<?=base_url().'order/updateorder_product_deliveredBy'?>";
		deliver_by = curr.value;
		$.ajax({
		    type: 'POST',
		    url: url,
		    data: {
		    	order_id:order_id,
		    	product_id:product_id,
		    	deliver_by:deliver_by
		    },
		    success:function(data){
		      Swal.fire(
	            'success',
	            'Delivery By Updated Successfully',
	            'success'
	            );
		    }
		});			
	}
</script>