<div class="row">
<!--  form area -->
<div class="col-sm-12">
    <div  class="panel panel-default thumbnail"> 
        <div class="panel-heading no-print">
            <div class="btn-group"> 
                <a class="btn btn-primary" href="<?php echo base_url("product") ?>"> <i class="fa fa-list"></i> All Products </a>  
            </div>
        </div>
        <div class="panel-body panel-form">
            <div class="row">
				 <div class="col-md-1 col-sm-12">
				</div>
                <div class="col-md-9 col-sm-12">
		<?php   $isedit = false;	
		$mainimage_required = 'required';
				if(!empty($product)) {
					$isedit = true;
					$mainimage_required = '';
				}	?>
		<?php  echo form_open_multipart(); ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Product Name <i class="text-danger">*</i></label>
								<input type="text" class="form-control" id="proname" name="proname" value="<?php echo ($isedit == true) ? $product->country_name : set_value("proname"); ?>" required>
							</div>							
						</div>

						<div class="col-md-6">
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-8">
								<div class="form-group">
									<label>Main Image<i class="text-danger">*</i></label>
								<input type="file" name="mainimage" class="dropify" data-default-file="" accept="image/*" <?=$mainimage_required?>>
									<small style="font-size: 10px;">Max Upload size is 1MB only with max width of 1024 and max height of 768</small>
									<?php if($isedit == true ) { ?>
									<img src = "<?php echo base_url("assets/images/products/".$product->image); ?>" class = "img-responsive" style="height:250px;max-width:250px;">		
									<?php } ?>
								</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label>Sub Images</label>
								<input type="file" class="form-control" id="sub-images" name="sub_images[]" multiple accept="image/*">
								<small style="font-size: 10px;">Max Upload size is 1MB only with max width of 1024 and max height of 768</small>
							</div>	

						</div>
						<div>							
						<?php if($isedit == true ) { 
							if(!empty($product->sub_image)){
								$sub_images	=	json_decode($product->sub_image);
								foreach ($sub_images as $key => $value) { ?>
									<div class="col-md-3 col-sm-4 col-xs-6">
										<img src = "<?php echo base_url("assets/images/products/".$value); ?>" class = "img-responsive" style="height:200px;max-width:200px;">												
									</div>											
								<?php
								}
							?>
							<?php 
							}
						} 
						?>
						</div>
					</div>
					<div class="row">
						<div class = "col-md-4">
							<div class="form-group">
								<label>HSN Code</label>
								<input type="text" class="form-control" id="hsn-code" placeholder="Enter HSN" name="hsn_code" value="<?php echo ($isedit == true) ? $product->hsn : set_value("hsn_code"); ?>">
							</div>
						</div>
						<div class = "col-md-4">
							<div class = "form-group">
								<label>Brand<i class="text-danger">*</i></label>
								<input type="text" name="brand" class="form-control" value="<?php echo ($isedit == true) ? $product->brand : set_value("brand"); ?>" required>
								<!--select class = "form-control" name = "brand">
									<option value="">Select Brand</option>
								<?php if(!empty($brand_list)) {
										if($isedit == true) {
											$brand = ($isedit == true) ? $product->brand:set_value("brand"); 
										}else{
											$brand =  "";
										}
										foreach($brand_list as $ind => $brand_row) { 										
										?>
										<option value = "<?php echo $brand_row->id ?>" <?php echo ($brand == $brand_row->id) ? "selected" : ""; ?>><?php echo $brand_row->name; ?></option><?php		
										}	
									} ?>
								
								</select-->
							</div>
						</div>
						<div class = "col-md-4">
							<div class = "form-group">
								<label>Seller</label>
								<select class = "form-control" name = "seller" onchange="checkProductDuplicacy(this.value)">
									<option value="">Select Seller</option>
								<?php if(!empty($seller_list)) {
										if($isedit == true) {
											$seller = ($isedit == true) ? $product->seller_id:set_value("seller"); 
										}else{
											$seller =  "";
										}
										foreach($seller_list as $ind => $seller_row) { 										
										?>
										<option value = "<?php echo $seller_row->pk_i_admin_id ?>" <?php echo ($seller == $seller_row->pk_i_admin_id) ? "selected" : ""; ?>><?php echo $seller_row->s_display_name.' '.$seller_row->last_name.' - '.$seller_row->s_user_email; ?></option><?php		
										}	
									} ?>
								
								</select>
							</div>
						</div>
						<!-- <div class = "col-md-6">
							<label>SKU ID</label>
							<input type="text" name='skuid' class="form-control" readonly>
						</div> -->
					</div>
					<div class="row">
						<div class = "col-md-12">
							<div class = "form-group">
								<label>Details</label>
								<textarea class = "form-control" name = "details"><?php echo ($isedit == true) ? $product->details : set_value("details"); ?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Category</label>
						<?php if($isedit == true) {
								$pcateg = $product->category;
								}else{
								$pcateg = 	 set_value("cat"); 
								}			
									?>
								<select class="form-control load-subcateg" id="cat" name="cat">
									<option value="">Select</option>
								<?php if(!empty($category)) { 
										foreach($category as $ind => $categ) {
									?>
											<option value = "<?php echo $categ->id; ?>" <?php echo ($pcateg == $categ->id) ? "selected" : ""; ?>><?php echo $categ->name; ?></option>
									<?php }
									}
									?>
								</select>
							</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>SubCategory</label>
											<?php if($isedit == true) {
								$categ = $product->subcatogory;
								}else{
								$categ = 	 set_value("scat"); 
								}			
									?>
									<select class="form-control" id="scat" name="scat">
										<option value="">Select</option>
								 <?php if(!empty($subcategory)) { 
											foreach($subcategory as $ind => $sbcateg) {
												?><option value = "<?php echo $sbcateg->id; ?>" <?php echo ($categ == $sbcateg->id) ? "selected" : ""; ?>><?php echo $sbcateg->subcat_name; ?></option>

												<?php
											}	
										}
										?>
									</select>
								</div>
							</div>
						
							<!-- <div class="col-md-4">
								<div class="form-group">
									<label>Size</label>
									<input type="text" class="form-control" id="height" name="size" value="<?php echo ($isedit == true) ? $product->size : set_value("size"); ?>">
								</div>
							</div> -->
							<!-- <div class="col-md-4">
								<div class="form-group">
									<label>Weight</label>
									<input type="text" class="form-control" id="width" name="weight" value="<?php echo ($isedit == true) ? $product->weight : set_value("weight"); ?>">
								</div>
							</div> -->
							
							<div class="col-md-4">
								<div class="form-group">
									<label>Measurement unit</label>
									<select name="measurement_unit" class="form-control">
										<option value="">--- Selete Unit ---</option>
										<?php 
										if($isedit == true) {
											$measurement_unit = $product->measurement_unit;
										}else{
											$measurement_unit  = 	 set_value("measurement_unit"); 
										}			
									
										if (!empty($units)) {
											foreach ($units as $unit) { ?>
												<option value="<?=$unit->id?>" <?php echo ($measurement_unit == $unit->id) ? "selected" : ""; ?> ><?=$unit->title?></option>
											<?php	
											}
										}
										?>
									</select>
								</div>
							</div>
							
							<div class="col-md-4">
									<div class="form-group">
										<label>Price<i class="text-danger">*</i></label>
										<input type="text" class="form-control" id="price" placeholder="Enter price" name="price" value="<?php echo ($isedit == true) ? $product->price : set_value("price"); ?>" required>
										<small id="note_playwood_cat" style="font-size: 10px;">You need to update pricing per piece/board</small>
									</div>
							</div>
							<div class="col-md-4">
									<div class="form-group">
										<label>MRP<i class="text-danger">*</i></label>
										<input type="text" class="form-control" id="price" placeholder="Enter price" name="othrprice" value="<?php echo ($isedit == true) ? $product->othr_price : set_value("othr_price"); ?>" required>
									</div>
							</div>
							<div class="col-md-4">
									<div class="form-group">
										<label>GST</label>
										<input type="text" class="form-control" id="tax" placeholder="Enter tax" name="tax" value="<?php echo ($isedit == true) ? $product->tax : set_value("tax"); ?>">
									</div>
									
									
							</div>
							<div class="col-md-4" id="color">
									<div class="form-group">
										<label>Color</label>
										<?php										
										if($isedit == true) {
											$color= $product->color;
										}else{
											$color = set_value("color"); 
										}
										?>
										<select class="form-control" id="color" name="color">
											<option value="">Select</option>
											<option value="White" <?php echo ($color == 'White') ? "selected" : ""; ?>>White</option>
											<option value="Yellow" <?php echo ($color == 'Yellow') ? "selected" : ""; ?>>Yellow</option>
											<option value="Blue" <?php echo ($color == 'Blue') ? "selected" : ""; ?>>Blue</option>
											<option value="Red" <?php echo ($color == 'Red') ? "selected" : ""; ?>>Red</option>
											<option value="Green" <?php echo ($color == 'Green') ? "selected" : ""; ?>>Green</option>
											<option value="Black" <?php echo ($color == 'Black') ? "selected" : ""; ?>>Black</option>
											<option value="Brown" <?php echo ($color == 'Brown') ? "selected" : ""; ?>>Brown</option>
											<option value="Azure" <?php echo ($color == 'Azure') ? "selected" : ""; ?>>Azure</option>
											<option value="Ivory" <?php echo ($color == 'Ivory') ? "selected" : ""; ?>>Ivory</option>
											<option value="Teal" <?php echo ($color == 'Teal') ? "selected" : ""; ?>>Teal</option>
											<option value="Silver" <?php echo ($color == 'Silver') ? "selected" : ""; ?>>Silver</option>
											<option value="Purple" <?php echo ($color == 'Purple') ? "selected" : ""; ?>>Purple</option>
											<option value="Navy blue" <?php echo ($color == 'Navy blue') ? "selected" : ""; ?>>Navy blue</option>
											<option value="Pea green" <?php echo ($color == 'Pea green') ? "selected" : ""; ?>>Pea green</option>
											<option value="Gray" <?php echo ($color == 'Gray') ? "selected" : ""; ?>>Gray</option>
											<option value="Orange" <?php echo ($color == 'Orange') ? "selected" : ""; ?>>Orange</option>
											<option value="Maroon" <?php echo ($color == 'Maroon') ? "selected" : ""; ?>>Maroon</option>
											<option value="Charcoal" <?php echo ($color == 'Charcoal') ? "selected" : ""; ?>>Charcoal</option>
											<option value="Aquamarine" <?php echo ($color == 'Aquamarine') ? "selected" : ""; ?>>Aquamarine</option>
											<option value="Coral" <?php echo ($color == 'Coral') ? "selected" : ""; ?>>Coral</option>
											<option value="Fuchsia" <?php echo ($color == 'Fuchsia') ? "selected" : ""; ?>>Fuchsia</option>
											<option value="Wheat" <?php echo ($color == 'Fuchsia') ? "selected" : ""; ?>>Wheat</option>
											<option value="Lime" <?php echo ($color == 'Lime') ? "selected" : ""; ?>>Lime</option>
											<option value="Crimson" <?php echo ($color == 'Crimson') ? "selected" : ""; ?>>Crimson</option>
											<option value="Khaki" <?php echo ($color == 'Khaki') ? "selected" : ""; ?>>Khaki</option>
											<option value="Hot pink" <?php echo ($color == 'Hot pink') ? "selected" : ""; ?>>Hot pink</option>
											<option value="Magenta" <?php echo ($color == 'Magenta') ? "selected" : ""; ?>>Magenta</option>
											<option value="Olden" <?php echo ($color == 'Olden') ? "selected" : ""; ?>>Olden</option>
											<option value="Plum" <?php echo ($color == 'Plum') ? "selected" : ""; ?>>Plum</option>
											<option value="Olive" <?php echo ($color == 'Olive') ? "selected" : ""; ?>>Olive</option>
											<option value="Cyan" <?php echo ($color == 'Cyan') ? "selected" : ""; ?>>Cyan</option>
										</select>
									</div>
							</div>
							<div class = "col-md-4">
								<div class = "form-group">
									<label>Scheme</label>
									<select class = "form-control" name = "scheme">
									<?php 
									if($isedit == true) {
										$schm = set_value("scheme"); 
									}else{
										$schm = $product->scheme;
									}
									if(!empty($scheme)) {
											foreach($scheme as $ind => $scm) {
											/*$qtytxt = "";
											if($scm->qty > 0){
												$qtytxt = "QTY ";	
											}*/
											?><option value = "<?php echo $scm->id ?>" <?php echo ($schm == $scm->id) ? "selected" : ""; ?>><?php echo "QTY ".$scm->coupan." - ".$scm->discount; ?></option><?php		
											}	
										} ?>
									
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Minimum Order Quantity<i class="text-danger">*</i></label>
									<input type="number" class="form-control" min="1" max="500" id="minimum_order_quantity" placeholder="Enter Minimum Order Quantity" name="minimum_order_quantity" value="<?php echo ($isedit == true) ? $product->minimum_order_quantity : set_value("minimum_order_quantity"); ?>" required>
								</div>
							</div>
							<div class="row" id="product_fields">							
							</div>
				
							<!--div class = "col-md-6">
								<div class = "form-group">
									<label>Process Id</label>
									<select class = "form-control" name = "process">
									<?php if(!empty($process)) {
												if($isedit == true) {
												$prcs = set_value("process"); 
											}else{
												//$prcs = $product->process;
												$prcs =  "";
											}
											foreach($process as $ind => $prc) { 
											
										
											?><option value = "<?php echo $prc->sb_id ?>" <?php echo ($prcs == $prc->sb_id) ? "selected" : ""; ?>><?php echo $prc->product_name; ?></option><?php		
											}	
										} ?>
									
									</select>
								</div>
							</div-->


						 	<div class="col-md-6">
								<label>Status</label>

								<input type="radio" name="status" value="1" checked="" <?=($isedit==1)?(($product->status==1)?'checked':''):'' ?>>
								<span>Active</span>

								
								<input type="radio" name="status" value="2" <?=($isedit==1)?(($product->status==0)?'checked':''):'' ?>>
								<span>Inactive</span>
								
							</div> 
							<div class = "col-md-12 text-center">
								<?php if($isedit == true) { ?>
								<input type = "hidden" name = "productid" value = "<?php echo $product->sb_id; ?>">
								<input type = "hidden" name = "detailsid" value = "<?php echo $product->id; ?>">
								<?php } ?>
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
	if($("#cat").val() == 34){
		$("#note_playwood_cat").show();
	}else{
		$("#note_playwood_cat").hide();		
	}
	if($("#cat").val() == 19){
		$("#color").hide();
	}else{
		$("#color").show();
	}
	$("#cat").on('change',function(){
		var cat	=	$(this).val();
		if (cat == 34) {
			$("#note_playwood_cat").show();
		}else{
			$("#note_playwood_cat").hide();			
		}
	});

	$(document).on("change", ".load-subcateg", function(){
		if ($(this).val() == 19) {
			$("#color").hide();
		}else{
			$("#color").show();
		}
		$("#scat").load("<?php echo base_url('buy/loadsubcateg/') ?>"+$(this).val());		
		get_product_field($(this).val());
	});
	if ("<?=$isedit?>" == "1") {
		get_product_field($("#cat").val());	
	}
	
	function get_product_field(cat){
		var pid = "<?=!empty($isedit)?$pid:''?>";
		$("#product_fields").load("<?php echo base_url('form/form/get_product_field_content/') ?>"+cat+'/'+pid);
	}

	
	function checkProductDuplicacy(seller)
	{
		var prod = $('#proname').val();
		if(seller !='' && prod !='')
		{
			$.ajax({
				url : '<?=base_url('product/checkProductDuplicacy')?>',
				type : "post",
				data : {'seller':seller,'prod':prod},
				dataType : "json",
				success : function(data)
				{
					if(data.status=='exist')
					{
						alert('same product already exist for the selected seller');
						$('#proname').val('');
						$(this).val('');
					}
				}

			});
		}
		else
		{
			alert("Please fill product name and then select a seller");
		}
		
	}

</script>
