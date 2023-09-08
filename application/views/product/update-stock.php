	  <div class="row">
		<div class="col-md-12" style="background-color: #fff;border-bottom: 1px solid #C8CED3;">
		  <div class="col-md-6"> 
			<p style="margin-top: 6px;">
			Update Stock      </p>
			<!-- Enquiry / Update Enquiry -->
		  </div>
		  <div class="col-md-6">
			 <div style="float:right">
				  <div class="btn-group" role="group" aria-label="Button group">
				   <a class="btn" onclick="window.location.reload();" title="Refresh">
				   <i class="fa fa-refresh icon_color"></i>
				   </a>  
				</div>
				<!-- For invenotry company -->
				<div class="btn-group" role="group" aria-label="Button group">
				   <a class="btn" href="<?php echo base_url("product/stock"); ?>" title="Back">
				   <i class="fa fa-arrow-left icon_color"></i>
				   </a>                                                    
				</div>
			 </div>
		  </div>
	   </div>
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("product/addstock") ?>"> <i class="fa fa-list"></i> Update Stock </a>  
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
						<?php  echo form_open_multipart(); ?>
				<div class = "row">
					<div class="form-group col-md-6">
						<label>Ware house : <b class = "mand"></b></label>
						<select class="form-control load-select" name="warehouse" data-target="#product-select">
				   <?php if(!empty($warehouse)) {
							?><option value = ""></option><?php
							foreach($warehouse as $ind => $wr){
								
						  ?><option value = "<?php echo $wr->id ?>" <?php echo ($wr->id == $stock->warehouse) ? "selected" : ""; ?>><?php echo $wr->name; ?></option><?php      
								
							}
						  } ?>
						</select>    
					</div>		
					<div class="form-group col-md-6">
						<label>Product : <b class = "mand"></b></label>
						<select class="form-control load-ajx-product" name="product" id ="product-select">
				   <?php if(!empty($products)) {
							foreach($products as $ind => $prd){
								
						  ?><option value = "<?php echo $prd->sb_id ?>" <?php echo ($stock->product  == $prd->sb_id) ? "selected" : "" ?>><?php echo $prd->product_name; ?></option><?php      
								
							}
						  } ?>
						</select>    
					</div>
				</div>
				<div class = "row">
					<div class = "col-md-1"></div>
					<div class = "col-10">
						<div class = "row">
							<div class = "col-md-12">
								<h4>Purchase Details </h4>
							</div>         
						</div> 
					   
						<div class = "row">
						<div class="form-group col-md-12">
							<label>Details : <b class = "mand"></b></label>
							<textarea class="form-control" name = "details"><?php echo  $stock->details; ?></textarea>
						</div>
				<!--	<div class="form-group col-md-6 prod-details">
							<label>Old Stock : <b class = "mand"></b></label>
							<input type = "text" name = "prod_stock" id ="prod-stock" class="form-control" readonly>
						</div> -->
						<div class = "row">
						<div class="form-group col-md-6">
							<label>Date : <b class = "mand"></b></label>
							
							<div class="input-group">
								<div class="input-group-addon">
									<div class="input-group-text">
										<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
									</div>
								</div><input class="form-control fc-datepicker datepicker" name="stockdate"  placeholder="MM/DD/YYYY" value="<?php echo  date("m/d/Y", strtotime($stock->stock_date)); ?>" type="date" style = "width:100%;">
							</div>
						</div>
						<div class="form-group col-md-6">
							<label>Supplier : <b class = "mand"></b></label>
							<input type="text" class="form-control" name="supplier" placeholder="Supplier "  value="<?php echo $stock->supplier; ?>" required> 
						</div>
						</div>
						<div class="form-group col-md-6">
							<label>Quantity :</label>
							<input type="number" class="form-control" name="quantity" placeholder="Enter Quantity"  value="<?php echo  $stock->quantity; ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label>Price :</label>
							<input type="number" class="form-control" name="price" placeholder="Enter Price" value="<?php echo  $stock->price; ?>"  required>
						</div>
				
						<div class = "form-group text-center">
							<br />
							<input type = "hidden" name ="stockno" value = "<?php echo $stock->id; ?>">	
					
							<button type = "submit" class = "btn btn-info btn-pill"> Save </button>
						</div>    
						</div>
					</div>
					<div class = "col-md-1"></div>
					
					</div>
				</div>
				<?php echo form_close(); ?>
					
					</div>
					<div class = "col-md-3">
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	