	  
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("/order") ?>"> <i class="fa fa-list"></i> All Order </a>  
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
					 <div class="col-md-1 col-sm-12">
					</div>
                    <div class="col-md-9 col-sm-12">
			<?php  echo form_open_multipart(); ?>
				
						<div class="row">
							<div class = "col-md-6">
								<div class="form-group">
									<label>Warehouse</label>
									<select class="form-control" name="warehouse" data-target="#product-select">
									<?php if(!empty($warehouse)) { 
												?><option value =""></option><?php
											
											foreach($warehouse as $ind => $whs) {
												
											?><option value = "<?php echo $whs->id; ?>"><?php echo $whs->name; ?></option><?php

													
											}
										 }	
										?>
										</select>
								</div>
							</div>		
										
								<div class = "col-md-6">
									<div class="form-group">
										<label>Product</label>
										<select class="form-control update-rate" id="proname" name="proname">
									<?php if(!empty($products)) { 
												?>
											<option value ="">Select</option><?php											
											foreach($products as $ind => $prd) {
												if(!empty($prd->total_price)) {
											?><option value = "<?php echo $prd->prodid; ?>" data-price = "<?php echo $prd->price; ?>" data-othrprice = "<?php echo $prd->othr_price;  ?>" data-tax = "<?php echo $prd->tax; ?>"><?php echo $prd->product_name; ?></option><?php

												}	
											}
										 }	
										?>
										</select>
									</div>
									<input type = "hidden" id = "sng-prd-rate" value = "">
									<input type = "hidden" id = "prd-othr-price" value = "">
									<input type = "hidden" id = "prd-tax-price" value = "">
									<input type = "hidden" id = "prd-discount" value = "">
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Quantity</label>
										<input type = "number" min="1" class = "form-control price-calc-qty" name = "quantity">
								
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Confirm Quantity</label>
										<input type = "text" class = "form-control tot-cnf-qty" name = "cnfquantity">
								
									</div>
								</div>
					
								<div class="col-md-6">
									<div class="form-group">
										<label>Delivery Date</label>
										<input type = "date" class = "form-control" name = "delvrdate">
								
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Pending Delivery </label>
										<input type = "date" class = "form-control" name = "penddelvr">
								
									</div>
								</div>
					
							</div>
							<div class="row">

								<div class="col-md-6">
										<div class="form-group">
											<label>Rate</label>
											<input type="text" class="form-control" id="rate" placeholder="Enter Product Rate" name="rate" value="">
					 					</div>
								</div>
								<div class="col-md-6">
										<div class="form-group">
											<label>Other Price</label>
											<input type="text" class="form-control" id="price" placeholder="Other price" name="othrprice" value="">
										</div>
								</div>
								<div class="col-md-6">
										<div class="form-group">
											<label>Tax</label>
											<input type="number" class="form-control" id="tax" placeholder="Enter Tax" name="tax" value="">
										</div>
								</div>
								<div class="col-md-6">
										<div class="form-group">
											<label>Discount</label>
											<input type="number" class="form-control discount-box" id="tax" placeholder="Enter Discount" name="discount" value="">
										</div>
								</div>
								<div class="col-md-6">
										<div class="form-group">
											<label>Price</label>
											<input type="number" class="form-control" id="tax" placeholder="Enter Price" name="totprice" value="">
										</div>
								</div>
								<div class="col-md-6 text-center">
									<label>Status</label>
									<label>
									<input type="radio" class="" name="status" value="1" checked="">
									Active
									</label>
									<label>
									<input type="radio" class="" name="status" value="0">
									<span>Inactive</span>
									</label>

								</div>
								<div class = "col-md-12">
									<div class = "form-group">
										<label>Details</label>
										<textarea class = "form-control" name = "details"></textarea>
									</div>
								</div>
								<div class = "col-md-12 text-center">
									<button type = "reset" class = "btn btn-info"> Reset </button>
									<button type = "submit" class = "btn btn-primary"> Save </button>

								</div>		
							</div>
					
				</div>
				<?php echo form_close(); ?>
					
					</div>
					
				</div>
			</div>
		</div>
	</div>
<script>
	$(document).on("keyup", ".tot-cnf-qty", function(){
		
		var price 		= parseInt($("#sng-prd-rate").val());
		var othrprice   = parseInt($("#prd-othr-price").val());
		var tax         = parseInt($("#prd-tax-price").val());
		var qty   = parseInt($("input[name=quantity]").val());
		
		var totprice = (price + othrprice + tax)  * qty;
		$("input[name=rate]").val(price);
		$("input[name=tax]").val(tax);
		$("input[name=othrprice]").val(othrprice);
		$("input[name=totprice]").val(totprice);
		
	});
	$(document).on("keyup", ".discount-box",function(){
		
		var discount     = parseInt($(this).val());
		var tprice = parseInt($("input[name=totprice]").val());
		
		$("input[name=totprice]").val(tprice - discount);
		
	});
	
	$(document).on("click", ".update-rate", function(){
		
		var curropt = $(this).find(':selected')
		$("#sng-prd-rate").val(curropt.attr('data-price'));
		$("input[name=tax]").val(tax);
		$("#prd-othr-price").val(curropt.attr('data-othrprice'));
		$("#prd-tax-price").val(curropt.attr('data-tax'));
	});
</script>
