
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("order") ?>"> <i class="fa fa-list"></i> Order List </a>  
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
								
						  ?><option value = "<?php echo $wr->id ?>"><?php echo $wr->name; ?></option><?php      
								
							}
						  } ?>
						</select>    
					</div>		
					<div class="form-group col-md-6">
						<label>Product : <b class = "mand"></b></label>
						<select class="form-control load-ajx-product" name="product" id ="product-select">
				   <?php if(!empty($products)) {
							foreach($products as $ind => $prd){
								
						  ?><option value = "<?php echo $prd->id ?>"><?php echo $prd->country_name; ?></option><?php      
								
							}
						  } ?>
						</select>    
					</div>
					<div class="form-group col-md-6">
						<label>Quantity : <b class = "mand"></b></label>
						<input type = "number" class = "form-control" name = "quantity">
					</div>
					<div class="form-group col-md-6">
						<label>Delivery Date : <b class = "mand"></b></label>
						
						<div class="input-group">
							<div class="input-group-addon">
								<div class="input-group-text">
									<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
								</div>
							</div><input class="form-control fc-datepicker datepicker" name="orderdate"  placeholder="MM/DD/YYYY" value = "<?php echo set_value("orderdate"); ?>" type="date" style = "width:100%;">
						</div>
					</div>
					
					<div class="form-group col-md-6">
						<label>Scheme :</label>
						<select class = "form-control" name = "scheme">
										<?php if(!empty($scheme)) {
												foreach($scheme as $ind => $scm) {
												
												$qtytxt = "";
												if($scm->qty > 0){
													$qtytxt = "QTY -";	
												}
												?><option value = "<?php echo $scm->id ?>"><?php echo $qtytxt.$scm->coupan." - ".$scm->discount; ?></option><?php		
												}	
											} ?>
										
										</select>
					
					</div>
					<div class="form-group col-md-6">
						<label>Discount :</label>
						<input type="number" class="form-control" name="discount" placeholder="Enter Discount" value="<?php echo set_value("discount"); ?>" required>
					</div>	
					<div class="form-group col-md-6">
						<label>Price :</label>
						<input type="number" class="form-control" name="price" placeholder="Enter Price" value="<?php echo set_value("price"); ?>" required>
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
							<textarea class="form-control" name = "details"><?php echo set_value("details"); ?></textarea>
						</div>
				<!--	<div class="form-group col-md-6 prod-details">
							<label>Old order : <b class = "mand"></b></label>
							<input type = "text" name = "prod_order" id ="prod-order" class="form-control" readonly>
						</div> -->
						<div class = "row">
				
					
					
				
						<div class = "form-group text-center">
							<br />
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